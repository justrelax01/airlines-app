@extends('layouts.app')

@section('title', 'Search Flights')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/external.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('content')

<button id="scrollTopBtn">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<button class="back-btn" onclick="history.back()">← Back</button>

<section class="bk_search">
    <div class="bk_search_photo">        
        <div class="bk_search_paraphoto">
            <h1>Your Journey Begins Here</h1>
            <p>Discover amazing destinations and book your next adventure with confidence.</p>
            <p>Let's discover the world together!</p>  
        </div>
    </div>

    <div class="bk_search_form">
        <div class="bk_search_tabs">
            <button type="button" class="bk-search-tab active">Round Trip</button>
            <button type="button" class="bk-search-tab">One Way</button>
            <button type="button" class="bk-search-tab">Multi-city</button>
        </div>

        <h2>Book your flight</h2>
        <form action="">
            <div class="bk_search_form_insert">
                <div>
                    <label for="departure">From</label>
                    <input type="text" placeholder="Departure city" id="departure">
                </div>
                <div>
                    <label for="arrival">To</label>
                    <input type="text" placeholder="Arrival city" id="arrival">
                </div>
                <div>
                    <label for="departure-date">Departure date</label>
                    <input type="date" id="departure-date">
                </div>
                <div>
                    <label for="return-date">Return date</label>
                    <input type="date" id="return-date">
                </div>
                <div>
                    <label for="passengers">Passengers</label>
                    <input type="number" placeholder="1 passenger" id="passengers" min="1" value="1">
                </div>
                <div>
                    <label for="class">Class</label>
                    <select id="class">
                        <option value="" disabled selected>select class</option>
                        <option value="economy">Economy</option>
                        <option value="business">Business</option>
                        <option value="first">First</option>
                    </select>
                </div>
            </div>
            <button type="submit"><i class="fa fa-search"></i> Search Flights</button>
        </form>
    </div>  
</section>

