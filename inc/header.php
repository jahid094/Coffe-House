<?php
    include("lib/Session.php");
    Session::init();
    include("lib/Database.php");
    include("helpers/Format.php");

    spl_autoload_register(function($class){
        include_once("classes/".$class.".php");
    });

    $db = new Database();
    $fm = new Format();
    $pd = new Product();
	$cmr = new Customer();
	$ct = new Cart();
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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="shortcut icon" type="image/png" href="image/favicon1.png"/>
		<link rel="stylesheet" type="text/css" href="css/global.css">
		<?php  
			if($GLOBALS['title']) {
				$title = $GLOBALS['title'];
			} else {
				$GLOBALS['title'] = "Welcome to My Website";        
			}
			echo "<title> ".$title."</title>";
		?>
	</head>
	<body>
		<?php
			if(isset($_GET['cid'])){
				Session::destroy();
			} 
		?>
		<nav class="navbar navbar-expand-lg  my-nav fixed-top">
			<a class="navbar-brand" href="index.php"><img src="image/logo.png"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span> <i class="fa fa-bars"></i> </span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<?php
							$login = Session::get("cuslogin");
							if($login == true){            
						?>
						<a class="nav-link " href="profile.php">Profile</a>
						<?php
							}
						?>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="product.php">Product</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="viewCart.php">View Cart</a>
					</li>
					<?php
						$cmrId = Session::get("cmrId");
						$chkOrder = $ct->checkOrder($cmrId);
						if($chkOrder){
					?>
					<li class="nav-item">
						<a class="nav-link" href="viewOrder.php">View Order</a>
					</li>
					<?php
						}
					?>
					<?php
                        $login = Session::get("cuslogin");
                        if($login == true){            
                    ?>
                    
					<li class="nav-item">
						<a class="nav-link" href="contactUs.php">Contact Us</a>
					</li>
					<?php
                        } 
                    ?>
					<li class="nav-item">
						<?php
							$login = Session::get("cuslogin");
							if($login == true){            
						?>
						<a class="nav-link " href="?cid=<?php Session::get('cmrId');?>">Logout</a>
						<?php
							} else {
						?>
						<a class="nav-link " href="login.php">Login</a>
						<?php
							}
						?>
					</li>
				</ul>
			</div>
		</nav>