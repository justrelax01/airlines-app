@extends('layouts.app')



@section('title', 'faq and feedback page')



@section('styles')

   <link rel="stylesheet" href="{{ asset('css/external.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
  
    :root {
      --blue:       #2563eb;
      --blue-light: #dbeafe;
      --blue-dark:  #1e40af;
      --orange:     #f97316;
      --bg:         #f0f4ff;
      --white:      #ffffff;
      --text:       #111827;
      --muted:      #6b7280;
      --border:     #e5e7eb;
      --card-bg:    #ffffff;
      --radius:     16px;
      --shadow:     0 4px 24px rgba(37,99,235,0.08);
    }

    * {
       margin: 0; 
       padding: 0; 
       box-sizing: border-box; 
      }

    body {
      font-family: 'DM Sans', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      min-height: 100vh;
    }

    
  </style>



@endsection



@section('content')

  
  <button id="scrollTopBtn">
  
      <i class="fa-solid fa-arrow-up"></i>
  
    </button>

  
     <button class="back-btn" onclick="history.back()">← Back</button>
  
   
  <div class="page-hero">
    <div class="hero-tag">Help Center</div>
    <h1 class="hero-title">FAQ & Feedback</h1>
    <p class="hero-subtitle">Find quick answers to common questions, or share your experience with us.</p>
  </div>

  <div class="page-content">

    
    <section class="faq">
      <div class="section-heading">
        <div class="section-heading-icon">
          
          <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/></svg>
        </div>
        <div>
          <h2>Frequently Asked Questions</h2>
          <p>Click a question to reveal the answer</p>
        </div>
      </div>

      <div class="faq-list" id="faq-list"></div>
    </section>

    <section>
      <div class="section-heading">
        <div class="section-heading-icon">
          <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
        </div>
        <div>
          <h2>Share Your Feedback</h2>
          <p>We read every response — your opinion shapes our service</p>
        </div>
      </div>

      <div class="feedback-card">
       <form method="POST" action="{{ route('feedback.store') }}" id="feedbackForm">
        @csrf

          <input type="hidden" name="subject" id="hidden-subject" value="General" />
          <input type="hidden" name="rating"  id="hidden-rating"  value="0" />
        <div class="faq-form-grid">

          
          <div class="faq-form-group">
            <label class="faq-form-label"  for="fb-name">Full Name</label>
            <input class="faq-form-input" name="name" id="fb-name" type="text" placeholder="e.g. John Smith" />
          </div>

         
          <div class="faq-form-group">
            <label class="faq-form-label" for="fb-email">Email Address</label>
            <input class="faq-form-input" name="email" id="fb-email" type="email" placeholder="you@example.com" />
          </div>

          <!-- Topic -->
          <div class="faq-form-group">
            <label class="faq-form-label" for="fb-topic">Topic</label>
            <select class="faq-form-select" name="topic" id="fb-topic">
              <option value="" disabled selected>Select a topic</option>
              <option>Flight Experience</option>
              <option>Booking Process</option>
              <option>Customer Support</option>
              <option>Pricing & Offers</option>
              <option>Other</option>
            </select>
          </div>    

          <!-- Rating -->
          <div class="faq-form-group">
            <label class="faq-form-label">Overall Rating</label>
            <div class="rating-group" id="star-rating">
              <span class="star" data-val="1">★</span>
              <span class="star" data-val="2">★</span>
              <span class="star" data-val="3">★</span>
              <span class="star" data-val="4">★</span>
              <span class="star" data-val="5">★</span>
            </div>
          </div>

          <!-- Message -->
          <div class="faq-form-group full">
            <label class="faq-form-label" for="fb-message">Your Message</label>
            <textarea class="faq-form-textarea" name="message" id="fb-message" placeholder="Tell us about your experience, or ask a question. We'll reply within 48 hours…"></textarea>
          </div>

        </div>


      
        <div class="submit-row">
          <p class="submit-note">🔒 Your information is private and never shared.</p>
          <button class="feedback-btn" id="submit-btn">Send Feedback
            <svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
          </button>
        </div>

        </form>
        
        @if(session('feedback_success'))
    <div class="success-msg show" id="success-msg">
