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

    <!-- jQuery import for Ajax -->
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css" href="../css/app.css">

</head>

<?php

require('../db_connect.php');
//session_start();

// print user name at the top
$getScreenName = 
'SELECT screenName
from FACEBOOKUSER 
where LOWER(email) like LOWER(:bv_email)';

$stid = oci_parse($conn, $getScreenName);
oci_bind_by_name($stid, ":bv_email", $_SESSION['email']);
oci_execute($stid);

while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
{
    echo '<h3 class="post-screenName">'.$row['SCREENNAME'].'</h3>';
}

$getPostData = 'SELECT *
from POST 
where LOWER(posterEmail) like LOWER(:bv_email)';

$stid = oci_parse($conn, $getPostData);
oci_bind_by_name($stid, ":bv_email", $_SESSION['email']);
oci_execute($stid);

// prints each post one by one until none remain
while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
{
    // used as an identifier for the post as a whole.
    echo '<div id="'.$row['POSTID'].'">';
        echo '<div class="post-time">'.$row['POSTTIME'].'</div>';
        echo '<div class="post-body">'.$row['BODYTEXT'].'</div>';
        echo '<input class="post-id" type="hidden" value="'.$row['POSTID'].'">';
    echo '</div>';
    ?>
    <div class="inline">
        <div class="post-btn" onclick="postLike()">
            <i class="far fa-thumbs-up fa-3x">
        </div>
        <div class="post-btn" onclick="postComment()">
            <i class="fas fa-reply fa-3x" >
    </div>
    <?php

}

?>

<script>

    function postLike()
    {
        $.post(
            var postID = $('input.post-id').val();
            'functions/postLike.php',
            {
                postID: postID;
            },
            function(data)
            {
                alert("success");
            }
        );
    }
    /*
    function postComment()
    {
        $.post(
            var postID = $('input.post-id').val();
            'functions/postLike.php',
            {
                postID: postID;
            },
            function(data)
            {
                
            }
        );
    }*/

</script>