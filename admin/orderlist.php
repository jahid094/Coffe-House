<?php include("inc/header.php");?>
<?php include("inc/sidebar.php");?>
<?php include("../classes/Cart.php");?>
<?php include_once("../helpers/Format.php");?>
<?php
    $fm = new Format();
    $ct = new Cart();
?>
<?php
    if(isset($_GET['shiftid'])){
        $id = $_GET['shiftid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $shift = $ct->productShifted($id,$time,$price);
    }

    if(isset($_GET['delProid'])){
        $id = $_GET['delProid'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $delOrder = $ct->delProductShifted($id,$time,$price);
    }
?>
<br>
<br>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-11">
			<table class="table  table-md table-success">
				<thead>
					<tr>
						<th scope="col">Serial</th>
						<th scope="col">Order Time</th>
						<th scope="col">Product Name</th>
						<th scope="col">Quantity</th>
						<th scope="col">Price</th>
						<th scope="col">Image</th>
						<th scope="col">Address</th>
						<th scope="col">Action(Edit/Delete)</th>
					</tr>
				</thead>
				<tbody>
					    <?php
                            $getOrder = $ct->getAllOrderProduct();
                            if($getOrder){
                                while($result = $getOrder->fetch_assoc()){
                        ?>
						<tr class="odd gradeX">
							<td><?php echo $result['id'];?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td><?php echo $result['productName'];?></td>
							<td><?php echo $result['quantity'];?></td>
							<td><?php echo $result['price'];?></td>
							<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"/></td>
							<td><a href="customer.php?custId=<?php echo $result['cmrId'];?>">View Details</a></td>
							<?php
                                if($result['status'] == '0'){
                            ?>
                            <td><a href="?shiftid=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Shifted</a></td>
                            <?php       
                                } else if($result['status'] == '1') {
                            ?>
							<td>Pending</td>
							<?php
                                } else if($result['status'] == '2') {
                            ?>
                            <td><a href="?delProid=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Remove</a></td>
                            <?php
                                }
                            ?>
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