<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require('../db_connect.php');
include_once('nav.php');

if (strcmp($_SESSION['loggedIn'], "yes") !== 0)
{
    header("Location: ../login");
}

$search = $_POST['friend-search'];

$searchUser='SELECT screenName, city, country
FROM FACEBOOKUSER
LEFT JOIN LOCATION
ON FACEBOOKUSER.locationID = LOCATION.locationID
WHERE LOWER(:bv_search) like LOWER(FACEBOOKUSER.screenName)
OR
LOWER(:bv_search) like LOWER(FACEBOOKUSER.email)';

$stid = oci_parse($conn, $searchUser);

oci_bind_by_name($stid, ':bv_search', $search);

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
                <div class="row">
                    <div class="col-xs-1">     
                        <i class="far fa-user-circle fa-3x"></i>
                    </div>
                    <div class="col-lg-5">
                        <?php  
                        echo '<h3 class="search-username">'.$row['SCREENNAME'].'</h3>';
                        if(isset($row['CITY'])=== true)
                        {
                            echo '<div class="search-location">'.$row['CITY'].', '.$row['COUNTRY'].'</div>';
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>


