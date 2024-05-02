<div class="content-wrapper">
	<section class="content">
		<form action="<?php echo $action; ?>" method="post">
			<div class="box box-primary ">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo strtoupper($button) ?> ITEM</h3>
				</div>
				<div class="box-body ">
					<div class='form-group'>
						<label for='inputEmail3'
							class='col-sm-2 control-label'>Category<?php echo form_error('category_id') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<?php echo select2_dinamis('category_id', 'item_category', 'name','Category Data','id',$category_id) ?>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3' class='col-md-2 control-label'>Inventory Number
							<?php echo form_error('inventory_number') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<input type="text" class="form-control" name="inventory_number" id="inventory_number" placeholder="Inventory Number"
								value="<?php echo $inventory_number; ?>" <?php $button == "Update" ? print('readonly') : '' ?>/>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3'
							class='col-sm-2 control-label'>Fund<?php echo form_error('fund_id') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<?php echo select2_dinamis('fund_id', 'item_fund', 'name','Fund','id',$fund_id) ?>
						</div>
					</div>
					<!-- <div class='form-group'>
						<label for='inputEmail3'
							class='col-sm-2 control-label'>Purchase Date<?php echo form_error('purchase_date') ?></label>
						<div class='col-sm-4' style="margin-bottom:10px;">
							<input type="text" class="form-control datepicker col-md-6 col-sm-12" name="purchase_date" id="purchase_date" placeholder="Date" autocomplete="off" value="<?php  print($purchase_date ??  ''); ?>" />
						</div>
					</div>

					<div class="col-md-12">
						<div class="row">
								<div class='form-group'>
								<label for='inputEmail3'
									class='col-sm-2 control-label'>Price<?php echo form_error('purchase_price') ?></label>
									<label for='inputEmail3' class='col-sm-1 control-label'>AUD
										<?php echo form_error('purchase_price') ?></label>
									<div class='col-sm-2' style="margin-bottom:10px;">
										<input type="number" class="form-control" name="purchase_price" id="purchase_price" placeholder="0"
											value="<?php echo $purchase_price ?? '' ; ?>"/>
									</div>
									<label for='inputEmail3' class='col-sm-1 control-label'>IDR
										<?php echo form_error('purchase_price') ?></label>
									<div class='col-sm-2' style="margin-bottom:10px;">
										<input type="number" class="form-control" name="purchase_price" id="purchase_price" placeholder="0"
											value="<?php echo $purchase_price ?? '' ; ?>"/>
									</div>
									<label for='inputEmail3' class='col-sm-1 control-label'>FJD
										<?php echo form_error('purchase_price') ?></label>
									<div class='col-sm-2' style="margin-bottom:10px;">
										<input type="number" class="form-control" name="purchase_price" id="purchase_price" placeholder="0"
											value="<?php echo $purchase_price ?? '' ; ?>"/>
									</div> 
								</div>
						</div>
					</div>					 -->
					<!-- <div class="col-md-12">
						<div class="row">
								<div class='form-group'>
									<label for='inputEmail3' class='col-sm-2 control-label'>Purchase Date<?php echo form_error('purchase_date') ?></label>
									<div class='col-sm-2' style="margin-bottom:10px;">
										<input type="text" class="form-control datepicker col-md-6 col-sm-12" name="purchase_date" id="purchase_date" placeholder="Date" autocomplete="off" value="<?php  print($purchase_date ??  ''); ?>" />
									</div>
									<label for='inputEmail3' class='col-sm-2 control-label'>Price (AUD/IDR/FJD)<?php echo form_error('purchase_price') ?></label>
									<div class='col-sm-2' style="margin-bottom:10px;">
										<input type="number" class="form-control" name="purchase_price" id="purchase_price" placeholder="AUD"
											value="<?php echo $purchase_price ?? '' ; ?>" />
									</div>
										<?php echo form_error('purchase_price') ?></label> 
									<div class='col-sm-2' style="margin-bottom:10px;">
										<input type="number" class="form-control" name="price_aud" id="purchase_price" placeholder="IDR"
											value="<?php echo $price_aud ?? '' ; ?>"/>
									</div>
										<?php echo form_error('purchase_price') ?></label> 
									<div class='col-sm-2' style="margin-bottom:10px;">
										<input type="number" class="form-control" name="price_fjd" id="purchase_price" placeholder="FJD"
											value="<?php echo $price_fjd ?? '' ; ?>"/>
									</div>
								</div>
						</div>
					</div> -->
					<div class="col-md-12">
						<div class="row">
								<div class='form-group'>
									<label for='inputEmail3' class='col-sm-2 control-label'>Purchase Date<?php echo form_error('purchase_date') ?></label>
									<div class='col-sm-3' style="margin-bottom:10px;">
										<input type="text" class="form-control datepicker col-md-6 col-sm-12" name="purchase_date" id="purchase_date" placeholder="Date" autocomplete="off" value="<?php  print($purchase_date ??  ''); ?>" />
									</div>
									<label for='inputEmail3' class='col-sm-1 control-label'>Price<?php echo form_error('purchase_price') ?></label>
									<div class='col-sm-3' style="margin-bottom:10px;">
										<input type="number" class="form-control" name="purchase_price" id="purchase_price" placeholder="Purchase Price"
											value="<?php echo $purchase_price ?? '' ; ?>" />
									</div>

									<label for='inputEmail3' class='col-sm-1 control-label'>Currency
										<?php echo form_error('purchase_price') ?></label>
									<div class='col-sm-2' style="margin-bottom:10px;">
										<select id='currency' name="currency" class="form-control">
											<?php  
											if (strlen($currency)  > 0) {
												if ($currency == 'AUD') {
													echo "<option value='AUD' selected='selected'>AUD</option>";
													echo "<option value='IDR'>IDR</option>";
													echo "<option value='FJD'>FJD</option>";
												}
												else if ($currency == 'IDR') {
													echo "<option value='AUD'>AUD</option>";
													echo "<option value='IDR' selected='selected'>IDR</option>";
													echo "<option value='FJD'>FJD</option>";
												}    
												else if ($currency == 'FJD') {
													echo "<option value='AUD'>AUD</option>";
													echo "<option value='IDR'>IDR</option>";
													echo "<option value='FJD' selected='selected'>FJD</option>";
												}
											}
											else {
												echo "<option value='AUD'>AUD</option>";
												echo "<option value='IDR'>IDR</option>";
												echo "<option value='FJD'>FJD</option>";
											}    
												?>
										</select>
									</div>
								</div>
						</div>
					</div>

					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Name
							<?php echo form_error('name') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<input type="text" class="form-control" name="name" id="name" placeholder="Name"
								value="<?php echo $name; ?>" />
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Description
							<?php echo form_error('description') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<textarea class="form-control" rows="3" name="description" id="description"
								placeholder="Description"><?php echo $description; ?></textarea>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Type
							<?php echo form_error('type_id') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<input type="text" name="type" id="type" value="<?php echo $type ?? ''; ?> " class="form-control" />
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Serial Number
							<?php echo form_error('serial_number') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<textarea class="form-control" rows="3" name="serial_number" id="serial_number"
								placeholder="Serial Number"><?php echo $serial_number; ?></textarea>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Sub Category<?php echo form_error('sub_category_id') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
						<?php echo select2_dinamis('sub_category_id', 'item_sub_category', 'name','Sub Category Data','id',$sub_category_id,['category_id' => $category_id]) ?>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3'
							class='col-sm-2 control-label'>Manufacture<?php echo form_error('manufacture_id') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<?php echo select2_dinamis('manufacture_id', 'item_manufacture', 'name','Manufacture','id',$manufacture_id) ?>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3'
							class='col-sm-2 control-label'>Supplier/Agent<?php echo form_error('supplier_id') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<?php echo select2_dinamis('supplier_id', 'item_supplier', 'name','Supplier/Agent','id',$supplier_id) ?>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3'
							class='col-sm-2 control-label'>Location<?php echo form_error('id_location') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<?php echo select2_dinamis('id_location', 'location', 'name','Location','id',$id_location,null,['required' => 'required']) ?>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Location Detail<?php echo form_error('location_det_id') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
						<?php echo select2_dinamis('location_det_id', 'location_detail', 'name','Location Detail','id',$location_det_id,['id_location' => $id_location], ['required' => 'required']) ?>
						</div>
					</div>

					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Scheduled check<?php echo form_error('scheduled') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<select id='scheduled' name="scheduled" class="form-control">
							<?php  
								if (strlen($scheduled)  > 0) {
									if ($scheduled == 'YES') {
										echo "<option value='YES' selected='selected'>YES</option>";
										echo "<option value='NO'>NO</option>";
									}
									else if ($scheduled == 'NO') {
										echo "<option value='YES'>YES</option>";
										echo "<option value='NO' selected='selected'>NO</option>";
									}    
								}
								else {
									echo "<option value='YES'>YES</option>";
									echo "<option value='NO'>NO</option>";
								}    
								?>
							</select>
						</div>
					</div>


					<div class='form-group'>
						<label for='inputEmail3'
							class='col-sm-2 control-label'>Quantity<?php echo form_error('qty') ?></label>
							<div class='col-sm-10' style="margin-bottom:10px;">
								<input type="number" class="form-control" name="qty" id="qty" placeholder="0"
									value="<?php echo $qty ?? '' ; ?>"/>
							</div>
					</div>

					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Receipt<?php echo form_error('receipt') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<input type="file" name="userfile" size="20" />
						<?php
						?>
						<!-- <input type="file" name="image" id="image" class="form-control"> -->
						</div>
					</div>

					<div class='form-group'>
						<label for='inputEmail3' class='col-sm-2 control-label'>Image<?php echo form_error('image') ?></label>
						<div class='col-sm-10' style="margin-bottom:10px;">
							<input type="file" name="image" id="image" class="form-control">
						</div>
					</div>
					
					<div class="form-group" id="imageView">
						<div class="col-md-2"></div>
						<div class="col-md-8" >
							<div class="form-group" style="display: flex;"id="imageData">
								<?php if(isset($images)) {
									foreach ($images as $row ) {
										echo '<div class="image-area" style="margin-right:25px;" data-id="'.$row->image.'">
												<a href="../assets/item-images/'.$row->image.'" target="_blank"><img src="../assets/item-images/'.$row->image.'"  alt="Preview"></a>
												<a class="remove-image" href="javascript:void(0)" style="display: inline;">&#215;</a>
												
											</div>';
									} 
								}?>
							</div>
						</div>
					</div>
				</div>
				<div class='box-footer'>
					<a href="<?php echo site_url('item_master') ?>" class="btn btn-danger"><i
							class="fa fa-arrow-circle-left"></i> Back</a>
						<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>
						<?php echo $button ?></button>
				</div>
				
			</div>
		</form>
	</section>
