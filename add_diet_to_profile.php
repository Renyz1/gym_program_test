<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);


$user_data = check_login($con);

if ($user_data) {
    if (isset($_GET['plan_id'])) {
        $plan_id = $_GET['plan_id'];

        $member_id = $user_data['member_id'];

        $insert_sql = "INSERT INTO nutritional_recommendations (member_id, plan_id, recommended_at) VALUES (?, ?, NOW())";

        if ($stmt = mysqli_prepare($con, $insert_sql)) {
            mysqli_stmt_bind_param($stmt, "ii", $member_id, $plan_id);
            if (mysqli_stmt_execute($stmt)){
                echo '<script>alert("Diet plan added to your recommendations successfully!");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            } else {
                echo "Error adding the diet plan to your recommendations: " . mysqli_error($con);
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing the statement: " . mysqli_error($con);
        }
    } else {
        echo "Invalid diet plan ID.";
    }
} else {
    echo "You must be logged in to add a diet plan to your recommendations.";
}
