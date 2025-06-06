@extends('layouts.app')

@section('content')
    <h1>Crear Proveedor</h1>

    <form id="formProveedor">
        @csrf
        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <button type="submit">Guardar</button>
    </form>

    <div id="mensaje"></div>

    <script>
        document.getElementById('formProveedor').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('{{ route('proveedores.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: new URLSearchParams(new FormData(this))
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('mensaje').innerText = "Proveedor guardado con éxito";
            })
            .catch(error => {
                document.getElementById('mensaje').innerText = "Error al guardar el proveedor";
            });
        });
    </script>
@endsection