@else
    <div class="success-msg" id="success-msg">
@endif
    <svg viewBox="0 0 24 24">...</svg>
    Thank you! Your feedback has been sent
      </div>
    </section>

  </div>


  

  

    

@endsection



@section('scripts')

    <script >

const faqs = [
      {
        q: "How can I book a flight?",
        a: "You can click on the 'Book a Flight' button on our home page. Our booking flow will guide you through selecting dates, passengers, and seats in just a few steps."
      },
      {
        q: "Is there a hotel I can stay at after arriving at my destination?",
        a: "Yes! We have partner hotels at most destinations. Call us on +42 67 89 98 90 for reservations and we'll arrange everything for you."
      },
      {
        q: "How many stops are there during a flight?",
        a: "It depends on the duration and route of your trip. Most flights are direct, but longer routes may include 1–2 stops. This is always displayed clearly during booking."
      },
      {
        q: "Which restaurants are recommended during my trip?",
        a: "Check our Instagram page for curated lists of restaurants at each destination, from street food to fine dining."
      },
      {
        q: "Is there insurance available during the trip?",
        a: "Absolutely — your safety is our top priority. Our medical and travel insurance system is active throughout the entire duration of your journey."
      },
      {
        q: "Why does my account registration keep showing an error?",
        a: "Double-check that your email address and password meet the requirements. If an account with your email already exists, please use the Sign In option instead."
      },
      {
        q: "Am I allowed to bring food on board?",
        a: "We welcome personal snacks on board. However, some destination countries restrict certain food items at customs. Please review your destination's import rules before travelling."
      }
    ];

   
    const faqList = document.getElementById('faq-list');
    faqList.innerHTML = faqs.map((item, i) => `
      <div class="faq-item" id="faq-${i}">
        <button class="faq-question" onclick="toggleFAQ(${i})">
          <span class="faq-question-text">${item.q}</span>
          <span class="faq-icon">
            <svg viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
          </span>
        </button>
        <div class="faq-answer">
          <p>${item.a}</p>
        </div>
      </div>
    `).join('');

    
    function toggleFAQ(index) {
      const item = document.getElementById(`faq-${index}`);
      const isOpen = item.classList.contains('open');

      document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('open'));

      if (!isOpen) item.classList.add('open');
    }

    let selectedRating = 0;
    const stars = document.querySelectorAll('.star');

    stars.forEach(star => {
      star.addEventListener('click', () => {
        selectedRating = parseInt(star.dataset.val);
        stars.forEach(s => {
          s.classList.toggle('active', parseInt(s.dataset.val) <= selectedRating);
        });
      });

      
      star.addEventListener('mouseenter', () => {
        stars.forEach(s => {
          s.style.color = parseInt(s.dataset.val) <= parseInt(star.dataset.val) ? '#f59e0b' : '#d1d5db';
        });
      });

      star.addEventListener('mouseleave', () => {
        stars.forEach(s => {
          s.style.color = parseInt(s.dataset.val) <= selectedRating ? '#f59e0b' : '#d1d5db';
        });
      });
    });


   document.getElementById('submit-btn').addEventListener('click', function () {
    const name    = document.getElementById('fb-name').value.trim();
    const email   = document.getElementById('fb-email').value.trim();
    const topic   = document.getElementById('fb-topic').value.trim();
    const message = document.getElementById('fb-message').value.trim();

    if (!name || !email || !message) {
        alert('Please fill in your name, email, and message before sending.');
        return;
    }

    document.getElementById('hidden-subject').value = topic || 'General';
    document.getElementById('hidden-rating').value  = selectedRating;

    document.getElementById('feedbackForm').submit();
});
</script>

<script src="js/js.js"></script>

@endsection