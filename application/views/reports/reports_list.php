<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
    
                    <div class="box-header with-borader">
                        <h3 class="box-title">INVENTORY REPORTS</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <?php //echo anchor(site_url('department/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php //echo anchor(site_url('department/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div>
        <!-- <table class="table table-bordered table-striped" id="mytable" width="100%">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Name</th>
		  
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    
        </table> -->
        <table class="table table-bordered" style="width:100%">
            <tr>
                <td width="250">Select filter of the Inventory reports :</td>
            </tr>
            <tr>
                <td>
                <!-- <div class="box box-primary"> -->
                    <!-- <div class="collapse" id="collapse-frez"> -->
                    <!-- <div class="box box-solid">  -->
                    <div class="box-body ">
                    <!-- <form name="form" action="" method="get"> -->

                    <div class='form-group'>
                        <label for="category_id" class="col-sm-2 control-label">Category </label>
                        <div class='col-sm-10' style="margin-bottom:10px;">
                            <?php echo select2_dinamis_pc('category_id', 'item_category', 'name','Category Data','id') ?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for="sub_category_id" class="col-sm-2 control-label">Sub Category </label>
                        <div class='col-sm-10' style="margin-bottom:10px;">
                            <?php echo select2_dinamis_pc('sub_category_id', 'item_sub_category', 'name','Sub Category Data','id') ?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for="fund" class="col-sm-2 control-label">Fund </label>
                        <div class='col-sm-10' style="margin-bottom:10px;">
                            <?php echo select2_dinamis_pc('fund_id', 'item_fund', 'name','Fund','id') ?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for="location_det_id" class="col-sm-2 control-label">Location Detail</label>
                        <div class='col-sm-10' style="margin-bottom:10px;">
                            <?php echo select2_dinamis_pc('location_det_id', 'location_detail', 'name','Location Detail','id', null, ['id_location' => $this->session->userdata('location_id')]) ?>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for='condition' class='col-sm-2 control-label'>Condition</label>
                        <div class='col-sm-10' style="margin-bottom:10px;">
                            <?php echo select2_dinamis_pc('condition_id','item_condition','name','Condition','id'); ?>
                        </div>
                    </div>
                    
                    <div class='form-group'>
                        <div class="col-md-12">
                            <div class="row">
                                <label for="date_rep" class="col-sm-2 control-label">Purchase date range </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control datepicker col-md-6 col-sm-12" id="date_rep1" name="date_rep1" placeholder="Date start">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control datepicker col-md-6 col-sm-12" id="date_rep2" name="date_rep2" placeholder="Date end">
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- <button id="refresh-rep" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</button> -->

                        <!-- </form> -->
                    </div>
                    <div class='box-footer'>
                        <button id="refresh-rep" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                    </div>                                            
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
                </td>
            </tr>
            <tr>
                <td>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header"></div>
                            <div class="box-body table-responsive">
                            <div style="padding-bottom: 10px;">
                                <button class='btn btn-success btn-sm' id='export'> <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export To Excel </button>
                                <?php //echo anchor(site_url('delivery_report/index2'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                                <?php //echo anchor(site_url('delivery_report/excel/'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                                <?php //echo anchor(site_url('kelolamenu/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>

                            <table id="myreptable" class="table display table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>#</th> -->
                                            <th>Inventory Number</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Name</th>
                                            <th>Purchase Date</th>
                                            <th>Fund</th>
                                            <th>Location</th> 
                                        </tr>
                                    </thead>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col-xs-12 -->
                </div><!-- /.row -->                                
                </td>
            </tr>
        </table>
    </div>
                    </div>
            </div>
            </div>
    </section>
</div>

<style>
    .select2-container {
        position: relative;
        display: inline-block;
        width: 90%; /* Set the desired width in pixels or any other valid CSS unit */
    }

    .btn-clear {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
    }
