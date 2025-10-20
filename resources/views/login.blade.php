<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow-lg border-0 rounded-4" style="max-width: 400px; width: 100%;">
    <div class="card-body p-4">
      <h3 class="text-center mb-4 fw-bold">Login</h3>

      <form action="{{ url('user/login') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="remember" name="remember">
          <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary btn-lg">Login</button>
        </div>
      </form>

      <p class="text-center mt-3 mb-0">
        Don't have an account? 
        <a href="{{ url('/register') }}" class="text-decoration-none fw-semibold">Register</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
