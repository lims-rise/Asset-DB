
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA ITEM_TRANSACTION</h3>
			</div>
		
		<table class='table table-bordered' width='100%'>        

	
			<tr>
				<td>Inventory Number</td>
				<td><?php echo $inventory_number; ?></td>
			</tr>
	
			<tr>
				<td>Location Id</td>
				<td><?php echo $location_id; ?></td>
			</tr>
	
			<tr>
				<td>Department Id</td>
				<td><?php echo $department_id; ?></td>
			</tr>
	
			<tr>
				<td>User Id</td>
				<td><?php echo $user_id; ?></td>
			</tr>
	
			<tr>
				<td>Purpose</td>
				<td><?php echo $purpose; ?></td>
			</tr>
	
			<tr>
				<td>Condition Id</td>
				<td><?php echo $condition_id; ?></td>
			</tr>
	
			<tr>
				<td>Remark</td>
				<td><?php echo $remark; ?></td>
			</tr>
	
			<tr>
				<td>Status</td>
				<td><?php echo $status; ?></td>
			</tr>
	
			<tr>
				<td>Transaction At</td>
				<td><?php echo $transaction_at; ?></td>
			</tr>
	
			<tr>
				<td>Transaction By</td>
				<td><?php echo $transaction_by; ?></td>
			</tr>
	
			<tr>
				<td>Created At</td>
				<td><?php echo $created_at; ?></td>
			</tr>
	
			<tr>
				<td>Created By</td>
				<td><?php echo $created_by; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('item_transaction') ?>" class="btn btn-default">Back</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>