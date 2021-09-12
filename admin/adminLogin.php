<?php include("../classes/Adminlogin.php");?>
<?php
    $al = new Adminlogin();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $adminEmail = $_POST['adminEmail'];
        $adminPass = md5($_POST['adminPass']);
        
        $loginChk = $al->adminLogin($adminEmail,$adminPass);
    }
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/global.css">
    <title>Admin Login Page</title>
  </head>
  <body>
    <div class="container_fluid bg" >
		<div class="row bg">
			<div class="col-md-4 col-sm-4 col-xs-12"> </div>
			<div class="col-md-4 col-sm-4 col-xs-12"> 
				<form class="form_container" action="adminLogin.php" method="post">
				<h3 class="text-light">Admin Login Form</h3><br/>
				<span style="color:red;font-size:18px;">
					<?php
						if(isset($loginChk)){
							echo $loginChk;
						}
					?>
				</span>
				  <div class="form-group" >
					<label for="exampleInputEmail1" class="text-light"><h5>Email:</h5></label>
					<input type="email" class="form-control" placeholder="Enter email" name="adminEmail"/>
				  </div>
				  <div class="form-group">
					<label for="exampleInputPassword1" class="text-light"><h5>Password:</h5></label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="adminPass">
				  </div>
				  <button type="submit" class="btn btn-success btn-block "><h5>Submit</h5></button><br/>
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