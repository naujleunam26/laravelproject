@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container col-md-10 bg-white p-4 shadow-sm rounded">
    <h1 class="text-center mb-4">Dashboard</h1>
    <div class="row">
        <!-- Ventas Totales del Mes -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Ventas Totales del Mes</h5>
                    <p class="display-4 text-primary">${{ number_format($totalVentasMes, 2) }}</p>
                </div>
            </div>
        </div>
        <!-- Ventas Diarias -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Ventas Diarias</h5>
                    <p class="display-4 text-success">${{ number_format($totalVentasDiarias, 2) }}</p>
                </div>
            </div>
        </div>
        <!-- Ventas por Usuario -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Ventas por Usuario</h5>
                    <ul class="list-group">
                        @foreach ($ventasPorUsuario as $venta)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $venta->usuario }}
                                <span class="badge bg-primary rounded-pill">${{ number_format($venta->total_ventas, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
