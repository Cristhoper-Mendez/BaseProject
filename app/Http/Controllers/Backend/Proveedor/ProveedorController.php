<?php

namespace App\Http\Controllers\Backend\Proveedor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function index()
    {
        return view('backend.proveedor.index');
    }

    public function tablaProveedores()
    {
        $proveedores = Proveedor::all();
        return view('backend.proveedor.tablaproveedores', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:proveedors,email',
        ]);

        Proveedor::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);

        return response()->json(['message' => 'Proveedor creado']);
    }
    public function destroy(Request $request)
{
    $proveedor = Proveedor::find($request->id);

    if (!$proveedor) {
        return response()->json(['success' => false, 'mensaje' => 'El proveedor no fue encontrado.']);
    }

    $proveedor->delete();

    return response()->json(['success' => true, 'mensaje' => 'El proveedor fue eliminado con éxito.']);
}
public function show($id)
{
    $proveedor = Proveedor::findOrFail($id);
    return view('backend.proveedor.show', compact('proveedor'));
}


}

