@extends('layouts.app')

@section('title', 'Register')
@section('styles')
 <link rel="stylesheet" href="{{ asset('css/external.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
@section('scripts')
<script>
/* Registration — validates then lets the form POST to the server */
function submitreg() {
  var email = document.getElementById("email").value;
  var pass = document.getElementById("pass").value;
  var fname = document.getElementById("fname-register").value;
  var lname = document.getElementById("lname-register").value;
  var passconfirm = document.getElementById("passcon-register").value;
  var errorMessages = document.getElementById("errmessages");
  var errorMessages1 = document.getElementById("errmessages1");
  var errorMessages2 = document.getElementById("errmessages2");
  
  if (!email || !pass || !fname || !lname || !passconfirm) {
    errorMessages.innerHTML = "All fields are required";
    return;
  }
  var passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,30}$/;
  
  if (!pass.match(passRegex)) {
    errorMessages2.innerHTML = "Password must be 8–30 characters and contain at least one uppercase letter, one lowercase letter, one digit, and one special character (!@#$%^&*()_+)";
    return;
  }
  if (pass !== passconfirm) {
    errorMessages1.innerHTML = "Passwords do not match";
    return;
  }
  errorMessages.innerHTML = "";
  errorMessages1.innerHTML = "";
  errorMessages2.innerHTML = "";
  document.querySelector('form').submit();
}

</script>
@endsection
@section('content')

  <button class="back-btn" onclick="history.back()">← Back</button>


  <div class="reg-background"></div>
  <div class="reg-container">
    <div class="reg-content">
      <h1>Welcome!<br><span>To Our New Website.</span></h1>
      <p>Register to continue.</p>
    </div>

    <div class="reg-logreg-box">
      <div class="reg-form-box">
        <h2>Registration</h2>

        <form method="POST" action="{{ route('register.submit') }}">
          @csrf

          <div class="reg-input-box">
            <input type="text" id="fname-register" name="first_name" value="{{ old('first_name') }}" >
            <label for="fname-register">First name</label>
          </div>

          <div class="reg-input-box">
            <input type="text" id="lname-register" name="last_name" value="{{ old('last_name') }}" >
            <label for="lname-register">Last name</label>
          </div>

          <div class="reg-input-box">
            <input type="email" id="email" name="email" value="{{ old('email') }}" >
            <label for="email">Email</label>
          </div>

          <div class="reg-input-box">
            <input type="password" id="pass" name="password" >
            <label for="pass">Password</label>
          </div>

          

          <div class="reg-input-box">
            <input type="password" id="passcon-register" name="password_confirmation" >
            <label for="passcon-register">Confirm Password</label>
          </div>

          <div id="errmessages1" class="reg-message"></div>
          <div id="errmessages"  class="reg-message"></div>
          <div id="errmessages2" class="reg-message"></div>

          <button type="button" onclick="submitreg()" class="reg-bttn">Register</button>
        </form>

        <div class="reg-login-register">
          <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('scripts')
 <script defer src="{{ asset('js/js.js') }}"></script>
@endsection