<?php 
	$GLOBALS['title'] = 'Order Details';
?>
<?php include("inc/header.php");?>
<?php
    $login = Session::get("cuslogin");
    if($login == false){
       header("Location:login.php");
   } 
?>
<?php
    if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
        $cmrId = Session::get("cmrId");
        $insertOrder = $ct->orderProduct($cmrId);
        $delData = $ct->delCustomerCart();
        header("Location:viewOrder.php");
    }
?>
<div id="home">
   	<div class="landing-text">
   		<p class="landingheading1">Scroll Down Below</p>
   		<p class="landingheading2 d-none d-sm-block">Update your profile and Conform your order</p><br/>
   	</div>
</div>
<div class="container-fluid  bg-gray">
	<br>
	<div class="container-fluid" >
		<div class="row"  >
			<div class="col-md-8">
				<div class="card ">
					<table class="table table-sm table-dark">
						<tr>
							<th>No</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
						<?php
							$getPro = $ct->getCartProduct();
							if($getPro){
								$i = 0;
								$sum = 0;
								$qty = 0;
								while($result = $getPro->fetch_assoc()){
								   $i++; 
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $result['productName'];?></td>
							<td><?php echo $result['price'];?></td>
							<td><?php echo $result['quantity'];?></td>
							<td><?php 
									$total = $result['price'];
									echo $total;?></td>
						</tr>
						<?php
							$qty = $qty + $result['quantity'];
							$sum = $sum + $total;
						?>
						<?php
								}
							}
						?>	
						<tr>
							<th scope="row"><h5>Total</h5></th>
							<td colspan="3"></td>
							<td><h5><?php echo $sum;?>/-</h5></td>
						</tr>
						
					</table>
					
				</div>
				<div class="container">
					<div class="row">	
						<a href="?orderid=order" type="button" class="btn btn-outline-success btn-lg btn-block">Confirm Order</a>
					</div>
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
					<hr>
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