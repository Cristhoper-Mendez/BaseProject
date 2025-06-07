@extends('backend.template.app')

@section('main-content')
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
@endsection
