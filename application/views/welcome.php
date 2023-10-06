<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary with-border">
                    <div class="box-body no-padding">
                    <div id="container"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box bg-blue">
                    <span class="info-box-icon"><iconify-icon icon="ion:heart-outline"></iconify-icon></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Good</span>
                        <span class="info-box-number"><?php echo $good  = round(( $condition['good']/$condition['total']) * 100 ,0); ?>%</span>
                        <div class="progress">
                            <div class="progress-bar" style="width:  <?php echo $good.'%'; ?>"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo $condition['good'];?> of the total <?php echo $condition['total']; ?> Units
                        </span>
                    </div>

                </div>
           
                <div class="info-box bg-red">
                    <span class="info-box-icon"><iconify-icon icon="ion:accessibility-outline"></iconify-icon></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Decommissioned</span>
                        <span class="info-box-number"><?php  echo $decom  = round(( $condition['decommissioned']/$condition['total']) * 100 ,0); ?>%</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $decom.'%'; ?>""></div>
                        </div>
                        <span class="progress-description">
                        <?php echo $condition['decommissioned']; ?> of the total <?php echo $condition['total']; ?> Units
                        </span>
                    </div>
                </div>

                <div class="info-box bg-purple">
                    <span class="info-box-icon"><iconify-icon icon="ion:construct-outline"></iconify-icon> </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Repair/Service</span>
                        <span class="info-box-number"><?php echo $repair= round(( $condition['repair']/$condition['total']) * 100 ,0);  ?>%</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $repair.'%'; ?>"></div>
                        </div>
                        <span class="progress-description">
                        <?php echo $condition['repair']; ?> of the total <?php echo $condition['total']; ?> Units
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-8">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Activity</h3>
                </div>
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        <?php foreach ($staff as $row) { ?>
                        <li style="width:20%;">
                            <img src="<?php echo base_url('assets/images/'.$row->image) ?>" 
                            style="object-fit: cover;width:75px;height:75px;"
                            alt="User Image">
                            <a class="users-list-name" href="<?php echo base_url('staff/read?id='.$row->id); ?>"><?php echo $row->name ;?> </a>
                            <span class="users-list-date"><?php echo $row->department_name; ?></span>
                        </li>
                        <?php  } ?>
                        
                    </ul>
                </div>

        </div>
    </section>
</div>
<script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                        Highcharts.chart('container', {
                            chart: {
                                type: 'column',
                                height: '300px'
                            },
                            title: {
                                text: 'Inventory Chart',
                                align: 'left'

                            },
                            
                            xAxis: {
                                categories: [
                                    <?php foreach ($inventory as $row) {
                                        echo "'$row->name'" . ',';      
                                    } ?>
                                ],
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Inventory by sub categories'
                                }
                            },
                            legend:{ enabled:false },
                            tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                pointFormat: '<tr><td style="color:{series.color};padding:0">{point.key}: </td>' +
                                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0,
                                    colorByPoint: true,
                                    dataLabels: {
                                        enabled: true,
                                        crop: false,
                                        overflow: 'none'
                                    }
                                },
                                colors: [
                                    '#ff0000',
                                    '#00ff00',
                                    '#0000ff'
                                ]
                            },
                            series: [
                                {
                                    data : [
                                       <?php foreach ($inventory as $row) {
                                           echo "{name: '$row->name',y: $row->val},";
                                       }?>
                                    ]
                                }]
                        });
            })
        </script>