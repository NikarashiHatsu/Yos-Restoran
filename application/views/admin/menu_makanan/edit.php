<link href="<?=base_url();?>backend/js/sweetalert2.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url();?>backend/js/sweetalert2.min.js"></script>
<link href="<?=base_url();?>backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<script src="<?=base_url('backend/js/jquery.maskMoney.min.js');?>"></script>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Menu
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Data Master</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                 <li>
                    <a href="<?=site_url('admin/menu_makanan');?>">Menu</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Menu : <?=$detail->menu_kode;?></a>
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
                            <i class="fa fa-edit"></i> Form Edit Menu
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" method="post" id="formInput" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$detail->menu_id;?>">
                        
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nama Menu</label>
                                        <div class="col-md-9">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <input type="text" class="form-control" placeholder="Enter Nama Makanan" name="nama" id="nama" autocomplete="off" value="<?=$detail->menu_nama;?>" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Kategori</label>
                                        <div class="col-md-9">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <select class="form-control" name="lstKategori">
                                                    <option value="">- Pilih Kategori -</option>
                                                    <?php 
                                                    foreach ($listKategori as $r) {
                                                        if ($detail->kategori_id == $r->kategori_id) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                    ?>
                                                    <option value="<?=$r->kategori_id;?>" <?=$selected;?>><?=$r->kategori_nama;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Est. Waktu (Menit)</label>
                                        <div class="col-md-5">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <input type="text" class="form-control number" placeholder="0" name="waktu" value="<?=number_format($detail->menu_waktu,0,'',',');?>" autocomplete="off" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Harga</label>
                                        <div class="col-md-5">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <input type="text" class="form-control number" placeholder="0" name="harga" value="<?=number_format($detail->menu_harga,0,'',',');?>" autocomplete="off" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Deskripsi</label>
                                        <div class="col-md-9">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <textarea class="form-control" rows="10" name="deskripsi"><?=$detail->menu_deskripsi;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Upload Foto</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="<?=base_url('img/no-image.png');?>" alt=""/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 250px;"></div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                    <span class="fileinput-new">
                                                    Pilih Foto </span>
                                                    <span class="fileinput-exists">
                                                    Ubah </span>
                                                    <input type="file" name="foto" accept=".png,.jpg,.jpeg">
                                                    </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Hapus </a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">
                                                INFO !</span>
                                                Resolution : 300 x 250 Pixel
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Foto Makanan</label>
                                        <div class="col-md-9">
                                            <?php if (!empty($detail->menu_foto)) { ?>
                                            <img src="<?=base_url('img/menu_folder/thumbs/'.$detail->menu_foto);?>" width="50%">
                                            <?php } else { ?>
                                            <img src="<?=base_url('img/no-image.jpg');?>" width="50%">
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" align="center">
                            <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                            <a href="<?=site_url('admin/menu_makanan');?>" class="btn btn-warning"><i class="fa fa-times"></i> Batal
                            </a>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.number').maskMoney({thousands:',', precision:0});
});

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
            nama: { required: true },
            lstKategori: { required: true },
            waktu: { required: true },
            harga: { required: true },
            deskripsi: { required: true }
        },
        messages: {
            nama: { required:'Nama Menu harus diisi' },
            lstKategori: { required:'Kategori harus dipilih' },
            waktu: { required:'Estimasi Waktu harus diisi' },
            harga: { required:'Harga harus dipilih' },
            deskripsi: { required:'Deskripsi harus diisi' }
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
            var formData = new FormData($('#formInput')[0]);
            $.ajax({
                dataType: 'json',
                data: formData,
                async: true,
                url: "<?=site_url('admin/menu_makanan/updatedata');?>",
                type: "POST",
                success: function(data) {
                    if (data.status === 'success') {
                        setTimeout(function() {
                            swal({
                                title:"Sukses",
                                text: "Update Data Berhasil",
                                timer: 2000,
                                showConfirmButton: false,
                                type: "success"
                            }, function() {
                                window.location="<?=site_url('admin/menu_makanan');?>";
                            })
                        });
                    } else {
                        setTimeout(function() {
                            swal({
                                title:"Gagal",
                                text: "File Tidak sesuai Format (JPG/PNG/JPEG)",
                                timer: 2000,
                                showConfirmButton: false,
                                type: "error"
                            })
                        });
                    }
                },
                error: function() {
                    setTimeout(function() {
                        swal({
                            title:"Error",
                            text: "Update Data Error",
                            timer: 2000,
                            showConfirmButton: false,
                            type: "error"
                        })
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
});
</script>