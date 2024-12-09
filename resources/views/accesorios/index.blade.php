@extends('layouts.app')

@section('title', 'Inventario de Accesorios')

@section('content')
<div class="container col-md-10 bg-white p-4 shadow-sm rounded">
    <h1>Inventario de Accesorios</h1>
    <a href="{{ route('accesorios.create') }}" class="btn btn-primary mb-3">Agregar Accesorio</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accesorios as $accesorio)
                <tr>
                    <td>{{ $accesorio->nombre }}</td>
                    <td>{{ $accesorio->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>{{ $accesorio->cantidad }}</td>
                    <td>
                        <a href="{{ route('accesorios.edit', $accesorio) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('accesorios.destroy', $accesorio) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
