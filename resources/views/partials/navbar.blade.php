@if (Auth::check())
<div class="d-flex" id="wrapper">
    <!-- Barra Lateral -->
    <div class="bg-dark text-light sidebar shadow-lg p-3 d-flex flex-column vh-100 position-fixed" id="sidebar">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-white">📱 Admin Panel</h4>
            <p class="text-muted">Bienvenido/a, {{ Auth::user()->name }}</p>
        </div>
        <ul class="navbar-nav flex-column gap-2 flex-grow-1">
            <!-- Opciones del menú para usuarios con rol 'admin' -->
            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="{{ route('ordenes.index') }}">
                        <i class="fas fa-plus-circle me-2"></i> ordenes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="{{ route('register') }}">
                        <i class="fas fa-users me-2"></i> Gestión de Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="#">
                        <i class="fas fa-cogs me-2"></i> Configuración
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="{{ route('ventas.create') }}">
                        <i class="fas fa-plus-circle me-2"></i> Venta
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="{{ route('facturas.create') }}">
                        <i class="fas fa-plus-circle me-2"></i> Factura
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="{{ route('proveedores.index') }}">
                        <i class="fas fa-plus-circle me-2"></i> proveedores
                    </a>
                </li>
                <li class="nav-item dropdown position-relative">
                    <a class="nav-link text-light d-flex align-items-center" href="#" id="accesoriosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-box-open me-2"></i> Accesorios
                    </a>
                    <ul class="dropdown-menu custom-dropdown-menu position-absolute start-100 top-0 mt-0 ms-2" aria-labelledby="accesoriosDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('accesorios.index') }}">
                                <i class="fas fa-list me-2"></i> Lista de Accesorios
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('accesorios.create') }}">
                                <i class="fas fa-plus-circle me-2"></i> Agregar Accesorio
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('categorias.index') }}">
                                <i class="fas fa-tags me-2"></i> Categorías de Accesorios
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('categorias.create') }}">
                                <i class="fas fa-plus-circle me-2"></i> Agregar Categoría
                            </a>
                        </li>
                    </ul>
                </li>
                
            @elseif (Auth::user()->role == 'user')
                <!-- Opciones del menú para usuarios con rol 'user' -->
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="#">
                        <i class="fas fa-user me-2"></i> Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="#">
                        <i class="fas fa-life-ring me-2"></i> Soporte
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light d-flex align-items-center" href="{{ route('ventas.create') }}">
                        <i class="fas fa-plus-circle me-2"></i> Agregar Venta
                    </a>
                </li>
            @endif
            <!-- Opción para cerrar sesión (disponible para todos) -->
            <li class="nav-item mt-auto">
                <a href="{{ route('logout') }}" class="nav-link text-danger d-flex align-items-center"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
@endif
