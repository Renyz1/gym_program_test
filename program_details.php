<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

// Check if the program ID is provided in the URL
if (isset($_GET['id'])) {
    $programId = $_GET['id'];

    // Fetch program details from the database
    $query = "SELECT * FROM programa WHERE programos_id = $programId";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $program = mysqli_fetch_assoc($result);
        $programName = $program['programa'];
        $programDuration = $program['programos_trukme'];
    } else {
        // If the program ID is not found in the database, display an error message
        echo "Invalid program ID.";
        exit;
    }
} else {
    // If the program ID is not provided in the URL, display an error message
    echo "Invalid program ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $programName; ?> - Weight Loss Program</title>
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
    <h2><?php echo $programName; ?></h2>
    <p>Program Duration: <?php echo $programDuration; ?> weeks</p>
    <div class="program-details">
      <h3>Program Overview</h3>
      <p>Write a brief overview of the weight loss program here. Describe the main goals, strategies, and benefits of the program.</p>

      <h3>Program Features</h3>
      <ul>
        <li>Feature 1</li>
        <li>Feature 2</li>
        <li>Feature 3</li>
        <!-- Add more features as needed -->
      </ul>

      <h3>Program Schedule</h3>
      <table>
        <thead>
          <tr>
            <th>Week</th>
            <th>Workout</th>
            <th>Nutrition Plan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Workout details for Week 1</td>
            <td>Nutrition plan details for Week 1</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Workout details for Week 2</td>
            <td>Nutrition plan details for Week 2</td>
          </tr>
          <!-- Add more rows for each week -->
        </tbody>
      </table>

      <h3>Testimonials</h3>
      <div class="testimonials">
        <div class="testimonial">
          <img src="testimonial1.jpg" alt="Testimonial 1">
          <p>Write a testimonial from a satisfied customer here. Share their experience and the results they achieved through the weight loss program.</p>
        </div>
        <div class="testimonial">
          <img src="testimonial2.jpg" alt="Testimonial 2">
          <p>Write another testimonial from a satisfied customer here. Highlight their transformation and how the program helped them reach their goals.</p>
        </div>
        <!-- Add more testimonials as needed -->
      </div>
    </div>

    <div class="suggestions">
      <h3>Related Programs</h3>
      <div class="program">
        <img src="related_program1.jpg" alt="Related Program 1">
        <h4>Related Program 1</h4>
        <p>Write a brief description of the related program here. Explain how it complements the weight loss program and offers additional benefits.</p>
        <a href="program_details.php?id=1">View Program Details</a>
      </div>
      <div class="program">
        <img src="related_program2.jpg" alt="Related Program 2">
        <h4>Related Program 2</h4>
        <p>Write a brief description of another related program here. Highlight the unique features and advantages it offers.</p>
        <a href="program_details.php?id=2">View Program Details</a>
      </div>
      <!-- Add more related programs as needed -->
    </div>
  </main>
  <div id="auth-forms">
    <!-- Your existing login and register forms -->
  </div>
  <footer>
    <p>&copy; <?php echo date("Y"); ?> Gym Website</p>
  </footer>
</body>  
</html>
