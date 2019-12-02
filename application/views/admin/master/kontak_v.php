<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>backend/js/sweetalert2.css">
<script src="<?=base_url(); ?>backend/js/sweetalert2.min.js"></script>

<div class="page-content-wrapper">
    <div class="page-content">            
        <h3 class="page-title">Kontak Kami</h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Menu Master</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Kontak Kami</a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height blue-madison">
                    <i class="icon-calendar">&nbsp; </i><span class="uppercase visible-lg-inline-block"><?=tgl_indo(date('Y-m-d')); ?></span>
                </div>
            </div>
        </div>            
        
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i> Detail Kontak Kami
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form role="form" method="post" id="formInput" action="" class="form-horizontal">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama Perusahaan</label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="name" value="<?=$detail->contact_name; ?>" autocomplete="off" autofocus />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Alamat</label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="address" value="<?=$detail->contact_address; ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">No. Telepon</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="phone" value="<?=$detail->contact_phone; ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Email</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="email" value="<?=$detail->contact_email; ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Website</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="web" value="<?=$detail->contact_web; ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script src="<?=base_url();?>backend/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url(); ?>backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript">
// Reset Form
function resetformInput() {
    var MValid = $("#formInput");
    MValid.validate().resetForm();
    MValid.find(".has-success, .has-warning, .fa-warning, .fa-check").removeClass("has-success has-warning fa-warning fa-check");
    MValid.find("i.fa[data-original-title]").removeAttr('data-original-title');
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
            name: { required: true },
            address: { required: true },
            phone: { required: true },
            email: { required: true, email: true },
            web: { required: true, url: true }
        },
        messages: {
            name: { required:'Nama Perusahaan required' },
            address: { required:'Alamat required' },
            phone: { required:'No. Telepon harus diisi' },
            email: { required:'Email harus diisi', email:'Email tidak Valid' },
            web: { required:'Website harus diisi', url:'Website tidak Valid (Ex. http://www.domain.com)' }
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
            for (instance in CKEDITOR.instances)
            {
                CKEDITOR.instances[instance].updateElement();
            }
            dataString = $("#formInput").serialize();
            $.ajax({
                url: "<?=site_url('admin/kontak/updatedata'); ?>",
                type: "POST",
                data: dataString,
                success: function(data) {
                    setTimeout(function() {
                        swal({
                            title:"Sukses",
                            text: "Update Data Sukses",
                            timer: 2000,
                            showConfirmButton: false,
                            type: "success"
                        })
                        resetformInput();
                    });
                },
                error: function() {
                    setTimeout(function() {
                        swal({
                            title:"Error",
                            text: "Update Data Gagal",
                            timer: 2000,
                            showConfirmButton: false,
                            type: "error"
                        })
                    });
                    resetformInput();
                }
            });
        }
    });
});
</script>