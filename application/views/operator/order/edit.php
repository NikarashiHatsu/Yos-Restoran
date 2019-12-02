<link rel="stylesheet" type="text/css" href="<?=base_url('backend/js/sweetalert2.css');?>">
<script src="<?=base_url('backend/js/sweetalert2.min.js');?>"></script>
<script src="<?=base_url('backend/js/jquery.maskMoney.min.js');?>"></script>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Order
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('operator/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Menu Transaksi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?=site_url('operator/order');?>">Order</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Transaksi Order</a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height blue-madison">
                    <i class="icon-calendar">&nbsp; </i><span class="uppercase visible-lg-inline-block"><?=tgl_indo(date('Y-m-d'));?></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-shopping-cart"></i> Form Transaksi Order
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form id="formInput" name="formInput" method="post" class="form-horizontal form">
                        <input type="hidden" name="order_id" value="<?=$detail->order_id;?>">
                        <input type="hidden" name="menu_id" id="menu_id">
                        <input type="hidden" name="order_detail_id" id="order_detail_id">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Kode Menu</label>
                                            <div class="col-md-5">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="menu_kode" id="menu_kode" placeholder="Cari Menu" autocomplete="off" autofocus />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <a data-toggle="modal" data-target="#tableDataMenu" class="btn btn-danger" id="btn-search">
                                                    <i class="fa fa-search"></i> Cari Menu
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-3 control-label">Nama Menu</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="menu_nama" id="menu_nama" placeholder="Nama Menu" autocomplete="off" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Qty</label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control number" name="qty" id="qty" placeholder="0" autocomplete="off" onkeydown="hitungTotal()" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Harga</label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control number" name="harga" id="harga" placeholder="0" autocomplete="off" onkeydown="hitungTotal()" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-3 control-label">Total</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="total" id="total" placeholder="0" autocomplete="off" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-3 control-label">Waktu</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="waktu" id="waktu" placeholder="0" autocomplete="off" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions" align="center">
                                <?php if ($detail->order_status == 1) { ?>
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan Item</button>
                                <a onclick="bayarOrder(<?=$detail->order_id;?>)" type="button" class="btn btn-primary"><i class="fa fa-money"></i> Bayar</a>
                                <?php } else { ?>
                                <a onclick="printNota(<?=$detail->order_id;?>)" type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print Nota</a>
                                <?php } ?>
                                <a href="<?=site_url('operator/order');?>" type="button" class="btn btn-warning"><i class="fa fa-times"></i> Batal</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list"></i> Data Order Menu
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-hover" id="tableOrder">
                                    <thead>
                                        <tr>
                                            <th width="5%"></th>
                                            <th width="5%">No.</th>
                                            <th width="10%">Menu Kode</th>
                                            <th>Nama Menu</th>
                                            <th width="10%">Qty</th>
                                            <th width="15%">Harga</th>
                                            <th width="10%">Waktu</th>
                                            <th width="15%">Sub Total</th>
                                            <th width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <div class="well">
                    <div class="row static-info align-reverse">
                        <div class="col-md-4 name"><b>NO. ORDER :</b></div>
                        <div class="col-md-8 value"><b>#<?=$detail->order_id;?></b></div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-4 name"><b>TANGGAL :</b></div>
                        <div class="col-md-8 value"><?=date('d-m-Y');?></div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-4 name"><b>PEMBELI :</b></div>
                        <div class="col-md-8 value"><?=$detail->order_nama;?></div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-4 name"><b>NO. MEJA :</b></div>
                        <div class="col-md-8 value"><?=$detail->meja_nama;?></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="well">
                    <div class="row static-info align-reverse">
                        <div class="col-md-7 name"><b>STATUS PEMBAYARAN :</b></div>
                        <div class="col-md-5 value"><?=$detail->order_status==1?'<span class="label label-danger">BELUM BAYAR</span>':'<span class="label label-success">BAYAR</span>';?></div>
                    </div>
                    <?php if ($detail->order_status == 2) { ?>
                    <div class="row static-info align-reverse">
                        <div class="col-md-7 name"><b>Tanggal Bayar :</b></div>
                        <div class="col-md-5 value"><?=date('d-m-Y', strtotime($detail->order_tgl_bayar));?></div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-7 name"><b>Kasir :</b></div>
                        <div class="col-md-5 value"><?=$detail->user_username;?></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
                    <div class="row static-info align-reverse">
                        <div class="col-md-7 name"><b>TOTAL QTY :</b></div>
                        <div class="col-md-5 value" id="totalqty"></div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-7 name"><b>WAKTU :</b></div>
                        <div class="col-md-5 value" id="totalwaktu"></div>
                    </div>
                    <div class="row static-info align-reverse">
                        <div class="col-md-7 name"><b>TOTAL :</b></div>
                        <div class="col-md-5 value" id="totalorder"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?=base_url('backend/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('backend/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=base_url('backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js');?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.number').maskMoney({thousands:',', precision:0});
    $('.digit').maskMoney({thousands:',', precision:2});
    getTotal();
});

var statusinput;
statusinput = 'Tambah';

var tableMenu;
$(document).ready(function() {
    tableMenu = $('#tableMenu').DataTable({
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?=site_url('operator/order/data_menu_list')?>",
            "type": "POST"
        },
        "columnDefs": [
        {
            "targets": [ 0, 1, 4, 5, 6 ],
            "orderable": false,
        },
        ],
    });
});

