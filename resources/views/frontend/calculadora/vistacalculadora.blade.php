<!DOCTYPE html>
<html lang="es">

<head>
    <title>Calculadora</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/login/bootstrap.min.css') }}">
    <link href="{{ asset('images/icono-sistemalogo.png') }}" rel="icon">
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 30rem;">
            <div class="card-body">

                <div class="container mt-5">
                    <h2 class="mb-4">Calculadora</h2>

                    <!-- Mostrar errores -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Formulario -->
                    <form method="POST" action="{{ route('calculadora.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="numero1" class="form-label">Ingrese el primer numero</label>
                            <input type="number" class="form-control" id="numero1" name="numero1" required>
                        </div>

                        <div class="mb-3">
                            <label for="numero2" class="form-label">Ingrese el segundo numero</label>
                            <input type="number" class="form-control" id="numero2" name="numero2" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Seleccione la operación</label>
                            <select class="form-control" name="operacion" required>
                                <option value="add">Suma</option>
                                <option value="multiply">Multiplicación</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Calcular</button>
                    </form>

                    <!-- Mostrar resultado -->
                    @isset($resultado)
                    <div class="alert alert-success mt-4">
                        <strong>Resultado:</strong> {{ $numero1 }}
                        {{ $operacion == 'add' ? '+' : '×' }}
                        {{ $numero2 }} = <strong>{{ $resultado }}</strong>
                    </div>
                    @endisset
                </div>

                <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
                <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
                <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
                <script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
                <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>

            </div>
        </div>
</body>

</html>