<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="<?=base_url('img/logo-icon.png');?>">
	<title>Laporan Data Penjualan</title>
</head>
<style type="text/css">
page {
  	background: white;
  	display: block;
  	margin: 0 auto;
  	margin-bottom: 2cm;
  	padding-top: 0.1cm;
  	padding-right: 0.3cm;
  	padding-left: 0.3cm;
  	padding-bottom: 0.5cm;
}
page[size="A4"] {  
  	width: 21cm;
  	height: 29.7cm; 
}
page[size="A4"][layout="portrait"] {
  	width: 29.7cm;
  	height: auto;  
}
page[size="A3"] {
  	width: 29.7cm;
  	height: 42cm;
}
page[size="A3"][layout="portrait"] {
  	width: 42cm;
  	height: 29.7cm;  
}
page[size="A5"] {
  	width: 14.8cm;
  	height: 21cm;
}
page[size="A5"][layout="portrait"] {
  	width: 21cm;
  	height: 14.8cm;  
}
table {
    border: 1px solid;
    border-collapse: collapse;
    width: 100%;
}

table, th, td {
	border: 1px solid black;
    padding: 2px;
    font-size: 12px;
}

th {
	height: 40px;
	text-align: center;
}	

th {
	height: 20px;
    background-color: #eff3f8;
    color: black;
}
	
th {
	padding: 5px;
}

td.label {
	padding-top: 30px;
    padding-bottom: 30px;
}

@media print{
    #comments_controls,
    #print-link{
        display:none;
    }
}
</style>

<body>
<a href="#Print">
    <img src="<?=base_url('img/print.png');?>" height="24" width="20" title="Print Laporan" id="print-link" onClick="window.print(); return false;" />
</a>
<page size="A4">
	<h3 align="center">LAPORAN PENJUALAN</h3>
	<table width="100%" cellpadding="1" cellspacing="0" border="1">
		<tr>
			<th width="3%">NO</th>
			<th>NAMA MENU</th>
			<th width="10%">QTY</th>
			<th width="10%">HARGA</th>
			<th width="10%">TOTAL</th>
		</tr>
		<?php 
		$qty    = 0;
		$total 	= 0;
		$no 	= 1;
		foreach($listData as $r) {
		?>
		<tr>
			<td align="center" valign="top"><?=$no;?></td>
			<td valign="top"><?=$r->menu_nama;?></td>
            <td valign="top" align="right"><?=number_format($r->order_detail_qty,0,'',',');?></td>
            <td valign="top" align="right"><?=number_format($r->order_detail_harga,0,'',',');?></td>
            <td valign="top" align="right"><?=number_format($r->order_detail_subtotal,0,'',',');?></td>
		</tr>
		<?php 
			$qty   = ($qty + $r->order_detail_qty);
			$total = ($total + $r->order_detail_subtotal);
			$no++;
		} 
		?>
		<tr>
			<td align="center" colspan="2"><b>TOTAL</b></td>
			<td align="right"><b><?=number_format($qty,0,'',',');?></b></td>
			<td align="right"></td>
			<td align="right"><b><?=number_format($total,0,'',',');?></b></td>
		</tr>
	</table>
</page>
</body>
</html>