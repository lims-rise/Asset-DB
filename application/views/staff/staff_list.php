<div class="content-wrapper">
    <section class="content">
        <div class="row">
        <div class="col-md-4 col-sm-12">
			<div class="box box-primary">
			<div class="box-header with-border">
						<h3 class="box-title"><?php echo strtoupper($button ?? 'NEW') ?> STAFF</h3>
					</div>

				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" id="OpenImgUpload" src="<?php echo base_url('assets/images/'. ($image ?? 'default.jpg')) ?> "
						alt="User profile picture" style="object-fit: cover;width:120px;height:120px;">
                        <input type="file" id="image" name="image" style="display:none"/> 
					<h3 class="profile-username text-center staff-name"><?php echo $name ?? 'Staff Name' ; ?></h3>
					<p class="text-muted text-center staff-department"><?php echo $department_name ?? 'Departmen Name' ; ?></p>
                    <form action="<?php print($link ?? base_url('staff/create_action')); ?>" method="post">
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item" style="margin-bottom: 10px;">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name ?? ''; ?>"  autocomplete="off" required />
						</li>
						<li class="list-group-item" style="margin-bottom: 10px;">
                            <?php echo select2_dinamis('department_id','department','name','Department Data','id',$department_id ?? ''); ?>
						</li>
						<li class="list-group-item"  style="margin-bottom: 10px;">
                            <?php echo select2_dinamis('location_id','location','name','Location Data','id',$location_id ?? ''); ?>
						</li>
					</ul>
                    <input type="hidden" name="file"  id="file">
                    <input type="hidden" name="id" value="<?php echo $id ?? '' ; ?>">
                    <?php
                            $lvl = $this->session->userdata('id_user_level');
                            if ($lvl == 3){                         
                                echo "";
                            }
                            else { ?>
                                <button type="submit" class="btn <?php echo $button_color ?? 'btn-primary'; ?> btn-block"><b><?php echo strtoupper($button ?? 'NEW') ?> </b></button>
                            <?php
                            }
                        ?>

                    </form>
				</div>
			</div>
		</div>
            <div class="col-md-8 col-xs-12">
                <div class="box box-primary">
    
                    <div class="box-header with-border">
                        <h3 class="box-title">STAFF LIST</h3>
                        <div class="pull-right">
                        <?php 
                            $lvl = $this->session->userdata('id_user_level');
                            if ($lvl == 3){                         
                                echo "";
                            }
                            else { 
                                echo anchor(site_url('staff'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Data', 'class="btn btn-primary btn-sm"'); 
                            }                        
                        ?>
                        </div>
                    </div>
        
        <div class="box-body">
 
        <table class="table table-bordered table-striped" width="100%" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
                    <th>Name</th>
                    <th>Departmen</th>
                    <th>Location</th>
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
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#OpenImgUpload').click(function(){ $('#image').trigger('click'); });
                $('#image').change(function(){
                    var fd = new FormData();
                    var files = $('#image')[0].files[0];
                    fd.append('image', files);

            
                    $.ajax({
                        url: 'staff/upload',
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType : 'json',
                        success: function(response){
                            console.log(response)
                            console.log(response.data)
                            if(response.error == false){
                                $('#OpenImgUpload').attr('src', '<?php echo base_url(''); ?>/assets/images/'+response.data)
                                $('#file').val(response.data)
                            }
                            else
                                alert(response.error)
                        },
                    });
                })
                $('#name').keyup(function(){
                    let name = $(this).val()
                    if(name != '')
                        $('.staff-name').html($(this).val())
                    else
                        $('.staff-name').html('Staff Name')

                })
                $('#department_id').change(function(){
                    let text = $(this).select2('data')
        
                    let id = $(this).val()
                    if(id != '')
                        $('.staff-department').html(text[0]['text'])
                    else
                        $('.staff-department').html('Department Name')
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

                var t = $("#mytable").DataTable({
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
                                { responsivePriority: 2, targets: 2 }
                            ],
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "staff/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id",
                            "orderable": false
                        },
                        {"data": "name"},{"data": "department_name"},{"data": "location_name"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
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
            });
        </script>