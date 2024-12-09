@extends('layouts.app')

@section('title', 'Editar Accesorio')

@section('content')
<div class="container col-md-10 bg-white p-4 shadow-sm rounded">
    <h1>Editar Accesorio</h1>
    <form action="{{ route('accesorios.update', $accesorio) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $accesorio->nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" name="categoria" class="form-control" value="{{ $accesorio->categoria }}" required>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="{{ $accesorio->cantidad }}" min="0" required>
        </div>
        <div class="mb-3">
            <label for="precio_compra" class="form-label">Precio de Compra</label>
            <input type="number" name="precio_compra" class="form-control" value="{{ $accesorio->precio_compra }}" min="0" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="precio_venta" class="form-label">Precio de Venta</label>
            <input type="number" name="precio_venta" class="form-control" value="{{ $accesorio->precio_venta }}" min="0" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $accesorio->descripcion }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
