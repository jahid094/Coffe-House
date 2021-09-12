<?php include("inc/header.php");?>
<?php include("inc/sidebar.php");?>
<?php include("../classes/Customer.php");?>
<?php include_once("../helpers/Format.php");?>
<?php
    $cmr = new Customer();
    $fm = new Format();
	
	if(isset($_GET['delfeedback'])){
        $id = $_GET['delfeedback'];
        $delfeedback = $cmr->delFeedbackById($id);
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
					if(isset($delfeedback)){
						echo $delfeedback;
					}
				?> 
				<thead>
					<tr>
						<th scope="col">Serial</th>
						<th scope="col">Customer Name</th>
						<th scope="col">Subject</th>
						<th scope="col">Message</th>
						<th scope="col">Details</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$getFeedback = $cmr->getAllFeedback();
					if($getFeedback){
						$i = 0;
						while($result = $getFeedback->fetch_assoc()){
						   $i++;
				?>
					<tr>
						<td><?php echo $i;?></th>
						<td><?php echo $result['name'];?></td>
						<td><?php echo $result['subject'];?></td>
						<td><?php echo $fm->textShorten($result['body'],50);?></td>
						<td><a href="customer.php?custId=<?php echo $result['customerId'];?>">View Details</a></td>
						<td><a onclick="return confirm('Are you sure to delete!')"  href="?delfeedback=<?php echo $result['feedbackId'];?>"  class="btn btn-outline-danger btn-sm" role="button" aria-pressed="true">Remove</a></td>
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