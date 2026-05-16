@extends('layouts.app')



@section('title', 'Flights page')



@section('styles')
 
    <link rel="stylesheet" href="external.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
       
        * { 
          margin: 0;
           padding: 0; 
           box-sizing: border-box; 
          }

       body {
         font-family: 'Poppins', sans-serif;
         background-color: #f0f4ff;
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         min-height: 100vh;
         padding: 40px 20px;
         gap: 24px;
       }


      
 

      

    </style>
    

@endsection



@section('content')

  <button id="scrollTopBtn">
      <i class="fa-solid fa-arrow-up"></i>
    </button>

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


    <div id="par_tickets_available"></div>

    <div id="showing_nb_available"></div>

    <div id="tickets-container"></div>
    
    
  

@endsection



@section('scripts')
<script>
    const planeSVG = `<svg viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5z"/></svg>`;
    const peopleSVG = `<svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>`;

    function fmtTime(dt) {
        return new Date(dt).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    }
    function fmtDate(dt) {
        return new Date(dt).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }

    function createTicketHTML(flight, passengers) {
        const total = (flight.price * passengers).toLocaleString('en-US', { minimumFractionDigits: 2 });
        const perPerson = passengers > 1
            ? `<div class="price-per-person">$${parseFloat(flight.price).toFixed(2)}/person</div>`
            : '';
        return `
          <div class="ticket-wrapper">
            <div class="ticket">
              <div class="ticket-left">
                <div class="ticket-header">
                  <div class="flight-id-group">
                    <div class="plane-icon-box">${planeSVG}</div>
                    <div>
                      <div class="flight-id-label">Flight</div>
                      <div class="flight-id-number">${flight.flight_number}</div>
                    </div>
                  </div>
                </div>
                <div class="route-row">
                  <div class="airport-from">
                    <div class="iata-code">${flight.origin}</div>
                    <div class="flight-time">${fmtTime(flight.departure_time)}</div>
                    <div class="flight-date">${fmtDate(flight.departure_time)}</div>
                  </div>
                  <div class="connector">
                    <div class="connector-line"></div>
                    <div class="connector-plane">${planeSVG}</div>
                  </div>
                  <div class="airport-to">
                    <div class="iata-code">${flight.destination}</div>
                    <div class="flight-time">${fmtTime(flight.arrival_time)}</div>
                    <div class="flight-date">${fmtDate(flight.arrival_time)}</div>
                  </div>
                </div>
                <div class="meta-row">
                  <div class="meta-item">
                    ${peopleSVG}
                    <div>
                      <div class="meta-label">Passengers</div>
                      <div class="meta-value">${passengers}</div>
                    </div>
                  </div>
                  <div class="meta-item">
                    ${peopleSVG}
                    <div>
                      <div class="meta-label">Seats Left</div>
                      <div class="meta-value">${flight.available_seats}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ticket-divider"><div class="notch"></div><div class="notch"></div></div>
              <div class="ticket-right">
                <div class="price-label">Total Price</div>
                <div class="price-amount">$${total}</div>
                ${perPerson}
                <button class="addtocart-btn" onclick="buynow(${flight.id}, ${passengers})">Buy now</button>
              </div>
            </div>
          </div>`;
    }

    async function loadAndRenderFlights() {
        const raw    = sessionStorage.getItem('flightSearch');
        const search = raw ? JSON.parse(raw) : {};
        const passengers = parseInt(search.passengers) || 1;

        const params = new URLSearchParams();
        if (search.from) params.set('from', search.from);
        if (search.to)   params.set('to',   search.to);
        if (search.date) params.set('date', search.date);

        const parTickets = document.getElementById('par_tickets_available');
        const container  = document.getElementById('tickets-container');

        parTickets.innerHTML = search.to
            ? `<h1>Flights to ${search.to.charAt(0).toUpperCase() + search.to.slice(1)}</h1><p>Showing available flights.</p>`
            : `<h1>Available Flights</h1><p>Here are the flights available for your travel needs.</p>`;

        try {
            const res   = await fetch('/api/flights?' + params.toString());
            const json  = await res.json();
            const flights = json.data || [];

            document.getElementById('showing_nb_available').innerHTML = flights.length > 0
                ? `<p>Showing ${flights.length} available flight(s).</p>`
                : `<p>No flights found. <a href="${window.Routes.searchflights}">Try again</a></p>`;

            container.innerHTML = flights.map(f => createTicketHTML(f, passengers)).join('');
        } catch {
            container.innerHTML = `<p>Could not load flights. Please try again later.</p>`;
        }

        sessionStorage.removeItem('flightSearch');
    }

    function buynow(flightId, passengers) {
        sessionStorage.setItem('selectedFlight', JSON.stringify({ flightId, passengers }));
        window.location.href = window.Routes.payment;
    }

    document.addEventListener('DOMContentLoaded', loadAndRenderFlights);
</script>
    
    

@endsection