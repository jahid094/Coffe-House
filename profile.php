<?php 
	$GLOBALS['title'] = 'Profile';
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
        $updateCmr = $cmr->customerUpdate($_POST,$id);
    }
?>
<div id="home">
   	<div class="landing-text">
   		<p class="landingheading1">Your Profile</p>
   		<p class="landingheading2 d-none d-sm-block">Update your profile.</p><br/>
   	</div>
</div>
<div class="container-fluid  bg-gray pb-5">
	<br>
	<br>
	<div class="container-fluid" >
		<div class="row"  >
			<div class="col-md-8">
				<div class="card">
					<div class="header">
						<h4  class="title" style="margin-top: 10px">Edit Profile</h4>
					</div>
						<?php
							$id = Session::get("cmrId");
							$getdata = $cmr->getCustomerData($id);
							if($getdata){
								while($result = $getdata->fetch_assoc()){ 
						?>
						<form style="width: 60%; margin: 0 auto;" action="" method="post">
							<div class="form-group">
								<label>First Name:</label>
								<input type="text" name="firstname" class="form-control" placeholder="Company" value="<?php echo $result['firstname'];?>">
							</div>
							<div class="form-group">
								<label>Last Name:</label>
								<input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $result['lastname'];?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address:</label>
								<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $result['email'];?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Phone Number:</label>
								<input type="text" name="phone" class="form-control" placeholder="Phone number" value="<?php echo $result['phone'];?>">
							</div>
							<div class="form-group">
								<label>Address:</label>
								<input type="text" name="address" class="form-control" placeholder="Home Address" value="<?php echo $result['address'];?>">
							</div>
							<input type="hidden" id="i" name="id" value="<?php echo $cmrId;?>">
							<input type="submit" class="btn btn-info" name="submit" value="Update Profile"/>
							<div class="clearfix"></div>
							<br>
							<br>
						</form>
						<?php
								}
							}
						?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card card-user">
					<?php
						$id = Session::get("cmrId");
						$getdata = $cmr->getCustomerData($id);
						if($getdata){
							while($result = $getdata->fetch_assoc()){ 
					?>
					<div class="image">
						<img class="img-fluid qualities-img p-4" src="image/sales-head.png">
					</div>
					<hr>
					<div>
						<label>Name:</label>	
						<h4><?php echo $result['firstname'];?> <?php echo $result['lastname'];?></h4>
					</div>
					<br>
					<div> 
						<label>Email:</label>
						<h5><?php echo $result['email'];?></h5>
					</div>
					<div> 
						<label>Contact Number:</label>
						<h5>+88 <?php echo $result['phone'];?></h5>
					</div>
					<br>
					<div> 
						<label>Address:</label>
						<h6><?php echo $result['address'];?></h6>
					</div>
					<br>
					<?php
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("inc/footer.php");?>