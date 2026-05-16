








/* Search flights */
document.addEventListener("DOMContentLoaded", function () {

 
  const searchForm = document.querySelector('.bk_search_form form');
  if (searchForm) {
    searchForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const searchData = {
        from:       document.getElementById('departure').value.trim().toLowerCase(),
        to:         document.getElementById('arrival').value.trim().toLowerCase(),
        date:       document.getElementById('departure-date').value,
        returnDate: document.getElementById('return-date').value,
        passengers: parseInt(document.getElementById('passengers').value),
        cabinClass: document.getElementById('class').value
      };
      sessionStorage.setItem('flightSearch', JSON.stringify(searchData));
      window.location.href = 'flights.html';
    });
  }
});

function viewDestinationFlights(destination) {
  sessionStorage.setItem('flightSearch', JSON.stringify({
    from:       '',
    to:         destination.toLowerCase(),  
    passengers: 1,
    cabinClass: ''
  }));
  window.location.href = 'flights.html';
}







// scroll to top button
 const btn = document.getElementById("scrollTopBtn");
  if (btn) {
    window.onscroll = function () {
      btn.style.display = (document.body.scrollTop > 200 || 
        document.documentElement.scrollTop > 200) ? "block" : "none";
    };
    btn.onclick = function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
  }










/*booking*/

  function makeabooking() {
  
    const fullname = document.getElementById("full-name").value;
    const email = document.getElementById("email").value;
  
    const textfrom = document.getElementById("text-from").value;
    const textto = document.getElementById("text-to").value;
    const phonenb = document.getElementById("phone").value;
    const age = document.getElementById("age").value;
    const returntime = document.getElementById("return-time").value;
    const returndate = document.getElementById("return-date").value;
    const errorMessages = document.getElementById("errmessages");
    const errorMessages1 = document.getElementById("errmessages1");
    const errorMessages2 = document.getElementById("errmessages2");

  // Validation
    if (!textfrom || !textto || !email || !age || !phonenb || !fullname || !returntime || !returndate) { 
    errorMessages.innerHTML = "All fields are required!";
    return;
  }

  if (isNaN(age) || age < 3 || age > 95) {
    errorMessages1.innerHTML = "Age should be a number between 3 and 95.";
    return;
  }

  if (phonenb.length !== 8 || isNaN(phonenb)) {
    errorMessages2.innerHTML = "Check your phone number!";
    return;
  }


  errorMessages.innerHTML = "";
  errorMessages1.innerHTML = "";
  errorMessages2.innerHTML = "";

  // Create a table row with delete button
  const tableRow = document.createElement("tr");
  tableRow.innerHTML = `
      <td>${fullname}</td>
      <td>${email}</td>
      <td>${age}</td>
      <td>${phonenb}</td>
      <td>${textfrom}</td>
      <td>${textto}</td>
      <td>${returndate}</td>
      <td>${returntime}</td>
      <td>hotel 1</td>
      <td><button onclick="deleteBooking(this)">Delete</button></td>
    `;

  // Append the table row to the table body
  const bookPostsContainer = document.getElementById("bookPostsContainer");
  bookPostsContainer.appendChild(tableRow);

  // Show the table and update the count message
  const bookingsTable = document.getElementById("bookingsTable");
  bookingsTable.style.display = "table";
  const bookCountMessage = document.getElementById("bookCountMessage");
  bookCountMessage.style.display = "block";
  bookCountMessage.innerText = `Total Bookings: ${bookPostsContainer.children.length}`;

 
}


//delete the booking in the booking page
function deleteBooking(button) {
  const row = button.closest("tr");
  row.remove();
  const bookPostsContainer = document.getElementById("bookPostsContainer");
  const bookCountMessage = document.getElementById("bookCountMessage");
  bookCountMessage.innerText = `Total Bookings: ${bookPostsContainer.children.length}`;
}


function nn(){
  window.location.href="bookhotel.html";
}












/*login*/
function submitlogin() {
  const email = document.getElementById("email").value;
  const pass = document.getElementById("pass").value;
  const errorMessages = document.getElementById("errmessages");
  const errorMessages1 = document.getElementById("errmessages1");
  const errorMessages2 = document.getElementById("errmessages2");

  //validation
  if (!email || !pass) {
    errorMessages.innerHTML = "All fields are required";
    return;
  }

  // const passRegex =/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,30}$/;

  // if (pass.length < 8 || pass.length > 30 || !pass.match(passRegex) ) {
    
  //   errorMessages2.innerHTML =
  //   "password should be between 8 or 30 and should contain at least a capital letter and 1 special character and a number";
  //   return;
  // }
 
  if (!email.includes("@")) {
    errorMessages1.innerHTML = "email should contain @";
    return ;
  }

  errorMessages.innerHTML = "";
  errorMessages1.innerHTML = "";
  errorMessages2.innerHTML = "";

  window.location.href = "home.html";
  
 
}









