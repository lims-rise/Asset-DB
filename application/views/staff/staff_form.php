<div class="content-wrapper">
	<section class="content">
		<div class="col-md-4 col-sm-12">
			<div class="box box-primary">
			<div class="box-header with-border">
						<h3 class="box-title"><?php echo strtoupper($button) ?> STAFF</h3>
					</div>

				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() ?>assets/adminlte/dist/img/user2-160x160.jpg"
						alt="User profile picture">
					<h3 class="profile-username text-center">Nina Mcintire</h3>
					<p class="text-muted text-center">Software Engineer</p>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Followers</b> <a class="pull-right">1,322</a>
						</li>
						<li class="list-group-item">
							<b>Following</b> <a class="pull-right">543</a>
						</li>
						<li class="list-group-item">
							<b>Friends</b> <a class="pull-right">13,287</a>
						</li>
					</ul>
					<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-sm-12">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<div class="box box-primary ">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo strtoupper($button) ?> STAFF</h3>
					</div>

					<div class="box-body ">

						<div class="avatar-upload">
							<div class="avatar-edit">
								<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
								<label for="imageUpload"></label>
							</div>
							<div class="avatar-preview">
								<div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
								</div>
							</div>
						</div>
						<div class='form-group'>
							<label for='inputEmail3' class='col-sm-2 control-label'>Image
								<?php echo form_error('image') ?></label>
							<div class='col-sm-10' style="margin-bottom: 10px;">
								<input type="file" name="image" id="image">
							</div>
						</div>

						<div class='form-group'>
							<label for='inputEmail3' class='col-sm-2 control-label'>Name
								<?php echo form_error('name') ?></label>
							<div class='col-sm-10' style="margin-bottom: 10px;">
								<input type="text" class="form-control" name="name" id="name" placeholder="Name"
									value="<?php echo $name; ?>" />
							</div>
						</div>

						<div class='form-group'>
							<label for='inputEmail3' class='col-sm-2 control-label'>Departmen
								<?php echo form_error('department_id') ?></label>
							<div class='col-sm-10' style="margin-bottom: 10px;">
								<?php echo select2_dinamis('department_id','department','name','Department Data','id',$department_id); ?>
							</div>
						</div>

						<div class='form-group'>
							<label for='inputEmail3'
								class='col-sm-2 control-label'>Location<?php echo form_error('location_id') ?></label>
							<div class='col-sm-10' style="margin-bottom: 10px;">
								<?php echo select2_dinamis('location_id','location','name','Location Data','id',$location_id); ?>
							</div>
						</div>
					</div>
					<div class='box-footer'>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<a href="<?php echo site_url('staff') ?>" class="btn btn-danger"><i
								class="fa fa-arrow-circle-left"></i> Back</a>
						<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>
							<?php echo $button ?></button>
					</div>

				</div>
			</form>
		</div>
</section>
</div>