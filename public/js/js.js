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
      var searchData = {
        from: document.getElementById('departure').value.trim().toLowerCase(),
        to: document.getElementById('arrival').value.trim().toLowerCase(),
        date: document.getElementById('departure-date').value,
        returnDate: document.getElementById('return-date').value,
        passengers: parseInt(document.getElementById('passengers').value),
        cabinClass: document.getElementById('class').value
      };
      sessionStorage.setItem('flightSearch', JSON.stringify(searchData));
      window.location.href = window.Routes && window.Routes.flights || '/flights';
    });
  }
});
function viewDestinationFlights(destination) {
  sessionStorage.setItem('flightSearch', JSON.stringify({
    from: '',
    to: destination.toLowerCase(),
    passengers: 1,
    cabinClass: ''
  }));
  window.location.href = window.Routes && window.Routes.flights || '/flights';
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
/******/ })()
;