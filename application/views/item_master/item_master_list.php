<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
    
                    <div class="box-header with-border">
                        <h3 class="box-title">INVENTORY LIST</h3>
                        <!-- filter -->
                        <table class="table table-bordered" style="width:100%">
                            <tr>
                                <td>
                                <!-- <div class="box-body "> -->
                                    <!-- <div class='form-group'>
                                        <label for="fund" class="col-sm-2 control-label">Category </label>
                                        <div class='col-sm-6' style="margin-bottom:10px;">
                                            <?php //echo select2_dinamis('category_id', 'item_category', 'name','Category Data','id') ?>
                                        </div>
                                    </div>                         -->
                                <!-- </div> -->
                                </td>
                            </tr>
                        </table>                        
                        <!-- //filter -->

                        <div class="pull-left">
                        <?php echo anchor(site_url('item_master/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Data', 'class="btn btn-primary btn-sm"'); ?>
		                <?php echo anchor(site_url('item_master/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                        </div>
                    </div>
        
        <div class="box-body">
        <table class="table table-bordered table-striped tbody" width="100%" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
                    <th>Inventory Number</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type/Model</th>
                    <th>Fund</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Location</th>
                    <th>Department</th>
                    <th>Person</th>
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
     </section>
<style>
.table tbody tr.selected {
    color: white !important;
    background-color: #0088CC !important;
}
</style>

</div>


        <script src="<?php //echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <!-- <script src="//cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.js"></script> -->
        <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script> -->
        <!-- <script src="<?php //echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script> -->
        <script src="<?php //echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {

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

                // $(function() {
                //     $("#category_id").change(function() {
                //         // var id = $('#id_user').val();
                //         var cat_id = $('#category_id').val();
                //         document.location.href="item_master/json2?cat_id="+cat_id;
                        
                //     });
                // });


                var t = $("#mytable").DataTable({
                    "pageLength": 100,
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
                        { responsivePriority: 1, targets: 0 },
                        { responsivePriority: 2, targets: 1 },
                        { responsivePriority: 3, targets: 2 },
                        { responsivePriority: 4, targets: 10 },
                        { responsivePriority: 5, targets: 14 },
                        { targets: 3,
                                render: function ( data, type, row ) {
                                    if(data.length > 34 )
                                        return data.substr( 0, 34 ) + ' ..';
                                    else
                                        return data
                                }
                            } 
                            ],
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "item_master/json", "type": "POST"},
                    columns: [
                        {
                            "data": "inventory_number",
                            "orderable": false
                        },
                        {"data": "inventory_number"},

                        {"data": "name"},
                        {"data": "description"},
                        {"data": "type"},
                        {"data": "fund_name"},
                        {"data": "category_name"},
                        {"data": "sub_category_name"},
                        {"data": "location_name"},
                        {"data": "department_name"},
                        {"data": "staff_name"},
                        {"data": "purpose"},
                        {"data": "condition_name"},
                        {"data": "remark"},
                        
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[1, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });


        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                t.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })   
		                
            });
        </script>