</style>


        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">

    function clearSelect2(select2Id) {
        $('#' + select2Id).val(null).trigger('change');
    }

            $(document).ready(function() {

                $('#category_id').on('select2:select',function(e){
                    console.log( e.params.data.id)
                    let id = e.params.data.id
                    $.ajax({
                        type: "POST",
                        url: "item_sub_category/list/",
                        data: {id},
                        dataType: "json",
                        success: function (response) {
                            $('#sub_category_id').html(response.data)
                        }
                    });
                })

                $('.datepicker').datepicker({
                    autoclose: true,
                    dateFormat:'yy-mm-dd'
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
                
                // var t = $("#mytable").dataTable({
                //     initComplete: function() {
                //         var api = this.api();
                //         $('#mytable_filter input')
                //                 .off('.DT')
                //                 .on('keyup.DT', function(e) {
                //                     if (e.keyCode == 13) {
                //                         api.search(this.value).draw();
                //             }
                //         });
                //     },
                //     oLanguage: {
                //         sProcessing: "loading..."
                //     },
                //     processing: true,
                //     serverSide: true,
                //     ajax: {"url": "reports/json", "type": "POST"},
                //     columns: [
                        // {"data": "inventory_number"},
                        // {"data": "category"},
                        // {"data": "sub_category"},
                        // {"data": "name"},
                        // {"data": "purchase_date"},
                        // {"data": "fund"},
                        // {"data": "location_all"}
                //     ],
                //     order: [[0, 'desc']],
                //     rowCallback: function(row, data, iDisplayIndex) {
                //         var info = this.fnPagingInfo();
                //         var page = info.iPage;
                //         var length = info.iLength;
                //         var index = page * length + (iDisplayIndex + 1);
                //         $('td:eq(0)', row).html(index);
                //     }
                // });



        $('#date_rep1').on('change', function (){
            if ($('#date_rep1').val() > $('#date_rep2').val()) {
                $('#date_rep2').val($('#date_rep1').val());
            }
        });

        $('#date_rep2').on('change', function (){
            if ($('#date_rep2').val() < $('#date_rep1').val()) {
                $('#date_rep1').val($('#date_rep2').val());
            }
        });

        $("#export").on('click', function() {
            var date1 = $('#date_rep1').val();
            var date2 = $('#date_rep2').val();
            var cat_id = $('#category_id').val();
            var subcat_id = $('#sub_category_id').val();
            var fund_id = $('#fund_id').val();
            var loc_id = $('#location_det_id').val();
            var con_id = $('#condition_id').val();
            document.location.href="reports/excel?date1="+date1+"&date2="+date2+"&cat="+cat_id+"&fund="+fund_id+"&loc="+loc_id+"&con="+con_id+"&subcat="+subcat_id;
        });

    $('#refresh-rep ').click(function() {
        var date1 = $('#date_rep1').val();
        var date2 = $('#date_rep2').val();
        var cat_id = $('#category_id').val();
        var subcat_id = $('#sub_category_id').val();
        var fund_id = $('#fund_id').val();
        var loc_id = $('#location_det_id').val();
        var con_id = $('#condition_id').val();
        var t = $("#myreptable").dataTable({
            // initComplete: function() {
            //     var api = this.api();
            //     $('#mytable_filter input')
            //     .off('.DT')
            //     .on('keyup.DT', function(e) {
            //         if (e.keyCode == 13) {
            //             api.search(this.value).draw();
            //         }
            //     });
            // },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            bDestroy: true,
            // paging: false,
            ordering: false,
            info: false,
            bFilter: false,
            ajax: {"url": "reports/json?date1="+date1+"&date2="+date2+"&cat="+cat_id+"&fund="+fund_id+"&loc="+loc_id+"&con="+con_id+"&subcat="+subcat_id, "type": "POST"},
            columns: [
                // {"data": "inventory_number"},
                {"data": "inventory_number"},
                {"data": "category"},
                {"data": "sub_category"},
                {"data": "name"},
                {"data": "purchase_date"},
                {"data": "fund"},
                {"data": "location_all"}
            ],
            order: [[1, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });
        // $('#compose-modal').modal('show');
    });

            });
        </script>