<?php

namespace App\Http\Controllers\Backend\Proveedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    public function index()
    {
        return view('backend.proveedor.index');
    }

    // Vista parcial de la tabla
    public function tablaProveedores()
    {
        $proveedores = Proveedor::all();
        return view('backend.proveedor.tablaproveedores', compact('proveedores'));
    }

    // Guardar nuevo proveedor
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'empresa' => 'required|string|max:100',
            'contacto' => 'required|email|max:255',
            'rol' => 'required|in:Mayorista,Minotario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validación fallida',
                'errors' => $validator->errors()
            ]);
        }

        try {
            Proveedor::create([
                'nombre' => $request->nombre,
                'empresa' => $request->empresa,
                'contacto' => $request->contacto,
                'rol' => $request->rol,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar proveedor',
                'error' => $e->getMessage()
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Proveedor creado exitosamente.']);
    }


    // Eliminar proveedor
    public function destroy(Request $request)
    {
        $proveedor = Proveedor::find($request->id);

        if (!$proveedor) {
            return response()->json(['success' => false, 'mensaje' => 'El proveedor no fue encontrado.']);
        }

        $proveedor->delete();

        return response()->json(['success' => true, 'mensaje' => 'El proveedor fue eliminado con éxito.']);
    }

    // Ver detalle
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('backend.proveedor.show', compact('proveedor'));
    }
}
