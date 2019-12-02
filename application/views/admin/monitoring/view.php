<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">Monitoring</h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Menu Transaksi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Monitoring</a>
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
                            <i class="fa fa-list"></i> Daftar Monitoring
                        </div>
                        <div class="actions">
                            <a onclick="Refresh()">
                                <button type="button" class="btn btn-primary btn-xs"><i class="fa fa-refresh"></i> Refresh</button>
                            </a>
                            <a data-toggle="modal" data-target="#filterData">
                                <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-search"></i> Filter Data</button>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-hover" id="tableData">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">No Meja</th>
                                <th width="10%">Kode</th>
                                <th>Nama Menu</th>
                                <th width="10%">Qty</th>
                                <th width="10%">Harga</th>
                                <th width="10%">Waktu</th>
                                <th width="10%">Sub Total</th>
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
        "paging": false,
        "info": false,
        "searching": false,
        "processing": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?=site_url('admin/monitoring/data_list')?>",
            "type": "POST",
            "data": function(data) {
                data.lstMeja    = $('#lstMeja').val();
                data.lstStatus  = $('#lstStatus').val();
            }
        },
        "columnDefs": [
        {
            "targets": [ 0 ],
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

function Refresh() {
    reload_table();
}
</script>

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
                    <label class="col-md-3 control-label">No. Meja</label>
                    <div class="col-md-9">
                        <select class="form-control" name="lstMeja" id="lstMeja">
                            <option value="">- SEMUA -</option>
                            <?php foreach($listData as $r) { ?>
                            <option value="<?=$r->meja_id;?>"><?=$r->meja_nama;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Status Menu</label>
                    <div class="col-md-9">
                        <select class="form-control" name="lstStatus" id="lstStatus">
                            <option value="">- SEMUA -</option>
                            <option value="1">Baru</option>
                            <option value="2">Selesai</option>
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