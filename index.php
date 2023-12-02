<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

function getUserData($con, $member_id) {
    $sql = "SELECT * FROM members WHERE member_id = $member_id"; 
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return array();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Training Studio - Free CSS Template</title>
<!--

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-training-studio.css">

    </head>
    
    <body>
    
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a class="logo">Simple<em> Gym</em></a>
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#features">Programs</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">Dieting</a></li>
                            <li class="scroll-to-section"><a href="#trainers">Trainers</a></li>
                            <li class="scroll-to-section"><a href="#my-profile">Profile</a></li>
                            <li class="logout"><a href="logout.php">Log Out</a></li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>work harder, get stronger</h6>
                <h2>Simple with our <em>gym</em></h2>
                <div class="main-button scroll-to-section">
                    <a href="#my-profile">My profile</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Features Item Start ***** -->
    <section class="section" id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading">
                    <h2>Free <em>Programs</em></h2>
                    <img src="assets/images/line-dec.png" alt="waves">
                    <p>Our free programs make it simple to find your desired results.</p>
                    <p>Choose a free program that you want to follow, and we will do the rest.</p>
                </div>
            </div>

            <?php
// Query to retrieve program names and descriptions from the sports_programs table
$sql = "SELECT program_id, program_name, program_description FROM sports_programs";
$result = mysqli_query($con, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $programId = $row["program_id"]; 
        $programName = $row["program_name"];
        $programDescription = $row["program_description"];

        echo '<div class="col-lg-6">';
        echo '<ul class="features-items">';
        echo '<li class="feature-item">';
        echo '<div class="left-icon">';
        echo '<img src="assets/images/features-first-icon.png" alt="' . $programName . '">';
        echo '</div>';
        echo '<div class="right-content">';
        echo '<h4>' . $programName . '</h4>';
        echo '<p>' . $programDescription . '</p>';
        echo '<a href="add_to_profile.php?program_id=' . $programId . '" class="text-button">Add to my profile</a>';
        echo '</div>';
        echo '</li>';
        echo '</ul>';
        echo '</div>';
    }
} else {
    echo "No programs found";
}
        ?>


        </div>
    </div>
</section>

    <!-- ***** Our Diets Start ***** -->
<section class="section" id="our-classes">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading">
                    <h2>Free <em>Diets</em></h2>
                    <img src="assets/images/line-dec.png" alt="">
                    <p>Free diet plans provide cost-effective solutions for individuals looking to enhance their well-being and achieve specific health and fitness objectives without the burden of financial commitments.</p>
                </div>
            </div>
        </div>
        <div class="row" id="tabs">
            <div class="col-lg-4">
                <ul>
                    <?php
                    $sql = "SELECT plan_name, plan_description FROM diet_plans";
                    $result = mysqli_query($con, $sql);
                    $planNumber = 5;

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $planName = $row["plan_name"];
                            $planDescription = $row["plan_description"];
                    ?>
                    <li><a href='#tabs-<?php echo $planNumber; ?>'><img src="assets/images/tabs-first-icon.png" alt=""><?php echo $planName; ?></a></li>
                    <?php
                            $planNumber++;
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-lg-8">
                <section class='tabs-content'>
                    <?php
                    // Reset the result pointer to the beginning of the results
                    mysqli_data_seek($result, 0);

                    $planNumber = 5;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $planName = $row["plan_name"];
                        $planDescription = $row["plan_description"];
                    ?>
                    <article id='tabs-<?php echo $planNumber; ?>'>
                        <img src="assets/images/diet-image-<?php echo $planNumber; ?>.jpg" alt="<?php echo $planName; ?>">
                        <h4><?php echo $planName; ?></h4>
                        <p><?php echo $planDescription; ?></p>
                        <div class="main-button">
                        <a href="add_diet_to_profile.php?plan_id=<?php echo $planNumber; ?>" class="text-button">Add to my profile</a>
                        </div>
                    </article>
                    <?php
                        $planNumber++;
                    }
                    ?>
                </section>
            </div>
        </div>
    </div>