$(function() {
    $(document).on("click",'.pilihData', function(e) {
        var menu_id      = $(this).data('id');
        var menu_kode    = $(this).data('code');
        var menu_nama    = $(this).data('name');
        var harga        = $(this).data('harga');
        var waktu        = $(this).data('waktu');
        var locale       = 'en';
        var options      = {minimumFractionDigits: 0, maximumFractionDigits: 0};
        var formatter    = new Intl.NumberFormat(locale, options);
        $("#menu_id").val(menu_id);
        $("#menu_kode").val(menu_kode);
        $("#menu_nama").val(menu_nama);
        $("#harga").val(formatter.format(harga));
        $("#qty").val(1);
        $("#total").val(formatter.format(harga));
        $("#waktu").val(waktu);
        $('#tableDataMenu').modal('hide');
        document.getElementById("qty").focus();
    })
});

function resetForm() {
    statusinput = 'Tambah';
    var MValid = $("#formInput");
    $("#menu_id").val('');
    $("#menu_kode").val('');
    $("#menu_nama").val('');
    $("#harga").val(0);
    $("#qty").val(0);
    $("#waktu").val(0);
    $('#total').val(0);

    MValid.validate().resetForm();
    MValid.find(".has-success, .has-warning, .fa-warning, .fa-check").removeClass("has-success has-warning fa-warning fa-check");
    MValid.find("i.fa[data-original-title]").removeAttr('data-original-title');
    document.getElementById("menu_kode").focus();
}

function hitungTotal() {
    var locale              = 'en';
    var options             = {minimumFractionDigits: 0, maximumFractionDigits: 0};
    var formatter           = new Intl.NumberFormat(locale, options);
    var myForm              = document.formInput;
    var Qty                 = myForm.qty.value;
    Qty                     = Qty.replace(/[,]/g, '');
    Qty                     = parseInt(Qty);
    var Harga               = myForm.harga.value;
    Harga                   = Harga.replace(/[,]/g, '');
    Harga                   = parseInt(Harga);

    if (Qty === 0 || isNaN(Qty)) {
        var Total           = 0;
    } else {
        var Total           = (Harga*Qty);
    }

    if (isNaN(Total)) {
        myForm.total.value     = 0;
    } else {
        myForm.total.value     = formatter.format(Total);
    }
}

var tableOrder;
$(document).ready(function() {
    var order_id = '<?=$detail->order_id;?>';
    tableOrder = $('#tableOrder').DataTable({
        "paging": false,
        "info": false,
        "searching": false,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?=site_url('operator/order/data_order_list/')?>"+order_id,
            "type": "POST"
        },
        "columnDefs": [
        {
            "targets": [ 0, 1, 2, 3, 4, 5, 6, 7, 8],
            "orderable": false,
        },
        ],
    });
});

function reload_table() {
    tableOrder.ajax.reload(null,false);
}

$(document).ready(function() {
    var form        = $('#formInput');
    var error       = $('.alert-danger', form);
    var success     = $('.alert-success', form);

    $("#formInput").validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: "",
        rules: {
            menu_kode: {
                required: true
            },
            qty: {
                required: true
            },
            harga: {
                required: true
            }
        },
        messages: {
            menu_kode: {
                required:'Menu Kode harus dipilih'
            },
            qty: {
                required:'Qty harus diisi'
            },
            harga: {
                required:'Harga harus diisi'
            }
        },
        invalidHandler: function (event, validator) {
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },
        errorPlacement: function (error, element) {
            var icon = $(element).parent('.input-icon').children('i');
            icon.removeClass('fa-check').addClass("fa-warning");
            icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
        },
        highlight: function (element) {
            $(element)
            .closest('.form-group').removeClass("has-success").addClass('has-error');
        },
        unhighlight: function (element) {
        },
        success: function (label, element) {
            var icon = $(element).parent('.input-icon').children('i');
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            icon.removeClass("fa-warning").addClass("fa-check");
        },
        submitHandler: function(form) {
            dataString = $('#formInput').serialize();
            if (statusinput =='Tambah') {
                $.ajax({
                    url: "<?=site_url('operator/order/saveitem');?>",
                    type: "POST",
                    data: dataString,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status === 'success') {
                            resetForm();
                            getTotal();
                            reload_table();
                        } else {
                            swal({
                                title:"Perhatian",
                                text: "Item Sudah Ada, Edit atau Hapus",
                                showConfirmButton: false,
                                type: "warning",
                                timer: 2000
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error Simpan Item');
                    }
                });
            } else {
                $.ajax({
                    url: "<?=site_url('operator/order/updateitem');?>",
                    type: "POST",
                    data: dataString,
                    dataType: 'JSON',
                    success: function(data) {
                        resetForm();
                        getTotal();
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error Update Item');
                    }
                });
            }
        }
    });
});

