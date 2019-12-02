<link rel="stylesheet" type="text/css" href="<?=base_url();?>backend/js/sweetalert2.css">
<script src="<?=base_url();?>backend/js/sweetalert2.min.js"></script>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Users
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?=site_url('admin/users');?>">Users</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Tambah User</a>
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
                            <i class="fa fa-plus-circle"></i> Form Tambah User
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form id="formInput" method="post" action="" class="form-horizontal form">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Username</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="Input Username" autocomplete="off" autofocus />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Password</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="password" class="form-control" name="password" placeholder="Input Password" autocomplete="off"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Nama Lengkap</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Input Nama Lengkap" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Email</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Input Email" autocomplete="off"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Level</label>
                                            <div class="col-md-5">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="lstLevel">
                                                        <option value="">- Pilih -</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Bar">Bar</option>
                                                        <option value="Kasir">Kasir</option>
                                                        <option value="Dapur">Dapur</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions" align="center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                <a href="<?=site_url('admin/users');?>" type="button" class="btn btn-warning"><i class="fa fa-times"></i> Batal</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^\w+$/i.test(value);
}, "Hany Huruf, Angka dan Garis Bawah");

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
            username: {
                required: true, minlength: 5, alphanumeric: true,
                remote: {
                    url: "<?=site_url('admin/users/register_user_exists');?>",
                    type: "post",
                    data: {
                        username: function() {
                            return $("#username").val();
                        }
                    }
                }
            },
            password: {
                required: true, minlength: 5
            },
            name: {
                required: true, minlength: 5
            },
            email: {
                required: true, minlength: 15, email: true,
                remote: {
                    url: "<?=site_url('admin/users/register_email_exists');?>",
                    type: "post",
                    data: {
                        email: function() {
                            return $("#email").val();
                        }
                    }
                }
            },
            lstLevel: {
                required: true
            }
        },
        messages: {
            username: {
                required:'Username required', minlength:'Minimal 5 Char',
                remote: 'Username sudah ada, mohon Ganti'
            },
            password: {
                required:'Password required', minlength:'Minimal 5 Char'
            },
            name: {
                required:'Nama required', minlength:'Minimal 5 Char'
            },
            email: {
                required:'Email required', minlength:'Minimal 15 Char', email:'Email tidak Valid',
                remote: 'Email sudah ada, mohon ganti'
            },
            lstLevel: {
                required:'Level required'
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
            $.ajax({
                url: "<?=site_url('admin/users/savedata');?>",
                type: "POST",
                data: dataString,
                dataType: 'JSON',
                success: function(data) {
                    swal({
                        title:"Sukses",
                        text: "Simpan Data Sukses",
                        showConfirmButton: false,
                        type: "success",
                        timer: 2000
                    }, function() {
                        window.location="<?=site_url('admin/users');?>";
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error Simpan Data');
                }
            });
        }
    });
});
</script>