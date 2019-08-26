<!DOCTYPE html>
<html lang="en">
<head>

    <?php require('../db_connect.php'); 
    session_start();

    // sets value to no if it's undefined.
    if (isset($_SESSION["loggedIn"] ) === false)
    {
        $_SESSION["loggedIn"] = "no";
    }
    // moves user directly to app if logged in already
    if ($_SESSION["loggedIn"] === "yes")
    {
        header("Location: ../app");
    }
    ?>

    <title>Facebook | Log in or Sign up</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 

    <!-- Facebook logo font -->
    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../css/login.css">

</head>
<body>

<!-- Nav bar -->
<nav class="login-nav">
    <div class="container">
        <div class="row nav-content">

            <!-- column for logo -->
            <div class="col-sm-6 fb-nav-logo">
                <i height="62" width="170">Facebook-Lite</i>
            </div>
            <!-- column for login -->
            <div class="col-lg-6">
                
                <form name="login-form" action="login.php" method="POST">

                    <!-- another row nested within the previous row for the login -->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="login-tag">Email</div>
                                <input class="login-field" type="text" name="login-email">
                            </div>
                            <div class="col-sm-2">
                                <div class="login-tag">Password</div>
                                <input class="login-field" type="password" name="login-password">
                            </div> 
                            <div class="col-sm-2">
                                <button type="submit" class="login-btn btn-primary">Login</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row page-content">
        <!-- Left hand column for Recent Login -->
        <div class="span-page col-lg-6">
            <h2>Facebook helps you connect and share with the people in your life.</h2>
            <img id="login-map" src="../img/login-map.png">
        </div>

        <!-- Right hand column for Account Registration -->
        <div class="col-lg-6">
            <h1>Create a new account</h1>
            <h3>It's quick and easy</h3>

                 
 		<form name="signup-form" action="signup.php" method="POST">
                <!-- Full Name --> 
                <div class="inline">
                    <input class="signup-field" type="text" name="firstname" placeholder="First name" required />
                    <input class="signup-field" type="text" name="surname" placeholder="Surname" required />
                </div><br>
                <!-- End full name segment -->

                <input class="signup-field" type="text" name="email" placeholder="Email" required /><br>
                <input class="signup-field" type="password" name="password" placeholder="New password" required /><br>
                
                <div class="title-tag">Birthday</div>
                <div class="inline">

                <!-- Select for Day of birthday -->
                <select class="login-dropdown" name="day" required>
                    <option value="Day" selected disabled >Day</option>
                    <?php
                        for ($day = 1; $day<= 31; $day++)
                        {
                            echo '<option value="'.$day.'">'.$day.'</option>';
                        }
                    ?>
		        </select>

                <!-- Select for Month of birthday -->
		        <select class="login-dropdown" name="month" required>
                    <option value="Month" selected disabled required >Month</option>
                    <?php
                        for ($month = 1; $month<= 12; $month++)
                        {
                            echo '<option value="'.$month.'">'.$month.'</option>';
                        }
                    ?>
		        </select>
                <!-- Select for Year of birthday -->
		        <select class="login-dropdown"  name="year" required>
                    <option value="Year" selected disabled>Year</option>
                    <?php
                        $currentYear = date('Y');
                        for ($year = $currentYear; $year >= $currentYear - 80; $year--)
                        {
                            echo '<option value="'.$year.'">'.$year.'</option>';
                        }
                    ?>
                </select>
                </div>
                <div class="title-tag">Gender</div>

                <!-- Gender options radio buttons -->
                <label class="radio-inline">
                    <input class="gender" type="radio" name="gender" value="male"> Male<br>
                </label>
                <label class="radio-inline">
                    <input class="gender" type="radio" name="gender" value="female"> Female<br>
                </label>
                <label class="radio-inline">
                    <input class="gender" type="radio" name="gender" value="other"> Other<br>
                </label>
                </div><br>
                <button class="sign-up-btn btn btn-success" type="submit">Sign Up</button>

            </form> 
        </div>
    </div>
</div>

<footer class="footer"></footer>

</body>

</html>

