<div id="content" class="site-content" tabindex="-1" >
    <div class="col-full">
        <div class="pizzaro-breadcrumb">
            <nav class="woocommerce-breadcrumb" itemprop="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a><span class="delimiter"><i class="po po-arrow-right-slider"></i></span>
                <a href="<?=site_url('kategori/'.$detail->kategori_seo);?>"><?=ucwords(strtolower($detail->kategori_nama));?></a>
                <span class="delimiter"><i class="po po-arrow-right-slider"></i></span><?=ucwords(strtolower($detail->menu_nama));?>
            </nav>
        </div>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" >
                <div class="product type-product status-publish has-post-thumbnail product_cat-pizza pa_food-type-veg first instock shipping-taxable purchasable product-type-variable has-children">
                    <div class="single-product-wrapper">
                        <div class="product-images-wrapper">
                            <div class="images">
                                <a href="<?=base_url('img/menu_folder/'.$detail->menu_foto);?>" itemprop="image" class="woocommerce-main-image zoom" title="" data-rel="prettyPhoto[product-gallery]">
                                    <img width="600" height="600" src="<?=base_url('img/menu_folder/'.$detail->menu_foto);?>" class="attachment-shop_single size-shop_single wp-post-image" alt=""/>
                                </a>
                            </div>
                        </div>
                        <div class="summary entry-summary">
                            <h1 itemprop="name" class="product_title entry-title"><?=ucwords(strtolower($detail->menu_nama));?>
                            </h1>
                            <div itemprop="offers">
                                <p class="price">Rp. <?=number_format($detail->menu_harga,0,'',',');?></p>
                            </div>
                            <div itemprop="description">
                                <p><?=ucwords(strtolower($detail->menu_deskripsi));?></p>
                            </div>
                        </div>
                    </div>
                    <div class="product-form-wrapper">
                        <div class="delivery-time">Waktu : <span><?=$detail->menu_waktu;?> Menit</span></div>
                        <form class="cart" name="cart">
                            <div class="single_variation_wrap">
                                <div class="woocommerce-variation single_variation"></div>
                                <div class="woocommerce-variation-add-to-cart variations_button">
                                    <div class="qty-btn">
                                        <label>Jumlah</label>
                                        <div class="quantity">
                                            <input type="text" name="qty" value="1" id="qty" onkeyup="qty_change()" title="Qty" class="input-text qty text product_quantity_value" autocomplete="off" />
                                            
                                        </div>
                                    </div>
                                    <button data-id="<?=$detail->menu_id;?>" data-qty="1" type="submit" class="single_add_to_cart_button button alt addToCart">Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<script type="text/javascript">
function qty_change() {
    var myForm = document.cart;
    var Qty    = myForm.qty.value;
    $('.addToCart').attr('data-qty', Qty);
}
</script>