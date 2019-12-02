<div id="content" class="site-content" tabindex="-1" >
    <div class="col-full">
        <div class="pizzaro-breadcrumb">
            <nav class="woocommerce-breadcrumb" >
                <a href="<?=base_url();?>">Beranda</a>
                <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>Order Selesai
            </nav>
        </div>

        <div id="primary" class="content-area">
            <main id="main" class="site-main" >
                <?=$_proses;?>
                <div id="post-8" class="post-8 page type-page status-publish hentry">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <?=$detail_content;?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.pizzaro-order-steps .complete'). addClass('cart');
</script>