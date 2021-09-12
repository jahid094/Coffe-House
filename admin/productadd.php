<?php include("inc/header.php");?>
<?php include("inc/sidebar.php");?>
<br>
<br>
<br>
<br>
<br>
<?php include("../classes/Product.php");?>
<?php
    $pd = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertProduct = $pd->productInsert($_POST,$_FILES);
    }
?>
<div class="container mt-50">
	<div class="row">
		<div class="col-2">
		</div>
		<div class="col-md-10">
			<?php
				if(isset($insertProduct)){
				   echo $insertProduct;
				}
			?>   
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="exampleFormControlInput1">Product Name</label>
					<input type="Name" name="productName" class="form-control" id="exampleFormControlInput1" placeholder="Product name">
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Description</label>
					<textarea name="body" id="exampleFormControlTextarea1" class="form-control" rows="3" placeholder="Product Description"></textarea>
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Price</label>
					<input type="text" name="price" class="form-control" id="exampleFormControlInput1" placeholder="Price"></input>
				</div>
				<div class="form-group">
					<label for="exampleFormControlFile1">Upload a image:</label>
					<input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
				</div>
				<input type="submit" name="submit" class="btn btn-outline-success btn-block" Value="Save"/>
			</form>	
		</div>
	</div>
</div>
<?php include("inc/footer.php");?>