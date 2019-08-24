<!DOCTYPE html>
<html lang="en">
<head>

    <title>Facebook | Log in or Sign up</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 

    <!-- TODO import CSS -->

</head>
</html>

<?php require('../db_connect.php'); 

session_start();

?>

<body>

<div class="container">
    <div class="row">
        <!-- Left hand column for Recent Login -->
        <div class="col-lg-6">
            <!-- TODO -->
        </div>

        <!-- Right hand column for Account Registration -->
        <div class="col-lg-4">
            <h1>Create a new account</h1>
            <h3>It's quick and easy</h3>

            <form name="signup-form" action="signup.php" method="POST">
 
                <!-- Full Name -->
                <div class="inline">
                    <input type="text" name="firstname" placeholder="First name" required />
                    <input type="text" name="surname" placeholder="Surname" required />
                </div><br>
                <!-- End full name segment -->

                <input type="text" name="email" placeholder="Email" required /><br>
                <input type="password" name="password" placeholder="New password" required /><br>
                
                <div class="title-tag">Birthday</div>
                <div class="inline">

                <!-- Select for Day of birthday -->
                <select name="day" required>
                    <option value="Day" default disabled >Day</option>
                    <?php
                        for ($day = 1; $day<= 31; $day++)
                        {
                            echo '<option value="'.$day.'">'.$day.'</option>';
                        }
                    ?>
		        </select>

                <!-- Select for Month of birthday -->
		        <select name="month" required>
                    <option value="Month" default disabled required >Month</option>
                    <?php
                        for ($month = 1; $month<= 12; $month++)
                        {
                            echo '<option value="'.$month.'">'.$month.'</option>';
                        }
                    ?>
		        </select>
                <!-- Select for Year of birthday -->
		        <select name="year" required>
                    <option value="Year" default disabled>Year</option>
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
                <div class="inline">
                    <input type="radio" name="gender" value="male"> Male<br>
                    <input type="radio" name="gender" value="female"> Female<br>
                    <input type="radio" name="gender" value="other"> Other<br>
                </div>

                <button class="sign-up-btn btn btn-success" type="submit">Sign Up</button>

            </form> 
        </div>
    </div>
</div>

</body>

