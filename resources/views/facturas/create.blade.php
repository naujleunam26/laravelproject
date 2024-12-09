@extends('layouts.app')

@section('content')
<div class="container col-md-8 bg-white p-4 shadow-sm rounded">
    <h1>Nueva Factura</h1>
    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="numero_factura">Número de Factura</label>
            <input type="text" name="numero_factura" class="form-control" value="{{ $nuevoNumeroFactura }}" readonly>
        </div>
        <div class="mb-3">
            <label for="proveedor_id">Proveedor</label>
            <select name="proveedor_id" class="form-select" required>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ now()->toDateString() }}" required>
        </div>
        
        <!-- Accesorios -->
        <div id="accesorios-container">
            <h4>Accesorios</h4>
            <div class="accesorio mb-3 position-relative">
                <label for="accesorio" class="form-label">Buscar Accesorio</label>
                <input type="text" class="form-control autocomplete-accesorio" id="accesorio-0" placeholder="Buscar accesorio por nombre">
                <input type="hidden" name="accesorios[0][accesorio_id]" id="accesorio_id-0">
                <div id="accesorio-list-0" class="list-group position-absolute"></div>
                <input type="number" name="accesorios[0][cantidad]" placeholder="Cantidad" class="form-control mt-2" required>
                <input type="number" name="accesorios[0][precio_unitario]" placeholder="Precio Unitario" class="form-control mt-2" required>
            </div>
        </div>

        <!-- Botón para agregar accesorios -->
        <div class="mb-3">
            <button type="button" id="add-accesorio" class="btn btn-secondary">Agregar Accesorio</button>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Registrar Factura</button>
    </form>
</div>

<!-- JavaScript para agregar accesorios dinámicamente con autocompletado -->
<script>
let accesorioIndex = 1; // Empieza en 1, ya que 0 está en el formulario inicial

document.getElementById('add-accesorio').addEventListener('click', function () {
    const container = document.getElementById('accesorios-container');

    const newAccesorio = document.createElement('div');
    newAccesorio.classList.add('accesorio', 'mb-3', 'position-relative');

    // Usa accesorioIndex aquí
    newAccesorio.innerHTML = `
        <label for="accesorio-${accesorioIndex}" class="form-label">Buscar Accesorio</label>
        <input type="text" class="form-control" id="accesorio-${accesorioIndex}" placeholder="Buscar accesorio por nombre">
        <input type="hidden" name="accesorios[${accesorioIndex}][accesorio_id]" id="accesorio_id-${accesorioIndex}">
        <div id="accesorio-list-${accesorioIndex}" class="list-group position-absolute"></div>
        <input type="number" name="accesorios[${accesorioIndex}][cantidad]" placeholder="Cantidad" class="form-control mt-2" required>
        <input type="number" name="accesorios[${accesorioIndex}][precio_unitario]" placeholder="Precio Unitario" class="form-control mt-2" required>
    `;

    container.appendChild(newAccesorio);

    // Activar autocompletado para el nuevo input
    activateAutocomplete(`accesorio-${accesorioIndex}`, `accesorio_id-${accesorioIndex}`, `accesorio-list-${accesorioIndex}`);
    
    // Luego incrementas
    accesorioIndex++;
});

function activateAutocomplete(inputId, hiddenId, listId) {
    const input = document.getElementById(inputId);
    const list = document.getElementById(listId);

    input.addEventListener('input', function () {
        const query = this.value;
        if (query.length > 2) {
            fetch(`/accesorios/search?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    list.innerHTML = '';
                    data.forEach(item => {
                        const option = document.createElement('a');
                        option.classList.add('list-group-item', 'list-group-item-action');
                        option.textContent = item.nombre;
                        option.dataset.id = item.id;
                        option.addEventListener('click', function () {
                            input.value = item.nombre;
                            document.getElementById(hiddenId).value = item.id;
                            list.innerHTML = ''; // Limpiar la lista después de seleccionar
                        });
                        list.appendChild(option);
                    });
                });
        } else {
            list.innerHTML = ''; // Limpiar la lista si no hay query
        }
    });

    // Cerrar la lista si se hace clic fuera
    document.addEventListener('click', function (event) {
        if (!input.contains(event.target) && !list.contains(event.target)) {
            list.innerHTML = ''; // Limpiar la lista si no es clic en el input ni en la lista
        }
    });
}

// Activar autocompletado para el primer input de forma predeterminada
activateAutocomplete('accesorio-0', 'accesorio_id-0', 'accesorio-list-0');

</script>
@endsection
