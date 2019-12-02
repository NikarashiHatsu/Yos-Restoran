<div id="content" class="site-content" tabindex="-1" >
    <div class="col-full">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" >
                <div class="home-v1-slider" >
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                        <?php 
                        $no = 1;
                        foreach($listSlider as $r) {
                        ?>
                        <div class="item slider-<?=$no;?>" style="background-image: url(<?=base_url('img/slider_folder/'.$r->slider_image);?>);"></div>
                        <?php $no++; } ?>
                    </div>
                </div>

                <div class="section-products">
                    <h2 class="section-title">Menu Kami</h2>
                    <div class="columns-4">
                        <ul class="products">
                            <?php 
                            $no = 1;
                            foreach($listMenu as $r) {
                                if ($no%4 == 1) {
                                    $class = 'first';
                                } elseif ($no%4 == 0) {
                                    $class = 'last';
                                } else {
                                    $class = '';
                                }
                            ?>
                            <li class="product <?=$class;?>">
                                <div class="product-outer">
                                    <div class="product-inner">
                                        <div class="product-image-wrapper">
                                            <a href="<?=site_url('menuorder/'.$r->menu_seo);?>" class="woocommerce-LoopProduct-link">
                                                <img src="<?=base_url('img/menu_folder/thumbs/'.$r->menu_foto);?>" class="img-responsive" alt="">
                                            </a>
                                        </div>
                                        <div class="product-content-wrapper">
                                            <a href="<?=site_url('menuorder/'.$r->menu_seo);?>" class="woocommerce-LoopProduct-link">
                                                <h3><?=ucwords(strtolower($r->menu_nama));?></h3>
                                                <div  class="yith_wapo_groups_container">
                                                    <div  class="ywapo_group_container ywapo_group_container_radio form-row form-row-wide " data-requested="1" data-type="radio" data-id="1" data-condition="">
                                                        <h3><span>Harga</span></h3>
                                                        <div class="ywapo_input_container ywapo_input_container_radio">
                                                            <span class="ywapo_label_price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp. </span><?=number_format($r->menu_harga, 0,'',',');?></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="hover-area">
                                                <a data-id="<?=$r->menu_id;?>" data-qty="1" title="Tambah ke Keranjang" type="button" class="addToCart button product_type_simple add_to_cart_button">Order</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                                if ($no%4 == 0) {
                                    echo '</ul></div><div class="columns-4"><ul class="products">';
                                }
                                $no++;
                            } 
                            ?>
                        </ul>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>