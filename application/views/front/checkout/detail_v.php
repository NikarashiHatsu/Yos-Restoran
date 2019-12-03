<div id="content" class="site-content" tabindex="-1" >
    <div class="col-full">
        <div class="pizzaro-breadcrumb">
            <nav class="woocommerce-breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>
                <a href="#">Konfirmasi</a>
                <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>Order Selesai
            </nav>
        </div>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" >
                <?= $_proses;?>
                
                <div id="post-9" class="post-9 page type-page status-publish hentry">
                    <header class="entry-header">
                        <h1 class="entry-title">Order Selesai</h1>
                    </header>
                    <div class="entry-content">
                        <div class="woocommerce">
                            <p class="woocommerce-thankyou-order-received">Terima Kasih, Order Anda Kami Terima.</p>
                            <ul class="woocommerce-thankyou-order-details order_details">
                                <li class="order">No. Order #:<strong><?=$Order->order_id;?></strong></li>
                                <li class="date">Tanggal :<strong><?=tgl_indo($Order->order_tanggal);?></strong></li>
                                <li class="date">Qty dan Waktu :<strong><?=$Order->order_qty.' / '.$Order->order_waktu.' Menit';?></strong></li>
                                <li class="total">Total :<strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp. </span><?=number_format($Order->order_total,0,'',',');?></span></strong></li>
                            </ul>
                            <div class="clear"></div>
                            <p>Silahkan melakukan Pembayaran setelah Anda menikmati hidangan Kami.</p>
                            <h2>Order Detail</h2>
                            <table class="shop_table order_details">
                                <thead>
                                    <tr>
                                        <th class="product-name">Menu</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listOrder as $r) { ?>
                                    <tr class="order_item">
                                        <td class="product-name">
                                            <a href="<?=site_url('menuorder/'.$r->menu_seo);?>"><?=ucwords(strtolower($r->menu_nama));?></a> <strong class="product-quantity">× <?=$r->order_detail_qty;?></strong>
                                        </td>
                                        <td class="product-total"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp. </span><?=number_format($r->order_detail_subtotal,0,'',',');?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row">Total :</th>
                                        <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp. </span><?=number_format($Order->order_total,0,'',',');?></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <header>
                                <h2>Detail Pembeli</h2>
                            </header>
                            <table class="shop_table customer_details">
                                <tbody>
                                    <tr>
                                        <th>Nama :</th>
                                        <td><?=$Order->order_nama;?></td>
                                    </tr>
                                    <tr>
                                        <th>No. Antrian :</th>
                                        <td><?=$Order->meja_nama;?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<script>
    function openInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }

    openInNewTab('../print/' + <?= $Order->order_id; ?>);
</script>