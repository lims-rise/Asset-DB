<style>
    ::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}

::-webkit-scrollbar-thumb {
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0);
}
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="box box-widget widget-user-2" style="overflow: overlay;">
                <div class="widget-user-header bg-black" style="background: url('<?php echo base_url('assets/adminlte/dist/img/photo1.png'); ?>') center center;">
                    <div class="widget-user-image">
                        <img class="img-circle"
                            src="<?php echo base_url('assets/images/'. ($image ?? 'default.jpg')) ?>"
                            style="object-fit: cover;width:75px;height:75px;border: 3px solid #fff;margin-right:15px;" alt="User Avatar">
                    </div>
                    <h3 class="widget-user-username"><?php echo $name ?? 'Staff Name' ; ?></h3>
                    <h5 class="widget-user-desc"><?php echo $department_name ?? 'Departmen Name' ; ?></h5>
                </div>
                <div class="box-footer no-padding" style="height: 148px;overflow-y: scroll;">
                    <ul class="nav nav-stacked">
                        <?php $total = 0; foreach ($condition as $row) {
                            echo '<li><a href="javascript:void(0)" class="subcategory-search" data-name="'.$row->name.'">'.$row->name.'<span class="pull-right badge bg-blue">'.$row->val.'</span></a></li>';
                            $total = $total + $row->val;
                        }; ?>
                            <li><a href="javascript:void(0)" class="subcategory-search" data-name="">Total items <span class="pull-right badge bg-navy"><?php echo $total; ?></span></a></li>
                            <li><a href="<?php echo $this->agent->referrer()?>"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i> Back</button></a></li>

                    </ul>
                </div>
            
            </div>
		</div>
        <div class="col-md-8 col-sm-12">
            <div id="container"></div>
        </div>
            <div class="col-md-12 col-xs-12">
                <div class="box box-primary">
    
                    <div class="box-header with-border">
                        <h3 class="box-title">INVENTORY LIST <b id="searchTitle"></b></h3>
                        <div class="pull-right">
                            <button class="btn btn-sm bg-navy transfer-all"><i class="fa fa-refresh"></i> Transfer All</button>
                        </div>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        </div>
        <table class="table table-bordered table-striped" width="100%" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
                    <th>Inventory Number</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Serial</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Remark</th>
                    <th>Condition</th>
		    		<th width="20px">Action</th>
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
				<h4 class="modal-title">Transfer Item</h4>
			</div>
			<div class="modal-body" style="margin-bottom: 20px;">
                 <div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Inventory Number</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<input type="text" id="inventory_number_show" class="form-control" readonly>
					</div>
				</div>
                <div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Description</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
                    <textarea rows="6" id="description" class="form-control" readonly></textarea>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Date</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					<div class="input-group date" id="id_1">
                            <input type="text" valu="" class="form-control date-picker" name="transaction_at" id="transaction_at" autocomplete="off" required/>
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            </span>
                        </div>
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
				<input type="hidden" class="form-control" name="inventory_number" id="inventory_number">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
