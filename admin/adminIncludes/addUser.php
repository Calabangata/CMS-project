<?php

if(isset($_POST['create_user'])){

    
    $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $role = $_POST['user_role'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['user_password']);
    //$post_date = date('d-m-y');
//$post_comment_count = 4;

//move_uploaded_file($post_image_temp, "../images/$post_image");

$query = "INSERT INTO  users(firstname, lastname, user_role,
 username, email, user_password)";

$query .= "VALUES('{$firstname}','{$lastname}',
'{$role}','{$username}','{$email}','{$password}')";

$user_query = mysqli_query($connection, $query);

confirmQuery($user_query);

echo "<label for=''>User Created: </label>" . " " . "<a class='btn btn-primary' href='Users.php'>View users</a>";

}


?>

<form action="" method = "post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" name="firstname">
</div>

<div class="form-group">
    <label for="post_status">Lastname</label>
    <input type="text" class="form-control" name="lastname">
</div>

<div class="form-group">
   <select name="user_role" id="">

   <option value="Subscriber">Select options</option>
    <option value="Admin">Admin</option>
    <option value="Subscriber">Subscriber</option>
    

   </select>
</div>



<!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
</div> -->

<div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" name="username">
</div>

<div class="form-group">
    <label for="post_content">Email</label>
<input type="email" class="form-control" name="email"></div>

<div class="form-group">
    <label for="post_content">Password</label>
<input type="password" class="form-control" name="user_password"></div>


<div class="form-group">
    <input class="btn btn-primary" type="submit"  name="create_user" value="Create User">
</div>

</form>