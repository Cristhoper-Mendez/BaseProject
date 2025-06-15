@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
@stop

<div class="container py-4">
    <h4 class="mb-4 text-center">🌤️ Pronóstico del clima (5 días)</h4>
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="city" class="form-control" placeholder="Ej. San Salvador, Los Angeles, etc.">
                <button class="btn btn-primary" onclick="getForecast()">Buscar</button>
            </div>
        </div>
    </div>
    <div class="row" id="result"></div>
</div>

@extends('backend.menus.footerjs')
@section('archivos-js')
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
    .sunny {
        animation: pulse 2s infinite;
        filter: drop-shadow(0 0 10px gold);
    }
    .rainy::before {
        content: "🌧️";
        font-size: 3rem;
        animation: rain 1s infinite;
        display: block;
    }
    .stormy::before {
        content: "⛈️";
        font-size: 3rem;
        animation: flash 0.7s infinite;
        display: block;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    @keyframes rain {
        0% { transform: translateY(0); opacity: 1; }
        100% { transform: translateY(10px); opacity: 0.3; }
    }
    @keyframes flash {
        0% { opacity: 1; }
        50% { opacity: 0.3; }
        100% { opacity: 1; }
    }

    .clima-card {
    min-height: 350px;
    max-height: 350px;
    }
</style>
<script>
    const apiKey = '4be1c4b8f311a60bfd04bcfc2df4a99f'; // API Key de OpenWeatherMap

    function getAnimationClass(description) {
        description = description.toLowerCase();
        if (description.includes('tormenta')) return 'stormy';
        if (description.includes('lluvia')) return 'rainy';
        if (description.includes('nubes')) return '';
        if (description.includes('despejado')) return 'sunny';
        return '';
    }

    async function getForecast() {
        const city = document.getElementById('city').value.trim();
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = '';

        if (!city) {
            resultDiv.innerHTML = '<div class="alert alert-warning">Por favor, escribe una ciudad.</div>';
            return;
        }

        try {
            const res = await axios.get('https://api.openweathermap.org/data/2.5/forecast', {
                params: {
                    q: city,
                    appid: apiKey,
                    units: 'metric',
                    lang: 'es'
                }
            });

            const list = res.data.list;
            const grouped = {};
            list.forEach(item => {
                const date = item.dt_txt.split(' ')[0];
                const hour = item.dt_txt.split(' ')[1];
                if (hour === '12:00:00' && !grouped[date]) {
                    grouped[date] = item;
                }
            });

            const days = Object.values(grouped).slice(0, 5);
            const country = res.data.city.country; // ← Código del país

            days.forEach(item => {
                const date = new Date(item.dt_txt).toLocaleDateString('es-ES', { weekday: 'long', day: 'numeric', month: 'short' });
                const description = item.weather[0].description;
                const icon = item.weather[0].icon;
                const temp = item.main.temp;
                const humidity = item.main.humidity;
                const wind = item.wind.speed;
                const animClass = getAnimationClass(description);

                const card = `
                    <div class="col-md-4 mb-4">
                        <div class="card text-center shadow-sm p-3 h-100 d-flex flex-column justify-content-between clima-card">
                            <h5 class="card-title">${date}</h5>
                            <h6 class="text-muted">${res.data.city.name}, ${country}</h6>
                            <div class="${animClass}">
                                <img src="http://openweathermap.org/img/wn/${icon}@2x.png" alt="clima">
                            </div>
                            <p class="text-capitalize">${description}</p>
                            <p><strong>🌡️ ${temp}°C</strong></p>
                            <p>💧 ${humidity}% | 💨 ${wind} m/s</p>
                        </div>
                    </div>`;
                resultDiv.innerHTML += card;
            });

        } catch (error) {
            console.error(error);
            resultDiv.innerHTML = '<div class="alert alert-danger">No se pudo obtener el clima para esa ciudad.</div>';
        }
    }
</script>