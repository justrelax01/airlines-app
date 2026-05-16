@extends('layouts.app')

@section('title', 'Complete Your Payment')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Sora:wght@400;600;700&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    :root {
        --bg: #eef2f7;
        --white: #ffffff;
        --card: #ffffff;
        --border: #e2e8f0;
        --text: #1a202c;
        --muted: #718096;
        --accent: #2563eb;
        --accent-light: #eff6ff;
        --accent-hover: #1d4ed8;
        --danger: #dc2626;
        --danger-bg: #fef2f2;
        --warn: #d97706;
        --warn-bg: #fffbeb;
        --success: #7c3aed;
        --wish-from: #7c3aed;
        --wish-to: #ec4899;
        --total-color: #2563eb;
        --radius: 14px;
        --radius-sm: 8px;
        --shadow: 0 2px 16px rgba(0,0,0,0.07);
        --shadow-lg: 0 8px 32px rgba(0,0,0,0.12);
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: 'DM Sans', sans-serif;
        background: var(--bg);
        color: var(--text);
        min-height: 100vh;
        padding: 40px 20px 60px;
    }
    h1.page-title {
        font-family: 'Sora', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 4px;
    }
    p.page-subtitle {
        color: var(--muted);
        font-size: 0.95rem;
        margin-bottom: 32px;
    }
</style>
@endsection

@section('content')

<button id="scrollTopBtn">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<button class="back-btn" onclick="history.back()">← Back</button>

<div class="page-header">
    <h1 class="page-title">Complete Your Payment</h1>
    <p class="page-subtitle">Choose your preferred payment method and complete your booking</p>
</div>

<div class="layout">
    <div class="payment-card">
        <div class="section-title">Payment Method</div>

        <div class="method-tabs">
            <button class="method-tab active" data-method="credit" onclick="switchMethod('credit')">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                Credit Card
            </button>
            <button class="method-tab" data-method="cash" onclick="switchMethod('cash')">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                Cash
            </button>
        </div>

        <!-- CREDIT CARD PANEL -->
        <div id="panel-credit" class="panel active">
            <div class="form-group">
                <label>Card Number</label>
                <div class="input-icon-wrap">
                    <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" oninput="formatCard(this)"/>
                    <span class="input-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label>Cardholder Name</label>
                <input type="text" id="cardName" placeholder="John Doe"/>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="text" id="expiry" placeholder="MM/YY" maxlength="5" oninput="formatExpiry(this)"/>
                </div>
                <div class="form-group">
                    <label>CVV</label>
                    <input type="text" id="cvv" placeholder="123" maxlength="4"/>
                </div>
            </div>
            <div class="info-banner blue">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="flex-shrink:0;margin-top:1px"><path d="M18 8h-1V6A5 5 0 0 0 7 6v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-6 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-9H8.9V6a3.1 3.1 0 0 1 6.2 0v2z"/></svg>
                <div>
                    <div class="banner-title">Secure Payment</div>
                    <div class="banner-sub">Your payment information is encrypted and secure</div>
                </div>
            </div>
            <div class="agree-row">
                <input type="checkbox" id="agree-credit"/>
                <label for="agree-credit">I agree to the terms and conditions and cancellation policy</label>
            </div>
            <button class="pay-btn" onclick="handlePayment('credit')">Complete Payment</button>
        </div>

        <!-- CASH PANEL -->
        <div id="panel-cash" class="panel">
            <div class="cash-due-box">
                <div class="cash-due-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    Payment Due Date
                </div>
                <div class="cash-due-sub">You must complete your cash payment by:</div>
                <div class="cash-date-chip">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#d97706"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
                    <div>
                        <strong id="cash-due-date">—</strong>
                        <span>at 11:59 PM</span>
                    </div>
                </div>
            </div>
            <div class="important-notice">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#dc2626" style="flex-shrink:0;margin-top:1px"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                <div>
                    <div class="notice-title">Important Notice</div>
                    <div class="notice-sub">After the due date, you will not be able to complete this payment and your booking will be cancelled.</div>
                </div>
            </div>
            <div class="instructions">
                <h4>Payment Instructions:</h4>
                <ol>
                    <li>Visit any authorized payment center</li>
                    <li>Provide your booking reference number</li>
                    <li>Pay the exact amount in cash</li>
                    <li>Keep your receipt as proof of payment</li>
                </ol>
            </div>
            <div class="agree-row">
                <input type="checkbox" id="agree-cash"/>
                <label for="agree-cash">I agree to the terms and conditions and cancellation policy</label>
            </div>
            <button class="pay-btn" onclick="handlePayment('cash')">Confirm Booking</button>
        </div>
    </div>

    <!-- ORDER SUMMARY -->
    <div class="summary-card">
        <h2>Order Summary</h2>
        <div class="summary-rows">
            <div class="summary-row">
                <span class="label">Flight ID:</span>
                <span class="value" id="sum-id">—</span>
            </div>
            <div class="summary-row">
                <span class="label">Route:</span>
                <span class="value" id="sum-route">—</span>
            </div>
            <div class="summary-row">
                <span class="label">Date:</span>
                <span class="value" id="sum-date">—</span>
            </div>
            <div class="summary-row">
                <span class="label">Passengers:</span>
                <span class="value" id="sum-passengers">—</span>
            </div>
        </div>
        <hr class="summary-divider"/>
        <div class="summary-rows">
            <div class="summary-row">
                <span class="label">Subtotal:</span>
                <span class="value" id="sum-subtotal">—</span>
            </div>
            <div class="summary-row">
                <span class="label">Taxes & Fees:</span>
                <span class="value" id="sum-tax">—</span>
            </div>
        </div>
        <hr class="summary-divider"/>
        <div class="summary-total">
            <span class="total-label">Total:</span>
            <span class="total-amount" id="sum-total">—</span>
        </div>
        <div class="cash-notice-chip" id="cash-notice" style="display:none">
            Cash payment must be completed within 3 days
        </div>
    </div>
