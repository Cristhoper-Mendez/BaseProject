<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleXMLElement;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    public function mostrarLibros()
    {
         // Ruta correcta al archivo XML con separador de directorios adecuado
    $xmlFile = storage_path('xml/libros.xml'); // Aquí 'app/xml' se refiere a storage/app/xml

    if (file_exists($xmlFile)) {
        // Cargar el archivo XML
        $xml = simplexml_load_file($xmlFile);
        
        // Convertir a JSON
        $json = json_encode($xml);
        
        // Devolver como JSON a la vista
        return view('preferencias', ['librosJson' => $json]);
    } else {
        return response()->json(['error' => 'Archivo no encontrado'], 404);
    }
    }
}