/*registration*/
function submitreg() {
  const email = document.getElementById("email").value;
  const pass = document.getElementById("pass").value;
  const fname = document.getElementById("fname-register").value;
  const lname = document.getElementById("lname-register").value;
  const passconfirm = document.getElementById("passcon-register").value;
  const errorMessages = document.getElementById("errmessages");
  const errorMessages1 = document.getElementById("errmessages1");
  const errorMessages2 = document.getElementById("errmessages2");

  if (!email || !pass || !fname || !lname || !passconfirm) {
    errorMessages.innerHTML = "All fields are required";
    return;
  }

  // Improved password validation
  const passRegex =/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,30}$/;

  if (!pass.match(passRegex)) {
   
    errorMessages2.innerHTML = 
    "Password should be between 8 and 30 characters,and must contain at least one lowercase letter,one uppercase letter,one digit,and one special character(!@#$%^&*()_+)";
    return;
  }

  if (pass !== passconfirm) {
    errorMessages1.innerHTML = "Passwords do not match";
    return;
  }

  // Clear error messages if everything is valid
  errorMessages.innerHTML = "";
  errorMessages1.innerHTML = "";
  errorMessages2.innerHTML = "";

  
  window.location.href = "home.html";


}







/*FaQ & feedback page*/














/* Flights page*/


// document.getElementById('par_tickets_available').innerHTML=`
//         <h1>Available Flights</h1>
//         <p>Here are the flights available for your travel needs.</p>
//       `;

     
//       const flights = [
        
//       {
//           id:         "AA1425",
//           cabinClass: "Economy",
//           from: { iata: "NYC", city: "new york",  time: "07:30", date: "May 15, 2026" },
//           to:   { iata: "LON", city: "london",    time: "19:45", date: "May 15, 2026" },
//           returnDate: "May 22, 2026",
//           passengers: 1,
//           gate:       "F18",
//           price:      850,
//           specialOffer:null
//         },
//         {
//           id:         "BA2890",
//           cabinClass: "Business",
//           from: { iata: "LAX", city: "Los Angeles", time: "14:20", date: "May 18, 2026" },
//           to:   { iata: "TYO", city: "Tokyo",       time: "18:30", date: "May 19, 2026" },
//           returnDate: "May 28, 2026",
//           passengers: 1,
//           gate:       "B12",
//           price:      2400,
//           specialOffer: null
//         },

//         {
//           id:"DL5673",
//           cabinClass:"Economy",
//           from:{iata:"MIA", city:"miami", time:"9:15",date :"June 02,2026"},
//           to:{iata:"PAR",city:"paris",time:"23:40",date:"June 02,2026"},
//           returnDate:"June 10,2026",
//           passengers: 2,
//           gate:"A24",
//           price:1200,
//           specialOffer:"Special Offer"
//         },

//         {
//           id:"BP4321",
//           cabinClass:"First",
//           from:{iata:"Bei",city:"beirut",time:"12:00",date:"july 05,2026"},
//           to:{iata:"Par",city:"paris",time:"16:30",date:"july 05,2026"},
//           returnDate:"july 15,2026",
//           passengers: 1,
//           gate:"C3",
//           price:1000,
//           specialOffer:null
//         },
//       ];
      
      
//       document.getElementById('showing_nb_available').innerHTML=`
//         <p>Showing ${flights.length} available flights.</p>
//       `;

//        const icons = {
//         plane: `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
//                   <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5z"/>
//                 </svg>`,
//         calendar: `<svg viewBox="0 0 24 24">
//                      <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1h-2zm3 18H5V8h14v11z"/>
//                    </svg>`,
//         people: `<svg viewBox="0 0 24 24">
//                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
//                  </svg>`,
//         gate: `<svg viewBox="0 0 24 24">
//                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
//                </svg>`
//       };

//     function createTicketHTML(flight) {
//         const badgeClass = flight.cabinClass.toLowerCase();
//         const badgeHTML = flight.specialOffer
//           ? `<div class="special-offer-badge">${flight.specialOffer}</div>`
//           : '';
 
//         const perPersonHTML = flight.passengers > 1
//           ? `<div class="price-per-person">$${(flight.price / flight.passengers).toFixed(2)}/person</div>`
//           : '';
 
//         return `
//           <div class="ticket-wrapper">
 
//             ${badgeHTML}
 
//             <div class="ticket">
//               <div class="ticket-left">
 
