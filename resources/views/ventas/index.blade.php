@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
<div class="container d-flex justify-content-center my-5"> <!-- Centra el contenedor -->
    <div class="col-md-10 bg-white p-4 shadow-sm rounded"> <!-- Ajusta el ancho y añade estilos de tarjeta -->
        <h1 class="text-center mb-4">Ventas</h1> <!-- Centra el título y ajusta el margen inferior -->
        
        <div class="d-flex justify-content-end mb-3"> <!-- Ajusta el botón a la derecha -->
            <a href="{{ route('ventas.create') }}" class="btn btn-primary">Registrar Venta</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <table class="table table-hover table-bordered text-center"> <!-- Centra el contenido de la tabla -->
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Valor Venta</th>
                    <th>Valor Compra</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->accesorio->nombre ?? 'Producto no encontrado' }}</td>
                        <td>${{ number_format($venta->precio) }}</td>
                        <td>${{ number_format($venta->valor_compra) }}</td>
                        <td>{{ $venta->fecha->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
