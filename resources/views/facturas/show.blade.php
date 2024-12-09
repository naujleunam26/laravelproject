@extends('layouts.app')

@section('content')
<div class="container col-md-8 bg-white p-4 shadow-sm rounded">
    <h1>Detalles de Factura</h1>
    <div class="card">
        <div class="card-header">
            <h4>Factura #{{ $factura->numero_factura }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Proveedor:</strong> {{ $factura->proveedor->nombre }}</p>
            <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
            <p><strong>Total:</strong> ${{ number_format($factura->total, 2) }}</p>
            
            <h5>Productos</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factura->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->accesorio->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
