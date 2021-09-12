<?php 
	$GLOBALS['title'] = 'View Cart';
?>
<?php include("inc/header.php");?>
<?php
    if(isset($_GET['delpro'])){
        $delId = $_GET['delpro'];
        $delProduct = $ct->delProductByCart($delId);
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cartId = $_POST['cartId']; 
		$productId = $_POST['productId']; 
        $quantity = $_POST['quantity']; 
        $updateCart = $ct->updateCartQuantity($cartId,$quantity,$productId);
        if($quantity <= 0){
            $delProduct = $ct->delProductByCart($cartId);
        }
    }
?>
<div id="home">
   	<div class="landing-text">
   		<p class="landingheading1">Your Order's</p>
   		<p class="landingheading2 d-none d-sm-block">view your Order.</p><br/>
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
				</tr> 
			</thead>
			<?php
				$getPro = $ct->getCartProduct();
				if($getPro){
					$i = 0;
					$sum = 0;
					$qty = 0;
					while($result = $getPro->fetch_assoc()){
					   $i++; 
			?>
			<tbody>
				<tr>
					<th scope="row"><?php echo $i;?></th>
					<td><img src="admin/<?php echo $result['image'];?>" alt="" height="40px" width="60px" /></td>
					<td><?php echo $result['productName'];?></td>
					<td>
						<form action="" method="post">
							<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>"/>
							<input type="hidden" name="productId" value="<?php echo $result['productId'];?>"/>
							<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
							<input type="submit" name="submit" value="Update"/>
						</form>
					</td>
					<td><?php echo $result['price'];?></td>
				</tr>
				<?php
					$total = $result['price'];
					$qty = $qty + $result['quantity'];
					$sum = $sum + $total;
					Session::set("qty",$qty);
					Session::set("sum",$sum);
				?>
				<?php
					}
				?>	
				<tr>
					<th scope="row"><h5>Total</h5></th>
					<td colspan="3"></td>
					<td><h5><?php echo $sum;?>/-</h5></td>
				</tr>
				<?php
				} 	else {
					}
				?>
			</tbody>
			
		</table>
		<div class="container">
			<div class="row">	
				<a href="orderdetails.php" type="button" class="btn btn-outline-success btn-lg btn-block">View Order</a>
			</div>
		</div>
	</div>
</div>
<?php include("inc/footer.php");?>