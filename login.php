<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password)) {
        $member_query = "SELECT * FROM members WHERE username = '$user_name' LIMIT 1";
        $member_result = mysqli_query($con, $member_query);

        if ($member_result && mysqli_num_rows($member_result) > 0) {
            $user_data = mysqli_fetch_assoc($member_result);

            if ($password == $user_data['password']) {
                $_SESSION['member_id'] = $user_data['member_id'];
                header("Location: index.php");
                die();
            } else {
                echo "Wrong username or password!";
            }
        } else {
            // Check if it's an admin login
            $admin_query = "SELECT * FROM admin WHERE admin_username = '$user_name' LIMIT 1";
            $admin_result = mysqli_query($con, $admin_query);

            if ($admin_result && mysqli_num_rows($admin_result) > 0) {
                $admin_data = mysqli_fetch_assoc($admin_result);

                if ($password == $admin_data['admin_password']) {
                    // Redirect to the admin page
                    header("Location: admin.php");
                    die();
                } else {
                    echo "Wrong username or password!";
                }
            } else {
                echo "Wrong username or password!";
            }
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="box">
    <form method="post">
    <div style="font-size: 24px; margin: 10px; color: #333;">Login</div>
    <input id="text" type="text" name="user_name" placeholder="Username"> 
    <input id="text" type="password" name="password" placeholder="Password">
    <input id="button" type="submit" value="Login">
    <a href="signup.php">Click to Signup</a>
    </form>
    </div>
</body>
</html>
