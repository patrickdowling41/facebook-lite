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

<?php include_once('components/nav.php');?>

<div class="container">
    <div class="row page-content">
        <!-- Left hand column for Recent Login -->
        <div class="span-page col-lg-6">
            <h1>Customise your profile</h1>
            <form action="functions/completeSignup.php">
                <label value="Display name"></label>
                <input class="signup-ad" type="text" placeholder="Display name">

                <label value="Location"></label>
                <input class="signup-ad" type="text" placeholder="City">
                <input class="signup-ad" type="text" placeholder="Country">

                <label value="Status"></label>
                <input class="signup-ad" type="text" placeholder="Status">

                <label value="Profile Visibility"></label>
                <input class="signup-ad" type="text" placeholder="Visibility">
            </form>
        </div>
    </div>
</div>

</body>

</html>
<?php oci_close($conn);?>