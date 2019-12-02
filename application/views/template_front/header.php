<?php
$contact      = $this->menu_m->select_contact()->row();
$listKategori = $this->menu_m->select_kategori()->result();
?>
<header id="masthead" class="site-header header-v1"  style="background-image: none; ">
    <div class="col-full">
        <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
        <a class="skip-link screen-reader-text" href="#content">Skip to content</a>
        <div class="header-wrap">
            <div class="site-branding">
                <a href="<?=base_url();?>" class="custom-logo-link" rel="home">
                    <img src="<?=base_url('img/logo-front.png');?>">
                </a>
            </div>
            <nav id="site-navigation" class="main-navigation"  aria-label="Primary Navigation">
                <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false"><span class="close-icon"><i class="po po-close-delete"></i></span><span class="menu-icon"><i class="po po-menu-icon"></i></span><span class=" screen-reader-text">Menu</span></button>
                <div class="handheld-navigation">
                    <span class="phm-close">Tutup</span>
                    <ul  class="menu">
                        <?php
                        foreach($listKategori as $r) {
                        ?>
                        <li class="menu-item "><a href="<?=base_url('index.php/kategori/'.$r->kategori_seo);?>"><i class="<?=$r->kategori_icon;?>"></i><?=ucwords(strtolower($r->kategori_nama));?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
            <div class="header-info-wrapper">
                <div class="header-phone-numbers">
                    <span class="intro-text">Telp. dan Order ke</span>
                    <span id="city-phone-number-label" class="phone-number"><?=$contact->contact_phone;?></span>
                </div>
                <ul class="site-header-cart-v2 menu">
                    <li class="cart-content ">
                        <a href="<?=site_url('index.php/cart');?>" title="Tampilkan Cart Order Anda">
                            <i class="fa fa-cart-plus"></i>
                            <span>Cart Order Anda</span>
                        </a>
                        <ul class="sub-menu cart_dropdown_container">
                            <?=$cart_dropdown_container;?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pizzaro-secondary-navigation">
            <nav class="secondary-navigation"  aria-label="Secondary Navigation">
                <ul  class="menu">
                    <?php
                    foreach($listKategori as $r) {
                    ?>
                    <li class="menu-item "><a href="<?=site_url('index.php/kategori/'.$r->kategori_seo);?>"><i class="<?=$r->kategori_icon;?>"></i><?=ucwords(strtolower($r->kategori_nama));?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</header>
