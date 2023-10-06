<div class="content-wrapper">
    <section class="content">
        <!-- staff -->
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary  with-border">
                    <div class="box-body">
                    <?php foreach($staff as $row) { ?>
                        <div class="col-md-4">
                            <div class="box box-widget widget-user">
                                <div class="widget-user-header bg-black"
                                    style="background: url('<?php echo base_url('assets/adminlte/dist/img/photo1.png'); ?>') center center;">
                                    <h3 class="widget-user-username"><?php echo $row->name; ?></h3>
                                    <h5 class="widget-user-desc"><?php echo $row->department_name; ?></h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle"
                                        src="<?php echo base_url('assets/images/'. ($row->image ?? 'default.jpg')) ?>"
                                        style="margin-top:20px;object-fit: cover;width:75px;height:75px;border: 3px solid #fff;margin-right:15px;"
                                        alt="User Avatar">
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-12 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header" style="margin-bottom: 10px;">
                                                    <?php if(isset($row->item)) echo $row->item . ' Items'; else echo '0 Items'; ?></h5>
                                                <span class="description-text"><a
                                                        href="<?php echo base_url('staff/read?id='.$row->id);?>"
                                                        class="btn bg-navy btn-sm btn-block">View Details</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <div class="box-footer">
                    <div class="text-center">
                    <a href="<?php echo base_url('staff'); ?>" class="btn"><i
                                    class="fa fa-users" style="margin-right: 10px;"></i> View All Staff</a>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List Inventory</h3>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php foreach($inventory as $row) { ?> 
                  
                        <li class="item">
                            <div class="product-img">
                                <img src="<?php echo base_url("assets/item-images/".$row->image); ?>" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="<?php echo base_url('item_master/read?id='.$row->inventory_number); ?>" class="product-title"><?php echo $row->name; ?>
                                    <span class="label label-primary pull-right"><?php echo $row->inventory_number;?></span></a>
                                <span class="product-description">
                                    <?php echo $row->description; ?>
                                </span>
                            </div>
                        </li>
                      
                        <?php } ?>
                    </ul>
                </div>

                <div class="box-footer text-center">
                    <a href="<?php echo base_url('item_master'); ?>" class="uppercase">View All Items</a>
                </div>
            </div>
            </div>
      
</div>
</section>
</div>