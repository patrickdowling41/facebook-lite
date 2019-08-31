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
<!-- Facebook logo font -->
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">

<script src="https://kit.fontawesome.com/356e745068.js"></script>

<!-- jQuery import -->
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous">
</script>

<link rel="stylesheet" type="text/css" href="../css/app.css">

<?php
session_start();
include_once('functions/confirmLoggedIn.php');
include_once('components/nav.php');
require('../db_connect.php');

$email = $_SESSION['email'];
$count = 0;
?>

</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            $getFriendRequests = "SELECT requestID
            FROM USERREQUEST
            WHERE email like :bv_email
            AND sentOrReceived like 'receiver'";

            $stid = oci_parse($conn, $getFriendRequests);
            oci_bind_by_name($stid, ":bv_email", $email);
            oci_execute($stid);

            while (($ridRow = oci_fetch_array($stid, OCI_ASSOC)) != false)
            {
                $count = $count+1;

                $getFriendDetails = 'SELECT fu.email as email, fu.screenName as screenName
                FROM FACEBOOKUSER fu
                LEFT JOIN USERREQUEST ur
                ON ur.email = fu.email
                WHERE ur.email IN
                (
                    SELECT email
                    FROM USERREQUEST
                    WHERE requestID like :bv_requestID
                )
                AND ur.EMAIL NOT LIKE :bv_email';

                $stid = oci_parse($conn, $getFriendDetails);
                oci_bind_by_name($stid, ":bv_requestID", $ridRow['REQUESTID']);
                oci_bind_by_name($stid, ":bv_email", $email);
                oci_execute($stid);

                while (($friendRow = oci_fetch_array($stid, OCI_ASSOC)) != false)
                {
                    ?>
                    <form action="functions/handleFriendRequest.php" method="POST">
                        <?php
                        echo '<h3 class="friend-screenName">'.$friendRow['SCREENNAME'].'</h3>';
                        echo '<input class="friend-email" type="hidden" name="friend-email" value="'.$friendRow['EMAIL'].'">';
                        echo '<input class="friend-requestID" type="hidden" name="friend-requestID" value="'.$ridRow['REQUESTID'].'">';
                        ?>
                        <button class="btn btn-danger" type="submit" name="task" value="decline">Decline</button>
                        <button class="btn btn-success" type="submit" name="task" value="accept">Accept</button>
                    </form> 
                    <?php
                }
            }

            if ($count == 0)
            {
                echo '<h3>No pending friend invites</h3>';
            }
        ?>
        </div>
    </div>
</body>