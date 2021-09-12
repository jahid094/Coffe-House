<?php include("inc/header.php");?>
<?php include("inc/sidebar.php");?>
<?php include("../classes/Product.php");?>
<?php include_once("../helpers/Format.php");?>
<?php
    $pd = new Product();
    $fm = new Format();
    
    if(isset($_GET['delpro'])){
        $id = $_GET['delpro'];
        $delpro = $pd->delProById($id);
    }
?>
<br>
<br>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-11">
			<table class="table  table-md table-success">
				<?php
					if(isset($delpro)){
						echo $delpro;
					}
				?> 
				<thead>
					<tr>
						<th scope="col">Serial</th>
						<th scope="col">Product Name</th>
						<th scope="col">Description</th>
						<th scope="col">Price</th>
						<th scope="col">Image</th>
						<th scope="col">Action(Edit/Delete)</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$getPd = $pd->getAllProduct();
					if($getPd){
						$i = 0;
						while($result = $getPd->fetch_assoc()){
						   $i++;
				?>
					<tr>
						<td><?php echo $i;?></th>
						<td><?php echo $result['productName'];?></td>
						<td><?php echo $fm->textShorten($result['body'],50);?></td>
						<td><?php echo $result['price'];?></td>
						<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"/></td>
						<td><a onclick="return confirm('Are you sure to delete!')"  href="?delpro=<?php echo $result['productId'];?>"  class="btn btn-outline-danger btn-sm" role="button" aria-pressed="true">Delete</a> / <a href="productedit.php?proid=<?php echo $result['productId'];?>" class="btn btn-outline-success btn-sm " role="button" aria-pressed="true">Edit</a> </td>
					</tr>
				<?php
                        }
                    }
                ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include("inc/footer.php");?>