function getTotal() {
    var order_id = '<?=$detail->order_id;?>';
    $.ajax({
        url : "<?=site_url('operator/order/get_data_total/');?>"+order_id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            var Waktu;
            var Qty;
            var Total;
            Waktu    = 0;
            Qty      = 0;
            Total    = 0;
            if (data == null) {
                Waktu    = 0;
                Qty      = 0;
                Total    = 0;
            } else if (data.total == null) {
                Waktu    = 0;
                Qty      = 0;
                Total    = 0;
            } else {
                var locale      = 'en';
                var options     = {minimumFractionDigits: 0, maximumFractionDigits: 0};
                var formatter   = new Intl.NumberFormat(locale, options);
                Waktu           = data.waktu;
                Qty             = data.qty;
                Total           = formatter.format(data.total);
            }

            $('#totalwaktu').html('<b>'+Waktu+' Menit</b>');
            $('#totalqty').html('<b>'+Qty+'</b>');
            $('#totalorder').html('<b>'+Total+'</b>');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get Total');
        }
    });
}

function editData(id) {
    statusinput = 'Edit';
    $.ajax({
        url : "<?=site_url('operator/order/get_data_detail/');?>"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            var locale     = 'en';
            var options    = {minimumFractionDigits: 0, maximumFractionDigits: 0};
            var formatter  = new Intl.NumberFormat(locale, options);
            var options1    = {minimumFractionDigits: 2, maximumFractionDigits: 2};
            var formatter1  = new Intl.NumberFormat(locale, options1);
            $('#order_detail_id').val(data.order_detail_id);
            $('#menu_id').val(data.menu_id);
            $("#menu_kode").val(data.menu_kode);
            $("#menu_nama").val(data.order_detail_nama);
            $("#qty").val(formatter.format(data.order_detail_qty));
            $("#harga").val(formatter.format(data.order_detail_harga));
            $("#waktu").val(data.order_detail_waktu);
            $("#total").val(formatter.format(data.order_detail_subtotal));
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function hapusData(order_detail_id) {
    var id = order_detail_id;
    swal({
        title: 'Anda Yakin ?',
        text: 'Item ini akan di Hapus !',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        closeOnConfirm: true
    }, function(isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url : "<?=site_url('operator/order/deletedataitem')?>/"+id,
            type: "POST",
            success: function(data) {
                swal({
                    title:"Sukses",
                    text: "Hapus Item Sukses",
                    showConfirmButton: false,
                    type: "success",
                    timer: 2000
                });
                reload_table();
                getTotal();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Hapus Item Gagal');
            }
        });
    });
}

function bayarOrder(id) {
    $('#formBayar')[0].reset();
    $.ajax({
        url : "<?=site_url('operator/order/get_data/');?>"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#id').val(data.order_id);
            $('#order_no').val(data.order_id);
            $('#order_tanggal').val(data.order_tanggal.split("-").reverse().join("-"));
            $('#nama_pembeli').val(data.order_nama);
            $('#meja').val(data.meja_nama);
            var order_id = data.order_id;
            $.ajax({
                url : "<?=site_url('operator/order/get_data_total/');?>"+order_id,
                type: "GET",
                dataType: "JSON",
                success: function(datax) {
                    var locale      = 'en';
                    var options     = {minimumFractionDigits: 0, maximumFractionDigits: 0};
                    var formatter   = new Intl.NumberFormat(locale, options);
                    var options1    = {minimumFractionDigits: 2, maximumFractionDigits: 2};
                    var formatter1  = new Intl.NumberFormat(locale, options1);
                    var Total;
                    Total           = 0;
                    if (datax == null) {
                        Total         = 0;
                    } else {
                        Total         = parseInt(datax.total);
                        if (isNaN(Total)) {
                            Total         = 0;
                        } else {
                            Total         = formatter.format(Total);
                        }
                    }

                    $('#totalorder_modal').val(Total);
                    $('#grandtotal').val(Total);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get Total');
                }
            });

            $('#formModalBayar').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function hitungDiskon() {
    var locale              = 'en';
    var options             = {minimumFractionDigits: 0, maximumFractionDigits: 0};
    var formatter           = new Intl.NumberFormat(locale, options);
    var myForm              = document.formBayar;
    var Total               = myForm.totalorder_modal.value;
    Total                   = Total.replace(/[,]/g, '');
    Total                   = parseInt(Total);
    var Diskon              = myForm.diskon.value;
    Diskon                  = Diskon.replace(/[,]/g, '');
    Diskon                  = parseInt(Diskon);

    if (Diskon === 0 || isNaN(Diskon)) {
        var TotalAkhir      = Total;
    } else {
        var TotalAkhir      = (Total-Diskon);
    }

    if (isNaN(TotalAkhir)) {
        myForm.grandtotal.value = 0;
    } else {
        myForm.grandtotal.value = formatter.format(TotalAkhir);
    }
}

function hitungKembalian() {
    var locale              = 'en';
    var options             = {minimumFractionDigits: 0, maximumFractionDigits: 0};
    var formatter           = new Intl.NumberFormat(locale, options);
    var myForm              = document.formBayar;
    var Total               = myForm.grandtotal.value;
    Total                   = Total.replace(/[,]/g, '');
    Total                   = parseInt(Total);
    var Bayar               = myForm.bayar.value;
    Bayar                   = Bayar.replace(/[,]/g, '');
    Bayar                   = parseInt(Bayar);
    var Kembali;
    if (Bayar < Total) {
        alert("Bayar Kurang dari Total Pembayaran");
        Kembali = 0;
        document.getElementById("bayar").focus();
    } else {
        Kembali = (Bayar-Total);
    }

    if (isNaN(Kembali)) {
        myForm.kembali.value     = 0;
    } else {
        myForm.kembali.value     = formatter.format(Kembali);
    }
}

$(document).ready(function() {
    var form        = $('#formBayar');
    var error       = $('.alert-danger', form);
    var success     = $('.alert-success', form);

    $("#formBayar").validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: "",
        rules: {
            bayar: { required: true }
        },
        messages: {
            bayar: {
                required :'Bayar harus diisi'
            }
        },
        invalidHandler: function (event, validator) {
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
        },
        submitHandler: function(form) {
            dataString = $("#formBayar").serialize();
            $.ajax({
                url: '<?=site_url('operator/order/bayar');?>',
                type: "POST",
                data: dataString,
                success: function(data) {
                    swal({
                        title:"Sukses",
                        text: "Pembayaran Selesai",
                        timer: 2000,
                        showConfirmButton: false,
                        type: "success"
                    });
                    $('#formModalBayar').modal('hide');
                    window.location="<?=site_url('operator/order');?>";
                },
                error: function() {
                    swal({
                        title:"Error",
                        text: "Pembayaran Gagal",
                        timer: 2000,
                        showConfirmButton: false,
                        type: "error"
                    });
                    $('#formModalBayar').modal('hide');
                    resetformBayar();
                }
            });
        }
    });
});

function resetformBayar() {
    var MValid = $("#formBayar");
    MValid.validate().resetForm();
    MValid.find(".has-error").removeClass("has-error");
    MValid.removeAttr('aria-describedby');
    MValid.removeAttr('aria-invalid');
}

function printNota(order_id) {
    var url = "<?=site_url('operator/order/cetaknotabayar/');?>"+order_id;
    window.open(url, "_blank");
    // location.reload();
}
</script>

<div class="modal fade" id="tableDataMenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-list"></i> Menu List</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover" id="tableMenu" width="100%">
                    <thead>
                        <tr>
                            <th width="5%"></th>
                            <th width="5%">No</th>
                            <th width="10%">Kode</th>
                            <th width="50%">Nama Menu</th>
                            <th width="10%">Kategori</th>
                            <th width="10%">Waktu</th>
                            <th width="10%">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="formModalBayar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" id="formBayar" name="formBayar" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Pembayaran</h4>
                <input type="hidden" name="id" id="id">
            </div>
            <div class="modal-body">
                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label">No. Order</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="order_no" id="order_no" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label">Tanggal</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="order_tanggal" id="order_tanggal" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label">Nama Pembeli</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nama_pembeli" id="nama_pembeli" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label">Meja</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="meja" id="meja" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label"><b>TOTAL</b></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="order_total" id="totalorder_modal" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Diskon (Rp)</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control number" name="diskon" id="diskon" placeholder="0" autocomplete="off" onkeydown="hitungDiskon()">
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label"><b>GRAND TOTAL</b></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="grandtotal" id="grandtotal" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Bayar</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control number" name="bayar" id="bayar" placeholder="0" autocomplete="off" onfocusout="hitungKembalian()">
                    </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-4 control-label">Kembali</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="kembali" id="kembali" placeholder="0" autocomplete="off" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Bayar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>