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

    public function tablaProveedores(){
         $proveedores = Proveedor::all();
        return view('backend.proveedor.tablaproveedores', compact('proveedores'));
    }
}
