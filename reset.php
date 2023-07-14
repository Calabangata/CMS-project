<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php

$token = '985ee5949bf4c9e5bdb1f73a3c97585ad43b484230572560f6f7ba4b2855ac49db7de2cc43a494b2fb0bf63d6b17995b9861';

// if($stmt = mysqli_prepare($connection, 'SELECT username, email, token FROM users WHERE token=?')){
//     mysqli_stmt_bind_param($stmt, 's', $token);

//     mysqli_stmt_execute($stmt);

//     mysqli_stmt_bind_result($stmt, $username, $email, $token);

//     mysqli_stmt_fetch($stmt);

//     mysqli_stmt_close($stmt);

//     echo $username;
// }

if(isset($_POST['password']) && isset($_POST['confirmPassword'])){
    echo "both passwords are set!";

    if($_POST['password'] == $_POST['confirmPassword']){
        echo "They match";
    }
}

?>


<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                                <input id="password" name="password" placeholder="Enter new password" class="form-control"  type="password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                                <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

