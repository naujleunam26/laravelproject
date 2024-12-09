@extends('layouts.app')

@section('content')
<div class="container col-md-10 bg-white p-4 shadow-sm rounded">
    <h1>Detalle de la Orden #{{ $orden->id }}</h1>
    <p><strong>Cliente:</strong> {{ $orden->cliente->nombre ?? 'N/A' }}</p>
    <p><strong>Modelo:</strong> {{ $orden->modelo_telefono }}</p>
    <p><strong>Marca:</strong> {{ $orden->marca }}</p>
    <p><strong>IMEI:</strong> {{ $orden->imei }}</p>
    <p><strong>Código de Bloque:</strong> {{ $orden->codigo_de_bloque }}</p>
    <p><strong>Problema Reportado:</strong> {{ $orden->problema_reportado }}</p>
    <p><strong>Estado:</strong> {{ $orden->estado }}</p>
    <p><strong>Costo Estimado:</strong> {{ $orden->costo_estimado }}</p>
    <p><strong>Costo Repuestos:</strong> {{ $orden->costo_repuestos }}</p>
    <p><strong>Abono:</strong> {{ $orden->abono }}</p>
    <p><strong>Fecha Ingreso:</strong> {{ $orden->fecha_ingreso }}</p>
    <p><strong>Fecha Entrega:</strong> {{ $orden->fecha_entrega ?? 'No definida' }}</p>
    <p><strong>Registrado por:</strong> {{ $orden->user->name ?? 'N/A' }}</p>
    
    <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Regresar</a>
</div>
@endsection
