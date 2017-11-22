<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Luna De Coco</title>

    <!-- INICIO ESTILOS BOOSTRAP -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <!-- FINAL ESTILOS BOOSTRAP -->

    <!-- INICIO ESTILOS PROPRIOS-->
    <link rel="stylesheet" href="{{ url('style.css') }}">
    <!-- FINAL ESTILOS PROPIOS -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="http://lunadecocoonline.com/favicon.ico">

</head>
<body>

<div class="container">
    <!-- INICIO HEADER -->
    <div class="header-superior">
        <a href="tel:+5490362154658556">+ 549 0362 154658556</a>
    </div>

    <div class="row">

        <div class="col-lg-4 col-sm-12">
            <a href="http://lunadecocoonline.com">
                <img src="{{ url('img/header-logo.png') }}" class="img-fluid logo" alt="Responsive image"/>
        </div>

        <div class="col-lg-12 col-sm-12">
            <div class="menuLineaSuperio">

                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a href="http://lunadecocoonline.com" class="nav-link disabled menuItem">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link disabled menuItem">CONTACTO</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link disabled">PEDIDO</div>
                        <div class="linea">&nbsp;</div>
                    </li>
                </ul>
            </div>
            <div class="menuLineaInferior"></div>
        </div>
    </div>
    <!-- FINAL HEADER -->

    <div class="menuLineaInferior"></div>

    <!-- INICIO PEDIDO DE PRODUCTO -->

    <br>
    <div class="row">
        <div class="col-12 producto">
            <h1>{{ $producto->nombre }}</h1>
            <h2>PRECIO POR UNIDAD  $ {{ $producto->precio }}</h2>
            <p>{{ $producto->descripcion }}</p>
        </div>
        <div class="col-lg-6 col-sm-12">
            <img src="{{ url('images/'. $producto->imagen) }}" alt="" width="100%">
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="formulario">
                <form action="{{ route('productos.procesar') }}" method="POST" >
                    {{ csrf_field() }}
                    <input type="hidden" name="id_producto" value="{{ $producto->id }}">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Nombre y apellido">
                        <br>
                        <input type="text" class="form-control form-control-lg" id="direccion" name="direccion" placeholder="Dirección de Envío">
                        <br>
                        <input type="text" class="form-control form-control-lg" id="correo" name="correo" placeholder="Correo Electrónico">
                        <br>
                        <input type="text" class="form-control form-control-lg" id="telefono" name="telefono" placeholder="Teléfono">
                        <br>
                        <div class="row">
                            <div class="col-lg-5 col-sm-12 precio">Cantidad</div>
                            <div class="col-lg-7 col-sm-12 ">
                                <input type="text" class="form-control form-control-lg" id="cantidad" name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-5 col-sm-12 hora">Recibirlo entre</div>
                            <div class="col-lg-3  col-sm-3">
                                <select class="form-control" name="entregaInicio" id="entragaInicio">
                                    <option value="07:00">07:00</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-sm-1 hora">y</div>
                            <div class="col-lg-3 col-sm-5">
                                <select class="form-control" name="entregaFinal" id="entragaFinal">
                                    <option value="07:00">07:00</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <h3>Opciones de pago y envío</h3>
                        <select class="form-control" name="pedido_id" id="pedido_id">
                            <option value="1">Pago por internet, envio incluido</option>
                            <option value="2">Pago por Sucursal</option>
                            <option value="3">Pago al delivery</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <strong>GASTOS DE ENVÍO:</strong> $ 40,00
                    </div>
                    <br>
                    <p align="center">
                        <button type="submit" class="btn btn-danger btn-lg">REALIZAR PEDIDO</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <br>

    <!-- FINAL PEDIDO DE PRODUCTO -->

    <!-- INICIO FOOTER -->

    <div class="estiloFooter">
        <div class="row">
            <div class="col-6">
                <strong>© Luna de Coco</strong> and its contents on this site are Registered Trademarks.
                <br>
                <a href="tel:+5490362154658556">+ 549 0362 154658556</a>
            </div>
            <div class="col-6" style="text-align: right">
                <strong>Power by <a href="http://terobit.com" target="_blank">terobit.com</a> <br></strong>
                This site has been developed with free software.
            </div>
        </div>
    </div>
    <br>

    <!-- FINAL FOOTER-->

</div>

</body>
</html>
