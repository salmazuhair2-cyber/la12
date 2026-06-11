<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{{ config('app.name') }}</title>
<link rel="stylesheet" href="{{ asset('web/css/style.css') }}?v={{ time() }}">

<!--Render All Element Normally-->
<link rel="stylesheet" href="{{asset('web/CSS/normalize.css')}}" />
<!-- Webfont library -->
<link rel="stylesheet" href="{{asset('web/CSS/all.min.css') }} " />
<!-- Google font link -->
<link rel="preconnect" href="https://fonts.googleapis.com" />

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Concert+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
  rel="stylesheet" />
<script
  src="https://kit.fontawesome.com/c1a12a9bed.js"
  crossorigin="anonymous"></script>
<!-- Bootstrap link -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
  rel="stylesheet" />


<style>
  .alert {
    background-color: #ffebee;
    color: #d32f2f;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid #ef9a9a;
    border-radius: 4px;
  }

  .alert ul {
    margin: 0;
    padding-left: 20px;
  }

  .alert li {
    margin: 5px 0;
  }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<script>
  document.addEventListener("DOMContentLoaded", function() {

    let modal = document.querySelector('.modal-overlay');
    let loginLink = document.querySelector('.login-link');
    let registerLink = document.querySelector('.register-link');
    let close = document.querySelector('.close-icon');


    registerLink.onclick = () => {
      modal.classList.add('active');
    };


    loginLink.onclick = () => {
      modal.classList.remove('active');
    };

    close.onclick = () => {
      modal.classList.remove('active');
      history.back();
    };
  });
</script>
</head>

<body>
  <!-- Start Login -->
  <div class="login-page">
    <span class="close-icon">&times;</span>
    <div class="modal-overlay">
      <span class="bg-animate"></span>
      <span class="bg-animate2"></span>
      <div class="form-box login ">
        <h2 class="animation" style="--i:0; --j:20;">Log In</h2>
        <form action="{{ route('customer.authenticate') }}" method="POST">
          @csrf
          @if ($errors->any())
          <div class="alert">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="input-box animation" style="--i:1; --j:21;">
            <input type="email" name="email" value="{{ old('email') }}" required>
            <span class="icon"><i class="fas fa-envelope"></i>
            </span>
            <label for="">Email</label>
          </div>
          <div class="input-box animation" style="--i:2; --j:22;">
            <input type="password" name="password" required>
            <span class="icon"><i class="fas fa-lock"></i>
            </span>
            <label for="">Password</label>
          </div>
          <div class="remember animation " style="--i:3; --j:23;">
            <label for=""> <input type="checkbox" name="remember">Remember Me </label>
            <a href="#">Forgot your password?</a>
          </div>
          <button type="submit" class="login-btn animation" style="--i:4; --j:24;">Log In</button>
          <div class="login-register animation" style="--i:5; --j:25;">
            <p>Don't Have An Account?<a href="javascript:;" class="register-link ">Sign Up</a></p>
          </div>
        </form>
      </div>
      <div class="info-text login ">
        <h2 class="animation" style="--i:0; --j:20;">Welcome Back!</h2>
        <p class="animation" style="--i:1; --j:21;"> We're glad to see you again. Please enter your login details to access your account and enjoy our services.</p>
      </div>

      <div class="form-box register">
        <h2 class="animation " style="--i:17;--j:0; margin-top:-35px;">Sign Up</h2>
        <form action="{{ route('customer.register') }}" method="POST">
          @csrf
          @if ($errors->any())
          <div class="alert">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="input-box animation" style="--i:18; --j:1;">
            <input type="text" name="name" value="{{ old('name') }}" required>
            <span class="icon"><i class="fas fa-user"></i>
            </span>
            <label for="">Full Name</label>
          </div>
          <div class="input-box animation" style="--i:19; --j:2;">
            <input type="email" name="email" value="{{ old('email') }}" required>
            <span class="icon"><i class="fas fa-envelope"></i>
            </span>
            <label for="">Email</label>
          </div>
          <div class="input-box animation" style="--i:20; --j:3;">
            <input type="password" name="password" required>
            <span class="icon"><i class="fas fa-lock"></i>
            </span>
            <label for="">Password</label>
          </div>
          <div class="input-box animation" style="--i:21; --j:4;">
            <input type="password" name="password_confirmation" required>
            <span class="icon"><i class="fas fa-lock"></i>
            </span>
            <label for="">Confirm Password</label>
          </div>
          <div class="remember animation" style="--i:22; --j:5;">
            <label for=""> <input type="checkbox" name="terms" required>Agree To The Terms & Account</label>

          </div>
          <button type="submit" class="login-btn animation" style="--i:23; --j:6;">Register</button>
          <div class="login-register animation" style="--i:23; --j:6;">
            <p>Already Have An Account?<a href="javascript:;" class="login-link ">Log In</a></p>
          </div>
        </form>
      </div>
      <div class="info-text register">
        <h2 class="animation" style="--i:17; --j:0;">Welcome to Our Community!</h2>
        <p class="animation" style="--i:18; --j:1;"> Join us now and enjoy a unique experience. Register your account to get the latest tips,
          products</p>
      </div>
    </div>
  </div>


  <!-- End Login -->
  <script src="{{ asset('js/loading.js') }}"></script>

  <script src="{{ asset('js/main.js') }}" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    $(document).ready(function() {
      toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "timeOut": "3000",
      };
      // Login Form Submit
      $(".form-box.login form").on("submit", function(e) {
        e.preventDefault();
        let $form = $(this);
        $.ajax({
          type: $form.attr("method"),
          url: $form.attr("action"),
          data: $form.serialize(),
          success: function(response) {
            toastr.success("Login successful");
            setTimeout(() => {
              window.location.href = "{{ route('website.index') }}";
            }, 2000);
          },
          error: function(xhr) {
            toastr.error("Login failed. Please check your credentials.");
          }
        });
      });

      // Register Form Submit
      $(".form-box.register form").on("submit", function(e) {
        e.preventDefault();
        let $form = $(this);
        $.ajax({
          type: $form.attr("method"),
          url: $form.attr("action"),
          data: $form.serialize(),
          success: function(response) {
            toastr.success("Registration successful!");
            setTimeout(() => {
              window.location.href = "{{ route('website.index') }}"; // Change to your target URL
            }, 2000);
          },
          error: function(xhr) {
            toastr.error("Registration failed. Please check your info.");
          }
        });
      });
    });
  </script>

</body>

</html>