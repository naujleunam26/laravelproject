@extends('layouts.app')

@section('content')
<div class="container col-md-10 bg-white p-4 shadow-sm rounded">
    <h1>Órdenes de Servicio</h1>
    <a href="{{ route('ordenes.create') }}" class="btn btn-primary mb-3">Crear Orden</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ordenes as $orden)
            <tr>
                <td>{{ $orden->id }}</td>
                <td>{{ $orden->cliente->nombre ?? 'N/A' }}</td>
                <td>{{ $orden->modelo_telefono }}</td>
                <td>{{ $orden->marca }}</td>
                <td>{{ $orden->estado }}</td>
                <td>
                    <a href="{{ route('ordenes.show', $orden->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('ordenes.edit', $orden->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('ordenes.destroy', $orden->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Desea eliminar esta orden?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