</form>
<form id="transfer">
<div class="modal fade" id="modal-transfer"  data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Transfer Item</h4>
			</div>
			<div class="modal-body" style="margin-bottom: 20px;">
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Responsible Person</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('staff_id_transfer','staff','name','Responsible Person','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Departmen</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('department_id_transfer','department','name','Department','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Location</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
						<?php echo select2_dinamis('location_id_transfer','location','name','Location','id'); ?>
					</div>
				</div>
				<div class='form-group'>
					<label for='inputEmail3' class='col-sm-4 control-label'>Purpose</label>
					<div class='col-sm-8' style="margin-bottom:10px;">
					 <textarea name="purpose" id="purpose" class="form-control" rows="5" placeholder="Purpose"></textarea>
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
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn bg-navy">Transfer All</button>
			</div>
		</div>
	</div>
</div>
</form>
        <input type="hidden" id="id" value="<?php echo $id; ?>">
        <input type="hidden" id="icname">
        <script src="<?php echo base_url('assets/adminlte/js/moment.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script type="text/javascript">
            let t
            $(document).ready(function() {
                $('select').attr('required',true)
                $('.date-picker').datetimepicker({
                    // inline: true,
                        //   sideBySide: true
                        format :"YYYY-MM-DD HH:mm:ss"
                })
                $('.transfer-all').click(function(){
                    $('form').trigger('reset');
                    $('.select2').val('').trigger('change')
                    $('#modal-transfer').modal('show')
                })
                $('#transfer').submit(function(e){
                    e.preventDefault()
                        let formData = new FormData(this)
                        formData.append('id',$('#id').val())

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('staff/transfer_all'); ?>",
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
                $('#action').submit(function(e) {
                        e.preventDefault()
                        let formData = new FormData(this)
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('staff/item_mutation'); ?>",
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
                $("#department_id,#location_id").prop('readonly', true);
                $("#staff_id").change(function(){
                    let id = $(this).val()
                    if(id != '')
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('staff/get_detail'); ?>",
                        data: {id},
                        dataType: "json",
                        success: function (response) {
                            $("#department_id").val(response.department_id).trigger('change')
                            $("#location_id").val(response.location_id).trigger('change')
                        }
                    });
                })
                $("#staff_id_transfer").change(function(){
                    let id = $(this).val()
                    if(id != '')
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('staff/get_detail'); ?>",
                        data: {id},
                        dataType: "json",
                        success: function (response) {
                            $("#department_id_transfer").val(response.department_id).trigger('change')
                            $("#location_id_transfer").val(response.location_id).trigger('change')
                        }
                    });
                })
                
                $('.subcategory-search').click(function(){
                    let data = $(this).data('name');
                    let text = ''
                    if(data != '')
                        text = ' - '
                    $('#icname').val(data)
                    $('#searchTitle').html(text + data)
                    t.ajax.reload()
                })
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
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
                                { responsivePriority: 2, targets: 2 },
                                { targets: 3,
                                render: function ( data, type, row ) {
                                    if(data.length > 34 )
                                        return data.substr( 0, 34 ) + ' ..';
                                    else
                                        return data
                                }
                            } ,
                            {targets : 1,  render : function(data,type,row){
                               return '<a style="color: #333333;" href="<?php echo base_url("item_master/read?id="); ?>'+data+'"><b>'+data+'</b></a>'
                              
                           }},
                            {targets : 10,  render : function(data,type,row){
                                data =  '<button type="button" class="bt bg-navy"><span class="fa fa-refresh"></span></button>'
                                return data
                           }
                        },
                            ],
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "data",
                            "data" : function(d){
                                d.cari = { "it2-staff_id" : $('#id').val(), "ic-name": $('#icname').val()}
                            },
							 "type": "POST"},
                    columns: [
                        {
                            "data": "inventory_number",
                            "orderable": false
                        },
                        {"data": "inventory_number"},
                        {"data": "transaction_at"},
						{"data": "description"},
						{"data": "serial_number"},
						{"data": "type"},
						{"data": "category_name"},
						{"data": "sub_category_name"},
						{"data": "remark"},
						{"data": "condition_name"},
                          
                        {
                          "data" : "action"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });

                $('#mytable').on('click','.bg-navy',function(){
                    let tr = $(this).parent().parent()
                    let data = t.row(tr).data()
                    $('form').trigger('reset');
                    $('.select2').val('').trigger('change')
                    $('#modal-default').modal('show')
                    $('#inventory_number,#inventory_number_show').val(data.inventory_number)
                    $('#condition_id').val(data.condition_id).trigger('change')
                    $('#remark').val(data.remark).trigger('change')
                    $('#purpose').val(data.purpose).trigger('change')
                    $('#description').html(data.description)
                })

                Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    height: "250px"
                },
                
                title: {
                    text: 'Chart',
                    align: 'left'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                    valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    },
                    showInLegend: true,
                    point: {
                            events: {
                                legendItemClick: function (e) {
                                    console.log(e.target.name)
                                }
                            }
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    itemMarginTop: 10,
                    itemMarginBottom: 10,
                    itemMarginRight: 100,

                    },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: [<?php foreach ($item as $row) {
                        echo ' {
                            name: "'.$row->name.'",
                            y: '.$row->val.'
                          },';
                    } ?>]
                }]
                });
                
            });
</script>