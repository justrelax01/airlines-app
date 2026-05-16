
@extends('layouts.app')

@section('title', 'Login')

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
            <li>
              <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
              <a href="{{ route('flights') }}">Flights</a>
            </li>
            <li>
              <a href="{{ route('faq-feedback') }}">FaQ & Feedback</a>
            </li>
            <li>
              <a href="#yyy">About</a>
            </li>
            <li>
              <a href="{{ route('login') }}">Login or Register</a>
            </li>
            <li>
              <a href="{{ route('searchflights') }}"><i class="fa-solid fa-magnifying-glass"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </section>

    <div class="background"></div>
    <div class="container">
        <div class="content">
            <h1>Welcome!<br><span>To Our New Website.</span></h1>
            <p>Login or register to continue.</p>
        </div>

        <div class="logreg-box">
            <div class="form-box login">
                <h2>Login</h2>

                @if (session('status'))
                    <div class="message">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <div class="input-box">
                        <input id="email" type="email" name="email" value="{{ old('email') }}">
                        <label for="email">Email</label>
                    </div>

                    <div class="input-box">
                        {{-- ✅ Changed id from "password" to "pass" to match JS --}}
                        <input id="pass" type="password" name="password">
                        <label for="pass">Password</label>
                    </div>

                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        @endif
                    </div>

                    {{-- ✅ Error message divs required by JS --}}
                    <div id="errmessages" class="message"></div>
                    <div id="errmessages1" class="message"></div>
                    <div id="errmessages2" class="message"></div>

                    {{-- ✅ type="button" so JS runs first --}}
                    <button type="button" onclick="submitlogin()" class="bttn">Login</button>

                </form>

                <div class="login-register">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection

