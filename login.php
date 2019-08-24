<!DOCTYPE html>
<html lang="en">
  <head>
    

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

<?php require('db_connect.php'); ?>

<body>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-4">
            <h1>Create a new account</h1>
            <h3>It's quick and easy</h3>

            <form>
                <div class="inline">
                    <input type="text" name="firstname-field" placeholder="First name"/>
                    <input type="text" name="surname-field" placeholder="Surname"/>
                </div><br>
                <input type="text" name="email-field" placeholder="Email"/><br>
                <input type="text" name="password-field" placeholder="New password"/><br>
                <div class="title-tag">Birthday</div>
                <select>
                    <option value="Select Day" disabled>Select Day</option>
                    <?php
                        for ($day = 1; $day<= 31; $day++)
                        {
                            echo '<option value="'.$day.'">'.$day.'</option>';
                        }
                    ?>
               
                </select>
                <div class="title-tag">Gender</div>
                <div class="inline">
                    <input type="radio" name="gender" value="male"> Male<br>
                    <input type="radio" name="gender" value="female"> Female<br>
                </div>

            </form> 

        </div>


        </div>
    </div>
</div>

</body>