</div>

<!-- DYNAMIC TICKET OVERLAY -->
<div class="ticket-overlay" id="ticketOverlay">
    <div class="boarding-pass" id="boardingPass">
        <div class="bp-actions">
            <button class="bp-action-btn bp-close-btn" onclick="closeTicket()">&#10005; Close</button>
        </div>
        <div class="bp-left">
            <div class="bp-confirmed-row">
                <div class="bp-check">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div>
                    <div class="bp-confirmed-text">Booking Confirmed!</div>
                    <div class="bp-confirmed-sub">Your ticket is ready. Have a great flight!</div>
                </div>
            </div>
            <div class="bp-flight-header">
                <div class="bp-flight-id-group">
                    <div class="bp-plane-box">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5z"/></svg>
                    </div>
                    <div>
                        <div class="bp-fid-label">Flight ID</div>
                        <div class="bp-fid-number" id="tk-flight-id">—</div>
                    </div>
                </div>
                <span class="bp-class-badge" id="tk-class">Economy</span>
            </div>
            <div class="bp-route">
                <div class="bp-airport">
                    <div class="bp-iata" id="tk-from-iata">—</div>
                    <div class="bp-city" id="tk-from-city">—</div>
                    <div class="bp-time" id="tk-from-time">—</div>
                    <div class="bp-date" id="tk-from-date">—</div>
                </div>
                <div class="bp-connector">
                    <div class="bp-conn-line">
                        <div class="bp-conn-plane">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bp-airport right">
                    <div class="bp-iata" id="tk-to-iata">—</div>
                    <div class="bp-city" id="tk-to-city">—</div>
                    <div class="bp-time" id="tk-to-time">—</div>
                    <div class="bp-date" id="tk-to-date">—</div>
                </div>
            </div>
            <div class="bp-meta">
                <div class="bp-meta-item">
                    <svg class="bp-meta-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
                    <div>
                        <div class="bp-meta-label">Return</div>
                        <div class="bp-meta-value" id="tk-return">—</div>
                    </div>
                </div>
                <div class="bp-meta-item">
                    <svg class="bp-meta-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                    <div>
                        <div class="bp-meta-label">Passengers</div>
                        <div class="bp-meta-value" id="tk-passengers">—</div>
                    </div>
                </div>
                <div class="bp-meta-item">
                    <svg class="bp-meta-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <div>
                        <div class="bp-meta-label">Gate</div>
                        <div class="bp-meta-value" id="tk-gate">TBD</div>
                    </div>
                </div>
            </div>
            <div class="bp-passenger">
                <div class="bp-pax-item">
                    <div class="bp-pax-label">Passenger Name</div>
                    <div class="bp-pax-value" id="tk-pax-name">—</div>
                </div>
                <div class="bp-pax-item">
                    <div class="bp-pax-label" id="tk-pax-contact-label">Contact</div>
                    <div class="bp-pax-value" id="tk-pax-contact">—</div>
                </div>
            </div>
        </div>
        <div class="bp-divider">
            <div class="bp-notch top"></div>
            <div class="bp-notch bottom"></div>
        </div>
        <div class="bp-right">
            <div style="text-align:center">
                <div class="bp-price-label">Total Price</div>
                <div class="bp-price-amount" id="tk-price">—</div>
                <div class="bp-price-per" id="tk-per-person"></div>
            </div>
            <div class="bp-payment-method">
                <div class="bp-pm-label">Payment Via</div>
                <div class="bp-pm-value" id="tk-pay-method">—</div>
            </div>
            <div class="bp-ref">
                <div class="bp-ref-label">Booking Ref</div>
                <div class="bp-ref-code" id="tk-ref">—</div>
            </div>
            <div class="bp-barcode" id="tk-barcode"></div>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="toast" id="toast"></div>

