<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">Dashboard</h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height blue-madison">
                    <i class="icon-calendar">&nbsp; </i><span class="uppercase visible-lg-inline-block"><?=tgl_indo(date('Y-m-d'));?></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-cutlery"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?=number_format(count($TotalMenu), 0,'',','); ?>
                        </div>
                        <div class="desc">
                        Menu
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('admin/menu_makanan'); ?>">
                        Detail <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-haze">
                    <div class="visual">
                        <i class="icon-badge"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?=number_format($TotalMonth->total, 0,'',','); ?>
                        </div>
                        <div class="desc">
                        Income <?=getBulan(date('m')).' '.date('Y');?>
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('admin/penjualan'); ?>">
                        Detail <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?=number_format($TotalIncome->total, 0,'',','); ?>
                        </div>
                        <div class="desc">
                        Total
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('admin/penjualan'); ?>">
                        Detail <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>