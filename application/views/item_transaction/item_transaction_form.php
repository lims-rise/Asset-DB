<div class="content-wrapper">
	<section class="content">
	<form action="<?php echo $action; ?>" method="post">
		<div class="box box-primary ">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> ITEM_TRANSACTION</h3>
			</div>
			
			<div class="box-body ">
			
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Inventory Number <?php echo form_error('inventory_number') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="inventory_number" id="inventory_number" placeholder="Inventory Number" value="<?php echo $inventory_number; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Location Id <?php echo form_error('location_id') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="location_id" id="location_id" placeholder="Location Id" value="<?php echo $location_id; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Department Id <?php echo form_error('department_id') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="department_id" id="department_id" placeholder="Department Id" value="<?php echo $department_id; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>User Id <?php echo form_error('user_id') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
						</div>
					</div>
	    
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Purpose <?php echo form_error('purpose') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<textarea class="form-control"   rows="3" name="purpose" id="purpose" placeholder="Purpose"><?php echo $purpose; ?></textarea>
						</div>
					</div>
					
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Condition Id <?php echo form_error('condition_id') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="condition_id" id="condition_id" placeholder="Condition Id" value="<?php echo $condition_id; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Remark <?php echo form_error('remark') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="remark" id="remark" placeholder="Remark" value="<?php echo $remark; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Status <?php echo form_error('status') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Transaction At <?php echo form_error('transaction_at') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="transaction_at" id="transaction_at" placeholder="Transaction At" value="<?php echo $transaction_at; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Transaction By <?php echo form_error('transaction_by') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="transaction_by" id="transaction_by" placeholder="Transaction By" value="<?php echo $transaction_by; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Created At <?php echo form_error('created_at') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
						</div>
					</div>
	
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Created By <?php echo form_error('created_by') ?></label>
						<div class='col-sm-10' style="margin-bottom: 10px;">
						<input type="text" class="form-control"   name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
						</div>
					</div>
	
					</div>
					<div class='box-footer'>
							<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
		<a href="<?php echo site_url('item_transaction') ?>" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a>
	 	<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
				</div>
	
	</div>
	</form>
	</section>
</div>