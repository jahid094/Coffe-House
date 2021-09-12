<?php 
	$GLOBALS['title'] = 'Contact Us';
?>
<?php include("inc/header.php");?>
<?php
    $login = Session::get("cuslogin");
    if($login == false){
       header("Location:login.php");
   } 
?>
<?php
    $cmrId = Session::get("cmrId");
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $id = $_POST['id'];
        $sendFeedback = $cmr->sendFeedback($_POST,$id);
    }
?>
<div id="home">
   	<div class="landing-text">
   		<p class="landingheading1">Scroll Down Below</p>
   		<p class="landingheading2 d-none d-sm-block">And Contact Us.</p><br/>
   	</div>
</div>
<br>
<br>
<br>
<div class="mt-100"></div>
<div class="container">
	<div class="row">
		<div class="col-12">
			<p>We are always here to help. If your have requirements/queries about our services; fill up the contact form
			below and we'll do our best to reply within 24 hours Alternatively simply pickup the phone and give us a feedback.</p>
		</div>
	</div>
</div>
<section class="form-section">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<?php
					$id = Session::get("cmrId");
					$getdata = $cmr->getCustomerData($id);
					if($getdata){
						while($result = $getdata->fetch_assoc()){ 
				?>
				<form action="" method="post">
					<div class="form-row">
						<div class="form-group col-md-6">
							<input type="text" name="name" class="form-control" placeholder="Full name *" value="<?php echo $result['firstname']." ".$result['lastname'];?>">
						</div>
						<div class="form-group col-md-6">
							<input type="email" name="email" class="form-control" placeholder="Email Address *" value="<?php echo $result['email'];?>">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<input type="number" name="phone"  value="<?php echo $result['phone'];?>" class="form-control" placeholder="Contact Number *">
						</div>
						<div class="form-group col-md-6">
							<input type="text" name="address" value="<?php echo $result['address'];?>" class="form-control" placeholder="Address *">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<input type="text" name="subject" class="form-control" placeholder="Subject *">
							<input type="hidden" id="i" name="id" value="<?php echo $cmrId;?>">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<textarea class="form-control" rows="3" name="body"></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12 text-center">
						   <input type="submit" name="submit" class="btn btn-primary" value="Send Message"/>
						</div>
					</div>
				</form>
				<?php
						}
					}
				?>

			</div>
			<div class="col-md-6 address">
				<h5>Call Us / WhatsApp</h5>
				<p><a href="+8801521419537"><i class="fa fa-phone"></i> +(88) 01521419537 </a><br></p>
				<h5>Email</h5>
				<p><i class="fa fa-envelope" aria-hidden="true"></i> : coffehouse@gmail.com</p>
				<h5>Working hours</h5>
				<p>
				saturday - thrusday : 10am - 8pm
				</p>
				<h5>Address</h5>
				<p>
				111/3/2 , Niketon , Ghulsan-1, Dhaka
				</p>
			</div>
		</div>
	</div>
</section> 
<br>
<br>
<br>
<?php include("inc/footer.php");?>	