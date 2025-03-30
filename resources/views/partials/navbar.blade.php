<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top top-bar">
  <div class="container">

      {{-- Logo + Título --}}
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
          {{-- Reemplaza con tu propio logo si lo deseas --}}
          <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="30" height="30" class="me-2">
      </a>

      {{-- Texto descriptivo de la página actual --}}
      <span class="ms-3 text-muted">
          @yield('page-title', 'Página Actual')
      </span>

      {{-- Botón toggler para pantallas pequeñas --}}
      <button 
          class="navbar-toggler" 
          type="button" 
          data-bs-toggle="collapse" 
          data-bs-target="#navbarContent"
          aria-controls="navbarContent" 
          aria-expanded="false" 
          aria-label="Toggle navigation"
      >
          <span class="navbar-toggler-icon"></span>
      </button>

      {{-- Menú desplegable --}}
      <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
              
              {{-- Enlace a Inicio --}}
              <li class="nav-item">
                  <a class="nav-link" href="{{ url('/') }}">Inicio</a>
              </li>
              
              @auth
                  {{-- Enlace a Perfil si está logueado --}}
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('profile') }}">Perfil</a>
                  </li>
                  @if (Route::has('logout'))
                    {{-- Botón de Logout --}}
                    <li class="nav-item ms-2">
                        <a class="btn btn-outline-danger" href="{{ route('logout') }}">Logout</a>
                    </li>
                  @endif
              @else
                @if (Route::has('login'))
                    {{-- Botón de Login si NO está logueado --}}
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
              @endauth

              {{-- Botón Modo Claro/Oscuro --}}
              <li class="nav-item ms-2">
                <button class="btn btn-secondary" id="toggleMode" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cambiar a modo oscuro">
                  <i class="fa-solid fa-moon"></i>
                  {{-- <i class="fa-solid fa-sun"></i> --}}
              </button>
              </li>
          </ul>
      </div>
  </div>
</nav>
