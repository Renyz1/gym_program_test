<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gym Website</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Gym Website</h1>
    <div id="auth-buttons">	
	  <button onclick="window.location.href='logout.php'">Logout</button>
    </div>
  </header>
  <main>
    <form id="exercise-form">
      <label for="muscle-group">Choose a muscle group:</label>
      <select id="muscle-group">
        <option value="">--Select a muscle group--</option>
        <option value="chest">Chest</option>
        <option value="back">Back</option>
        <option value="legs">Legs</option>
        <option value="arms">Arms</option>
      </select>
      <button type="submit">Submit</button>
    </form>
    <div id="exercise-list"></div>
  </main>
  <div id="auth-forms">
    <form id="login-form">
      <h2>Login</h2>
      <label for="login-username">Username</label>
      <input type="text" id="login-username">
      <label for="login-password">Password</label>
      <input type="password" id="login-password">
      <button type="submit">Login</button>
    </form>
    <form id="register-form">
      <h2>Register</h2>
      <label for="register-username">Username</label>
      <input type="text" id="register-username">
      <label for="register-password">Password</label>
      <input type="password" id="register-password">
      <label for="register-confirm-password">Confirm Password</label>
      <input type="password" id="register-confirm-password">
      <button type="submit">Register</button>
    </form>
  </div>
  <footer>
    <p>&copy; 2023 Gym Website</p>
  </footer>
  <script src="script.js"></script>
</body>  
</html>
