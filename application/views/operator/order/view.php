<link href="<?=base_url();?>backend/js/sweetalert2.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url();?>backend/js/sweetalert2.min.js"></script>

<div class="modal" id="filterData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form-filter" class="form-horizontal">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-search"></i> Filter Data</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Periode</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" class="form-control date-picker" name="date_from" id="date_from" placeholder="From" data-date-format="dd-mm-yyyy" autocomplete="off">
                            <span class="input-group-addon"><b>s/d</b></span>
                            <input type="text" class="form-control date-picker" name="date_to" id="date_to" placeholder="To" data-date-format="dd-mm-yyyy" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Status Bayar</label>
                    <div class="col-md-9">
                        <select class="form-control" name="lstStatus" id="lstStatus">
                            <option value="">- SEMUA -</option>
                            <option value="1">Belum Bayar</option>
                            <option value="2">Sudah Bayar</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="btn-filter"><i class="fa fa-search"></i> Filter</button>
                <button type="button" class="btn btn-default" id="btn-reset"><i class="fa fa-refresh"></i> Reset</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">Order</h3>
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
                    <a href="#">Order</a>
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
                            <i class="fa fa-list"></i> Daftar Order
                        </div>
                        <div class="actions">
                            <a data-toggle="modal" data-target="#filterData">
                                <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-search"></i> Filter Data</button>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-hover" id="tableData">
                        <thead>
                            <tr>
                                <th width="7%"></th>
                                <th width="5%">No</th>
                                <th width="10%">Order No</th>
                                <th width="10%">Tanggal</th>
                                <th>Nama Pembeli</th>
                                <th width="10%">Meja</th>
                                <th width="10%">Waktu</th>
                                <th width="10%">Qty</th>
                                <th width="10%">Total</th>
                                <th width="10%">Konfirm</th>
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

<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript">
function reload_table() {
    table.ajax.reload(null,false);
}

var table;
$(document).ready(function() {
    table = $('#tableData').DataTable({
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?=site_url('operator/order/data_list')?>",
            "type": "POST",
            "data": function(data) {
                data.date_from  = $('#date_from').val();
                data.date_to    = $('#date_to').val();
                data.lstStatus  = $('#lstStatus').val();
            }
        },
        "columnDefs": [
        {
            "targets": [ 0, 1, 6, 7, 8 ],
            "orderable": false,
        },
        ],
    });

    $('#btn-filter').click(function() {
        reload_table();
        $('#filterData').modal('hide');
    });

    $('#btn-reset').click(function() {
        $('#form-filter')[0].reset();
        reload_table();
        $('#filterData').modal('hide');
    });
});

function konfirmData(order_id) {
    var id = order_id;
    swal({
        title: 'Anda Yakin ?',
        text: 'Order ini akan di Konfirmasi.',
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
            url : "<?=site_url('operator/order/confirmdata')?>/"+id,
            type: "POST",
            success: function(data) {
                swal({
                    title:"Sukses",
                    text: "Data Order di Konfirmasi",
                    showConfirmButton: false,
                    type: "success",
                    timer: 2000
                });
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Konfirmasi Order Gagal');
            }
        });
    });
}

function hapusData(order_id) {
    var id = order_id;
    swal({
        title: 'Anda Yakin ?',
        text: 'Data ini akan di Hapus !',
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
            url : "<?=site_url('operator/order/deletedata')?>/"+id,
            type: "POST",
            success: function(data) {
                swal({
                    title:"Sukses",
                    text: "Hapus Data Sukses",
                    showConfirmButton: false,
                    type: "success",
                    timer: 2000
                });
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Hapus Data Gagal');
            }
        });
    });
}

function printNota(order_id) {
    var url = "<?=site_url('operator/order/cetaknotabayar/');?>"+order_id;
    window.open(url, "_blank");
}
</script>