</section>
<!-- ***** Our Diets End ***** -->

    <!-- ***** Testimonials Starts ***** -->
    <section class="section" id="trainers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Expert <em>Trainers</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        <p>An Experienced Trainer is a seasoned fitness professional with a wealth of knowledge and a proven track record in the fitness industry. With years of hands-on experience, they will help you customize workout routines, dietary plans, and fitness strategies tailored to your individual needs.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="assets/images/first-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Yoga Trainer</span>
                            <h4>Bret D. Bowers</h4>
                            <p>A Yoga Trainer is a certified instructor who specializes in the ancient practice of yoga. They guide individuals through various yoga postures, breathing exercises, and meditation techniques to promote physical and mental well-being. Yoga Trainers help their clients improve flexibility, reduce stress, and achieve harmony between mind and body.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="assets/images/second-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Muscle Trainer</span>
                            <h4>Hector T. Daigl</h4>
                            <p>A Muscle Trainer, often referred to as a Strength or Resistance Trainer, is an expert in designing and implementing workout routines focused on building muscle strength and endurance. They create personalized exercise programs, emphasizing weightlifting and resistance training, to help clients increase muscle mass, improve overall fitness, and reach their strength-related fitness goals.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="assets/images/third-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Calisthenics Trainer</span>
                            <h4>Paul D. Newman</h4>
                            <p>A Calisthenics Trainer specializes in bodyweight exercises and functional fitness. They teach individuals how to use their own body weight for resistance in exercises such as push-ups, pull-ups, and bodyweight squats. Calisthenics Trainers assist clients in developing strength, balance, and agility while promoting a holistic approach to fitness that requires minimal equipment.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Testimonials Ends ***** -->

<!-- ***** My Profile Section Starts ***** -->
<section class="section" id="my-profile">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading">
                    <h2>My <em>Profile</em></h2>
                    <img src="assets/images/line-dec.png" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="my-profile">
                    <?php
                    // Retrieve user data
                    $user_data = getUserData($con, $user_data['member_id']);

                    $birthdate = new DateTime($user_data['birthdate']);
                    $today = new DateTime();
                    $age = $today->diff($birthdate)->y;

                    // Display user information
                    echo '<h3>Welcome, ' . $user_data['first_name'] . '!</h3>';
                    echo '<p>Email: ' . $user_data['email'] . '</p>';
                    echo '<p>Member Since: ' . $user_data['join_date'] . '</p>';
                    echo '<p>Age: ' . $age . ' years</p>';
                    ?>

                    <!-- Display chosen programs -->
                    <h3>My Programs</h3>
                    <ul>
                        <?php
                        $user_id = $user_data['member_id']; 

                        if ($con) {
                            $query = "SELECT sports_programs.program_name FROM member_programs
                                      INNER JOIN sports_programs ON member_programs.program_id = sports_programs.program_id
                                      WHERE member_programs.member_id = $user_id";

                            $result = mysqli_query($con, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<li>' . $row['program_name'] . '</li>';
                                }
                            } else {
                                echo '<li>No programs chosen</li>';
                            }

                        } else {
                            echo '<li>Database connection failed</li>';
                        }
                        ?>
                    </ul>

<!-- Display chosen diet plans -->
<section class="section" id="my-profile">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="my-diet-plans">
                    <h3>My Diet Plans</h3>
                    <ul>
                        <?php
                        // Ensure database connection
                        if ($con) {
                            $user_id = $user_data['member_id']; 
                            $sql = "SELECT diet_plans.plan_id, diet_plans.plan_name, diet_plans.plan_content 
                                    FROM diet_plans 
                                    INNER JOIN nutritional_recommendations ON diet_plans.plan_id = nutritional_recommendations.plan_id 
                                    WHERE nutritional_recommendations.member_id = $user_id";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                // Check if there are rows in the result set
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<li>Plan Name: ' . $row['plan_name'] . '</li>';
                                        echo '<li>Plan Content: ' . $row['plan_content'] . '</li>';
                                        echo '<br>';
                                    }
                                } else {
                                    echo '<li>No diet plans found for the member</li>';
                                }
                                // Free the result set
                                mysqli_free_result($result);
                            } else {
                                // Display an error message
                                echo '<li>Error executing query: ' . mysqli_error($con) . '</li>';
                            }

                            // Close the database connection
                        } else {
                            echo '<li>Database connection failed</li>';
                        }
                        mysqli_close($con);
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ***** My Profile Section Ends ***** -->




    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">

                    
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    
    <script src="assets/js/custom.js"></script>

  </body>
</html>