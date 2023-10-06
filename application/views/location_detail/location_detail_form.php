<div class="content-wrapper">
	<section class="content">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA LOCATION DETAIL</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
					<tr>
						<td>Location</td>
						<td><?php echo cmb_dinamis('id_location', 'location', 'name', 'id',$id_location) ?>
						</td>
					</tr>
	
					<tr>
						<td width='200'>Location Detail <?php echo form_error('name') ?></td>
						<td><input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
						</td>
					</tr>
	
					
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('location_detail') ?>" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>