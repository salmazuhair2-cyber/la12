<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ config('app.name') }} - Admin Login</title>
  <link rel="stylesheet" href="{{ asset('assets/CSS/normalize.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/CSS/all.min.css') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300..700&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/c1a12a9bed.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{ asset('web/css/auth.css') }}?v={{ time() }}">


</head>

<body>

  <div class="admin-auth-page">
    <div class="admin-left">
      <div class="blob b1"></div>
      <div class="blob b2"></div>
      <div class="blob b3"></div>

      <div class="shield-icon">
        <i class="fas fa-shield-alt"></i>
      </div>
      <h2>Admin Panel</h2>
      <div class="bar"></div>
      <p>Secure access for authorized administrators only.</p>
      <div class="restricted-badge">RESTRICTED ACCESS</div>
    </div>

    <div class="admin-right">
      <div class="admin-right-head">
        <h3>Sign in to dashboard</h3>
        <p>Enter your credentials to continue</p>
      </div>

      @if ($errors->any())
      <div class="error-box">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('admin.authenticate') }}" method="POST">
        @csrf

        <div class="a-field">
          <label>Email Address</label>
          <div class="a-field-wrap">
            <i class="fas fa-envelope"></i>
            <input type="email"
              name="email"
              value="{{ old('email') }}"
              placeholder="admin@example.com"
              required>
          </div>
        </div>

        <div class="a-field">
          <label>Password</label>
          <div class="a-field-wrap">
            <i class="fas fa-lock"></i>
            <input type="password"
              name="password"
              id="adminPass"
              placeholder="••••••••"
              required>
            <button type="button" class="eye-btn" onclick="togglePass()">
              <i class="fas fa-eye-slash" id="eyeIcon"></i>
            </button>
          </div>
        </div>

        <div class="a-row">
          <label class="a-remember">
            <input type="checkbox" name="remember" style="accent-color:#3b6cb7;"> Remember me
          </label>
          <a href="#" class="a-forgot">Forgot password?</a>
        </div>

        <button type="submit" class="a-btn">
          <i class="fas fa-sign-in-alt"></i>
          Sign in to dashboard
        </button>
      </form>

      <div class="a-footer-note">
        Protected area — unauthorized access is prohibited
      </div>
    </div>
  </div>

  <script>
    function togglePass() {
      const input = document.getElementById('adminPass');
      const icon = document.getElementById('eyeIcon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      } else {
        input.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      }
    }
  </script>

</body>

</html>