<?php

namespace App\Http\Controllers;

use App\Compra;
use App\Http\Requests\ProductosFormRequest;
use App\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SantiGraviano\LaravelMercadoPago\Facades\MP;

class ProductosController extends Controller
{


    public function index(){

        $productos = Producto::all();

        return view('productos.index',compact('productos'));
    }

    public function create(){

        $tipos = ['1'=>'A pedido','2'=>'En stock'];


        return view('productos.create',compact('tipos'));
    }

    public function store(ProductosFormRequest $request){

        $file = $this->storeFile($request);

        $doc = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'tipo_id' => $request->tipo_id,
            'slug' => str_slug($request->nombre),
            'url' => str_slug($request->nombre),
            'imagen' => $file,

        ]);


        flash()->success('Producto cargado con exito!');

        return back();
    }

    public function storeFile(Request $request)
    {

        $imageName = time().'.'.$request->imagen->getClientOriginalExtension();

        $request->imagen->move(public_path('images'), $imageName);

        return $imageName;
    }

    public function edit(Producto $producto){

        $tipos = ['1'=>'A pedido','2'=>'En stock'];

        return view('productos.edit',compact('producto','tipos'));
    }

    public function update(ProductosFormRequest $request, $id){

        if($request->imagen){

            $file = $this->storeFile($request);

        }else{

            $file = Producto::find($id)->imagen;
        }

        $doc = Producto::where('id',$id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'tipo_id' => $request->tipo_id,
            'slug' => str_slug($request->nombre),
            'url' => str_slug($request->nombre),
            'imagen' => $file,
        ]);

        flash()->success('Producto actualizado!');

        return back();
    }

    public function delete($id){

        Producto::find($id)->delete();

        flash()->success('Producto Eliminado');

        return back();

    }


    public function compras(Request $request){

        dd($request->all());
    }

    public function mercadoLibre(){

        $mp = new \MP ("TEST-7139380895739250-111306-b6cdb2c8d97a8e3d41de32b4b7f912db__LA_LB__-45656683");

        $preference_data = array (

        );

        //$preference = $mp->create_preference($preference_data);

        $mp->post (
            array(
                "uri" => "/v1/payments",
                "data" => []
            )
        );

    }

    public function getCreatePreference(Compra $compra)
    {
        $producto = Producto::find($compra->producto_id);


    }
    public function getJson(){

        //return Producto::select('nombre','email')->get();

        return DB::table('productos')->select('nombre','email')->get();

        $users = DB::connection('general')->table("productos")->get();

    }

    public function getJsonPedido(){

        return Producto::where('tipo_id','=','1')->get();

    }

    public function getJsonStock(){

        return Producto::where('tipo_id','=','2')->get();

    }

    public function msgExito(){
        return view('messages.exito');
    }

    public function getCompra($slug){

        $producto = Producto::where('slug','=',$slug)->first();

        if (!isset($producto->id)){
            return abort(404);
        }

        return view('compra.checkout_compra',compact('producto'));
    }

    public function procesarPago(Request $request){


        $compra = Compra::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'email' => $request->correo,
            'cantidad' => $request->cantidad,
            'telefono' => $request->telefono,
            'producto_id' => $request->id_producto  ,
            'entregaInicio' => $request->entregaInicio,
            'entregaFinal' => $request->entregaFinal,
            'pedido_id' => $request->pedido_id
        ]);

        $producto = Producto::find($compra->producto_id);

        if($request->pedido_id == 1){

            $preferenceData = [
                'items' => [
                    [
                        'category_id' => 'Tortas',
                        'title' => $producto->nombre,
                        'description' => $producto->descripcion,
                        'id' => $compra->id,
                        'picture_url' => 'http://admin.lunadecocoonline.com/images/' . $producto->imagen,
                        'quantity' => (int)$compra->cantidad,
                        'currency_id' => 'ARS',
                        'unit_price' => (int)$producto->precio
                    ]
                ],
                'back_urls' => [
                    'success'=>'https://admin.lunadecocoonline.com/compras/exito',
                    'pending'=>'',
                    'failure'=>'https://admin.lunadecocoonline.com/',

                ],
            ];

            $preference = MP::create_preference($preferenceData);



            //guardar referencia ID de compra en Mercado Libre
            $compra->ml_id = $preference['response']['collector_id'];
            $compra->save();


            return redirect($preference['response']['init_point']);

            //Entregado
            //Enviado
            //Finalizado
        }else{

            return view('messages.exito');
        }
    }

    public function getPayments(){

        $mp = new \SantiGraviano\LaravelMercadoPago\MP("8042725785968357", "c6XW77VKSqMeg6LSLtUEV8RytAk1uEn3");

        //http_response_code(200,'Ok');

        response('The resource is created successfully, 200');

        if (!isset($_GET["id"], $_GET["topic"]) || !ctype_digit($_GET["id"])) {
            http_response_code(400);
            return;
        }

        // Get the payment and the corresponding merchant_order reported by the IPN.
        if($_GET["topic"] == 'payment'){
            $payment_info = $mp->get("/collections/notifications/" . $_GET["id"]);
            $merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["collection"]["merchant_order_id"]);

        // Get the merchant_order reported by the IPN.
        } else if($_GET["topic"] == 'merchant_order'){
            $merchant_order_info = $mp->get("/merchant_orders/" . $_GET["id"]);
        }

        if ($merchant_order_info["status"] == 200) {
            // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
            $paid_amount = 0;

            foreach ($merchant_order_info["response"]["payments"] as  $payment) {
                if ($payment['status'] == 'approved'){
                    $paid_amount += $payment['transaction_amount'];
                }
            }

            if($paid_amount >= $merchant_order_info["response"]["total_amount"]){
                if(count($merchant_order_info["response"]["shipments"]) > 0) { // The merchant_order has shipments
                    if($merchant_order_info["response"]["shipments"][0]["status"] == "ready_to_ship"){
                        print_r("Totally paid. Print the label and release your item.");
                    }
                } else { // The merchant_order don't has any shipments
                    print_r("Totally paid. Release your item.");
                }
            } else {
                print_r("Not paid yet. Do not release your item.");
            }
        }

        http_response_code(200,'Ok');

    }


}


