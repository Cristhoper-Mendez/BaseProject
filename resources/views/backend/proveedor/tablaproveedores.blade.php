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
                                    <th style="width: 8%">Clasificación</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- DataTables --}}
<script>
    $(function () {
        $("#tabla").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pagingType: "full_numbers",
            lengthMenu: [[10, 25, 50, 100, 150, -1], [10, 25, 50, 100, 150, "Todo"]],
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
                url: '{{ route('proveedores.destroy') }}',
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
</script>

