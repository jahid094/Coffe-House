<?php
    include("lib/Session.php");
    Session::init();
    include("lib/Database.php");
    include("helpers/Format.php");

    spl_autoload_register(function($class){
        include_once("classes/".$class.".php");
    });

    /*$db = new Database();
    $fm = new Format();
    $pd = new Product();
    $cat = new Category();
    $ct = new Cart();
    $cmr = new Customer();*/
?>
 <?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/global.css">
		<title>Login Page</title>
	</head>
	<body>
		<?php
			include("classes/Customer.php");
			$cmr = new Customer();
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
				$custLogin = $cmr->customerLogin($_POST);
			}
		?>
		<div class="container_fluid bg" >
			<div class="row bg">
				<div class="col-md-4 col-sm-4 col-xs-12"> </div>
				<div class="col-md-4 col-sm-4 col-xs-12"> 
					<form class="form_container " action="" method="post">
						<h3 class="text-light">Login Form</h3><br/>
						<span style="color:red;font-size:18px;">
							<?php
							   if(isset($custLogin)){
								   echo $custLogin;
							   } 
							?>
						</span>
						<div class="form-group" >
							<label for="exampleInputEmail1" class="text-light"><h5>Email:</h5></label>
							<input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php if(isset($_COOKIE["user_email"])) { echo $_COOKIE["user_email"]; } ?>" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1" class="text-light"><h5>Password:</h5></label>
							<input type="password" class="form-control" id="exampleInputPassword1" name="pass" value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>" placeholder="Password">
						</div>
						<div class="form-group form-check">
							<input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1" 
							<?php 
								if(isset($_COOKIE["user_email"])) { 
							?> checked 
							<?php 
								} 
							?>/>	
							<label class="form-check-label text-light" for="exampleCheck1">Remember me</label>
						</div>
						<button type="submit" class="btn btn-success btn-block" name="login"><h5>Submit</h5></button><br/>
						<a href="registration.php" class="text-light"><h6>I don't have any account</h6></a>
					</form>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12"></div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>