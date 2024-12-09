@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Agregar Nueva Venta</h4>
                </div>
                <div class="card-body">
                    <!-- Formulario para agregar una venta -->
                    <form action="{{ route('ventas.store') }}" method="POST">
                        @csrf
                    
                        <!-- Autocompletar Accesorio -->
                        <div class="mb-3 position-relative">
                            <label for="accesorio" class="form-label">Accesorio</label>
                            <input type="text" class="form-control" id="accesorio" placeholder="Buscar accesorio por nombre">
                            <input type="hidden" name="accesorio_id" id="accesorio_id">
                            <div id="accesorio-list" class="list-group position-absolute"></div>
                        </div>
                    
                        <!-- Cantidad -->
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" id="cantidad" value="1" min="1" required>
                            @error('cantidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" id="precio" value="" step="0.01" placeholder="Ingresa el precio">
                        
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    
                        <!-- Autocompletar Cliente -->
                        <div class="mb-3 position-relative">
                            <label for="cliente" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="cliente" placeholder="Buscar cliente por nombre o DNI">
                            <input type="hidden" name="cliente_id" id="cliente_id">
                            <div id="cliente-list" class="list-group position-absolute"></div>
                        </div>
                    
                        <!-- Botones -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Agregar Venta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de error de stock -->
@if(session('showModal'))
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">Error de Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('modalMessage') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Autocompletar accesorio
    const accesorioInput = document.getElementById('accesorio');
    const accesorioList = document.getElementById('accesorio-list');

    accesorioInput.addEventListener('input', function () {
        const query = this.value;
        if (query.length > 2) {
            fetch(`/accesorios/search?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    accesorioList.innerHTML = '';

                    // Encontrar el accesorio con el menor ID
                    const minIdAccesorio = data.reduce((prev, curr) => (prev.id < curr.id ? prev : curr), data[0]);

                    // Mostrar solo el accesorio con el menor ID
                    const option = document.createElement('a');
                    option.classList.add('list-group-item', 'list-group-item-action');
                    option.textContent = `${minIdAccesorio.nombre}`;
                    option.dataset.id = minIdAccesorio.id;
                    option.dataset.precio = minIdAccesorio.precio_venta;
                    accesorioList.appendChild(option);
                });
        }
    });

    accesorioList.addEventListener('click', function (event) {
    if (event.target.tagName === 'A') {
        accesorioInput.value = event.target.textContent;
        document.getElementById('accesorio_id').value = event.target.dataset.id;
        // No establecer el precio automáticamente
        accesorioList.innerHTML = '';
    }
});


    // Autocompletar cliente
    const clienteInput = document.getElementById('cliente');
    const clienteList = document.getElementById('cliente-list');
    clienteInput.addEventListener('input', function () {
        const query = this.value;
        if (query.length > 2) {
            fetch(`/clientes/search?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    clienteList.innerHTML = '';

                    data.forEach(item => {
                        const option = document.createElement('a');
                        option.classList.add('list-group-item', 'list-group-item-action');
                        option.textContent = `${item.nombre} (DNI: ${item.dni})`;
                        option.dataset.id = item.id;
                        clienteList.appendChild(option);
                    });
                });
        }
    });

    clienteList.addEventListener('click', function (event) {
        if (event.target.tagName === 'A') {
            clienteInput.value = event.target.textContent;
            document.getElementById('cliente_id').value = event.target.dataset.id;
            clienteList.innerHTML = '';
        }
    });
});

</script>
@endsection
