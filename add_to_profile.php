<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($user_data) {
    if (isset($_GET['program_id'])) {
        $program_id = $_GET['program_id'];

        $member_id = $user_data['member_id'];

        $check_sql = "SELECT * FROM member_programs WHERE member_id = '$member_id' AND program_id = '$program_id'";
        $check_result = mysqli_query($con, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            echo '<script>alert("You already have this program in your active programs.");</script>';
                echo '<script>window.location.href = "index.php";</script>';
        } else {
            $insert_sql = "INSERT INTO member_programs (member_id, program_id, start_date, end_date) VALUES ('$member_id', '$program_id', NOW(), NOW())";
            $insert_result = mysqli_query($con, $insert_sql);

            if ($insert_result) {
                echo '<script>alert("Program added to your profile successfully!");</script>';
                echo '<script>window.location.href = "index.php";</script>';
            } else {
                echo "Error adding the program to your profile.";
            }
        }
    } else {
        echo "Invalid program ID.";
    }
} else {
    echo "You must be logged in to add a program to your profile.";
}
?>
