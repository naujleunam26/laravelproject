@extends('layouts.app')

@section('content')
<div class="container col-md-8 bg-white p-4 shadow-sm rounded">
    <h1>Proveedores</h1>
    <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-3">Agregar Proveedor</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facturas as $factura)
<tr>
    <td>{{ $factura->id }}</td>
    <td>{{ $factura->numero_factura }}</td>
    <td>{{ $factura->proveedor->nombre }}</td> <!-- Proveedor relacionado -->
    <td>{{ $factura->fecha }}</td>
    <td>${{ number_format($factura->total, 2) }}</td>
    <td>
        <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-sm btn-info">Ver</a>
        <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-sm btn-warning">Editar</a>
        <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
        </form>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>
@endsection
