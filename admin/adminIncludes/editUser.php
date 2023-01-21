<?php

if(isset($_GET['update_user'])){
   $that_user_id = $_GET['update_user'];

   $query = "SELECT * FROM users WHERE user_id = $that_user_id";
   $select_users_query = mysqli_query($connection, $query);
   while($row = mysqli_fetch_assoc($select_users_query)){
       $user_id = $row['user_id'];
       $username = $row['username'];
       $password = $row['user_password'];
       $firstname = $row['firstname'];
       $lastname = $row['lastname'];
       $email = $row['email'];
       $user_image = $row['user_image'];
       $role = $row['user_role']; 
   }

}

if(isset($_POST['update_user'])){

    
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

$query = "UPDATE users SET ";
    //$query .= "user_id = '{$user_id}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_password = {$password}, ";
    $query .= "firstname = '{$firstname}', ";
    $query .= "lastname = '{$lastname}', ";
    $query .= "email = '{$email}', ";
    $query .= "user_role = '{$role}' ";
    $query .= "WHERE user_id = {$that_user_id} ";

    

    $update_user_query = mysqli_query($connection, $query);

    confirmQuery($update_user_query);

}


?>

<form action="" method = "post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" value="<?php echo $firstname; ?>" class="form-control" name="firstname">
</div>

<div class="form-group">
    <label for="post_status">Lastname</label>
    <input type="text" value="<?php echo $lastname; ?>" class="form-control" name="lastname">
</div>

<div class="form-group">
   <select name="user_role"  id="">

   <option value='Subscriber'>Subscriber</option>
    <option value='Admin'>Admin</option>

   </select>
</div>

<!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
</div> -->

<div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
</div>

<div class="form-group">
    <label for="post_content">Email</label>
<input type="email" value="<?php echo $email; ?>" class="form-control" name="email"></div>

<div class="form-group">
    <label for="post_content">Password</label>
<input type="password" value="<?php echo $password; ?>" class="form-control" name="user_password"></div>


<div class="form-group">
    <input class="btn btn-primary" type="submit"  name="update_user" value="Update User">
</div>

</form>