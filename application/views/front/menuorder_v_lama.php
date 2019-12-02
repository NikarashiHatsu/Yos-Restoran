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
                <div itemscope class="post-50 product type-product status-publish has-post-thumbnail product_cat-pizza pa_food-type-veg first instock shipping-taxable purchasable product-type-simple addon-product">
                    <div class="single-product-wrapper">
                        <div class="product-images-wrapper">
                            <div class="images">
                                <a href="<?=base_url('img/menu_folder/'.$detail->menu_foto);?>" itemprop="image" class="woocommerce-main-image zoom" title="" data-rel="prettyPhoto[product-gallery]">
                                    <img width="600" height="600" src="<?=base_url('img/menu_folder/'.$detail->menu_foto);?>" class="attachment-shop_single size-shop_single wp-post-image" alt=""/>
                                </a>
                            </div>
                        </div>

                        <div class="summary entry-summary">
                            <h1 itemprop="name" class="product_title entry-title"><?=ucwords(strtolower($detail->menu_nama));?><span class="food-type-icon"><i class="po po-veggie-icon"></i></span></h1>
                            <div itemprop="description">
                                <p><?=ucwords(strtolower($detail->menu_deskripsi));?></p>
                            </div>
                            <form class="cart" name="cart">
                                <div  class="yith_wapo_groups_container">
                                    <div class="yith_wapo_groups_container_wrap">
                                        <div id="ywapo_value_2" class="ywapo_group_container ywapo_group_container_checkbox form-row form-row-wide " data-requested="0" data-type="checkbox" data-id="2" data-condition="">
                                            <h3><span>Harga</span></h3>
                                            <div class="ywapo_input_container ywapo_input_container_radio">
                                                <input data-typeid="3" data-price="19.9" data-pricetype="fixed" data-index="0" type="radio" name="ywapo_radio_3[]" value="0" required checked class="ywapo_input ywapo_input_radio ywapo_price_fixed"   />
                                                <span class="ywapo_label_price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp. </span><?=number_format($detail->menu_harga,0,'',',');?></span></span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="yith_wapo_group_total" data-product-price="0">
                                        <div class="yith_wapo_group_final_total">
                                            <span class="price amount"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="qty-btn">
                                    <label>Qty</label>
                                    <div class="quantity">
                                        <input type="text" name="qty" value="1" id="qty" onkeyup="qty_change()" title="Qty" class="input-text qty text product_quantity_value" autocomplete="off" />
                                    </div>
                                </div>
                                <button data-id="<?=$detail->menu_id;?>" data-qty="1" type="submit" class="single_add_to_cart_button button alt addToCart">Order</button>
                            </form>
                        </div>
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