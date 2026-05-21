@extends('layouts.app')

@section('title', 'Home - Airlines')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/external.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .class1 { width: 100%; height: 100%; margin: auto; }
    .photo {
        width: 100%; min-height: 100vh; margin: auto;
        background-image: url("/images/plane.jpg");
        background-size: cover; background-position: center;
        position: relative; display: table;
    }
    .paraphoto { max-width: 450px; min-width: 320px; width: 100%; margin: auto; text-align: center; display: table-cell; vertical-align: middle; }
    .paraphoto h1 { font-family: "Century Gothic", sans-serif; color: white; font-size: 50px; }
    .paraphoto a { color: white; font-family: "Century Gothic", sans-serif; text-decoration: none; border: 2px solid white; border-radius: 5px; padding: 10px 20px; font-weight: bold; }
    .paraphoto a:hover { color: rgb(0, 200, 255); border: 2px solid rgb(0, 200, 255); }
</style>
@endsection

@section('content')

<button id="scrollTopBtn"><i class="fa-solid fa-arrow-up"></i></button>
<button class="back-btn" onclick="history.back()">← Back</button>

<div id="top" class="class1">
    <section class="photo">
        <div class="paraphoto">
            <h1>Travel With Us</h1>
            <a href="{{ route('flights') }}">GET STARTED</a>
        </div>
    </section>
</div>

<section>
    <div class="Flights" id="ttt">
        <h1 class="ppp">lets tour the world</h1>
    </div>
    <div class="slider">
        <div class="slides">
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">
            <input type="radio" name="radio-btn" id="radio4">
            <input type="radio" name="radio-btn" id="radio5">
            <input type="radio" name="radio-btn" id="radio6">
            <div class="slide first"><img src="{{ asset('images/paris.jpg') }}" alt="Paris"></div>
            <div class="slide"><img src="{{ asset('images/Pisa.jpg') }}" alt="Pisa"></div>
            <div class="slide"><img src="{{ asset('images/newyork.jpg') }}" alt="New York"></div>
            <div class="slide"><img src="{{ asset('images/burj-khalifa.jpg') }}" alt="Burj Khalifa"></div>
            <div class="slide"><img src="{{ asset('images/brazil.jpg') }}" alt="Brazil"></div>
            <div class="slide"><img src="{{ asset('images/berlin.jpg') }}" alt="Berlin"></div>
            <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>
                <div class="auto-btn5"></div>
                <div class="auto-btn6"></div>
            </div>
        </div>
        <div class="navigation-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
            <label for="radio5" class="manual-btn"></label>
            <label for="radio6" class="manual-btn"></label>
        </div>
    </div>
</section>

<section id="hx-offers-section">
    <div class="hx-container">
        <h2 class="hx-title">Special Offers</h2>
        <p class="hx-subtitle">Don't miss out on our exclusive deals</p>
        <div class="hx-grid">
            <div class="hx-card">
                <div class="hx-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34" />
                    <span class="hx-badge">40% OFF</span>
                </div>
                <div class="hx-content">
                    <h3>Summer Sale</h3>
                    <p>Save up to 40% on flights to Europe</p>
                    <span class="hx-date">Valid until June 31, 2026</span>
                    <button class="hx-btn">Book Now</button>
                </div>
            </div>
            <div class="hx-card">
                <div class="hx-img-wrapper">
                    <img src="{{ asset('images/hotel.jpg') }}" />
                    <span class="hx-badge">50% OFF</span>
                </div>
                <div class="hx-content">
                    <h3>Hotel Deal</h3>
                    <p>Book a luxurious stay at our partner hotels</p>
                    <span class="hx-date">Valid until June 15, 2026</span>
                    <button class="hx-btn" onclick="window.location.href=window.Routes.bookhotel">Book Now</button>
                </div>
            </div>
            <div class="hx-card">
                <div class="hx-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1505761671935-60b3a7427bad" />
                    <span class="hx-badge">30% OFF</span>
                </div>
                <div class="hx-content">
                    <h3>Asian Adventures</h3>
                    <p>Explore Asia with exclusive discounts</p>
                    <span class="hx-date">Valid until June 28, 2026</span>
                    <button class="hx-btn">Book Now</button>
                </div>
            </div>
            <div class="hx-card">
                <div class="hx-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d" />
                    <span class="hx-badge">25% OFF</span>
                </div>
                <div class="hx-content">
                    <h3>Dubai Escape</h3>
                    <p>Luxury trips at affordable prices</p>
                    <span class="hx-date">Valid until May 20, 2026</span>
                    <button class="hx-btn">Book Now</button>
                </div>
            </div>
            <div class="hx-card">
                <div class="hx-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c" />
                    <span class="hx-badge">Coming soon</span>
                </div>
                <div class="hx-content">
                    <h3>USA Tour</h3>
                    <p>Discover top cities in the USA</p>
                    <span class="hx-date">Valid until June 5, 2026</span>
                    <button class="hx-btn">Book Now</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="swg-why-section">
    <div class="swg-container">
        <h2 class="swg-title">Why Choose SkyWings</h2>
        <p class="swg-subtitle">Experience the difference with our premium services</p>
        <div class="swg-features">
            <div class="swg-feature-box">
                <div class="swg-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Safe & Secure</h3>
                <p>Your safety is our top priority with enhanced security measures</p>
            </div>
            <div class="swg-feature-box">
                <div class="swg-icon"><i class="fas fa-headphones"></i></div>
                <h3>24/7 Support</h3>
                <p>Our customer service team is always ready to help you</p>
            </div>
            <div class="swg-feature-box">
                <div class="swg-icon"><i class="fas fa-credit-card"></i></div>
                <h3>Best Price Guarantee</h3>
                <p>Find a lower price? We'll match it and give you extra credit</p>
            </div>
            <div class="swg-feature-box">
                <div class="swg-icon"><i class="fas fa-award"></i></div>
                <h3>Award Winning</h3>
                <p>Recognized as the world's best airline for 5 consecutive years</p>
            </div>
        </div>
    </div>
</section>

<div class="headingg" id="yyy">
    <h1>About Us</h1>
    <p>Welcome to , a leading airline with a rich history and a commitment to delivering exceptional service to our passengers.</p>
</div>
<div class="cont">
    <section class="about">
        <div class="about-image">
            <img src="{{ asset('images/image1.jpg') }}" alt="About SkyWings" />
        </div>
        <div class="about-content">
            <p>Our mission is to provide safe, comfortable, and reliable air travel to destinations around the world.</p>
            <a href="" class="read-more">Read More</a>
        </div>
    </section>
</div>

<footer class="footer">
    <div class="contain">
        <div class="row">
            <div class="footer-col">
                <h4>company</h4>
                <ul>
                    <li><a href="#">about us</a></li>
                    <li><a href="#">our services</a></li>
                    <li><a href="#">privacy policy</a></li>
                    <li><a href="#">affiliate program</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>get help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">shipping</a></li>
                    <li><a href="#">returns</a></li>
                    <li><a href="#">order status</a></li>
                    <li><a href="#">payment options</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

@endsection

@section('scripts')
<script>
    var counter = 1;
    setInterval(function () {
        document.getElementById("radio" + counter).checked = true;
        counter++;
        if (counter > 6) { counter = 1; }
    }, 5000);
</script>
<script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>

<script src="{{ asset('js/js.js') }}"></script>
@endsection