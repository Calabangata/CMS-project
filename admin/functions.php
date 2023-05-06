<?php

function onlineUsers(){

        if(isset($_GET['onlineusers'])){

        global $connection;

        if(!$connection){
            session_start();

            include("../includes/db.php");

            $session = session_id();
            
        $time = time();
        $timeOutseconds = 60;
        $timeOut = $time - $timeOutseconds;

        $query = "SELECT * FROM online_users WHERE session = '$session'";
        $sendQuery = mysqli_query($connection, $query);
        confirmQuery($sendQuery);

        $count = mysqli_num_rows($sendQuery);

        if($count == NULL){


            mysqli_query($connection, "INSERT INTO online_users(session, time) VALUES('$session', '$time')");

        } else {

            mysqli_query($connection, "UPDATE online_users SET time = '$time' WHERE session = '$session'");

        }

        $onlineUsers = mysqli_query($connection, "SELECT * FROM online_users WHERE time > '$timeOut'");
        $countUser = mysqli_num_rows($onlineUsers);

        echo $countUser;

        }
    }

}
onlineUsers();

function insertCategories(){

    global $connection;

    if(isset($_POST['submit'])){
                            
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title)";
            $query.= "VALUE('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query){

                die('QUERY FAILED' . mysqli_error($connection));
            }
        }

    }

}

function confirmQuery($check){

global $connection;

    if(!$check){
        die("Query failed" . mysqli_error($connection));
    }
    
}

function FindallCategories(){

global $connection;

$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);


while($row = mysqli_fetch_assoc($select_categories)){
    $id_cat = $row['id_cat'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
    echo "<td>{$id_cat}</td>";
    echo "<td>{$cat_title}</td>";
    //echo "<td><a href = 'Categories.php?delete={$id_cat}'>Delete</a></td>";
    echo "<td><a rel='$id_cat' href='javascript:void(0)' class='deleteLink' id='categoryDeletelink'>Delete</a></td>";

    echo "<td><a href = 'Categories.php?edit={$id_cat}'>Edit</a></td>";
    echo "</tr>";
}

}

function deleteCategory(){

    global $connection;
    if(isset($_GET['delete'])){


        $delete_category = $_GET['delete'];//{$delete_category}
        $query = "DELETE FROM categories WHERE id_cat = {$delete_category} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: Categories.php");
    }
    

}

function redirect($location){
    return header("Location:" . $location);
}

function recordCount($tableName){
    global $connection;

    $query = "SELECT * FROM " . $tableName;
    $select_all_record = mysqli_query($connection, $query);
    confirmQuery($select_all_record);
    $result = mysqli_num_rows($select_all_record);

    return $result;
}

function recordCountStatus($tableName, $tableColumn, $status){

    global $connection;
    $query = "SELECT * FROM $tableName WHERE $tableColumn = '$status'";
    $select_all_records_status = mysqli_query($connection, $query);
    confirmQuery($select_all_records_status);

    $result = mysqli_num_rows($select_all_records_status);
    return $result;

}

function isAdmin($userRole){
    if($userRole == 'Admin'){
        return true;
    }
    return false;
}

function userExists($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '{$username}'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    }
    return false;
}

function emailExists($email){
    global $connection;

    $query = "SELECT email FROM users WHERE email = '{$email}'";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);

        if(mysqli_num_rows($result) > 0){
            return true;
        }
        return false;
}

?>