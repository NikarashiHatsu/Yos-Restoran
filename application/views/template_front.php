<?php
$meta = $this->menu_m->select_meta()->row();
?>
<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">
  	<head>
     	<meta charset="UTF-8">
      	<meta name="viewport" content="width=device-width, initial-scale=1">
      	<title><?=$meta->meta_name;?></title>
		<link rel="shortcut icon" href="<?=base_url('img/logo-icon.png');?>">
        <link rel="stylesheet" type="text/css" href="<?=base_url('frontend');?>/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('frontend');?>/css/font-awesome.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('frontend');?>/css/animate.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('frontend');?>/css/font-pizzaro.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('frontend');?>/css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('frontend');?>/css/colors/red.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('frontend');?>/css/jquery.mCustomScrollbar.min.css" media="all" />
      	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CYanone+Kaffeesatz:200,300,400,700" rel="stylesheet">
        <link href="<?=base_url();?>backend/js/sweetalert2.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>backend/css/datatables.css" rel="stylesheet" type="text/css" />
        <script src="<?=base_url();?>backend/js/sweetalert2.min.js"></script>
        <script src="<?=base_url();?>backend/js/datatables.js"></script>
        <script type="text/javascript" src="<?=base_url('frontend');?>/js/jquery.min.js"></script>
    </head>
    <?php
    if ($this->uri->segment(1) == '') {
        $class = 'page-template-template-homepage-v1 home-v1';
    } elseif ($this->uri->segment(1)=='kategori') {
        $class = 'full-width grid-view columns-4 archive woocommerce-page';
    } elseif ($this->uri->segment(1) == 'menuorder') {
        $class = 'single-product style-2';
    } elseif ($this->uri->segment(1) == 'cart') {
        $class = 'woocommerce-cart';
    } elseif ($this->uri->segment(1) == 'checkout' && $this->uri->segment(2) == 'review') {
        $class = 'woocommerce-checkout';
    } elseif ($this->uri->segment(1) == 'checkout' && $this->uri->segment(2) == 'selesai') {
        $class = 'woocommerce-page woocommerce-order-received woocommerce-checkout';
    }
    ?>
   <body class="<?=$class;?>">
      	<div id="page" class="hfeed site">
        <?=$_header;?>
		<?=$content;?>
        <?=$_footer;?>
      	</div>
      	<script type="text/javascript" src="<?=base_url('frontend');?>/js/tether.min.js"></script>
      	<script type="text/javascript" src="<?=base_url('frontend');?>/js/bootstrap.min.js"></script>
      	<script type="text/javascript" src="<?=base_url('frontend');?>/js/owl.carousel.min.js"></script>
      	<script type="text/javascript" src="<?=base_url('frontend');?>/js/social.share.min.js"></script>
      	<script type="text/javascript" src="<?=base_url('frontend');?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
      	<script type="text/javascript" src="<?=base_url('frontend');?>/js/scripts.min.js"></script>

        <script type="text/javascript">
        // function qty_change() {
        //     var qty = 1;
        //     qty = parseInt($(this).parent().find('.product_quantity_value').val());
        //     $(this).parent().parent().parent().find('.addToCart').attr('data-qty', qty);
        //     console.log(qty);
            // var qty = 1;
            // $('.product_quantity_up').each(function(index, el) {
            //     $(this).on('click', function(event) {
            //         qty = parseInt($(this).parent().find('.product_quantity_value').val())+1;
            //         if (qty > 0) {
            //             $(this).parent().parent().parent().find('.addToCart').attr('data-qty', qty);
            //         }else{
            //             $(this).parent().parent().parent().find('.addToCart').attr('data-qty', 1);
            //         }
            //     });
            // });

            // $('.product_quantity_down').each(function(index, el) {
            //     $(this).on('click', function(event) {
            //         qty = parseInt($(this).parent().find('.product_quantity_value').val())-1;
            //         if (qty > 0) {
            //             $(this).parent().parent().parent().find('.addToCart').attr('data-qty', qty);
            //         }else{
            //             $(this).parent().parent().parent().find('.addToCart').attr('data-qty', 1);
            //         }
            //     });
            // });
        // }

        // qty_change();

        $('.addToCart').each(function(index, el) {
            var data = {};
            $(this).on('click', function(event) {
                event.preventDefault();
                data['id']  = $(this).data('id');
                data['qty'] = $(this).attr('data-qty');
                $.ajax({
                    url: '<?=site_url('index.php/cart/additem');?>',
                    type: 'POST',
                    data: {data: data},
                })
                .done(function(res) {
                    swal({
                        title:"Sukses",
                        text: "Order Menu Berhasil",
                        timer: 2000,
                        showConfirmButton: false,
                        type: "success"
                    });
                    $('.cart_count').html(res.cart_count);
                    $('.cart_total_format').html(res.cart_total_format);
                    $('.cart_dropdown_container').html(res.cart_dropdown_container);
                    $('.cart_count_footer').html(res.cart_count_footer);
                })
                .fail(function(error) {
                    console.log(error.responseText);
                });
            });
        });
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
   	</body>
</html>
