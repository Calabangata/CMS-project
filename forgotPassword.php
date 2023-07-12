<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php require './vendor/autoload.php'; ?>







<?php


if(!isset($_GET['forgot'])){
    redirect('index.php');
}

// if(!ifItIsMethod('get') || !$_GET['forgot']){
//     redirect('index.php');
// }

if(ifItIsMethod('post')){

    if(isset($_POST['email'])){
        $email = mysqli_real_escape_string($connection, $_POST['email']);

        $tokenLength = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($tokenLength));

        if(emailExists($email)){
            if($stamenent = mysqli_prepare($connection, "UPDATE users  SET token = '{$token}' WHERE email = ?")){

                mysqli_stmt_bind_param($stamenent, "s", $email);
                mysqli_stmt_execute($stamenent);
                mysqli_stmt_close($stamenent);

                echo "hi";
                /**
                 * CONFIG PHP Mailer
                 */
                
                $phpmailer = new PHPMailer(true);
                $phpmailer->isSMTP();
                $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 2525;
                $phpmailer->Username = '1679badad0e510';
                $phpmailer->Password = 'd6246723139720';
                $phpmailer->SMTPSecure = false;
                $phpmailer->isHTML(true);
                $phpmailer->CharSet = 'UTF-8';

                $phpmailer->setFrom('cmssystem@gmail.com', 'Kris R');
                $phpmailer->addAddress($email);

                $phpmailer->Subject = 'This is a test email';
                $phpmailer->Body = 'Body of Email';

                if($phpmailer->send()){
                    echo "IT WORKSS YAYY";
                } else {
                    echo "NOT GOOD";
                }

            } else {
                echo mysqli_error($connection);
            }
            }
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
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
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

