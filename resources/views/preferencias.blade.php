<!-- resources/views/preferencias.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table thead th {
            background-color: #0d6efd;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4 text-center text-primary">📚 Lista de Libros</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Año</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $libros = json_decode($librosJson, true);
                    @endphp

                    @foreach($libros['libro'] as $libro)
                        <tr>
                            <td>{{ $libro['id'] }}</td>
                            <td>{{ $libro['titulo'] }}</td>
                            <td>{{ $libro['autor'] }}</td>
                            <td>{{ $libro['anio'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>