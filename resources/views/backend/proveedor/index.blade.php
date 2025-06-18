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
                                        id="empresa-nuevo" placeholder="Empresa">
                                </div>

                                <div class="form-group">
                                    <label>Contacto</label>
                                    <input type="text" maxlength="255" autocomplete="off" class="form-control"
                                        id="contacto-nuevo" placeholder="Correo Electronico">
                                </div>

                                <div class="form-group">
                                    <label style="color:#191818">Clasificacion</label>
                                    <br>
                                    <div>
                                        <select class="form-control" id="rol-nuevo">
                                            <option value="null" selected disabled>Seleccione una opcion</option>
                                            <option value="Mayorista">Mayorista</option>
                                            <option value="Minorista">Minorista</option>
                                        </select>
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label>Productos</label>
                                            <input type="text" maxlength="255" autocomplete="off" class="form-control"
                                           id="productos-nuevo" placeholder="Ej: Frutas, Lácteos, Abarrotes">
                               </div>

                               <div class="form-group">
                                     <label>¿Activo?</label>
                                      <select class="form-control" id="activo-nuevo">
                                     <option value="1" selected>Sí</option>
                                    <option value="0">No</option>
                                      </select>
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
                    onclick="nuevoProveedor()">Guardar</button>
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

    <script>
  function borrar(idproveedor) {
            Swal.fire({
                title: '¿Estás seguro que deseas eliminar este proveedor?',
                text: "Esta accion sera irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    openLoading()

                    var formData = new FormData();
                    formData.append('idproveedor', idproveedor);

                    axios.post(url + '/admin/proveedores/eliminar', formData, {})
                        .then((response) => {
                            closeLoading()
                            $('#modalBorrar').modal('hide');

                            if (response.data.success === 1) {
                                toastr.success('Proveedor eliminado');
                                recargar();
                            } else {
                                toastr.error('Error al eliminar');
                            }
                        })
                        .catch((error) => {
                            closeLoading();
                            toastr.error('Error al eliminar');
                        });
                }
            });
        }
</script>


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

<script>
    function nuevoProveedor() {
    let nombre = document.getElementById('nombre-nuevo').value.trim();
    let empresa = document.getElementById('empresa-nuevo').value.trim();
    let contacto = document.getElementById('contacto-nuevo').value.trim();
    let clasificacion = document.getElementById('rol-nuevo').value;
    let productos = document.getElementById('productos-nuevo').value.trim();
    let activo = document.getElementById('activo-nuevo').value;


    if (!nombre || !empresa || !contacto || !clasificacion || !productos) {
        toastr.error('Debe completar todos los campos');
        return;
    }

    let formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('empresa', empresa);
    formData.append('contacto', contacto);
    formData.append('clasificacion', clasificacion);
    formData.append('productos', productos); 
    formData.append('activo', activo);


    axios.post("{{ url('admin/proveedores/store') }}", formData)
        .then(response => {
            if (response.data.success) {
                toastr.success('Proveedor guardado exitosamente');
                $('#modalAgregar').modal('hide');
                $('#tablaDatatable').load("{{ URL::to('admin/proveedores/tabla') }}");
            } else {
                toastr.error(response.data.message || 'Error al guardar');
            }
        })
        .catch(error => {
            toastr.error('Error al guardar proveedor');
        });
}

</script>



@stop
