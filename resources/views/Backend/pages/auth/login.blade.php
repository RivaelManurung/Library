<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Form Design | CodeLab</title>
    <link rel="stylesheet" href="{{ asset('assets/backend/css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="wrapper">
        <div class="title">
            Login Form
        </div>

        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ url('/admin/login') }}" method="POST">
            @csrf
            <!-- CSRF Token untuk keamanan -->

            <div class="field">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
                @error('username')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
            </div>

            <div class="field">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
            </div>
            <br>
            <br>

            <div class="field">
                <input type="submit" value="Login">
            </div>
            <div class="signup-link">
                Login as user <a href="{{url('/user/login') }}">Click here</a>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>