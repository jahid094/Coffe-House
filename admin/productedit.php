<?php include("inc/header.php");?>
<?php include("inc/sidebar.php");?>
<?php include("../classes/Product.php");?>
<?php
    if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script>window.location = '../404.php'; </script>";  
    } else{
        $id = $_GET['proid']; 
    }
    $pd = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $id = $_POST['id'];
        $updateProduct = $pd->productUpdate($_POST,$_FILES,$id);
    }
?>
<br>
<br>
<br>
<br>
<br>
<div class="container mt-50">
	<div class="row">
		<div class="col-2">
		</div>
		<div class="col-md-10">
			<?php
				if(isset($updateProduct)){
				   echo $updateProduct;
				}
			?>  
			<?php
				$getPro = $pd->getProById($id);
				if($getPro){
					while($value = $getPro->fetch_assoc()){
			?>   
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="exampleFormControlInput1">Product Name</label>
					<input type="Name" name="productName" value="<?php echo $value['productName'];?>" class="form-control" id="exampleFormControlInput1" placeholder="Product name">
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Description</label>
					<textarea name="body" id="user-message" class="form-control" rows="10" placeholder="Enter your Message"> <?php echo $value['body'];?></textarea>
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Price</label>
					<input type="text" name="price" value="<?php echo $value['price'];?>" class="form-control" id="exampleFormControlInput1"></input>
				</div>
				<div class="form-group">
					<label for="exampleFormControlFile1">Upload a image:</label>
					<img src="<?php echo $value['image']; ?>" height="80px" width="200px"/>
					<input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
				</div>
				<input type="submit" name="submit" class="btn btn-outline-success btn-block" Value="Update"/>
				<input type="hidden" id="i" name="id" value="<?php echo $id;?>">
			</form>	
			<?php 
                    }
                }
            ?>
		</div>
	</div>
</div>
<?php include("inc/footer.php");?>