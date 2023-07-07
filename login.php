<?php include "includes/db.php";
include "includes/header.php";
//session_start();
?>

<?php include "includes/navigation.php"; ?>




<?php

if(checkIfUserIsLoggedInAndRedirect('/admin')){

}


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
    $db_email = $row['email'];

    if(password_verify($password, $db_password)){
    //echo $password . "   " . $db_password;
    //if($username === $db_username && $password === $db_password)

    if($username === $db_username){

    $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['userRole'] = $db_userRole;
        $_SESSION['email'] = $db_email;
        
        if($_SESSION['userRole'] == "Admin"){
    header("Location: ./admin");
        } else {
            header("Location: ./admin/subIndex.php");
        }
    
    } 

    } else {
        //header("Location: ../index.php");
        
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


							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="text-center">Login</h2>
							<div class="panel-body">


								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

											<input name="username" type="text" class="form-control" placeholder="Enter Username">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Enter Password">
										</div>
									</div>

									<div class="form-group">

										<input name="login" class="btn btn-lg btn-primary btn-block" value="login" type="submit">
									</div>


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
