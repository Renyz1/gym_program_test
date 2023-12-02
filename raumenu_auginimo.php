<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$creation_date = $user_data['date']; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Raumenu Auginimo Programa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1, h2, h3 {
            color: #333;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .program-details {
            margin-bottom: 20px;
        }

        .exercises {
            margin-bottom: 40px;
        }

        .diets {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Raumenu Auginimo Programa</h1>
        <h2>Welcome, <?php echo $user_data['user_name']; ?>!</h2>

        <div class="program-details">
            <h3>Program Details</h3>
            <p>Program Name: Raumenu Auginimo Programa</p>
            <p>Program Duration: 6 months</p>
        </div>

        <div class="exercises">
            <h3>Exercises</h3>
            <ul>
                <li><strong>Exercise 1</strong>: Squats - Perform 3 sets of 10 reps with heavy weights to target your quadriceps, hamstrings, and glutes.</li>
                <li><strong>Exercise 2</strong>: Bench Press - Do 3 sets of 8 reps with moderate to heavy weights to focus on your chest, shoulders, and triceps.</li>
                <li><strong>Exercise 3</strong>: Deadlifts - Perform 3 sets of 6 reps with challenging weights to engage your entire body and promote overall muscle growth.</li>
            </ul>
        </div>

        <div class="diets">
            <h3>Diet Plan</h3>
            <ul>
                <li><strong>Diet Plan 1</strong>: High Protein Diet - Consume lean sources of protein such as chicken, fish, and tofu along with complex carbohydrates and healthy fats to support muscle growth and recovery.</li>
                <li><strong>Diet Plan 2</strong>: Pre-Workout Nutrition - Prioritize consuming a balanced meal containing carbohydrates and protein about 1-2 hours before your workout to provide energy and promote muscle synthesis.</li>
                <li><strong>Diet Plan 3</strong>: Post-Workout Recovery - After your workout, have a protein-rich meal or shake to replenish nutrients and support muscle repair and growth.</li>
            </ul>
        </div>
    </div>

</body>
</html>