</div>
<script type="text/javascript">
	$(function(){
        $("#category_id").change(function() {
            var cat_id = $('#category_id').val();
            document.location.href="../item_master/create2?cat_id="+cat_id;
        });
		$('.datepicker').datepicker({
			autoclose: true,
			dateFormat:'yy-mm-dd'
		})
		$('#category_id').on('select2:select',function(e){
			console.log( e.params.data.id)
			let id = e.params.data.id
			$.ajax({
				type: "POST",
				url: "../item_sub_category/list/",
				data: {id},
				dataType: "json",
				success: function (response) {
					$('#sub_category_id').html(response.data)
				}
			});
		})
		$('#id_location').on('select2:select',function(e){
			console.log( e.params.data.id)
			let id = e.params.data.id
			$.ajax({
				type: "POST",
				url: "../location_detail/list/",
				data: {id},
				dataType: "json",
				success: function (response) {
					$('#location_det_id').html(response.data)
				}
			});
		})

		$('#image').change(function(){
                    var fd = new FormData();
                    var files = $('#image')[0].files[0];
                    fd.append('image', files);
                    $.ajax({
                        url: '../item_master/upload',
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType : 'json',
                        success: function(response){
                            if(response.error == false){
								$('#imageData').append(response.data)
                            }
                            else
                                alert(response.error)
								$('#image').val('')
                        },
                    });
                })
			$('#imageData').on('click','.remove-image',function(){
				let parent = $(this).parent()
				let id = $('#inventory_number').val()
				if($(parent).data('id') != ''){
					$.ajax({
						type: "POST",
						url: "../item_master/remove_image",
						data: {id,image:$(parent).data('id')},
						dataType: "json",
						success: function (response) {
								
						}
					});
				}
				$(parent).remove()
			})

	})
</script>