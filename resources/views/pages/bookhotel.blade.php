@extends('layouts.app')

@section('title', 'Book Hotel Page')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/external.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        background-image: url({{ asset('images/plane3.jpg') }});
        background-size: cover;
        background-position: center;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
    th { background-color: #f2f2f2; }

    button { padding: 8px 12px; background-color: #2563eb; color: #fff; border: none; cursor: pointer; }
</style>
@endsection

@section('content')

<button id="scrollTopBtn"><i class="fa-solid fa-arrow-up"></i></button>
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
                <li><a href="{{ route('faq-feedback') }}">FaQ &amp; Feedback</a></li>
                <li><a href="#yyy">About</a></li>
                <li><a href="{{ route('login') }}">Login or Register</a></li>
                <li><a href="{{ route('searchflights') }}"><i class="fa-solid fa-magnifying-glass"></i></a></li>
            </ul>
        </nav>
    </div>
</section>

<div class="container1">

    @if(session('success'))
        <div style="background:#d1fae5;color:#065f46;padding:16px 20px;border-radius:8px;margin:16px auto;max-width:800px;font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:16px 20px;border-radius:8px;margin:16px auto;max-width:800px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('hotel.book') }}" method="POST">
        @csrf
        <div class="form">

            <h2 class="text-b">Booking Details</h2>

            <div class="input1">
                <input type="text" class="input-group" name="country" id="text-from"
                       placeholder="Country" value="{{ old('country') }}">
                <input type="text" class="input-group" name="city" id="text-to"
                       placeholder="City" value="{{ old('city') }}">
                <select class="input-group" name="room_type">
                    <option value="" disabled {{ old('room_type') ? '' : 'selected' }}>Preferred Room</option>
                    <option value="single" {{ old('room_type') === 'single' ? 'selected' : '' }}>Single Room</option>
                    <option value="double" {{ old('room_type') === 'double' ? 'selected' : '' }}>Double Room</option>
                    <option value="suite"  {{ old('room_type') === 'suite'  ? 'selected' : '' }}>Suite</option>
                </select>
            </div>

            <div class="input2">
                <input type="number" class="input-group" name="age" placeholder="Age"
                       id="age" min="18" max="120" value="{{ old('age') }}">
            </div>

            <div class="input4">
                <input type="date" class="input-group" name="return_date" id="return-date"
                       value="{{ old('return_date') }}">
                <input type="time" class="input-group" name="return_time" placeholder="Return time"
                       id="return-time" value="{{ old('return_time') }}">
                <input type="text" class="input-group1" name="message" placeholder="Any Message"
                       value="{{ old('message') }}">
            </div>

            <div class="input5">
                <h2 class="text-choice">Personal Details</h2>
            </div>

            <div class="input6">
                <input type="text" class="input-group" name="full_name" placeholder="Full Name"
                       id="full-name" value="{{ old('full_name') }}">
                <input type="text" class="input-group" name="phone" placeholder="Phone Number"
                       id="phone" value="{{ old('phone') }}">
                <input type="email" class="input-group1" name="email" placeholder="Enter your Email"
                       id="email" value="{{ old('email') }}">
            </div>

            <button type="submit" class="btn-booking">Submit Form</button>
            <button type="reset" class="btn-booking-clear">Clear Form</button>

        </div>
    </form>
</div>

@endsection