@endsection

@section('scripts')
<script>
    const raw = sessionStorage.getItem('selectedFlight');
    const flight = raw ? JSON.parse(raw) : null;
    const TAX_RATE = 0.15;

    function populateSummary(f) {
        if (!f) return;
        const subtotal = f.price;
        const tax = +(subtotal * TAX_RATE).toFixed(2);
        const total = subtotal + tax;

        document.getElementById('sum-id').textContent = f.id;
        document.getElementById('sum-route').textContent = `${f.from.iata} → ${f.to.iata}`;
        document.getElementById('sum-date').textContent = f.from.date;
        document.getElementById('sum-passengers').textContent = f.passengers;
        document.getElementById('sum-subtotal').textContent = `$${subtotal.toLocaleString('en-US', {minimumFractionDigits:2})}`;
        document.getElementById('sum-tax').textContent = `$${tax.toLocaleString('en-US', {minimumFractionDigits:2})}`;
        document.getElementById('sum-total').textContent = `$${total.toLocaleString('en-US', {minimumFractionDigits:2})}`;
        setCashDueDate();
    }

    function setCashDueDate() {
        const due = new Date();
        due.setDate(due.getDate() + 3);
        const opts = { weekday:'long', year:'numeric', month:'long', day:'numeric' };
        document.getElementById('cash-due-date').textContent = due.toLocaleDateString('en-US', opts);
    }

    populateSummary(flight);

    function switchMethod(method) {
        document.querySelectorAll('.method-tab').forEach(t => t.classList.remove('active'));
        document.querySelector(`[data-method="${method}"]`).classList.add('active');
        document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
        document.getElementById(`panel-${method}`).classList.add('active');
        const cashNotice = document.getElementById('cash-notice');
        cashNotice.style.display = method === 'cash' ? 'block' : 'none';
    }

    function formatCard(el) {
        let v = el.value.replace(/\D/g,'').substring(0,16);
        el.value = v.match(/.{1,4}/g)?.join(' ') ?? v;
    }

    function formatExpiry(el) {
        let v = el.value.replace(/\D/g,'').substring(0,4);
        if (v.length >= 3) v = v.substring(0,2) + '/' + v.substring(2);
        el.value = v;
    }

    function handlePayment(method) {
        const agreeId = `agree-${method}`;
        if (!document.getElementById(agreeId).checked) {
            showToast('⚠️ Please agree to the terms and conditions first.');
            return;
        }

        let userInfo = {};

        if (method === 'credit') {
            const num = document.getElementById('cardNumber').value.replace(/\s/g,'');
            const name = document.getElementById('cardName').value.trim();
            const exp = document.getElementById('expiry').value.trim();
            const cvv = document.getElementById('cvv').value.trim();
            if (!num || num.length < 16) { showToast('⚠️ Please enter a valid 16-digit card number.'); return; }
            if (!name) { showToast('⚠️ Please enter the cardholder name.'); return; }
            if (!exp || exp.length < 5) { showToast('⚠️ Please enter a valid expiry date.'); return; }
            if (!cvv || cvv.length < 3) { showToast('⚠️ Please enter a valid CVV.'); return; }
            userInfo = { name, contact: '**** **** **** ' + num.slice(-4), method: 'Credit Card' };
        }

        if (method === 'cash') {
            userInfo = { name: 'Walk-in Passenger', contact: 'Cash at Center', method: 'Cash' };
        }

        if (flight) {
            showDynamicTicket(userInfo, flight);
        } else {
            showToast('⚠️ No flight selected. Please go back and select a flight.');
        }
    }

    function showDynamicTicket(userInfo, f) {
        const subtotal = f.price;
        const tax = +(subtotal * TAX_RATE).toFixed(2);
        const total = subtotal + tax;

        document.getElementById('tk-flight-id').textContent = f.id;
        document.getElementById('tk-class').textContent = f.cabinClass || 'Economy';
        document.getElementById('tk-from-iata').textContent = f.from.iata;
        document.getElementById('tk-from-city').textContent = f.from.city;
        document.getElementById('tk-from-time').textContent = f.from.time;
        document.getElementById('tk-from-date').textContent = f.from.date;
        document.getElementById('tk-to-iata').textContent = f.to.iata;
        document.getElementById('tk-to-city').textContent = f.to.city;
        document.getElementById('tk-to-time').textContent = f.to.time;
        document.getElementById('tk-to-date').textContent = f.to.date;
        document.getElementById('tk-return').textContent = f.returnDate || 'One Way';
        document.getElementById('tk-passengers').textContent = f.passengers;
        document.getElementById('tk-price').textContent = '$' + total.toLocaleString('en-US', {minimumFractionDigits:2});

        const perEl = document.getElementById('tk-per-person');
        if (f.passengers > 1) {
            perEl.textContent = '$' + (total / f.passengers).toFixed(2) + '/person';
        } else {
            perEl.textContent = '';
        }

        document.getElementById('tk-pax-name').textContent = userInfo.name;
        document.getElementById('tk-pax-contact').textContent = userInfo.contact;
        document.getElementById('tk-pax-contact-label').textContent = userInfo.method === 'Credit Card' ? 'Card (last 4)' : 'Contact';
        document.getElementById('tk-pay-method').textContent = userInfo.method;

        const ref = f.id + '-' + Math.random().toString(36).substring(2,7).toUpperCase();
        document.getElementById('tk-ref').textContent = ref;

        const barcode = document.getElementById('tk-barcode');
        barcode.innerHTML = '';
        const widths = [1,2,1,3,1,2,2,1,3,1,2,1,3,2,1,2,1,3,1,2,1,1,3,2,1,2,3,1];
        widths.forEach((w, i) => {
            const bar = document.createElement('div');
            bar.className = 'bp-bar';
            bar.style.width = w + 'px';
            bar.style.height = (i % 4 === 0 ? 40 : i % 3 === 0 ? 32 : 26) + 'px';
            barcode.appendChild(bar);
        });

        document.getElementById('ticketOverlay').classList.add('show');
    }

    function closeTicket() {
        document.getElementById('ticketOverlay').classList.remove('show');
    }

    document.getElementById('ticketOverlay').addEventListener('click', function(e) {
        if (e.target === this) closeTicket();
    });

    function showToast(msg) {
        const t = document.getElementById('toast');
        t.textContent = msg;
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 3200);
    }
</script>
@endsection