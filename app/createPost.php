<?php 
require('../db_connect.php');
session_start();

$body = $_POST['cp-body'];
$email = $$_COOKIE['email'];

$addLike = 'INSERT INTO RATING (
    body,
    posterEmail
)
VALUES
(
    :bv_body,
    :bv_email
)';

$stid = oci_parse($conn, $addLike);

oci_bind_by_name($stid, ":bv_body", $body);
oci_bind_by_name($stid, ":bv_email", $email);

header("Location: index.php");

?>