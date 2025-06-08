@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
@stop

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Detalle del Proveedor</h4>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $proveedor->nombre }}</p>
            <p><strong>Empresa:</strong> {{ $proveedor->empresa }}</p>
            <p><strong>Contacto:</strong> {{ $proveedor->contacto }}</p>
            <p><strong>Clasificación:</strong> {{ $proveedor->clasificacion }}</p>
            <p><strong>Estado:</strong> 
                @if ($proveedor->activo)
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-danger">Inactivo</span>
                @endif
            </p>
            <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>

@extends('backend.menus.footerjs')
@section('archivos-js')
@stop
