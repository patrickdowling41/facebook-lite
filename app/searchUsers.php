<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require('../db_connect.php');
include_once('nav.php');

$search = $_POST['friend-search'];
$userEmail = $_SESSION['email'];

include_once('functions/confirmLoggedIn.php');

// responds all search results matching the screen name or email, not showing the logged in user however
$searchUser="SELECT fu.email, fu.screenName, l.city, l.country
FROM FACEBOOKUSER fu
LEFT JOIN LOCATION l
ON fu.locationID = l.locationID
WHERE lower(:bv_userEmail) not like lower(fu.email)
AND LOWER(:bv_search) like LOWER(fu.screenName) 
OR LOWER(:bv_search) like LOWER(fu.email)";


$stid = oci_parse($conn, $searchUser);

oci_bind_by_name($stid, ':bv_search', $search);
oci_bind_by_name($stid, ':bv_userEmail', $userEmail);

oci_execute($stid);

?>
<body>
    <div class="container">
        <div class="user-component">
            <h1>Search Results</h1>
            <?php
            while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
            {
            ?>
                <!-- form that displays each user and allows current user to add them as friend -->
                <form action="functions/sendFriendRequest.php" method="POST">
                    <div class="row">
                        <div class="col-xs-1">
                            <i class="far fa-user-circle fa-3x"></i>
                        </div>
                        <div class="col-lg-5">
                            <?php  
                            echo '<h3 class="search-username">'.$row['SCREENNAME'].'</h3>';
                            echo '<p class="search-email">'.$row['EMAIL'].'</p>';
                            if(isset($row['CITY'])=== true)
                            {
                                echo '<div class="search-location">'.$row['CITY'].', '.$row['COUNTRY'].'</div>';
                            }
                            echo '<input name="friend-email" type="hidden" value="'.$row['EMAIL'].'">';
                            ?>
                        </div>
                        <div class="col-lg-5">
                            <button type="submit" class="btn btn-light">+ Add Friend</button>
                        </div>
                    </div>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</body>

<?php 

oci_close($conn); ?>


