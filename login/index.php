<!DOCTYPE html>
<html lang="en">
<head>

    <?php require('../db_connect.php'); 
    session_start();

    if (sessionStorage.getItem("loggedIn") === NULL)
    {
        sessionStorage.setItem("loggedIn", false);
    }

    if (sessionStorage.getItem("loggedIn") === true)
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

    <!-- TODO import CSS -->


    <!-- Nav bar -->
    <nav class="login-nav" style="background-color: #3c5a99">
        <div class="container">
            <div class="row">

                <!-- buffer column -->
                <div class="col-md-2">
                </div>
                <!-- column for logo -->
                <div class="col-lg-5">
                    <i class="fb-nav-logo" height="62" width="170">Facebook-Lite</i>
                </div>
                <!-- column for login -->
                <div class="col-lg-5">
                    
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
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </nav>

</head>
</html>

<body>

<div class="container">
    <div class="row">
        <!-- Left hand column for Recent Login -->
        <div class="col-lg-6">
            <!-- TODO -->
        </div>

        <!-- Right hand column for Account Registration -->
        <div class="col-lg-6">
            <h1>Create a new account</h1>
            <h3>It's quick and easy</h3>

                 
 
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

