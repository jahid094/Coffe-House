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
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="css/global.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<title>Registration Page</title>
	</head>
	<body>
		<?php
			include("classes/Customer.php");
			$cmr = new Customer();
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
                $customerReg = $cmr->customerRegistration($_POST);
            }
        ?>
		<div class="container_fluid bg" >
			<div class="row bg">
				<div class="col-md-4 col-sm-4 col-xs-12"></div>
				<div class="col-md-4 col-sm-4 col-xs-12"> 
					<form class="form_container" style="margin-top: 1vh;padding-top:0vh;" method="post">
						<span style="color:red;font-size:18px;">
							<?php
							   if(isset($customerReg)){
								   echo $customerReg;
							   } 
							?>
						</span>
						<div class="form-group form-sm" >
							<label class="text-light"><h6>First Name:</h6></label>
							<input type="text" class="form-control" name="firstname" placeholder="Enter First Name">
						</div>
						<div class="form-group" >
							<label class="text-light"><h6>Last Name:</h6></label>
							<input type="text" class="form-control" name="lastname" placeholder="Enter Last Name">
						</div>
						<div class="form-group" >
							<label for="exampleInputEmail1" class="text-light"><h6>Email:</h6></label>
							<input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
						</div>
						<div class="form-group" >
							<label for="exampleInputEmail1" class="text-light"><h6>Address:</h6></label>
							<input type="address" class="form-control" name="address" placeholder="Enter address">
						</div>
						<div class="form-group" >
							<label for="exampleInputEmail1" class="text-light"><h6>Phone Number:</h6></label>
							<input type="address" class="form-control" name="phone" placeholder="Enter address">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1" class="text-light"><h6>Password:</h6></label>
							<input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
						</div>
						<div>
							<h6 class="text-light">Gender:</h6>
							<div class="radio text-light">
								<label><input type="radio" name="gender" value="Male"><b> Male</b></label>
							</div>
							<div class="radio text-light">
								<label><input type="radio" name="gender" value="Female"><b> Female</b></label>
							</div>
						</div>
						<button type="submit" class="btn btn-success btn-sm btn-block" name="register"><h5>Submit</h5></button>
						<a href="login.php" class="text-light"><b>I already have an account</b></a>
					</form>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12"> </div>
			</div>
		</div>

    
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>