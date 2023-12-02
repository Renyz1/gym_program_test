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
    <title>Svorio Metimo Programa</title>
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
        <h1>Svorio Metimo Programa</h1>
        <h2>Welcome, <?php echo $user_data['user_name']; ?>!</h2>

        <div class="program-details">
            <h3>Program Details</h3>
            <p>Program Name: Svorio Metimo Programa</p>
            <p>Program Duration: 3 months</p>
        </div>

        <div class="exercises">
            <h3>Exercises</h3>
            <ul>
                <li><strong>Exercise 1</strong>: Running for 30 minutes every morning.</li>
                <li><strong>Exercise 2</strong>: High-intensity interval training (HIIT) for 20 minutes.</li>
                <li><strong>Exercise 3</strong>: Cycling for 1 hour three times a week.</li>
            </ul>
        </div>

        <div class="diets">
            <h3>Diet Plan</h3>
            <ul>
                <li><strong>Diet Plan 1</strong>: Eat a balanced diet with plenty of fruits, vegetables, lean proteins, and whole grains.</li>
                <li><strong>Diet Plan 2</strong>: Reduce intake of sugary foods and beverages, and opt for healthier alternatives.</li>
                <li><strong>Diet Plan 3</strong>: Drink plenty of water and limit portion sizes to control calorie intake.</li>
            </ul>
        </div>
    </div>

</body>
</html>