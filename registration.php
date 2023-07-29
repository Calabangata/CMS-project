<?php
include "includes/db.php";
include "includes/header.php";

//navigation
include "includes/navigation.php";
?>

<?php

if(isset($_GET['lang']) && !empty($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];

    if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
        echo "<script type='text/javascript'>location.reload();</script>";
    }

}

    if(isset($_SESSION['lang'])){
        include "includes/languages/".$_SESSION['lang'].".php";
    } else {
        include "includes/languages/en.php";
    }


if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(userExists($username)){

        $message = "The username you want to use is already taken!";

    } else if(!empty($username) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname)){

        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        

        $hashAndSalt = password_hash($password, PASSWORD_BCRYPT);

        

        if(emailExists($email)){

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

<form method="get" class="navbar-form navbar-right" action="" id="language_form">
    <div class="form-group">
        <label for="lang"><?php echo _LANGUAGE_LABEL; ?></label>
        <select name="lang" class="form-control" onchange="changeLanguage()">
            <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == "en"){echo "selected";} ?>>English</option>
            <option value="bg" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == "bg"){echo "selected";} ?>>Български</option>
            <option value="es" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == "es"){echo "selected";} ?>>Spanish</option>
        </select>
    </div>
</form>
<br>

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1 id="register"><?php echo _REGISTER; ?></h1>
                    <form role="form" action="registration.php" id="login-form" method="post" autocomplete="off">
                        <h4 class="text-center" id="message"><?php echo $message; ?></h4>

                        <div class="form-group">
                            <label for="firstname" class="sr-only">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="<?php echo _FIRSTNAME; ?>">
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="sr-only">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="<?php echo _LASTNAME; ?>">
                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo _USERNAME; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo _EMAIL; ?>">
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control" id="key" placeholder="<?php echo _PASSWORD; ?>">
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<script>
    function changeLanguage(){
        document.getElementById('language_form').submit();
    }
</script>

<?php include "includes/footer.php"; ?>

<script src="js/script.js"></script>






</div>