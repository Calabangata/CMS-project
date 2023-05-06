<?php
ob_start();
include "db.php";
session_start();

$session = session_id();

$query = "DELETE FROM online_users WHERE session = '$session'";
$removeSessionquery = mysqli_query($connection, $query);
if(!$removeSessionquery){
    die(mysqli_error() . "ERROR");
}

$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['userRole'] = null;

header("Location: ../index.php");




session_destroy();

?>

