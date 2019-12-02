<?php
$contact    = $this->menu_m->select_contact()->row();
$meta       = $this->menu_m->select_meta()->row();
$listSocial = $this->menu_m->select_social()->result();
?>
<footer id="colophon" class="site-footer footer-v1" >
    <div class="col-full">
        <div class="footer-social-icons">
            <span class="social-icon-text">Follow us</span>
            <ul class="social-icons list-unstyled">
                <?php
                foreach($listSocial as $r) {
                ?>
                <li><a class="fa fa-<?=$r->social_class;?>" href="<?=$r->social_url;?>" target="_blank"></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="footer-logo">
            <a href="<?=base_url();?>" class="custom-logo-link" rel="home">
                <img src="<?=base_url('img/logo-front.png');?>">
            </a>
        </div>
        <div class="site-address">
            <ul class="address">
                <li><?=$contact->contact_name;?></li>
                <li><?=trim($contact->contact_address);?></li>
                <li>Telp. <?=$contact->contact_phone;?></li>
                <li><?=$contact->contact_email;?></li>
            </ul>
        </div>

        <div class="site-info">
            <p class="copyright">Copyright &copy; 2019 <?=$meta->meta_name;?></p>
        </div>

        <div class="pizzaro-handheld-footer-bar">
            <ul class="columns-3">
                <li class="my-account">
                    <a href="login-and-register.html">My Account</a>
                </li>
                <li class="search">
                    <a href="">Search</a>
                    <div class="site-search">
                        <div class="widget woocommerce widget_product_search">
                            <form role="search" method="get" class="woocommerce-product-search" >
                                <label class="screen-reader-text" for="woocommerce-product-search-field">Search for:</label>
                                <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Search Products&hellip;" value="" name="s" title="Search for:" />
                                <input type="submit" value="Search" />
                                <input type="hidden" name="post_type" value="product" />
                            </form>
                        </div>
                    </div>
                </li>
                <li class="cart">
                    <a class="footer-cart-contents" href="<?=site_url('index.php/cart');?>" title="Tampilkan Cart Order Anda">
                        <?=$cart_count_footer;?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
