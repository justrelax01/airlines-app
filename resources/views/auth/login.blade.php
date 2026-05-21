@extends('layouts.app')

@section('title', 'Login')
@section('styles')
 <link rel="stylesheet" href="{{ asset('css/external.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
@section('content')

  <button class="back-btn" onclick="history.back()">← Back</button>

  <section class="nav-bar">
    <div class="nav-container">
      <div class="brand">
        <a href="{{ route('home') }}" style="font-weight:700;font-size:1.2rem;color:#2563eb;text-decoration:none;">SkyWings</a>
      </div>
      <nav>
        <div class="nav-mobile">
          <a id="nav-toggle" href="#!"><span class="material-icons"></span></a>
        </div>
        <ul class="nav-list selected">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('flights') }}">Flights</a></li>
          <li><a href="{{ route('faq-feedback') }}">FaQ & Feedback</a></li>
          <li><a href="#yyy">About</a></li>
          <li><a href="{{ route('login') }}">Login or Register</a></li>
          <li><a href="{{ route('searchflights') }}"><i class="fa-solid fa-magnifying-glass"></i></a></li>
        </ul>
      </nav>
    </div>
  </section>

  <div class="lr-background"></div>
  <div class="lr-container">
    <div class="lr-content">
      <h1>Welcome!<br><span>To Our New Website.</span></h1>
      <p>Login or register to continue.</p>
    </div>

    <div class="lr-logreg-box">
      <div class="lr-form-box">
        <h2>Login</h2>

        @if (session('status'))
          <div class="lr-message">{{ session('status') }}</div>
        @endif

       <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="lr-input-box">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            <label for="email">Email</label>
          </div>

          <div class="lr-input-box">
            <input id="pass" type="password" name="password" required>
            <label for="pass">Password</label>
          </div>

          <div class="lr-remember-forgot">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              Remember me
            </label>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">Forgot your password?</a>
            @endif
          </div>

          <div id="errmessages"  class="lr-message"></div>
          <div id="errmessages1" class="lr-message"></div>
          <div id="errmessages2" class="lr-message"></div>

          <button type="button" onclick="submitlogin()" class="lr-bttn">Login</button>
        </form>

        <div class="lr-login-register">
          <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script>
function submitlogin() {
    var email = document.getElementById("email").value;
    var pass = document.getElementById("pass").value;
    var errorMessages = document.getElementById("errmessages");
    var errorMessages1 = document.getElementById("errmessages1");
    if (!email || !pass) { errorMessages.innerHTML = "All fields are required"; return; }
    if (!email.includes("@")) { errorMessages1.innerHTML = "Email should contain @"; return; }
    errorMessages.innerHTML = "";
    errorMessages1.innerHTML = "";
    document.querySelector('form').submit();
}
</script>
 <script defer src="{{ asset('js/js.js') }}"></script>
@endsection