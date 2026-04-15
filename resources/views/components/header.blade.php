<nav class="navbar navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">@yield('title')</span>

        <div class="d-flex align-items-center gap-3">
            <span>
                {{ auth()->user()->role?->name }}
            </span>

            {{-- Logout --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>
