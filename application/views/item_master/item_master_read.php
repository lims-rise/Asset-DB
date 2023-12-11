<link rel="stylesheet" href="<?php echo base_url('assets/adminlte/css/bootstrap-datepicker.min.css'); ?>">

<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">DETAIL <?php echo $inventory_number; ?></h3>
					</div>
					<input type="hidden" name="inventory_number" id="inventory_number" value="<?php echo $inventory_number; ?>">
					<table class='table table-bordered' width='100%'>
					<tr>
							<td>Purchase Date </td>
							<td><?php echo $purchase_date; ?></td>
						</tr>
						<tr>
							<td>Purchase Price </td>
							<td><?php echo $purchase_price; ?></td>
						</tr>
						<tr>
							<td>Inventory Number</td>
							<td><?php echo $inventory_number; ?></td>
						</tr>
						<tr>
							<td>Fund</td>
							<td><?php echo $fund_name; ?></td>
						</tr>
						<tr>
							<td>Name</td>
							<td><?php echo $name; ?></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><?php echo $description; ?></td>
						</tr>

						<tr>
							<td>Type</td>
							<td><?php echo $type; ?></td>
						</tr>

						<tr>
							<td>Serial Number</td>
							<td><?php echo $serial_number; ?></td>
						</tr>

						<tr>
							<td>Category</td>
							<td><?php echo $category_name; ?></td>
						</tr>

						<tr>
							<td>Sub Category </td>
							<td><?php echo $sub_category_name; ?></td>
						</tr>
						<tr>
							<td>Manufacture </td>
							<td><?php echo $manufacture_name; ?></td>
						</tr>
						<tr>
							<td>Supplier/Agent </td>
							<td><?php echo $supplier_name; ?></td>
						</tr>
						<tr>
							<td>Location </td>
							<td><?php echo $location_name; ?></td>
						</tr>
						<tr>
							<td>Location Detail </td>
							<td><?php echo $location_detail_name; ?></td>
						</tr>
						<tr>
							<td>Scheduled check </td>
							<td><?php echo $scheduled; ?></td>
						</tr>
						<tr>
							<td>Quantity </td>
							<td><?php echo $qty; ?></td>
						</tr>
					
						<tr>
							<td><a href="<?php echo $this->agent->referrer()?>" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</a></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">IMAGE</h3>
					</div>
					<?php if (isset($images)) {
						if($images->num_rows() > 0){
							?>
					
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php for($x=0; $x < $images->num_rows(); $x++) {
								if ($x == 0)
									echo '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
								else
									echo '<li data-target="#carousel-example-generic" data-slide-to="' . $x . '"></li>';
							}?>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<?php $z = 'active'; foreach ($images->result() as $row) {
								echo '	<div class="item '.$z.'">
											<a href="'.base_url("assets/item-images/".$row->image).'" target="_blank"><img src="../assets/item-images/'.$row->image.'" alt="..." style="max-height:308px;" class="center-block"></a>
											<div class="carousel-caption">
											</div>
										</div>';
								$z = '';
							}?>
						
						</div>
						
						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
					<?php 	}
					}?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h3 class="box-title">HISTORY DETAILS</h3>
					</div>

					<div class="box-body">
						<div style="padding-bottom: 10px;">
							<button class="btn btn-danger btn-sm btn-modal" type="button"><i class="fa fa-wpforms" aria-hidden="true"></i> New Data</button>
							<?php echo anchor(site_url('item_transaction/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div>
							<table class="table table-bordered table-striped" width="100%" id="mytable">
								<thead>
									<tr>
										<th width="30px">No</th>
										<th>Date</th>
										<th>Responsible Person</th>
										<th>Departmen</th>
										<th>Location</th>
										<th>Purpose</th>
										<th>Condition</th>
										<th>Remark</th>
										<th width="200px">Action</th>
									</tr>
								</thead>
							
							</table>
       					 </div>
                    </div>
            </div>
		</div>
 <!-- maintenance -->
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h3 class="box-title">MAINTENANCE</h3>
					</div>

					<div class="box-body">
						<div style="padding-bottom: 10px;">
							<button class="btn btn-danger btn-sm btn-maintenance" type="button"><i class="fa fa-wpforms" aria-hidden="true"></i> New Data</button>
							<?php echo anchor(site_url('item_transaction/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div>
							<table class="table table-bordered table-striped" width="100%" id="mytable2">
								<thead>
									<tr>
										<th width="30px">ID</th>
										<th>Latest services date</th>
										<th>Services type</th>
										<th>Services provider contact</th>
										<th>Lab PIC</th>
										<th>Services description</th>
										<th>Frequency</th>
										<th>Services schedule</th>
										<th width="200px">Action</th>
									</tr>
								</thead>
							
							</table>
       					 </div>
                    </div>
            </div>
		</div>

	</section>
</div>

<form id="action">
<div class="modal fade" id="modal-default"  data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">History Details</h4>
			</div>
			<div class="modal-body" style="margin-bottom: 20px;">
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Date</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					<div class="input-group date" id="id_1">
                            <input type="text" valu="" class="form-control date-picker" name="transaction_at" id="transaction_at" autocomplete="off" required/>
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            </span>
                        </div>
						<!-- <input type="text" class="form-control datepicker col-md-6 col-sm-12" name="transaction_at" id="transaction_at" placeholder="date" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" /> -->
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Responsible Person</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('staff_id','staff','name','Responsible Person','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Departmen</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('department_id','department','name','Department','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Location</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('location_id','location','name','Location','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Purpose</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					 <textarea name="purpose" id="purpose" class="form-control" rows="5" placeholder="Purpose"></textarea>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Condition</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('condition_id','item_condition','name','Condition','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Remark</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					 <textarea name="remark" id="remark" class="form-control" rows="5" placeholder="Remark"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" name="id" id="id">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
</form>
      
<form id="action2">
<div class="modal fade" id="modal-maintenance"  data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Maintenance details</h4>
			</div>
			<div class="modal-body" style="margin-bottom: 20px;">
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Last services Date</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					<div class="input-group date" id="id_1">
                            <input type="text" valu="" class="form-control date-picker" name="last_service_date" id="last_service_date" autocomplete="off" required/>
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            </span>
                        </div>
						<!-- <input type="text" class="form-control datepicker col-md-6 col-sm-12" name="transaction_at" id="transaction_at" placeholder="date" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" /> -->
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Service type</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('id_services','ref_services','services','Service type','id_services'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Service provider contact</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					<input type="text" name="provider_contact" id="provider_contact" class="form-control" placeholder="Service provider contact"/>
					 <!-- <textarea name="provider_contact" id="provider_contact" class="form-control" rows="5" placeholder="Purpose"></textarea> -->
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>PIC</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('staff_id','staff','name','PIC','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Service description</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					 <textarea name="service_desc" id="service_desc" class="form-control" rows="5" placeholder="Service description"></textarea>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Frequency</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('id_frequency','ref_frequency','frequency','Frequency','id_frequency'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Schedule prior (weeks)</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					<input type="number" name="service_schedule" id="service_schedule" class="form-control" placeholder="Service schedule"/>
					 <!-- <textarea name="provider_contact" id="provider_contact" class="form-control" rows="5" placeholder="Purpose"></textarea> -->
					</div>
				</div>
				<!-- <div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Condition</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php // echo select2_dinamis('condition_id','item_condition','name','Condition','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Remark</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					 <textarea name="remark" id="remark" class="form-control" rows="5" placeholder="Remark"></textarea>
					</div>
				</div> -->
			</div>
			<div class="modal-footer">
				<input type="hidden" class="form-control" name="id_maintenance" id="id_maintenance">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
</form>

        <script src="<?php echo base_url('assets/adminlte/js/moment.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
        <script type="text/javascript">
			var t
$(function() {
	$('.date-picker').datetimepicker({
		// inline: true,
            //   sideBySide: true
			format :"YYYY-MM-DD"
	})
	// $('.date-only').datetimepicker({
	// 	// inline: true,
    //         //   sideBySide: true
	// 		format :"YYYY-MM-DD HH:mm:ss"
	// })	
	$('#action').submit(function(e) {
		e.preventDefault()
			let formData = new FormData(this)
			formData.append('inventory_number',$('#inventory_number').val())
			$.ajax({
				type: "POST",
				url: "../item_transaction/action",
				data: formData,
				dataType: "json",
				contentType: false,
				processData: false,
				success: function (response) {
					t.ajax.reload()
					$('.modal').modal('hide')
				}
			})
		
	})
	$('#action2').submit(function(e) {
		e.preventDefault()
			let formData = new FormData(this)
			formData.append('inventory_number',$('#inventory_number').val())
			$.ajax({
				type: "POST",
				url: "../item_transaction/action2",
				data: formData,
				dataType: "json",
				contentType: false,
				processData: false,
				success: function (response) {
					t2.ajax.reload()
					$('.modal').modal('hide')
				}
			})
		
	})	
	$("#department_id,#location_id").prop('readonly', true);
	$("#staff_id").change(function(){
		let id = $(this).val()
		if(id != '')
		$.ajax({
			type: "POST",
			url: "../staff/get_detail",
			data: {id},
			dataType: "json",
			success: function (response) {
				$("#department_id").val(response.department_id).trigger('change')
				$("#location_id").val(response.location_id).trigger('change')
			}
		});
	})
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    $(".btn-modal").click(function() {
		$('form').trigger('reset');
		$('.select2').val('').trigger('change')
        $('#modal-default').modal('show')
    });

    $(".btn-maintenance").click(function() {
		$('form').trigger('reset');
		$('.select2').val('').trigger('change')
        $('#modal-maintenance').modal('show')
    });
	
    t = $("#mytable").DataTable({
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
        },
		responsive: true,
		columnDefs: [
					{ responsivePriority: 1, targets: 1 },
					{ 	responsivePriority: 2, 
						targets: 2 , 
						
						},

				],
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
		autoWidth: true,
        ajax: {
            "url": "../item_transaction/json",
            "type": "POST",
            "data": function(d) {
                d.id = $('#inventory_number').val()
            }
        },
        columns: [{
                "data": "transaction_at",
                "orderable": false
            }, 
			{
               render : function(data, type, row){
				// return row.transaction_at
				return moment(row.transaction_at).format('Y-MM-DD HH:mm:ss')
			   }
            },
            {
                "data": "staff_name",
				render : function(data,type,row){
							return '<a style="color: #333333;" href="<?php echo base_url("staff/read?id="); ?>'+row.staff_id+'"><b>'+data+'</b></a>'}
            },
            {
                "data": "department_name",
				"name" : "department.name"
            },
            {
                "data": "location_name",
				"name": "location.name"
            },
            {
                "data": "purpose"
            },
            {
                "data": "condition_name"
            },
            {
                "data": "remark"
            },
            {
                render : function(){
					let html =  "<button class='btn btn-primary btn-sm btn-edit' type='button' style='margin-right:10px'><i class='fa fa-pencil' aria-hidden='true'></i></button>"
					html += "<button class='btn btn-danger btn-sm btn-remove' type='button'><i class='fa fa-trash' aria-hidden='true'></i></button>"
					return html
				}
            }
        ],
        order: [
            [0, 'desc']
        ],
		columnDefs: [
			{ width: '10%', targets: 1 },
      
        ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    t2 = $("#mytable2").DataTable({
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
        },
		responsive: true,
		columnDefs: [
					{ responsivePriority: 1, targets: 1 },
					{ 	responsivePriority: 2, 
						targets: 2 , 
						
						},

				],
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
		autoWidth: true,
        ajax: {
            "url": "../item_transaction/json2",
            "type": "POST",
            "data": function(d) {
                d.id = $('#inventory_number').val()
            }
        },
        columns: [
			{
                "data": "id_maintenance",
                "orderable": true
            }, 
			{
                "data": "last_service_date",
                "orderable": true
            }, 
			// {
            //    render : function(data, type, row){
			// 	// return row.transaction_at
			// 	return moment(row.last_service_date).format('Y-MM-DD')
			//    }
            // },
            {
                "data": "services_type",
				"name" : "ref_services.services"
            },
            {
                "data": "provider_contact"
            },
            {
                "data": "staff_name",
				render : function(data,type,row){
							return '<a style="color: #333333;" href="<?php echo base_url("staff/read?id="); ?>'+row.staff_id+'"><b>'+data+'</b></a>'}
            },
            {
                "data": "service_desc"
            },
            {
                "data": "frequency",
				"name": "ref_frequency.frequency"
            },
            {
                "data": "service_schedule"
            },
            {
                render : function(){
					let html =  "<button class='btn btn-primary btn-sm btn-edit2' type='button' style='margin-right:10px'><i class='fa fa-pencil' aria-hidden='true'></i></button>"
					html += "<button class='btn btn-danger btn-sm btn-remove2' type='button'><i class='fa fa-trash' aria-hidden='true'></i></button>"
					return html
				}
            }
        ],
        order: [
            [0, 'desc']
        ],
		columnDefs: [
			{ width: '10%', targets: 1 },
      
        ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });	

	// $('#mytable').on('click', '.btn-edit', function(){
    //         let tr = $(this).parent().parent();
    //         let data = table.row(tr).data();
    //         console.log(data);
    //         // var data = this.parents('tr').data();
    //         $('#mode').val('edit');
    //         $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Feces KK 1<span id="my-another-cool-loader"></span>');
    //         $('#barcode_sample').attr('readonly', true);
    //         $('#barcode_sample').val(data.barcode_sample);
    //         $('#date_receipt').val(data.date_process);
    //         $('#time_receipt').val(data.time_process);
    //         // $('#time_receipt').clockpicker({'default': data.time_receipt});
    //         // $("#date_receipt").datepicker("setDate",'now');
    //         // $('#time_receipt').timepicker('setTime', new Date());
    //         $('#id_person').val(data.id_person).trigger('change');
    //         $('#bar_kkslide').val(data.bar_kkslide);
    //         $('#comments').val(data.comments);
    //         $('#compose-modal').modal('show');
    //     });  

	// $("#mytable").on('click', '.btn-edit', function () {
	// 	// $(".btn-edit").click(function() {
	// 	$('form').trigger('reset');
	// 	$('.select2').val('').trigger('change')
	// 	let tr = $(this).parent().parent()
	// 	let data = t.row(tr).data()
	// 	data = $.makeArray(data)
		
		// await $('form .form-control').each(function (index, item) {
		// 	if ($(this).is('select') === true)
		// 		$(this).val(data[0][item.name]).trigger('change')
		// 	else
		// 		$(this).val(data[0][item.name])
		// })
    //     $('#modal-default').modal('show')
    // });

	$("#mytable").on('click', '.btn-edit', async function () {
		$('form').trigger('reset');
		$('.select2').val('').trigger('change')
		let tr = $(this).parent().parent()
		let data = t.row(tr).data()
		data = $.makeArray(data)
		
		await $('form .form-control').each(function (index, item) {
			if ($(this).is('select') === true)
				$(this).val(data[0][item.name]).trigger('change')
			else
				$(this).val(data[0][item.name])
		})
		$("#modal-default").modal('show')
	})

	$("#mytable2").on('click', '.btn-edit2', async function () {
		$('form').trigger('reset');
		$('.select2').val('').trigger('change')
		let tr = $(this).parent().parent()
		let data = t2.row(tr).data()
		data = $.makeArray(data)
		
		await $('form .form-control').each(function (index, item) {
			if ($(this).is('select') === true)
				$(this).val(data[0][item.name]).trigger('change')
			else
				$(this).val(data[0][item.name])
		})
		$("#modal-maintenance").modal('show')
	})

	$("#mytable").on('click', '.btn-remove', async function () {
		let tr = $(this).parent().parent()
		let id = t.row(tr).data().id
		$.ajax({
			type: "POST",
			url: "../item_transaction/delete",
			data: {id},
			dataType: "json",
			success: function (response) {
				t.ajax.reload()
			}
		});
	})

	$("#mytable2").on('click', '.btn-remove2', async function () {
		let tr = $(this).parent().parent()
		let id = t2.row(tr).data().id_maintenance
		$.ajax({
			type: "POST",
			url: "../item_transaction/delete2",
			data: {id},
			dataType: "json",
			success: function (response) {
				t2.ajax.reload()
			}
		});
	})	

})
        </script>