<section id="bk-dest-section">
    <div class="bk-container">
        <h2 class="bk-title">Popular Destinations</h2>
        <p class="bk-subtitle">Explore the most visited places around the world</p>

        <div class="bk-filters">
            <button class="bk-filter active" data-filter="all">All Destinations</button>
            <button class="bk-filter" data-filter="asia">Asia</button>
            <button class="bk-filter" data-filter="europe">Europe</button>
            <button class="bk-filter" data-filter="oceania">Oceania</button>
            <button class="bk-filter" data-filter="middleeast">Middle East</button>
            <button class="bk-filter" data-filter="americas">Americas</button>
            <button class="bk-filter" data-filter="africa">Africa</button>
        </div>
        <div id="search-status" class="bk-search-status">Showing all popular destinations.</div>

        <div class="bk-grid">
            <!-- ASIA -->
            <div class="bk-card" data-category="asia">
                <div class="bk-card-image">
                    <img src="{{ asset('images/tokyo.jpg') }}" alt="Tokyo">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $450</span>
                    <span class="bk-card-location">📍 Japan</span>
                    <span class="bk-card-rating">⭐ 4.8</span>
                </div>
                <div class="bk-card-content">
                    <h3>Tokyo</h3>
                    <p>Experience the perfect blend of tradition and modernity.</p>
                    <div class="bk-card-meta"><span>⏱ 7h 30m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('tokyo')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="asia">
                <div class="bk-card-image">
                    <img src="{{ asset('images/singapore.jpg') }}" alt="Singapore">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $180</span>
                    <span class="bk-card-location">📍 Singapore</span>
                    <span class="bk-card-rating">⭐ 4.9</span>
                </div>
                <div class="bk-card-content">
                    <h3>Singapore</h3>
                    <p>Gateway to Southeast Asia with world-class attractions.</p>
                    <div class="bk-card-meta"><span>⏱ 2h 15m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('singapore')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="asia">
                <div class="bk-card-image">
                    <img src="{{ asset('images/tehran.jpg') }}" alt="Tehran">
                    <span class="bk-card-badge">Trending</span>
                    <span class="bk-card-price">from $230</span>
                    <span class="bk-card-location">📍 Iran</span>
                    <span class="bk-card-rating">⭐ 4.5</span>
                </div>
                <div class="bk-card-content">
                    <h3>Tehran</h3>
                    <p>Discover vibrant culture, historic sites, and lively bazaars.</p>
                    <div class="bk-card-meta"><span>⏱ 4h 20m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('tehran')">View Flights</button>
                </div>
            </div>

            <!-- EUROPE -->
            <div class="bk-card" data-category="europe">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34" alt="Paris">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $380</span>
                    <span class="bk-card-location">📍 France</span>
                    <span class="bk-card-rating">⭐ 4.7</span>
                </div>
                <div class="bk-card-content">
                    <h3>Paris</h3>
                    <p>Romantic landmarks, world-class museums, and café culture.</p>
                    <div class="bk-card-meta"><span>⏱ 8h 10m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('paris')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="europe">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1467269204594-9661b134dd2b" alt="London">
                    <span class="bk-card-badge">Top</span>
                    <span class="bk-card-price">from $410</span>
                    <span class="bk-card-location">📍 UK</span>
                    <span class="bk-card-rating">⭐ 4.6</span>
                </div>
                <div class="bk-card-content">
                    <h3>London</h3>
                    <p>Iconic history, royal palaces, and vibrant neighbourhoods.</p>
                    <div class="bk-card-meta"><span>⏱ 7h 50m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('london')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="europe">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1583422409516-2895a77efded" alt="Barcelona">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $420</span>
                    <span class="bk-card-location">📍 Spain</span>
                    <span class="bk-card-rating">⭐ 4.7</span>
                </div>
                <div class="bk-card-content">
                    <h3>Barcelona</h3>
                    <p>Vibrant city with stunning architecture and Mediterranean beaches.</p>
                    <div class="bk-card-meta"><span>⏱ 8h 30m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('barcelona')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="europe">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1561883088-039cb07b32fa" alt="Madrid">
                    <span class="bk-card-badge">Top</span>
                    <span class="bk-card-price">from $400</span>
                    <span class="bk-card-location">📍 Spain</span>
                    <span class="bk-card-rating">⭐ 4.5</span>
                </div>
                <div class="bk-card-content">
                    <h3>Madrid</h3>
                    <p>Spain's vibrant capital with world-class museums and nightlife.</p>
                    <div class="bk-card-meta"><span>⏱ 8h 45m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('madrid')">View Flights</button>
                </div>
            </div>

            <!-- OCEANIA -->
            <div class="bk-card" data-category="oceania">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9" alt="Sydney">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $520</span>
                    <span class="bk-card-location">📍 Australia</span>
                    <span class="bk-card-rating">⭐ 4.7</span>
                </div>
                <div class="bk-card-content">
                    <h3>Sydney</h3>
                    <p>Iconic landmarks and stunning coastal scenery.</p>
                    <div class="bk-card-meta"><span>⏱ 8h 45m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('sydney')">View Flights</button>
                </div>
            </div>

            <!-- MIDDLE EAST -->
            <div class="bk-card" data-category="middleeast">
                <div class="bk-card-image">
                    <img src="{{ asset('images/Rouche.jpg') }}" alt="Lebanon">
                    <span class="bk-card-badge bk-badge-special">Must Visit ✨</span>
                    <span class="bk-card-price">from $250</span>
                    <span class="bk-card-location">📍 Lebanon</span>
                    <span class="bk-card-rating">⭐ 4.9</span>
                </div>
                <div class="bk-card-content">
                    <h3>Beirut</h3>
                    <p>Experience the vibrant culture, stunning beaches, and rich history of the Levant.</p>
                    <div class="bk-card-meta"><span>⏱ 3h 40m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('beirut')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="middleeast">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1570633632222-c7e4d1c6b5c5" alt="Iraq">
                    <span class="bk-card-badge">Trending</span>
                    <span class="bk-card-price">from $280</span>
                    <span class="bk-card-location">📍 Iraq</span>
                    <span class="bk-card-rating">⭐ 4.4</span>
                </div>
                <div class="bk-card-content">
                    <h3>Baghdad</h3>
                    <p>Discover ancient Mesopotamian heritage and modern Iraqi culture.</p>
                    <div class="bk-card-meta"><span>⏱ 4h 15m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('baghdad')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="middleeast">
                <div class="bk-card-image">
                    <img src="{{ asset('images/karbala.jpg') }}" alt="Imam Hussein Makam">
                    <span class="bk-card-badge">Pilgrimage</span>
                    <span class="bk-card-price">from $290</span>
                    <span class="bk-card-location">📍 Iraq</span>
                    <span class="bk-card-rating">⭐ 4.8</span>
                </div>
                <div class="bk-card-content">
                    <h3>Karbala</h3>
                    <p>Visit Imam Hussein's shrine and feel the powerful spiritual atmosphere.</p>
                    <div class="bk-card-meta"><span>⏱ 4h 30m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('karbala')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="middleeast">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1518684079-3c830dcef090" alt="Dubai">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $340</span>
                    <span class="bk-card-location">📍 UAE</span>
                    <span class="bk-card-rating">⭐ 4.8</span>
                </div>
                <div class="bk-card-content">
                    <h3>Dubai</h3>
                    <p>Luxury shopping, desert adventures, and modern architecture.</p>
                    <div class="bk-card-meta"><span>⏱ 6h 05m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('dubai')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="middleeast">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1539650116574-75c0c6d73c3e" alt="Riyadh">
                    <span class="bk-card-badge">Top</span>
                    <span class="bk-card-price">from $360</span>
                    <span class="bk-card-location">📍 Saudi Arabia</span>
                    <span class="bk-card-rating">⭐ 4.6</span>
                </div>
                <div class="bk-card-content">
                    <h3>Riyadh</h3>
                    <p>Modern skyline mixed with rich Arabian heritage.</p>
                    <div class="bk-card-meta"><span>⏱ 5h 40m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('riyadh')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="middleeast">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1580835845971-4b0c07b5c3cf" alt="Doha">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $330</span>
                    <span class="bk-card-location">📍 Qatar</span>
                    <span class="bk-card-rating">⭐ 4.4</span>
                </div>
                <div class="bk-card-content">
                    <h3>Doha</h3>
                    <p>Elegant city skyline and rich cultural experiences.</p>
                    <div class="bk-card-meta"><span>⏱ 5h 55m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('doha')">View Flights</button>
                </div>
            </div>

            <!-- AMERICAS -->
            <div class="bk-card" data-category="americas">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9" alt="New York">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $580</span>
                    <span class="bk-card-location">📍 USA</span>
                    <span class="bk-card-rating">⭐ 4.8</span>
                </div>
                <div class="bk-card-content">
                    <h3>New York</h3>
                    <p>The city that never sleeps with iconic landmarks and endless entertainment.</p>
                    <div class="bk-card-meta"><span>⏱ 11h 30m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('new-york')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="americas">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1483729558449-99daa62f1dcd" alt="Brazil">
                    <span class="bk-card-badge">Trending</span>
                    <span class="bk-card-price">from $520</span>
                    <span class="bk-card-location">📍 Brazil</span>
                    <span class="bk-card-rating">⭐ 4.6</span>
                </div>
                <div class="bk-card-content">
                    <h3>Rio de Janeiro</h3>
                    <p>Experience vibrant culture, beautiful beaches, and iconic Christ the Redeemer.</p>
                    <div class="bk-card-meta"><span>⏱ 12h 50m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('rio-de-janeiro')">View Flights</button>
                </div>
            </div>

            <!-- AFRICA -->
            <div class="bk-card" data-category="africa">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1539650116574-75c0c6d73c3e" alt="Cairo">
                    <span class="bk-card-badge">Popular</span>
                    <span class="bk-card-price">from $290</span>
                    <span class="bk-card-location">📍 Egypt</span>
                    <span class="bk-card-rating">⭐ 4.3</span>
                </div>
                <div class="bk-card-content">
                    <h3>Cairo</h3>
                    <p>Explore ancient pyramids and vibrant city markets.</p>
                    <div class="bk-card-meta"><span>⏱ 9h 10m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('cairo')">View Flights</button>
                </div>
            </div>

            <div class="bk-card" data-category="africa">
                <div class="bk-card-image">
                    <img src="https://images.unsplash.com/photo-1501594907352-04cda38ebc29" alt="Casablanca">
                    <span class="bk-card-badge">Top</span>
                    <span class="bk-card-price">from $310</span>
                    <span class="bk-card-location">📍 Morocco</span>
                    <span class="bk-card-rating">⭐ 4.2</span>
                </div>
                <div class="bk-card-content">
                    <h3>Casablanca</h3>
                    <p>Historic Moroccan culture with Atlantic coast charm.</p>
                    <div class="bk-card-meta"><span>⏱ 10h 20m</span></div>
                    <button class="bk-card-button" onclick="viewDestinationFlights('casablanca')">View Flights</button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('js/js.js') }}"></script>
@endsection