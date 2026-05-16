<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    
    <!-- Using asset() assumes external.css is inside your public/ folder -->
    <link rel="stylesheet" href="{{ asset('css/external.css') }}">
</head>
<body>
    
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
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/flights') }}">Flights</a></li>
                    <li><a href="{{ url('/faq-feedback') }}">FaQ & Feedback</a></li>
                    <li><a href="#yyy">About</a></li>
                    <li><a href="{{ url('/login') }}">Login or Register</a></li>
                    <li>
                        <a href="{{ url('/search-flights') }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
      
    <div class="backgroundd"></div>
    <div class="containerr">
        <div class="content">
            <div class="text">
                <h1>Welcome!<br><span>To Our New Website.</span></h1>
                <p>Register to continue....</p>
            </div>

            <div class="logreg-box">
                <div class="form-box login">
                    
                    <!-- Changed <div> to a proper <form> element -->
                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf {{-- Crucial for Laravel security against CSRF attacks --}}

                        <h2>Registration</h2>


                        <div class="input-box">
                            <!-- Added 'name' attribute so Laravel backend can read the data -->
                            <input type="text" id="fname-register" name="first_name" value="{{ old('first_name') }}" >
                            <label for="fname-register">First name</label>
                        </div>

                        <div class="input-box">
                            <input type="text" id="lname-register" name="last_name" value="{{ old('last_name') }}" >
                            <label for="lname-register">Last name</label>
                        </div>

                        <div class="input-box">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" >
                            <label for="email">Email</label>
                        </div>

                        <div class="input-box">
                            <input type="password" id="pass" name="password" >
                            <label for="pass">Password</label>
                        </div>
                        
                        <div id="errmessages2" class="message"></div>

                        <div class="input-box">
                            <input type="password" id="passcon-register" name="password_confirmation" >
                            <label for="passcon-register">Confirm Password</label>
                        </div>
                        
                        <div id="errmessages1" class="message"></div><br>
                        <div id="errmessages" class="message"></div>
                        
                        <!-- Fixed button hierarchy. Removed empty <a> tag -->
                        <button onclick="submitreg()" type="button" class="bttn">Register</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
  
    <!-- Assumes js.js is inside your public/ folder -->
   <script src="{{ asset('js/js.js') }}"></script>
</body>
</html>