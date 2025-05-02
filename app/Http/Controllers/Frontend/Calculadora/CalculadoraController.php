<?php

namespace App\Http\Controllers\Frontend\Calculadora;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    /**
     * Mostrar la vista del formulario.
     */
    public function index()
    {
        return view('frontend.calculadora.vistacalculadora');
    }

    /**
     * Procesar la solicitud del formulario y consumir el servicio SOAP.
     */
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'numero1' => 'required|numeric',
            'numero2' => 'required|numeric',
            'operacion' => 'required|in:add,multiply',
        ]);

        $numero1 = $request->input('numero1');
        $numero2 = $request->input('numero2');
        $operacion = $request->input('operacion');

        // Crear cliente SOAP
        $client = new \SoapClient("http://www.dneonline.com/calculator.asmx?WSDL");

        try {
            if ($operacion === 'add') {
                $params = ['intA' => $numero1, 'intB' => $numero2];
                $response = $client->Add($params);
                $resultado = $response->AddResult;
            } else {
                $params = ['intA' => $numero1, 'intB' => $numero2];
                $response = $client->Multiply($params);
                $resultado = $response->MultiplyResult;
            }

            // Retornar la vista con el resultado
            return view('frontend.calculadora.vistacalculadora', compact('resultado', 'numero1', 'numero2', 'operacion'));

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al conectar con el servicio SOAP: ' . $e->getMessage()]);
        }
    }

    // Otros métodos no usados por ahora
    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}

