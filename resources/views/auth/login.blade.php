<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 400px;">
            <div class="card-body">

                <h4 class="text-center mb-4">Login</h4>

                {{-- Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ url('postlog') }}">
                    @csrf

                    {{-- Username --}}
                    <div class="mb-3">
                        <label class="form-label">Username / Email / Phone</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                            required>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                👁️
                            </button>
                        </div>
                    </div>

                    {{-- Role Dropdown --}}
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="superadmin">Admin</option>
                            <option value="Manager HRD">Manajer HRD</option>
                            <option value="Admin HRD">Staf HRD</option>
                        </select>
                    </div>

                    {{-- CAPTCHA --}}
                    <div class="mb-3">
                        <label class="form-label">Captcha</label>

                        {{-- Tampilkan captcha --}}
                        <div class="row align-items-center mb-3">

                            <!-- CAPTCHA -->
                            <div class="col-md-4 mb-2 mb-md-0">
                                <strong class="bg-secondary text-white px-3 py-2 rounded d-block text-center">
                                    {{ session('captcha') }}
                                </strong>
                            </div>

                            <!-- INPUT -->
                            <div class="col-md-8">
                                <input type="text" name="captcha" class="form-control" placeholder="Masukkan captcha"
                                    required>
                            </div>

                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                    {{-- Button --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
    function togglePassword() {
        let input = document.getElementById('password');

        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>

</html>
