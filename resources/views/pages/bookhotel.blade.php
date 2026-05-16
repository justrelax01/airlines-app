@extends('layouts.app')

@section('title', 'Book Hotel Page')

@section('styles')
     <link rel="stylesheet" href="external.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

    * { 
          margin: 0;
           padding: 0; 
           box-sizing: border-box; 
          }
          
  body{
    background-image: url(images/plane3.jpg) ;
    background-size:cover;
    background-position: center;

}
/* New styles for the table */
table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    border-spacing: 0;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
  }

  button {
    padding: 8px 12px;
    background-color: #2563eb;
    color: #fff;
    border: none;
    cursor: pointer;
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
          <a href="#"><img src="" /><img /></a>
        </div>
        <nav>
          <div class="nav-mobile">
            <a id="nav-toggle" href="#!"><span class="material-icons"></span></a>
          </div>
          <ul class="nav-list selected">
            <li>
              <a href="home.html">Home</a>
            </li>
            <li>
              <a href="Flights.html">Flights</a>
            </li>
            <li>
              <a href="faq&feedb.html">FaQ & Feedback</a>
            </li>
            <li>
              <a href="#yyy">About</a>
            </li>
            <li>
              <a href="login.html">Login or Register</a>
            </li>
            <li>
              <a href="searchflights.html"><i class="fa-solid fa-magnifying-glass"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </section>


      <div class="container1">
        
        <form >
          <div class="form">

            <h2 class="text-b">Booking Details</h2> 
            
            <div class="input1">
            <input type="text" class="input-group" id="text-from" placeholder="country ">
            <input type="text" class="input-group" id="text-to" placeholder="city ">
            <select class="input-group">
              <option value="">Preffered room</option>
              <option value="">single room</option>
              <option value="">double room</option>
              <option value="">suite</option>

            </select>

           </div>
           
           <div class="input2">
            <input type="text" class="input-group" placeholder="Age" id="age">
           

           </div>
           
          

           <!-- <div class="input3">
            <span class="text-select">Select Your Fare</span>
             <input type="radio" class="input-group" name="r">
            <label class="text-choice" for="input-group">One way</label>
             <input type="radio" class="input-group" name="r">
            <label class="text-choice" for="input-group">Round Trip</label>
          
           </div> -->

           <div class="input4">
            <input type="date" class="input-group" id="return-date" >
            <input type="time" class="input-group" placeholder="Return time" id="return-time">
            <input type="text" class="input-group1" placeholder="Any Message">

           </div>

           <div class="input5">
            <h2 class="text-choice">Personal Details</h2>

           </div>

           <div class="input6">
            <input type="text" class="input-group" placeholder="Full Name" id="full-name">
            <input type="text" class="input-group" placeholder="Phone Number" id="phone">
            <input type="email" class="input-group1" placeholder="Enter your Email" id="email">

           </div>

           <div id="errmessages" class="message"></div> 
       
           <div id="errmessages1" class="message"></div>
        
           <div id="errmessages2" class="message"></div>
        
           <button type="button" onclick="makeabooking()" class="btn-booking">Submit Form</button>
           <button type="reset" class="btn-booking-clear">Clear Form</button>

      <div id="bookCountMessage" style="display: none; margin-top: 10px"></div>

      <table id="bookingsTable" style="display: none; margin-top: 20px;">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Phone Number</th>
            <th>city</th>
            <th>country</th>
            <th>booking Time</th>
            <th>book date</th>
            <th>hotel name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="bookPostsContainer"></tbody>
      </table>

    </form>
  </div>
      
      




    
@endsection

@section('scripts')
    <script src="js.js"></script>
@endsection