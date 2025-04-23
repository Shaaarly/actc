<div class="d-flex flex-column sidebar-fixed">
    <ul class="nav flex-column gap-1">
        <!-- Dashboard -->
        <li class="nav-item">
            <a 
                href="{{ route('dashboard') }}" 
                class="mt-3 nav-link sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>
        </li>

        <!-- Alquileres -->
        <li class="nav-item">
            <a 
                href="{{ route('leases.index') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('leases.index') ? 'active' : '' }}"
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
                href="{{ route('properties.index') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('properties.index') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-building"></i> Propiedades
            </a>
        </li>

        <!-- Pagos -->
        <li class="nav-item">
            <a 
                href="{{ route('payments') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('payments') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-dollar-sign"></i> Pagos
            </a>
        </li>

        <!-- Gastos -->
        <li class="nav-item">
            <a 
                href="{{ route('expenses') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('expenses') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-chart-simple"></i> Gastos
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

        <!-- Seguros -->
        <li class="nav-item">
            <a 
                href="{{ route('insurances') }}" 
                class="nav-link sidebar-link {{ request()->routeIs('settings') ? 'active' : '' }}"
            >
            <i class="fa-solid fa-handshake"></i> Insurances
            </a>
        </li>
    </ul>
</div>
