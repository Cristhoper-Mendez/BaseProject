@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
@stop

<style>
    table {
        /*Ajustar tablas*/
        table-layout: fixed;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="col-sm-12">
            <h1>Lista de Proveedores</h1>
        </div>
        <br>
        <button type="button" style="font-weight: bold; background-color: #28a745; color: white !important;"
            onclick="modalAgregar()" class="button button-3d button-rounded button-pill button-small">
            <i class="fas fa-pencil-alt"></i>
            Agregar Proveedor
        </button>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Lista</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="tablaDatatable"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalAgregar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario-nuevo">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" maxlength="50" autocomplete="off" class="form-control"
                                        id="nombre-nuevo" placeholder="Nombre">
                                </div>

                                <div class="form-group">
                                    <label>Empresa</label>
                                    <input type="text" maxlength="50" autocomplete="off" class="form-control"
                                        id="empresa-nuevo" placeholder="Usuario">
                                </div>

                                <div class="form-group">
                                    <label>Contacto</label>
                                    <input type="text" maxlength="16" autocomplete="off" class="form-control"
                                        id="contacto-nuevo" placeholder="Contraseña">
                                </div>

                                <div class="form-group">
                                    <label style="color:#191818">Rol</label>
                                    <br>
                                    <div>
                                        <select class="form-control" id="rol-nuevo">
                                            <option value="null" selected disabled>Seleccione una opcion</option>
                                            <option value="Mayorista">Mayorista</option>
                                            <option value="Mayorista">Minotario</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" style="font-weight: bold; background-color: #28a745; color: white !important;"
                    class="button button-3d button-rounded button-pill button-small"
                    onclick="nuevoUsuario()">Guardar</button>
            </div>
        </div>
    </div>
</div>

@extends('backend.menus.footerjs')
@section('archivos-js')

    <script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

    <!-- incluir tabla -->
    <script type="text/javascript">
        $(document).ready(function() {
            var ruta = "{{ URL::to('admin/proveedores/tabla') }}";
            $('#tablaDatatable').load(ruta);
            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>

    <script>
        function modalAgregar(){
            document.getElementById("formulario-nuevo").reset();
            $('#modalAgregar').modal('show');
        }
    </script>
@stop
