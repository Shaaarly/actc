@if ($errors->any())
    <div class="mt-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading text-warning">¡Error!</h4>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
@if(session('success'))
    <div class="mt-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading text-success">¡Conseguido!</h4>
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="mt-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading text-warning">¡Error!</h4>
            <p>{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif