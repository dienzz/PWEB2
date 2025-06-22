<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badai GYM - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh; 
            margin: 0; 
            padding: 0; 
        }
    </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-md-5"> 
                        <h2 class="card-title text-center mb-4">Login Badai GYM</h2>

                        @if(session('error'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}"> 
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required autofocus>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>