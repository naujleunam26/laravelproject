@extends('layouts.app')

@section('content')
    <h1>Crear Orden de Servicio</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ordenes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control">
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="modelo_telefono">Modelo del Teléfono</label>
            <input type="text" name="modelo_telefono" class="form-control" value="{{ old('modelo_telefono') }}">
        </div>
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" name="marca" class="form-control" value="{{ old('marca') }}">
        </div>
        <div class="form-group">
            <label for="imei">IMEI</label>
            <input type="text" name="imei" class="form-control" value="{{ old('imei') }}">
        </div>
        <div class="form-group">
            <label for="codigo_de_bloque">Código de Bloque</label>
            <input type="text" name="codigo_de_bloque" class="form-control" value="{{ old('codigo_de_bloque') }}">
        </div>
        <div class="form-group">
            <label for="problema_reportado">Problema Reportado</label>
            <textarea name="problema_reportado" class="form-control">{{ old('problema_reportado') }}</textarea>
        </div>
        <div class="form-group">
            <label for="costo_estimado">Costo Estimado</label>
            <input type="number" step="0.01" name="costo_estimado" class="form-control" value="{{ old('costo_estimado') }}">
        </div>
        <div class="form-group">
            <label for="costo_repuestos">Costo Repuestos</label>
            <input type="number" step="0.01" name="costo_repuestos" class="form-control" value="{{ old('costo_repuestos') }}">
        </div>
        <div class="form-group">
            <label for="abono">Abono</label>
            <input type="number" step="0.01" name="abono" class="form-control" value="{{ old('abono', 0) }}">
        </div>
        <div class="form-group">
            <label for="fecha_entrega">Fecha de Entrega (opcional)</label>
            <input type="datetime-local" name="fecha_entrega" class="form-control" value="{{ old('fecha_entrega') }}">
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control">
                <option value="pendiente" {{ old('estado', 'pendiente') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="completado" {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                <option value="cancelado" {{ old('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
@endsection