//                 <div class="ticket-header">
//                   <div class="flight-id-group">
//                     <div class="plane-icon-box">${icons.plane}</div>
//                     <div>
//                       <div class="flight-id-label">Flight ID</div>
//                       <div class="flight-id-number">${flight.id}</div>
//                     </div>
//                   </div>
//                   <span class="class-badge ${badgeClass}">${flight.cabinClass}</span>
//                 </div>
 
//                 <div class="route-row">
//                   <div class="airport-from">
//                     <div class="iata-code">${flight.from.iata}</div>
//                     <div class="city-name">${flight.from.city}</div>
//                     <div class="flight-time">${flight.from.time}</div>
//                     <div class="flight-date">${flight.from.date}</div>
//                   </div>
//                   <div class="connector">
//                     <div class="connector-line"></div>
//                     <div class="connector-plane">${icons.plane}</div>
//                   </div>
//                   <div class="airport-to">
//                     <div class="iata-code">${flight.to.iata}</div>
//                     <div class="city-name">${flight.to.city}</div>
//                     <div class="flight-time">${flight.to.time}</div>
//                     <div class="flight-date">${flight.to.date}</div>
//                   </div>
//                 </div>
 
//                 <div class="meta-row">
//                   <div class="meta-item">
//                     ${icons.calendar}
//                     <div>
//                       <div class="meta-label">Return</div>
//                       <div class="meta-value">${flight.returnDate}</div>
//                     </div>
//                   </div>
//                   <div class="meta-item">
//                     ${icons.people}
//                     <div>
//                       <div class="meta-label">Passengers</div>
//                       <div class="meta-value">${flight.passengers}</div>
//                     </div>
//                   </div>
//                   <div class="meta-item">
//                     ${icons.gate}
//                     <div>
//                       <div class="meta-label">Gate</div>
//                       <div class="meta-value">${flight.gate}</div>
//                     </div>
//                   </div>
//                 </div>
 
//               </div>
 
//               <div class="ticket-divider">
//                 <div class="notch"></div>
//                 <div class="notch"></div>
//               </div>
 
//               <div class="ticket-right">
//                 <div class="price-label">Total Price</div>
//                 <div class="price-amount">$${flight.price.toLocaleString()}</div>
//                 ${perPersonHTML}
//                 <button class="addtocart-btn" onclick="buynow(${flights.indexOf(flight)})">Buy now</button>
//               </div>
//             </div>
 
//           </div>
//         `;
//       }
 
//       const container = document.getElementById('tickets-container');
//       container.innerHTML = flights.map(flight => createTicketHTML(flight)).join('');
 

// document.addEventListener("DOMContentLoaded", function () {

//   const parTickets = document.getElementById('par_tickets_available');
//   if (!parTickets) return; 

//   const raw = sessionStorage.getItem('flightSearch');
//   const search = raw ? JSON.parse(raw) : null;
//   let filteredFlights = flights; 

//   if (search) {
//     filteredFlights = flights.filter(flight => {
//   const fromMatch = !search.from ||
//     flight.from.city.toLowerCase().includes(search.from) ||
//     flight.from.iata.toLowerCase().includes(search.from);

//   const toMatch = !search.to ||
//     flight.to.city.toLowerCase().includes(search.to) ||
//     flight.to.iata.toLowerCase().includes(search.to);

//   const classMatch = !search.cabinClass ||
//     flight.cabinClass.toLowerCase() === search.cabinClass;

//   const passengersMatch = !search.passengers || 
//     flight.passengers >= search.passengers;

//   return fromMatch && toMatch && classMatch && passengersMatch;

//     });

//     parTickets.innerHTML = `
//       <h1>Flights to ${search.to.charAt(0).toUpperCase() + search.to.slice(1)}</h1>
//       <p>Showing all available flights to this destination.</p>
//     `;
//   } else {

//     parTickets.innerHTML = `
//       <h1>Available Flights</h1>
//       <p>Here are the flights available for your travel needs.</p>
//     `;
//   }

//   document.getElementById('showing_nb_available').innerHTML =
//     filteredFlights.length > 0
//       ? `<p>Showing ${filteredFlights.length} available flight(s).</p>`
//       : `<p>No flights found. <a href="searchflights.html">Try again</a></p>`;

//   const container = document.getElementById('tickets-container');
//   container.innerHTML = filteredFlights.map(flight => createTicketHTML(flight)).join('');

//   sessionStorage.removeItem('flightSearch');
// });


// function buynow(index) {
//   sessionStorage.setItem('selectedFlight', JSON.stringify(flights[index]));
//   window.location.href = "payment.html";
// }






// payment page





