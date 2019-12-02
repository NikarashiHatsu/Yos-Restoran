<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">Laporan Penjualan</h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Menu Report</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Laporan</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Laporan Penjualan</a>
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
                            <i class="fa fa-list"></i> Laporan Penjualan
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="formInput" method="post" class="form-horizontal form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Periode</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control date-picker" name="tgl_dari" id="tgl_dari" placeholder="Dari" data-date-format="dd-mm-yyyy">
                                                    <span class="input-group-addon"><b>s/d</b></span>
                                                    <input type="text" class="form-control date-picker" name="tgl_sampai" id="tgl_sampai" placeholder="Sampai" data-date-format="dd-mm-yyyy">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Kategori</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="lstKategori" id="lstKategori">
                                                    <option value="">- SEMUA -</option>
                                                    <?php 
                                                    foreach ($listData as $r) {
                                                    ?>
                                                    <option value="<?=$r->kategori_id;?>"><?=$r->kategori_nama;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions" align="center">
                                <a onclick="printpreview()">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function printpreview() {
    var tgl_dari = $("#tgl_dari").val();
    var dari;
    if (tgl_dari == '') {
        dari     = 'all';
    } else {
        dari     = tgl_dari;
    }

    var tgl_sampai = $("#tgl_sampai").val();
    var sampai;
    if (tgl_sampai == '') {
        sampai     = 'all';
    } else {
        sampai     = tgl_sampai;
    }

    var kat = $("#lstKategori").val();
    var kategori;
    if (kat == '') {
        kategori = 'all';
    } else {
        kategori = kat;
    }

    var url         = "<?=site_url('admin/lap_penjualan/preview/');?>"+dari+"/"+sampai+"/"+kategori;
    window.open(url, "_blank"); // Open New Tab
}
</script>