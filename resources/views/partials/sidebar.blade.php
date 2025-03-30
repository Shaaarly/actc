<div class="d-flex flex-column sidebar-fixed">
    <ul class="nav flex-column gap-2">
        <!-- Dashboard -->
        <li class="nav-item">
            <a 
                href="{{ route('dashboard') }}" 
                class="mt-3 nav-link sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-home"></i> Dashboard
            </a>
        </li>

        <!-- Alquileres -->
        <li class="nav-item">
            <a 
                href="{{ route('leases') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-building-user"></i> Alquileres
            </a>
        </li>

        <!-- Usuarios -->
        <li class="nav-item">
            <a 
                href="{{ route('users.index') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-user"></i> Usuarios
            </a>
        </li>

        <!-- Propiedades -->
        <li class="nav-item">
            <a 
                href="{{ route('properties') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-building"></i> Propiedades
            </a>
        </li>

        <!-- Contabilidad -->
        <li class="nav-item">
            <a 
                href="{{ route('finances') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-money-bill-trend-up"></i> Contabilidad
            </a>
        </li>

        <!-- Pagos -->
        <li class="nav-item">
            <a 
                href="{{ route('payments') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-dollar-sign"></i> Pagos
            </a>
        </li>

        <!-- Contratos -->
        <li class="nav-item">
            <a 
                href="{{ route('contracts') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-file-signature"></i> Contratos
            </a>
        </li>

        <!-- Facturas -->
        <li class="nav-item">
            <a 
                href="{{ route('bills') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-file-invoice-dollar"></i> Facturas
            </a>
        </li>

        <!-- Logs -->
        <li class="nav-item">
            <a 
                href="{{ route('logs') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-list"></i> Logs
            </a>
        </li>
    </ul>
</div>
