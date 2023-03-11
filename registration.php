<?php
include "includes/db.php";
include "includes/header.php";

//navigation
include "includes/navigation.php";
?>

<?php

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

        if(!empty($username) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname)){

        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        

        $hashAndSalt = password_hash($password, PASSWORD_BCRYPT);

        $query = "SELECT * FROM users WHERE email = '{$email}'";
        $sendquery = mysqli_query($connection, $query);

        if(mysqli_num_rows($sendquery) > 0){

            $message = "This email is already used!";

        } else {
            $query = "INSERT INTO users (username, firstname, lastname, email, user_password, user_role) ";
            $query .= "VALUES('{$username}','{$firstname}','{$lastname}','{$email}','{$hashAndSalt}', 'Subscriber')";
            $resigter_user_query = mysqli_query($connection, $query);

            if(!$resigter_user_query){
                die("Query failed!" . mysqli_error($connection) . ' ' . mysqli_errno($connection));

            }
            $message = "Thank you for the registration!";
        }
        
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
                        <h6 class="text-center" id="message"><?php echo $message; ?></h6>

                        <div class="form-group">
                            <label for="firstname" class="sr-only">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your firstname">
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="sr-only">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your lastname">
                        </div>

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