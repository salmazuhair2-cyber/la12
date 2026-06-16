<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ config('app.name') }} - Login</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/c1a12a9bed.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('web/CSS/all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('web/css/auth.css') }}?v={{ time() }}">
</head>

<body>

  <div class="auth-page">

    {{-- LEFT --}}
    <div class="auth-left light" id="authLeft">
      <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      <div class="blob blob-3"></div>
      <div class="brand">
        <span class="brand-name">
          <span class="brand-dot"></span>
          <img src="{{ asset('assets/images/logo2.png') }}" alt="logo" class="brand-logo">

        </span>
      </div>
      <div class="left-title" id="leftTitle">Welcome Back!</div>
      <div class="divider-line"></div>
      <p class="left-sub" id="leftSub">Sign in to explore our latest collection and track your orders.</p>
    </div>

    {{-- RIGHT --}}
    <div class="auth-right">
      <div class="tabs">
        <button class="tab-btn active" id="tab-login" onclick="switchTab('login')">Sign In</button>
        <button class="tab-btn" id="tab-register" onclick="switchTab('register')">Create Account</button>
      </div>

      {{-- LOGIN FORM --}}
      <div class="form-section active" id="form-login">
        @if ($errors->any() && old('_form') == 'login')
        <div class="error-box">
          <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('customer.authenticate') }}" method="POST">
          @csrf
          <input type="hidden" name="_form" value="login">

          <div class="field">
            <label>Email address</label>
            <div class="field-wrap">
              <i class="fas fa-envelope f-icon"></i>
              <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
            </div>
          </div>

          <div class="field">
            <label>Password</label>
            <div class="field-wrap">
              <i class="fas fa-lock f-icon"></i>
              <input type="password" name="password" id="loginPass" placeholder="••••••••" required>
              <button type="button" class="eye-toggle" onclick="togglePass('loginPass', this)">
                <i class="fas fa-eye-slash"></i>
              </button>
            </div>
          </div>

          <div class="row-flex">
            <label class="remember-label">
              <input type="checkbox" name="remember" style="accent-color:#ff3496;"> Remember me
            </label>
            <a href="#" class="forgot-link">Forgot password?</a>
          </div>

          <button type="submit" class="btn-submit">Sign In</button>

          <div class="or-sep">or continue with</div>
          <div class="social-btns">
            <button type="button" class="social-btn"><i class="fab fa-google"></i> Google</button>
            <button type="button" class="social-btn"><i class="fab fa-facebook-f"></i> Facebook</button>
          </div>
        </form>
      </div>

      {{-- REGISTER FORM --}}
      <div class="form-section" id="form-register">
        @if ($errors->any() && old('_form') == 'register')
        <div class="error-box">
          <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('customer.register') }}" method="POST">
          @csrf
          <input type="hidden" name="_form" value="register">

          <div class="field">
            <label>Full Name</label>
            <div class="field-wrap">
              <i class="fas fa-user f-icon"></i>
              <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required>
            </div>
          </div>

          <div class="field">
            <label>Email address</label>
            <div class="field-wrap">
              <i class="fas fa-envelope f-icon"></i>
              <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
            </div>
          </div>

          <div class="field">
            <label>Password</label>
            <div class="field-wrap">
              <i class="fas fa-lock f-icon"></i>
              <input type="password" name="password" id="regPass" placeholder="••••••••" required>
              <button type="button" class="eye-toggle" onclick="togglePass('regPass', this)">
                <i class="fas fa-eye-slash"></i>
              </button>
            </div>
          </div>

          <div class="field">
            <label>Confirm Password</label>
            <div class="field-wrap">
              <i class="fas fa-lock f-icon"></i>
              <input type="password" name="password_confirmation" id="regPassConfirm" placeholder="••••••••" required>
              <button type="button" class="eye-toggle" onclick="togglePass('regPassConfirm', this)">
                <i class="fas fa-eye-slash"></i>
              </button>
            </div>
          </div>

          <div class="field" style="margin-bottom:1.5rem;">
            <label class="terms-label">
              <input type="checkbox" name="terms" required style="accent-color:#ff3496; margin-top:3px;">
              I agree to the <a href="#">Terms & Conditions</a>
            </label>
          </div>

          <button type="submit" class="btn-submit">Create Account</button>
        </form>
      </div>

    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    @if(old('_form') == 'register')
    switchTab('register');
    @endif

    function switchTab(tab) {
      const left = document.getElementById('authLeft');
      const title = document.getElementById('leftTitle');
      const sub = document.getElementById('leftSub');
      const tabLogin = document.getElementById('tab-login');
      const tabReg = document.getElementById('tab-register');
      const fLogin = document.getElementById('form-login');
      const fReg = document.getElementById('form-register');

      if (tab === 'register') {
        left.classList.replace('light', 'dark');
        title.textContent = 'Join Us!';
        sub.textContent = 'Create your account and start shopping today.';
        tabLogin.classList.remove('active');
        tabReg.classList.add('active');
        fLogin.classList.remove('active');
        fReg.classList.add('active');
      } else {
        left.classList.replace('dark', 'light');
        title.textContent = 'Welcome Back!';
        sub.textContent = 'Sign in to explore our latest collection and track your orders.';
        tabReg.classList.remove('active');
        tabLogin.classList.add('active');
        fReg.classList.remove('active');
        fLogin.classList.add('active');
      }
    }

    function togglePass(inputId, btn) {
      const input = document.getElementById(inputId);
      const icon = btn.querySelector('i');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      } else {
        input.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      }
    }

    @if(session('success'))
    toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: "toast-bottom-right",
      timeOut: 3000
    };
    toastr.success("{{ session('success') }}");
    @endif
  </script>

</body>

</html>