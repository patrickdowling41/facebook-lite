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

</head>

<?php

require('../db_connect.php');

$getPostData = "SELECT posterEmail, bodyText, screenName, postID, postTime
from POST left join FACEBOOKUSER
on POST.posterEmail = FACEBOOKUSER.email
where LOWER(posterEmail) like LOWER(:bv_email)
order by POST.postTime DESC";

$stid = oci_parse($conn, $getPostData);
oci_bind_by_name($stid, ":bv_email", $_SESSION['email']);
oci_execute($stid);

// prints each post one by one until none remain
while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
{
    ?>
    <div class="post-component">
        <?php
        echo '<h3 class="post-screenName">'.$row['SCREENNAME'].'</h3>';
        // used as an identifier for the post as a whole.
        echo '<div id="'.$row['POSTID'].'">';
            echo '<div class="post-body">'.$row['POSTTIME'].'</div>';
            echo '<div class="post-body">'.$row['BODYTEXT'].'</div>';
            echo '<input class="post-id" type="hidden" value="'.$row['POSTID'].'">';
            
        echo '</div>';
        ?>
        
        <div class="inline">
            <div class="post-btn">
                <i class="far fa-thumbs-up fa-2x" onclick=postComment();></i>
            </div>
            <div class="post-btn" onclick=postLike();>
                <i class="fas fa-reply fa-2x"></i>
            </div>
        </div>
        <?php

        echo '<input class="reply-field name="reply-field" type="text" placeholder="Reply">';

        ?>
    </div>
    <?php

}

?>

<script>

    function postLike()
    {
        // $.post(
        //     var postID = $('input.post-id').val();
        //     'functions/postLike.php',
        //     {
        //         postID: postID;
        //     },
        //     function(data)
        //     {
        //         alert("success");
        //     }
        // );
    }
    function postComment()
    {
        // $.post(
        //     var postID = $('input.post-id').val();
        //     'functions/postLike.php',
        //     {
        //         postID: postID;
        //     },
        //     function(data)
        //     {
                
        //     }
        // );
    }

</script>