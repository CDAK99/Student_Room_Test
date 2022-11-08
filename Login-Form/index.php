<?php
  // Initialize the session
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- add jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
  <script src="main.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Login Form</title>
</head>
<body>

<div class="container">
    <h1>Login Page</h1>
    
    <?php 
      //if the user isn't logged in, display the login form else display login message
      if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
        echo('
        <form id="loginForm" method="post">
          <p>Please fill in this form to login to your account.</p>
          <hr>

          <label for="strUsername"><b>Username</b></label>
          <input type="text" class="form-field" placeholder="Enter Username" name="strUsername" id="strUsername" required>

          <label for="strPassword"><b>Password</b></label>
          <input type="password" class="form-field" placeholder="Enter Password" name="strPassword" id="strPassword" required>

          <button id="loginBtn" class="submit-btn">Login</button>
        </form>
        ');
      } else {
        echo('
        <hr>
        <p class="login-message">User "'.$_SESSION["username"]. '" is logged in!</p>
        <button id="logoutBtn" class="submit-btn logout-btn">Logout</button>
        ');
      } 
    ?>
  <!-- div to display error message -->
  <div id="messageDiv"></div>
</div>

</body>
</html>
