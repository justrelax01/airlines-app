/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************!*\
  !*** ./resources/js/js.js ***!
  \****************************/



/* Search flights — redirect uses server-provided route URLs */
document.addEventListener("DOMContentLoaded", function () {
    var searchForm = document.querySelector('.bk_search_form form');
    if (searchForm) {
        searchForm.addEventListener('submit', function (e) {
            e.preventDefault();

            var from       = document.getElementById('departure').value.trim();
            var to         = document.getElementById('arrival').value.trim();
            var date       = document.getElementById('departure-date').value;
            var returnDate = document.getElementById('return-date').value;
            var passengers = document.getElementById('passengers').value;
            var cabinClass = document.getElementById('class').value;

            window.location.href = '/flights?from=' + from +'&to=' + to +'&date=' + date +                             
            '&returnDate=' + returnDate +
            '&passengers=' + passengers +                    
            '&cabinClass=' + cabinClass;
        });
    }
});

function viewDestinationFlights(destination) {
    window.location.href = '/flights?to=' + destination + '&passengers=1';
}
/* Scroll-to-top button */
var btn = document.getElementById("scrollTopBtn");
if (btn) {
  window.onscroll = function () {
    btn.style.display = document.body.scrollTop > 200 || document.documentElement.scrollTop > 200 ? "block" : "none";
  };
  btn.onclick = function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  };
}

/* Login — validates then submits the form to the server */
function submitlogin() {
  var email = document.getElementById("email").value;
  var pass = document.getElementById("pass").value;
  var errorMessages = document.getElementById("errmessages");
  var errorMessages1 = document.getElementById("errmessages1");
  if (!email || !pass) {
    errorMessages.innerHTML = "All fields are required";
    return;
  }
  if (!email.includes("@")) {
    errorMessages1.innerHTML = "Email should contain @";
    return;
  }
  errorMessages.innerHTML = "";
  errorMessages1.innerHTML = "";
  document.querySelector('form').submit();
}

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










/******/ })()
;