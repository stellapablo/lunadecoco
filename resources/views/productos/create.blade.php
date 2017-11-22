@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">Productos</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">

                        @include('flash::message')


                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @include('layouts.flash')
                        <form action="{{ route('productos.store') }}" enctype="multipart/form-data"  method="POST" >
                            {{ csrf_field() }}
                            <div class="form-body">
                                <h3 class="box-title">Datos de consultas</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nombre</label>
                                            {!! Form::text('nombre', null, ['class' => 'form-control'])!!}
                                        </div>
                                    </div>

                                    <script type="text/javascript">
                                        (function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
                                    </script>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Precio</label>
                                            {!! Form::text('precio', null, ['class' => 'form-control'])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Tipo de producto</label>
                                            {!! Form::select('tipo_id', $tipos ,  null, ['class' => 'form-control col-sm-4'])!!}
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label class="control-label">Descripcion</label>
                                        <div>
                                            {{ Form::textarea('descripcion',null,['class'=>'form-control','rows'=>'5']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Imagen:</label>
                                            <div class="input-group">
                                                {!! Form::file('imagen', null, ['class' => 'form-control'])!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Guardar</button>
                                </div>
                                <div id="contInputs">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @endsection
        @section('scripts.footer')
            <link href="{{ url('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')  }}" rel="stylesheet" />
            <script src="{{ url('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
            <script>

                $("#fecha_documento").datepicker(
                    { dateFormat: 'dd/mm/yy' }
                );

                Dropzone.options.addDoc = {
                    paramName: 'file',
                    addRemoveLinks: true,
                    maxFiles: 2,
                    dictDefaultMessage: 'Arrastre el documento que desea guardar',
                    dictCancelUpload: true,
                    dictRemoveFile: 'Eliminar',
                    // The setting up of the dropzone
                    init: function () {
                        var i = 0;
                        var fileList = new Array;
                        this.on("success", function (file, serverFileName) {
                            //fileList[file.name] = file.name;
                            //console.log(serverFileName);
                            //var obj = JSON.parse(serverFileName);
                            //console.log(serverFileName); // <---- here is your filename

                            $("#contInputs").append('<input type="hidden" name="valor[' + serverFileName + ']" id="valor[' + serverFileName + ']" value="' + serverFileName + '"  > ');

                        });
                        this.on("removedfile", function (file) {
                            //console.log(file.xhr.responseText);
                            var valor = document.getElementById('valor[' + file.xhr.responseText + ']');
                            valor.remove();
                            //$('valor['+file.name+']').remove();
                            $.ajax({
                                type: 'POST',
                                url: 'upload/delete',
                                data: {file: file.xhr.responseText, _token: $("input[name=_token]").val()},
                                dataType: 'html',
                                success: function (data) {
                                }
                            });

                        });
                    },
                    error: function (file, response) {
                        if ($.type(response) === "string")
                            var message = response; //dropzone sends it's own error messages in string
                        else
                            var message = response.message;
                        file.previewElement.classList.add("dz-error");
                        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                        _results = [];
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            node = _ref[_i];
                            _results.push(node.textContent = message);
                        }
                        return _results;
                    },
                }
            </script>
@endsection