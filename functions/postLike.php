<?php 
require('../db_connect.php');
session_start();

$postID = $_POST['postID'];
$email = $$_COOKIE['email'];

$addLike = 'INSERT INTO RATING (
    postID,
    raterEmail
)
VALUES
(
    :bv_postID,
    :bv_email
)';

$stid = oci_parse($conn, $addLike);

oci_bind_by_name($stid, ":bv_postID", $postID);
oci_bind_by_name($stid, ":bv_email", $email);

?>