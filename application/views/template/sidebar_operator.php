<?php
$uri = $this->uri->segment(2);

if ($uri == 'home') {
    $dashboard     = 'active';
    $monitoring    = '';
    $order         = '';
} elseif ($uri == 'monitoring') {
    $dashboard     = '';
    $monitoring    = 'active';
    $order         = '';
} elseif ($uri == 'order') {
    $dashboard     = '';
    $monitoring    = '';
    $order         = 'active';
} else {
    $dashboard     = '';
    $monitoring    = '';
    $order         = '';
}
?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <br>
            <li class="tooltips <?=$dashboard;?>" data-container="body" data-placement="right" data-html="true" data-original-title="Dashboard">
                <a href="<?=site_url('operator/home');?>">
                    <i class="fa fa-home"></i><span class="title"> Dashboard</span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">MENU TRANSAKSI</h3>
            </li>
            <li class="tooltips <?=$monitoring;?>" data-container="body" data-placement="right" data-html="true" data-original-title="Monitoring">
                <a href="<?=site_url('operator/monitoring');?>">
                    <i class="fa fa-laptop"></i><span class="title"> Monitoring</span>
                </a>
            </li>
            <?php if ($this->session->userdata('level') == 'Kasir') { ?>
            <li class="tooltips <?=$order;?>" data-container="body" data-placement="right" data-html="true" data-original-title="Order Menu">
                <a href="<?=site_url('operator/order');?>">
                    <i class="icon-notebook"></i><span class="title"> Order</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>