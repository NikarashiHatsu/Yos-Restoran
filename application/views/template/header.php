<?php 
$username   = $this->session->userdata('username');
$dataUser   = $this->menu_m->select_user($username)->row();
?>
<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
    <div class="page-header-inner">
        <div class="page-logo">
            <a href="<?=site_url('admin/home'); ?>">
                <img src="<?=base_url('img/logo-header.png');?>" alt="logo" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <?php if ($dataUser->user_avatar != '') { ?>
                        <img src="<?=base_url(); ?>img/icon/<?=$dataUser->user_avatar; ?>" class="img-circle"/>
                        <?php } else { ?>
                        <img src="<?=base_url(); ?>img/no-image.jpg" class="img-circle"/>
                        <?php } ?>
                        <span class="username username-hide-on-mobile"><?=ucwords(strtolower($dataUser->user_name)); ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?=site_url('profil'); ?>">
                            <i class="icon-user"></i> Profil </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?=site_url('login/logout'); ?>">
                                <i class="icon-key"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>