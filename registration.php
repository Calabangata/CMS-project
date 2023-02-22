<?php
include "includes/db.php";
include "includes/header.php";

//navigation
include "includes/navigation.php";
?>

<?php

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

        if(!empty($username) && !empty($email) && !empty($password)){

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        // $query = "SELECT randSalt FROM users";
        // $select_randSalt_query = mysqli_query($connection, $query);

        // if(!$select_randSalt_query){
        //     die("Query failed!" . mysqli_error($connection));
        // }

        // $row = mysqli_fetch_array($select_randSalt_query);
        //$salt = $row['randSalt'];

        $hashAndSalt = password_hash($password, PASSWORD_BCRYPT);

        //$password = crypt($password, $salt);

        


        $query = "INSERT INTO users (username, email, user_password, user_role) ";
        $query .= "VALUES('{$username}','{$email}','{$hashAndSalt}', 'Subscriber')";
        $resigter_user_query = mysqli_query($connection, $query);

        if(!$resigter_user_query){
            die("Query failed!" . mysqli_error($connection) . ' ' . mysqli_errno($connection));

        }

        $message = "Thank you for the registration!";

    } else {
        $message = "The fields cannot be empty!";
    }
    

} else {
    $message = "";
}

?>

<!-- content -->

<div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Register</h1>
                    <form role="form" action="registration.php" id="login-form" method="post" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Something@example.com">
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control" id="key" placeholder="Enter your password">
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php"; ?>







</div>