<?php 
require('../db_connect.php');
session_start();

$body = $_POST['cp-body'];
$email = $$_COOKIE['email'];
date_default_timezone_set('Australia/Melbourne');
$timeOfPost = date('d-M-Y');

$addLike = 'INSERT INTO RATING (
    body,
    posterEmail,
    timeOfPost
)
VALUES
(
    :bv_body,
    :bv_email,
    bv_timeOfPost
)';

$stid = oci_parse($conn, $addLike);

oci_bind_by_name($stid, ":bv_body", $body);
oci_bind_by_name($stid, ":bv_email", $email);
oci_bind_by_name($stid, "bv_timeOfPost", $timeOfPost);

echo $timeOfPost ;
echo $email;
echo $body;

//header("Location: index.php");

?>