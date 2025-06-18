<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="tabla" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 6%">ID</th>
                                    <th style="width: 10%">Nombre</th>
                                    <th style="width: 10%">Empresa</th>
                                    <th style="width: 10%">Contacto</th>
                                    <th style="width: 8%">Clasificacion</th>
                                    <th style="width: 8%">Productos</th>
                                    <th style="width: 8%">Activo</th>
                                    <th style="width: 20%">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proveedores as $dato)
                                <tr id="fila-{{ $dato->id }}">
                                    <td>{{ $dato->id }}</td>
                                    <td>{{ $dato->nombre }}</td>
                                    <td>{{ $dato->empresa }}</td>
                                    <td>{{ $dato->contacto }}</td>
                                    <td>{{ $dato->clasificacion }}</td>
                                    <td>{{ $dato->productos }}</td>


                                    <td>
                                        @if($dato->activo == 0)
                                        <span class="badge bg-danger">Inactivo</span>
                                        @else
                                        <span class="badge bg-success">Activo</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.proveedores.show', $dato->id) }}" class="btn btn-sm btn-info" title="Ver Detalle">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>

                                        <button type="button" class="btn btn-sm btn-primary" onclick="verInformacion({{ $dato->id }})">
                                            <i class="fas fa-pencil-alt" title="Editar"></i> Editar
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger" onclick="eliminarProveedor({{ $dato->id }})">
                                            <i class="fas fa-trash-alt" title="Eliminar"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Aquí empieza la nueva tabla integrada --}}
                        <table class="table table-bordered table-striped mt-4">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Empresa</th>
                                    <th>Contacto</th>
                                    <th>Clasificacion</th>
                                    <th>Productos</th>
                                    <th>Activo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proveedores as $proveedor)
                                <tr id="fila-secundaria-{{ $proveedor->id }}">
                                    <td>{{ $proveedor->nombre }}</td>
                                    <td>{{ $proveedor->empresa }}</td>
                                    <td>{{ $proveedor->contacto }}</td>
                                    <td>{{ $proveedor->clasificacion }}</td>
                                    <td>{{ $proveedor->productos }}</td>
                                    <td>
                                        @if($dato->activo == 0)
                                        <span class="badge bg-danger">Inactivo</span>
                                        @else
                                        <span class="badge bg-success">Activo</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Fin nueva tabla --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar proveedor -->
    <div class="modal fade" id="modalEditarProveedor" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="formEditarProveedor">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Proveedor</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editar-id">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" id="editar-nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Empresa</label>
                            <input type="text" id="editar-empresa" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="email" id="editar-contacto" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Clasificacion</label>
                            <select name="clasificacion" id="editar-clasificacion" class="form-control" required>
                                <option value="Mayorista">Mayorista</option>
                                <option value="Minorista">Minorista</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Productos</label>
                            <input type="text" id="editar-productos" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select id="editar-activo" class="form-control" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>

{{-- DataTables --}}
<script>
    $(function() {
        $("#tabla").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pagingType: "full_numbers",
            lengthMenu: [
                [10, 25, 50, 100, 150, -1],
                [10, 25, 50, 100, 150, "Todo"]
            ],
            language: {
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ registros",
                sZeroRecords: "No se encontraron resultados",
                sEmptyTable: "Ningún dato disponible en esta tabla",
                sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                sSearch: "Buscar:",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior"
                },
                oAria: {
                    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            },
            responsive: true,
        });
    });

    // Eliminar proveedor
    function eliminarProveedor(id) {
        if (confirm('¿Deseas eliminar este proveedor?')) {
            $.ajax({
                url: '{{ route('
                proveedores.destroy ') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        $('#fila-' + id).remove();
                        alert('Proveedor eliminado exitosamente.');
                    } else {
                        alert('Ocurrió un error al eliminar el proveedor.');
                    }
                },
                error: function(xhr) {
                    alert('Error al procesar la solicitud.');
                }
            });
        }
    }

    // Obtener información y abrir modal
    function verInformacion(id) {
        $.get("/proveedores/" + id + "/edit", function(data) {
            if (data.success) {
                $('#editar-id').val(data.proveedor.id);
                $('#editar-nombre').val(data.proveedor.nombre);
                $('#editar-empresa').val(data.proveedor.empresa);
                $('#editar-contacto').val(data.proveedor.contacto);
                $('#editar-clasificacion').val(data.proveedor.clasificacion);
                $('#editar-productos').val(data.proveedor.productos);
                $('#editar-activo').val(data.proveedor.activo);
                $('#modalEditarProveedor').modal('show');
            } else {
                alert('Proveedor no encontrado.');
            }
        });
    }

    // Guardar cambios del proveedor
    $('#formEditarProveedor').submit(function(e) {
        e.preventDefault();

        let id = $('#editar-id').val();
        let data = {
            nombre: $('#editar-nombre').val(),
            empresa: $('#editar-empresa').val(),
            contacto: $('#editar-contacto').val(),
            clasificacion: $('#editar-clasificacion').val(),
            productos: $('#editar-productos').val(),
            activo: $('#editar-activo').val(),
            _token: '{{ csrf_token() }}',
            _method: 'PUT' // Importante: decirle a Laravel que es un PUT
        };

        $.ajax({
            url: "/proveedores/" + id,
            method: "POST", // AJAX manda POST, pero _method lo convierte en PUT
            data: data,
            success: function(response) {
                if (response.success) {
                    $('#modalEditarProveedor').modal('hide');
                    alert('Proveedor actualizado correctamente.');

                    let fila = $('#fila-' + id);
                    fila.find('td').eq(1).text(response.proveedor.nombre);
                    fila.find('td').eq(2).text(response.proveedor.empresa);
                    fila.find('td').eq(3).text(response.proveedor.contacto);
                    fila.find('td').eq(4).text(response.proveedor.clasificacion);
                    fila.find('td').eq(5).text(response.proveedor.productos); // ✅ ¡aquí se actualiza correctamente!
                    let estadoHTML = (response.proveedor.activo == 1) ?
                        '<span class="badge bg-success">Activo</span>' :
                        '<span class="badge bg-danger">Inactivo</span>';
                    fila.find('td').eq(6).html(estadoHTML);

                    let filaSec = $('#fila-secundaria-' + id);
                    filaSec.find('td').eq(0).text(response.proveedor.nombre);
                    filaSec.find('td').eq(1).text(response.proveedor.empresa);
                    filaSec.find('td').eq(2).text(response.proveedor.contacto);
                    filaSec.find('td').eq(3).text(response.proveedor.clasificacion);
                    filaSec.find('td').eq(4).text(response.proveedor.productos);
                    let estadoHTML2 = (response.proveedor.activo == 1) ?
                        '<span class="badge bg-success">Activo</span>' :
                        '<span class="badge bg-danger">Inactivo</span>';
                    filaSec.find('td').eq(5).html(estadoHTML2);
                } else {
                    alert('Error: ' + response.message);
                }
            }
        });
    });
</script>