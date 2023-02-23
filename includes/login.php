<?php include "db.php";
session_start();
?>



<?php

if(isset($_POST['login'])){
$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);

//$query = "SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password}'";
//TO DO make username and email unique, make login with email or username


$query = "SELECT * FROM users WHERE username = '{$username}'";
$select_user_query = mysqli_query($connection, $query);

if(!$select_user_query){
    die("query failed" . mysqli.error($connection));
}


while($row = mysqli_fetch_array($select_user_query)){
    $db_user_id = $row['user_id'];
    $db_username = $row['username'];
    $db_password = $row['user_password'];
    $db_firstname = $row['firstname'];
    $db_lastname = $row['lastname'];
    $db_userRole = $row['user_role'];
    
}

    if(password_verify($password, $db_password)){
        


    //echo $password . "   " . $db_password;





    //if($username === $db_username && $password === $db_password)

    if($username === $db_username){

    $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['userRole'] = $db_userRole;
    header("Location: ../admin");
    
    } 

    } else {
        header("Location: ../index.php");
    }

}




?>