<?php
// Assuming you have a session management mechanism in place
session_start();

// Include necessary files (connection and functions)
include("connection.php");
include("functions.php");

// Check if the user is logged in as an admin
$admin_data = check_admin_login($con);

// Function to get the count of active members
function getTotalMembersCount($con) {
    $sql = "SELECT COUNT(*) as count FROM members";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    } else {
        return 0;
    }
}



// Function to check if the admin is logged in
function check_admin_login($con) {
    // Your logic to check if the user is logged in as an admin
    // This might involve checking session variables or any other authentication mechanism

    // For example:
    // if (isset($_SESSION['admin_id'])) {
    //    $admin_id = $_SESSION['admin_id'];
    //    $sql = "SELECT * FROM admin_table WHERE admin_id = $admin_id";
    //    $result = mysqli_query($con, $sql);
    //    return mysqli_fetch_assoc($result);
    // } else {
    //    header("Location: admin_login.php"); // Redirect to admin login page if not logged in
    //    exit();
    // }

    return true; // Placeholder for now
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-rS1OWJigQlnwgtfA0AA9e6u85wt9Vr++kCGRE3PqCwxp80WNrbIxm3oKE5PbxCtg" crossorigin="anonymous">
    <title>Gym Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav {
            width: 200px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        nav a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            margin-bottom: 5px;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Gym Management System</h1>
    </header>

    <nav>
        <a href="admin.php?page=home">Home</a>
        <a href="admin.php?page=members">Members</a>
        <a href="admin.php?page=programs">Programs</a>
        <a href="admin.php?page=diet_plans">Diet Plans</a>
        <a href="admin.php?page=trainers">Trainers</a>
    </nav>

    <div class="content">

    <?php
// Assuming you have a database connection established ($con)
$totalMembersCount = getTotalMembersCount($con);
?>

<!-- Display total members count with Bootstrap styling -->
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Welcome back, Administrator!</h5>
        <p class="card-text">
            <span class="badge badge-primary">
                <i class="fas fa-users"></i> Total Members: <?php echo $totalMembersCount; ?>
            </span>
        </p>
    </div>
</div>


    </div>

</body>

</html>
