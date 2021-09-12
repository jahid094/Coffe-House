<?php include("inc/header.php");?>
<?php include("inc/sidebar.php");?>
<?php include("../classes/Customer.php");?>
<?php include_once("../helpers/Format.php");?>
<?php
    $cmr = new Customer();
    $fm = new Format();
	
	if(!isset($_GET['custId']) || $_GET['custId'] == NULL){
        echo "<script>window.location = '404.php'; </script>";  
    } else{
        $id = $_GET['custId']; 
    }
?>
<div class="container-fluid  bg-gray pb-5">
	<br>
	<br>
	<div class="container-fluid" >
		<div class="row"  >
		    <div class="col-md-4">
            </div>
			<div class="col-md-4">
				<div class="card card-user">
					<?php
						$getdata = $cmr->getCustomerData($id);
						if($getdata){
							while($result = $getdata->fetch_assoc()){ 
					?>
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