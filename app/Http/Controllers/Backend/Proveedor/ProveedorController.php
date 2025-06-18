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
            'clasificacion' => 'required|in:Mayorista,Minorista',
            'productos' => 'required|string|max:255',
            'activo' => 'required|in:0,1',

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
                'clasificacion' => $request->clasificacion,
                'productos' => $request->productos,
                'activo' => $request->activo,
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

    //==============================================================
    //== INICIO: CÓDIGO PARA LA EDICIÓN
    //==============================================================

    /**
     * Obtiene los datos de un proveedor específico para la edición.
     * Devuelve los datos en formato JSON para ser usados en un formulario de edición.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return response()->json(['success' => false, 'message' => 'Proveedor no encontrado.']);
        }

        // Devuelve los datos del proveedor en formato JSON
        return response()->json(['success' => true, 'proveedor' => $proveedor]);
    }

    /**
     * Actualiza un proveedor existente en la base de datos.
     * Recibe los datos vía AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // La validación es similar a la del método store
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'empresa' => 'required|string|max:100',
            'contacto' => 'required|email|max:255',
            'clasificacion' => 'required|in:Mayorista,Minorista',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validación fallida',
                'errors' => $validator->errors()
            ]);
        }

        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['success' => false, 'message' => 'Proveedor no encontrado.']);
        }

        try {
            $proveedor->update([
                'nombre' => $request->nombre,
                'empresa' => $request->empresa,
                'contacto' => $request->contacto,
                'clasificacion' => $request->clasificacion,
            ]);

            $proveedor->refresh();

            return response()->json([
            'success' => true,
            'message' => 'Proveedor actualizado exitosamente.',
            'proveedor' => $proveedor // 🔥 Este es clave para que JS lo use
        ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el proveedor',
                'error' => $e->getMessage()
            ]);
        }

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
