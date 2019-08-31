<?php

require('../../db_connect.php');
session_start();

$senderEmail = $_SESSION['email'];
$friendEmail = $_POST['friend-email'];

if (checkForExistingRequest($conn, $senderEmail, $friendEmail) == true && checkForExistingFriendship($conn, $senderEmail, $friendEmail) == true)
{
    sendFriendRequest($conn, $senderEmail, $friendEmail);
}

oci_close($conn);
header('Location: ../index.php');

function checkForExistingRequest($conn, $senderEmail, $friendEmail)
{
    $checkRequests = 'SELECT count(*) as count
    FROM USERREQUEST
    WHERE email like :bv_senderEmail
    AND
    requestID in
    (
        SELECT requestID
        FROM USERREQUEST
        WHERE email like :bv_friendEmail
    )';
    $stid = oci_parse($conn, $checkRequests);
    oci_bind_by_name($stid, ':bv_senderEmail', $senderEmail);
    oci_bind_by_name($stid, ':bv_friendEmail', $friendEmail);
    oci_execute($stid);   

    $row = oci_fetch_array($stid, OCI_ASSOC);

    if ($row['COUNT'] == 0)
    {
        return true;
    }
    return false;
}

function checkForExistingFriendship($conn, $senderEmail, $friendEmail)
{
    $checkRequests = 'SELECT count(*) as count
    FROM FRIEND
    WHERE email like :bv_senderEmail
    AND
    friendshipID in
    (
        SELECT friendshipID
        FROM FRIEND
        WHERE email like :bv_friendEmail
    )';
    $stid = oci_parse($conn, $checkRequests);
    oci_bind_by_name($stid, ':bv_senderEmail', $senderEmail);
    oci_bind_by_name($stid, ':bv_friendEmail', $friendEmail);
    oci_execute($stid);

    $row = oci_fetch_array($stid, OCI_ASSOC);

    if ($row['COUNT'] == 0)
    {
        return true;
    }
    return false;
}

function sendFriendRequest($conn, $senderEmail, $friendEmail)
{
    // create the Friend Request entity
    $timeOfRequest = date('d-m-y H:i');

    $createRequest="INSERT INTO FRIENDREQUEST
    (
        timeOfRequest
    )
    values
    (
        TO_DATE(:bv_timeOfRequest, 'dd-mm-yy hh24:mi')
    )";
    $stid = oci_parse($conn, $createRequest);
    oci_bind_by_name($stid, ':bv_timeOfRequest', $timeOfRequest);
    oci_execute($stid);   

    // retried request ID for the newly created request
    $retrieveID = 'SELECT friendrequestid_seq.currval as ID from dual';
    $stid = oci_parse($conn, $retrieveID);
    oci_execute($stid); 

    $row = oci_fetch_array($stid, OCI_ASSOC);
    $requestID = $row['ID'];

    // add sender to the request
    createUserRequest($conn, $requestID, $senderEmail, "sender");

    // add receiver to the request
    createUserRequest($conn, $requestID, $friendEmail, "receiver");
    
}

function createUserRequest($conn, $requestID, $userEmail, $senderOrReceiver)
{
    $createFriendEntity = 'INSERT INTO UserRequest
    (
        email,
        requestID,
        sentOrReceived
    )
    values
    (
        :bv_email,
        :bv_requestID,
        :bv_senderOrReceiver
    )';

    $stid = oci_parse($conn, $createFriendEntity);
    oci_bind_by_name($stid, ':bv_requestID', $requestID);
    oci_bind_by_name($stid, ':bv_email', $userEmail);
    oci_bind_by_name($stid, ':bv_senderOrReceiver', $senderOrReceiver);
    oci_execute($stid);
}
?>