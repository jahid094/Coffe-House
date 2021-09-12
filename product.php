<?php 
	$GLOBALS['title'] = 'Order';
?>
<?php include("inc/header.php");?>	
<div id="home">
   	<div class="landing-text">
   		<p class="landingheading1">Here is the Coffe's </p>
   		<p class="landingheading2 d-none d-sm-block"> Choose your desire Coffe.</p><br/>
   	</div>
 </div>
<div class="container-fluid  bg-gray pb-5">
   	<div class="container">
   		<div class="row top-heading mt-5">
   			<div class="col-md-12">
   				<p>Product List</p>
   			</div>
   		</div>
		<div class="container">
			<div class="row">
				<?php
					$pd = new Product();
                    $getAllpd = $pd->getAllProduct();
                    if($getAllpd){
                        while($result = $getAllpd->fetch_assoc()){  
                ?>
				<div class="col-md-4">
					<div class="card">
						<img src="admin/<?php echo $result['image']; ?>" alt="" style="width: 100%" />
						<div class="card-body">
							<p style="color: gray;"><?php echo $result['productName']; ?> </p>
						</div>  
						<div class="container">
							<div class="row">
								<a href="details.php?proid=<?php echo $result['productId']; ?>" class="btn btn-outline-success btn-lg btn-block">View Details</a>
							</div>
						</div>
					</div>
				</div>
				<?php
                        }
                    }
                ?>
			</div>
		</div>
		
	</div>
</div>
<?php include("inc/footer.php");?>	