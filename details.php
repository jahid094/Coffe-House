<?php 
	$GLOBALS['title'] = 'Product Order';
?>
<?php include("inc/header.php");?>
<?php
	if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script>window.location = '404.php'; </script>";  
    } else{
        $id = $_GET['proid']; 
    }
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $quantity = $_POST['quantity']; 
        $id = $_POST['id'];
        if($quantity > 0){
            $addCart = $ct->addToCart($quantity,$id);
        }
        
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
<section class="form-section">
	<div class="container">
		<div class="row">
			<?php
				$getPd = $pd->getSingleProduct($id);
				if($getPd){
					while($result = $getPd->fetch_assoc()){ 
			?>	
			<div class="col-md-1"></div>
			<div class="col-md-6">
				<div class="card ">
				   <img src="admin/<?php echo $result['image'];?>" alt="" style="width: 100%" />
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<br>
				<div>
					<h2><?php echo $result['productName'];?></h2>
				</div>
				<hr>
				<div>
					<h4>Price: <?php echo $result['price'];?></h3>
				</div>
				<div>
					<p><?php echo $result['body'];?></p>
				</div>
				<div class="card-body">
					<form action="" method="post">
						<div class="form-group">
							<input style="width: 100%; margin: 0 auto; " name="quantity" type="number" class="form-control" id="exampleInputNumber" placeholder="Quantities of coffe" value="1">
							<input type="hidden" id="i" name="id" value="<?php echo $id;?>">
						</div>
						<div class="container">
							<div class="row">
								<input type="submit" name="submit" class="btn btn-outline-success btn-lg btn-block" value="Add to cart"/>
							</div>
						</div>
					</form>	
				</div> 
				<span style="color:red;font-size:18px;">
				    <?php
                        if(isset($addCart)){
                            echo $addCart;
                        }
                    ?>
				</span>
				
			</div>
			<?php
					}
				}
			?>	
		</div>
	</div>
</section> 
<br>
<br>
<br>
<?php include("inc/footer.php");?>	