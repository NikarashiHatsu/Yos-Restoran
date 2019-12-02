<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">Dashboard</h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('operator/home');?>">Dashboard</a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height blue-madison">
                    <i class="icon-calendar">&nbsp; </i><span class="uppercase visible-lg-inline-block"><?=tgl_indo(date('Y-m-d'));?></span>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-building"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            $Jml_Pasar = count($TotalPasar);
                            echo number_format($Jml_Pasar);
                        ?>
                        </div>
                        <div class="desc">
                        Pasar
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('operator/pasar'); ?>">
                        Detail <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="icon-users"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            $Jml_Data = count($TotalPedagang);
                            echo number_format($Jml_Data);
                        ?>
                        </div>
                        <div class="desc">
                        Pedagang
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('operator/pendasaran'); ?>">
                        Detail <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-haze">
                    <div class="visual">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            echo number_format($piutang->total,0,'',',');
                        ?>
                        </div>
                        <div class="desc">
                        Piutang <?=date('Y'); ?>
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('operator/retribusi'); ?>">
                        Detail <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-line-chart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                        <?php 
                            echo number_format($bayar->total, 0,'',',');
                        ?>
                        </div>
                        <div class="desc">
                        Pembayaran <?=date('Y'); ?>
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('operator/retribusi'); ?>">
                        Detail <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div> -->

        <div class="clearfix"></div>
    </div>
</div>