<?php

if(isset($_POST['contact'])){

    $to = "rulevkristian@gmail.com";
    
    // $firstname = $_POST['firstname'];
    // $lastname = $_POST['lastname'];
    $enteredEmail = $_POST['email'];

    $subject = $_POST['subject'];

    $subject = wordwrap($subject, 70);
    $content = $_POST['content'];

    $header = "From: " . $enteredEmail;

    //mail($to, $subject, $content, $header);


}

?>

<div class="well">
    <h4>Contact us</h4>

    <div class="form-wrap">
                    
                    <form role="form" action="" id="login-form" method="post" autocomplete="off">
                        

                        <!-- <div class="form-group">
                            <label for="firstname" class="sr-only">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your firstname">
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="sr-only">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your lastname">
                        </div> -->

                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Something@example.com">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter your subject">
                        </div>        

                        <div class="form-group">
                            <label for="username" class="sr-only">content</label>
                            <!-- <input type="text" class="form-control" id="content" name="content" placeholder="Enter your username"> -->
                            <textarea name="content" id="content" class="form-control" placeholder="Ask us a question"></textarea>
                        </div>

                        <input type="submit" name="contact" id="" class="btn btn-primary" value="Contact us">
                    </form>
                </div>
                    
</div>