@extends('layouts.app')

@section('title', 'Agregar Accesorio')

@section('content')
<div class="container col-md-8 bg-white p-4 shadow-sm rounded">
    <h1>Agregar Accesorio</h1>
    <form action="{{ route('accesorios.store') }}" method="POST">
        @csrf
        <!-- Nombre -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <!-- Categoría -->
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Código de Factura -->
        <div class="mb-3">
            <label for="codigo_factura" class="form-label">Código de Factura</label>
            <input type="text" name="codigo_factura" class="form-control">
        </div>

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
