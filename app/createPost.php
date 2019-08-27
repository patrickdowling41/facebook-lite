<?php 
require('../db_connect.php');
session_start();

$body = $_POST['cp-body'];
$email = $_SESSION['email'];
date_default_timezone_set('Australia/Melbourne');
$timeOfPost = date('d-M-y');

$addLike = 'INSERT INTO POST (
bodyText,
posterEmail,
postTime
)
VALUES
(
    :bv_body,
    :bv_email,
    :bv_timeOfPost
)';

$stid = oci_parse($conn, $addLike);

oci_bind_by_name($stid, ':bv_body', $body);
oci_bind_by_name($stid, ':bv_email', $email);
oci_bind_by_name($stid, ':bv_timeOfPost', $timeOfPost);

echo $timeOfPost;
echo $body;
echo $email;

oci_execute($stid);

?>
