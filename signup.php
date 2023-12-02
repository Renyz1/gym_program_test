<?php
session_start();
include("connection.php");
include("functions.php");

// Function to sanitize user input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Sanitize and validate user input
$first_name = clean_input($_POST['first_name']);
$last_name = clean_input($_POST['last_name']);
$email = clean_input($_POST['email']);
$phone = clean_input($_POST['phone']);
$birthdate = clean_input($_POST['birthdate']);
$user_name = clean_input($_POST['user_name']);
$password = clean_input($_POST['password']);

// Initialize $user_name here to avoid undefined variable warning
$user_name = mysqli_real_escape_string($con, $user_name);

// Array to store error messages
$errors = [];

    // Check if first name is empty or contains numbers
    if (empty($first_name) || !preg_match("/^[a-zA-Z]+$/", $first_name)) {
        $errors["first_name"] = "Please enter a valid first name.";
    }

    // Check if last name is empty or contains numbers
    if (empty($last_name) || !preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $errors["last_name"] = "Please enter a valid last name.";
    }

    // Check if email is empty and has a valid format
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    } else {
        // Further check for a specific format using a regular expression
        $email_pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
        if (!preg_match($email_pattern, $email)) {
            $errors["email"] = "Please enter a valid email address in the format xx@xx.xx.";
        }
    }

    // Check if phone number is empty and has a valid format
    if (empty($phone) || !preg_match("/^\+3706\d{7}$/", $phone)) {
        $errors["phone"] = "Please enter a valid phone number in the format +3706XXXXXXXX.";
    }

    // Check if birthdate is empty
    if (empty($birthdate)) {
        $errors["birthdate"] = "Please enter your date of birth.";
    }

    // Check if username is empty or is numeric
    if (empty($user_name) || is_numeric($user_name)) {
        $errors["user_name"] = "Please enter a valid username.";
    }

    // Check if password is empty
    if (empty($password)) {
        $errors["password"] = "Please enter a password.";
    }
}
// If there are no errors, proceed with user registration
if (empty($errors)) {
    // Check if the user already exists
    $user_name = mysqli_real_escape_string($con, $user_name);  // Sanitize input
    $query = "SELECT * FROM members WHERE username='$user_name'";
    $result = mysqli_query($con, $query);

    // Assuming the program_id is passed in $program
    $program = isset($_POST['program']) ? (int)$_POST['program'] : 0;

    if (mysqli_num_rows($result) > 0) {
        $errors["username"] = "Username already exists. Please choose a different username.";
    } else {
        // Save to the members table
        $query = "SELECT MAX(member_id) AS max_id FROM members";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $max_id = $row['max_id'];
        $member_id = $max_id + 1;

        $insertQuery = "INSERT INTO members (member_id, first_name, last_name, email, phone, birthdate, username, password) VALUES ('$member_id', '$first_name', '$last_name', '$email', '$phone', '$birthdate', '$user_name', '$password')";
        mysqli_query($con, $insertQuery);

        // Insert the program association into member_programs
        $programInsertQuery = "INSERT INTO member_programs (member_id, program_id, start_date, end_date, trainer_id) VALUES ('$member_id', '$program', 'YYYY-MM-DD', 'YYYY-MM-DD', 1)";
        mysqli_query($con, $programInsertQuery);

        header("Location: login.php");
        die();
    }
}


// Fetch program options from the 'sports_programs' table
$program_query = "SELECT * FROM sports_programs";
$program_result = mysqli_query($con, $program_query);

$program_options = "";
if (mysqli_num_rows($program_result) > 0) {
    while ($row = mysqli_fetch_assoc($program_result)) {
        $program_id = $row['program_id'];
        $program_name = $row['program_name'];
        $program_options .= "<option value='$program_id'>$program_name</option>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-image: url('signupchad.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        #box {
            background-color: rgba(255, 255, 255, 0.8);
            margin: 10% auto;
            width: 90%;
            max-width: 400px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            text-align: center;
        }

        #box img {
            display: block;
            margin: 0 auto;
        }

        #text {
            height: 40px;
            border-radius: 5px;
            padding: 10px;
            border: solid 1px #aaa;
            width: 100%;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        #button {
            padding: 10px;
            width: 100%;
            color: white;
            background-color: lightblue;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #button:hover {
            background-color: #0077b6;
        }

        #box label {
            font-size: 16px;
            color: #333;
            font-weight: bold;
            display: block; /* Added to make labels appear in a new line */
            margin-top: 10px; /* Added to separate labels from the input fields */
        }

        #box select {
            height: 40px;
            border-radius: 5px;
            padding: 5px;
            border: solid 1px #aaa;
            width: 100%;
            margin-bottom: 20px;
        }

        #box a {
            text-align: center;
            display: block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }

        #box a:hover {
            color: #0077b6;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <div style="font-size: 24px; margin: 10px; color: #333;">Signup</div>

            <label for="first_name">First Name:</label>
            <input id="text" type="text" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" maxlength="100">
            <span class="error"><?php echo isset($errors["first_name"]) ? $errors["first_name"] : ''; ?></span>

            <label for="last_name">Last Name:</label>
            <input id="text" type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>" maxlength="100">
            <span class="error"><?php echo isset($errors["last_name"]) ? $errors["last_name"] : ''; ?></span>

            <label for="email">Email:</label>
            <input id="text" type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" maxlength="100">
            <span class="error"><?php echo isset($errors["email"]) ? $errors["email"] : ''; ?></span>

            <label for="phone">Phone Number:</label>
            <input id="text" type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" maxlength="12">
            <span class="error"><?php echo isset($errors["phone"]) ? $errors["phone"] : ''; ?></span>

            <label for="birthdate">Date of Birth:</label>
            <input id="text" type="date" name="birthdate" value="<?php echo isset($_POST['birthdate']) ? $_POST['birthdate'] : ''; ?>">
            <span class="error"><?php echo isset($errors["birthdate"]) ? $errors["birthdate"] : ''; ?></span>

            <label for="user_name">Username:</label>
            <input id="text" type="text" name="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" maxlength="100">
            <span class="error"><?php echo isset($errors["username"]) ? $errors["username"] : ''; ?></span>



            <label for="password">Password:</label>
            <input id="text" type="password" name="password" maxlength="100">
            <span class="error"><?php echo isset($errors["password"]) ? $errors["password"] : ''; ?></span>

            <label for="program">Select a program:</label><br>
            <select id="program" name="program">
                <?php echo $program_options; ?>
            </select>

            <input id="button" type="submit" value="Signup">
            <a href="login.php">Click to Login</a>
        </form>
    </div>
</body>
</html