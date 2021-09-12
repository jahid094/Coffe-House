<?php 
	$GLOBALS['title'] = 'View Order';
?>
<?php include("inc/header.php");?>
<?php
    $login = Session::get("cuslogin");
    if($login == false){
       header("Location:login.php");
   } 
?>
<?php
    if(isset($_GET['customerid'])){
        $id = $_GET['customerid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $confirm = $ct->productShiftConfirm($id,$time,$price);
    }
	
	if(isset($_GET['delProid'])){
        $id = $_GET['delProid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $delOrder = $ct->delProductShifted($id,$time,$price);
    }
?>
<div id="home">
   	<div class="landing-text">
   		<p class="landingheading1">Scroll Down Below</p>
   		<p class="landingheading2 d-none d-sm-block">and looking up your order's</p><br/>
   	</div>
</div>
<div class="container-fluid  bg-gray pb-5">
	<br>
	<br>
	<div class="container">
		<div class="row top-heading">
			<div class="col-md-12">
				<p>Order Confirm Now</p>
			</div>
		</div>
		<?php
			if(isset($updateCart)){
				echo $updateCart;
			}
			if(isset($delProduct)){
				echo $delProduct;
			}
		?>	
		<table class="table table-sm table-dark">
			<thead>
				<tr>
					<th scope="col">Serial</th>
					<th scope="col">Image</th>
					<th scope="col">Coffe Name</th>
					<th scope="col">Quantity</th>
					<th scope="col">Price</th>
					<th scope="col">Date</th>
					<th scope="col">Status</th>
					<th scope="col">Action</th>
				</tr> 
			</thead>
			<?php
				$cmrId = Session::get("cmrId");
				$getOrder = $ct->getOrderedProduct($cmrId);
				if($getOrder){
					$i = 0;
					$sum = 0;
					$qty = 0;
					while($result = $getOrder->fetch_assoc()){
					   $i++;  
			?>
			<tbody>
				<tr>
					<th scope="row"><?php echo $i;?></th>
					<td><img src="admin/<?php echo $result['image'];?>" alt="" height="40px" width="60px" /></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['quantity'];?></td>
					<td><?php echo $result['price'];?></td>
					<td><?php echo $fm->formatDate($result['date']);?></td>
					<td>
					<?php 
							if($result['status'] == '0'){
								echo "Pending";
							} else if($result['status'] == '1') {
						?>
						<a href="?customerid=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Shifted</a>
						<?php
							} else {
								echo "Confirm";
							}
						?></td>
					<?php
						if($result['status'] == '2'){
					?>
					<td><a onclick="return confirm('Are you sure to Delete!');" href="?delProid=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">X</a></td>
					<?php
						} else {
					?>
					<td>N/A</td>
					<?php
						}
					?>
				</tr>
				<?php
					$qty = $qty + $result['quantity'];
					$sum = $sum + $result['price'];
				?>
				<?php
						}
					}
				?>			
			</tbody>
		</table>
	</div>
</div>
<?php include("inc/footer.php");?>	