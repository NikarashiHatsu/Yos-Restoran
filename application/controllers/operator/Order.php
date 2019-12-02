<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_operator();
        $this->load->library('template');
        $this->load->model('operator/order_m');
    }

    public function index()
    {
        $this->template->display('operator/order/view');
    }

    public function data_list()
    {
        $List = $this->order_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row      = array();
            $order_id = $r->order_id;
            if ($r->order_status == 1 && $r->order_status == 1) {
                $konfirmasi = '<a onclick="konfirmData(' . $order_id . ')" title="Konfirmasi Order"><i class="icon-check"></i></a>';
                $hapus      = '<a onclick="hapusData(' . $order_id . ')" title="Hapus Order"><i class="icon-close"></i></a>';
                $print      = '';
            } elseif ($r->order_status == 2 && $r->order_status == 2) {
                $konfirmasi = '';
                $hapus      = '';
                $print      = '<a onclick="printNota(' . $order_id . ')" title="Print Nota"><i class="icon-printer"></i></a>';
            } else {
                $konfirmasi = '';
                $hapus      = '';
                $print      = '';
            }
            $link  = site_url('operator/order/editdata/' . $r->order_id);
            $row[] = '<a href="' . $link . '" title="Detail Order"><i class="icon-screen-tablet"></i></a> ' . $konfirmasi . ' ' . $hapus . ' ' . $print;
            $row[] = $no;
            $row[] = $r->order_id;
            $row[] = date('d-m-Y', strtotime($r->order_tanggal));
            $row[] = $r->order_nama;
            $row[] = $r->meja_nama;
            $row[] = $r->order_waktu;
            $row[] = number_format($r->order_qty, 0, '', ',');
            $row[] = number_format($r->order_total, 0, '', ',');
            if ($r->order_status == 1) {
                $confirm = '<span class="label label-danger">Belum Konfirm</span>';
            } else {
                $confirm = '<span class="label label-success">Konfirm</span>';
            }
            $row[] = $confirm;
            if ($r->order_status == 1) {
                $status = '<span class="label label-danger">Belum Bayar</span>';
            } else {
                $status = '<span class="label label-success">Bayar</span>';
            }
            $row[]  = $status;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->order_m->count_all(),
            "recordsFiltered" => $this->order_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function adddata()
    {
        $username = $this->session->userdata('username');
        $NoOrder  = $this->order_m->getnoorder($username);
        // Insert ke Table Order
        $data = array(
            'order_no'      => $NoOrder,
            'user_username' => $username,
            'order_tanggal' => date('Y-m-d'),
            'order_update'  => date('Y-m-d H:i:s'),
        );

        $this->db->insert('resto_order', $data);
        $order_id = $this->db->insert_id();
        redirect(site_url('operator/order/editdata/' . $order_id . '/' . $NoOrder));
    }

    public function editdata($order_id)
    {
        $data['detail'] = $this->db->get_where('v_order', array('order_id' => $order_id))->row();
        $this->template->display('operator/order/edit', $data);
    }

    public function data_menu_list()
    {
        $List = $this->order_m->get_menu_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row     = array();
            $menu_id = $r->menu_id;
            $row[]   = '<a title="Pilih Menu" class="pilihData"  data-id="' . $menu_id . '" data-code="' . $r->menu_kode . '" data-name="' . trim($r->menu_nama) . '" data-harga="' . $r->menu_harga . '" data-waktu="' . $r->menu_waktu . '"><i class="icon-check"></i></a>';
            $row[]   = $no;
            $row[]   = $r->menu_kode;
            $row[]   = $r->menu_nama;
            $row[]   = $r->kategori_nama;
            $row[]   = $r->menu_waktu;
            $row[]   = number_format($r->menu_harga, 0, '', ',');
            $data[]  = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->order_m->count_menu_all(),
            "recordsFiltered" => $this->order_m->count_menu_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function confirmdata($id)
    {
        $this->order_m->confirm_data($id);
    }

    public function deletedata($id)
    {
        $this->order_m->delete_data($id);
    }

    public function data_order_list($order_id)
    {
        $List = $this->order_m->get_order_datatables($order_id);
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row             = array();
            $order_detail_id = $r->order_detail_id;
            if ($r->order_status == 1) {
                $row[] = '<a title="Edit Data" href="javascript:void(0)" onclick="editData(' . "'" . $order_detail_id . "'" . ')"><i class="icon-pencil"></i></a>
                                <a onclick="hapusData(' . $order_detail_id . ')" title="Delete Data"><i class="icon-close"></i></a>';
            } else {
                $row[] = '';
            }
            $row[] = $no;
            $row[] = $r->menu_kode;
            $row[] = $r->menu_nama;
            $row[] = number_format($r->order_detail_qty, 0, '', ',');
            $row[] = number_format($r->order_detail_harga, 0, '', ',');
            $row[] = $r->order_detail_waktu;
            $row[] = number_format($r->order_detail_subtotal, 0, '', ',');
            if ($r->order_detail_status == 1) {
                $status = '<span class="label label-primary">Baru</span>';
            } else {
                $status = '<span class="label label-success">Selesai</span>';
            }
            $row[]  = $status;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->order_m->count_order_all($order_id),
            "recordsFiltered" => $this->order_m->count_order_filtered($order_id),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function saveitem()
    {
        $order_id  = $this->input->post('order_id', 'true');
        $menu_id   = $this->input->post('menu_id', 'true');
        $checkMenu = $this->db->get_where('resto_order_detail', array('menu_id' => $menu_id, 'order_id' => $order_id))->row();
        if (count($checkMenu) > 0) {
            $response['status'] = 'info';
        } else {
            $this->order_m->insert_data_item();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function updateitem()
    {
        $this->order_m->update_data_item();
    }

    public function get_data_total($order_id)
    {
        $data = $this->db->select_sum('order_detail_waktu', 'waktu')->select_sum('order_detail_qty', 'qty')->select_sum('order_detail_subtotal', 'total')->get_where('resto_order_detail', array('order_id' => $order_id))->row();
        echo json_encode($data);
    }

    public function get_data_detail($order_detail_id)
    {
        $data = $this->db->get_where('v_order_detail', array('order_detail_id' => $order_detail_id))->row();
        echo json_encode($data);
    }

    public function get_data($order_id)
    {
        $data = $this->db->get_where('v_order', array('order_id' => $order_id))->row();
        echo json_encode($data);
    }

    public function deletedataitem($id)
    {
        $this->order_m->delete_data_item($id);
    }

    public function bayar()
    {
        $order_id   = $this->input->post('id', 'true');
        $dataJumlah = $this->db->select_sum('order_detail_qty', 'qty')->get_where('resto_order_detail', array('order_id' => $order_id))->row();
        $qty        = $dataJumlah->qty;
        $data       = array(
            'order_diskon'    => intval(str_replace(",", "", $this->input->post('diskon', 'true'))),
            'order_bayar'     => intval(str_replace(",", "", $this->input->post('bayar', 'true'))),
            'order_kembali'   => intval(str_replace(",", "", $this->input->post('kembali', 'true'))),
            'order_tgl_bayar' => date('Y-m-d'),
            'user_username'   => $this->session->userdata('username'),
            'order_status'    => 2, // Bayar
            'order_update'    => date('Y-m-d H:i:s'),
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('resto_order', $data);

        // Update Detail Order jadi Selesai
        $dataDetail = array(
            'order_detail_status' => 2,
            'order_detail_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('resto_order_detail', $dataDetail);

        // Item Order
        $listItem = $this->db->get_where('resto_order_detail', array('order_id' => $order_id))->result();
        foreach ($listItem as $i) {
            $menu_id  = $i->menu_id;
            $Jual     = $this->db->get_where('resto_menu', array('menu_id' => $menu_id))->row();
            $dataMenu = array(
                'menu_jual' => ($Jual->menu_jual + $i->order_detail_qty),
            );

            $this->db->where('menu_id', $menu_id);
            $this->db->update('resto_menu', $dataMenu);
        }

        $this->cetaknotabayar($order_id);
    }

    public function cetaknotabayar($order_id)
    {
        $dataToko    = $this->db->get_where('resto_contact', array('contact_id' => 1))->row();
        $dataOrder   = $this->db->get_where('v_order', array('order_id' => $order_id))->row();
        $listItem    = $this->db->get_where('v_order_detail', array('order_id' => $order_id))->result();
        $tmpdir      = sys_get_temp_dir(); # ambil direktori temporary untuk simpan file.
        $file        = tempnam($tmpdir, 'cetak'); # nama file temporary yang akan dicetak
        $handle      = fopen($file, 'w');
        $bold0       = Chr(27) . Chr(69);
        $bold1       = Chr(27) . Chr(70);
        $initialized = chr(27) . chr(64);
        $leftMargin  = chr(27) . chr(108) . chr(1);
        $condensed   = Chr(27) . Chr(33) . Chr(4);
        $draft       = Chr(27) . Chr(120) . Chr(48);
        $Data        = $initialized;
        $Data .= $leftMargin;
        $Data .= $condensed;
        $Data .= $draft;
        $NamaToko   = trim($dataToko->contact_name);
        $AlamatToko = trim($dataToko->contact_address);
        $TelpToko   = trim($dataToko->contact_phone);
        $NoOrder    = trim($dataOrder->order_id);
        $Tanggal    = date('d-m-Y', strtotime($dataOrder->order_tanggal));
        $Kasir      = trim($dataOrder->user_username);
        $Data .= $this->addHeader($NamaToko, $AlamatToko, $TelpToko, $NoOrder, $Tanggal, $Kasir);
        foreach ($listItem as $r) {
            $NamaMenu = trim($r->menu_nama);
            $Harga    = number_format($r->order_detail_harga, 0, '', ',');
            $Qty      = number_format($r->order_detail_qty, 0, '', ',');
            $Subtotal = number_format($r->order_detail_subtotal, 0, '', ',');
            $Data .= $this->addItem($NamaMenu, $Harga, $Qty, $Subtotal);
        }

        $SubTotal = number_format($dataOrder->order_total, 0, '', ',');
        $Diskon   = number_format($dataOrder->order_diskon, 0, '', ',');
        $Total    = number_format(($dataOrder->order_total - $dataOrder->order_diskon), 0, '', ',');
        $Data .= $this->addFooter($SubTotal, $Diskon, $Total);
        fwrite($handle, $Data);
        fclose($handle);
        $time        = time();
        $filename    = "Nota_" . $time;
        $pdfFilePath = FCPATH . "/download/$filename.txt";
        copy($file, $pdfFilePath);

        // $printer        = $this->db->get_where('resto_printer', array('printer_tipe' => 'Nota'))->row();
        // $lokasi_printer = $printer->printer_lokasi;
        // copy($file, $lokasi_printer);
        // unlink($file);
    }

    public function cetaknota()
    {
        $tmpdir      = sys_get_temp_dir(); # ambil direktori temporary untuk simpan file.
        $file        = tempnam($tmpdir, 'ctk'); # nama file temporary yang akan dicetak
        $handle      = fopen($file, 'w');
        $condensed   = Chr(27) . Chr(33) . Chr(4);
        $bold1       = Chr(27) . Chr(69);
        $bold0       = Chr(27) . Chr(70);
        $initialized = chr(27) . chr(64);
        $condensed1  = chr(15);
        $condensed0  = chr(18);
        $Data        = $initialized;
        $Data .= $condensed1;
        $Data .= "==========================\n";
        $Data .= "|     " . $bold1 . "OFIDZ MAJEZTY" . $bold0 . "      |\n";
        $Data .= "==========================\n";
        $Data .= "Ofidz Majezty is here\n";
        $Data .= "We Love PHP Indonesia\n";
        $Data .= "We Love PHP Indonesia\n";
        $Data .= "We Love PHP Indonesia\n";
        $Data .= "--------------------------\n";

        fwrite($handle, $Data);
        fclose($handle);
        $printer        = $this->db->get_where('resto_printer', array('printer_tipe' => 'Nota'))->row();
        $lokasi_printer = $printer->printer_lokasi;
        copy($file, '//127.0.0.1/EPSONTM-T82');
        unlink($file);
    }

    public function addHeader($NamaToko, $AlamatToko, $TelpToko, $NoOrder, $Tanggal, $Kasir)
    {
        $returnValue = "";
        $limitHeader = 28;
        $txtToko     = "";
        $txtAlamat   = "";
        $txtTelp     = "";

        if (strlen($NamaToko) <= $limitHeader) {
            $txtToko = str_pad($NamaToko, $limitHeader);
        } else {
            $txtToko = substr($NamaToko, 0, $limitHeader);
        }

        if (strlen($AlamatToko) <= $limitHeader) {
            $txtAlamat = str_pad($AlamatToko, $limitHeader);
        } else {
            $txtAlamat = substr($AlamatToko, 0, $limitHeader);
        }

        if (strlen($TelpToko) <= $limitHeader) {
            $txtTelp = str_pad($TelpToko, $limitHeader);
        } else {
            $txtTelp = substr($TelpToko, 0, $limitHeader);
        }
        $returnValue .= "" . chr(10);
        $returnValue .= "Toko      : " . $txtToko . chr(10);
        $returnValue .= "Alamat    : " . $txtAlamat . chr(10);
        $returnValue .= "No. Telp  : " . $txtTelp . chr(10);
        $returnValue .= chr(10);
        $returnValue .= "No. Order : " . $NoOrder . chr(10);
        $returnValue .= "Tanggal   : " . $Tanggal . chr(10);
        $returnValue .= "Kasir     : " . $Kasir . chr(10);
        $returnValue .= "========================================" . chr(10);
        $returnValue .= "Menu                 Harga Qty  Subtotal" . chr(10);
        $returnValue .= "========================================" . chr(10);
        return $returnValue;
    }

    public function addItem($NamaMenu, $Harga, $Qty, $Subtotal)
    {
        // LimitCharacter
        $limitNamaMenu = 18;
        $limitHarga    = 7;
        $limitQty      = 3;
        $limitSubtotal = 9;
        // Variabel
        $txtNamaMenu = "";
        $txtHarga    = 0;
        $txtQty      = 0;
        $txtSubtotal = 0;

        // Nama Menu
        if (strlen($NamaMenu) <= $limitNamaMenu) {
            $txtNamaMenu = str_pad($NamaMenu, $limitNamaMenu);
        } else {
            $txtNamaMenu = substr($NamaMenu, 0, $limitNamaMenu);
        }

        // Harga
        if (strlen($Harga) <= $limitHarga) {
            $txtHarga = str_pad($Harga, $limitHarga, " ", STR_PAD_LEFT);
        } else {
            $txtHarga = substr($Harga, 0, $limitHarga);
        }

        // Qty
        if (strlen($Qty) <= $limitQty) {
            $txtQty = str_pad($Qty, $limitQty, " ", STR_PAD_LEFT);
        } else {
            $txtQty = substr($Qty, 0, $limitQty);
        }

        // Subtotal
        if (strlen($Subtotal) <= $limitSubtotal) {
            $txtSubtotal = str_pad($Subtotal, $limitSubtotal, " ", STR_PAD_LEFT);
        } else {
            $txtSubtotal = substr($Subtotal, 0, $limitSubtotal);
        }

        $returnValue = "" . $txtNamaMenu . " " . $txtHarga . " " . $txtQty . " " . $txtSubtotal . chr(10);
        return $returnValue;
    }

    public function addFooter($SubTotal, $Diskon, $Total)
    {

        // LimitCharacter
        $limitNominal = 9;
        // Variabel
        $txtSubTotal = 0;
        $txtDiskon   = 0;
        $txtPajak    = 0;
        $txtTotal    = 0;

        // Sub Total
        if (strlen($SubTotal) <= $limitNominal) {
            $txtSubTotal = str_pad($SubTotal, $limitNominal, " ", STR_PAD_LEFT);
        } else {
            $txtSubTotal = substr($SubTotal, 0, $limitNominal);
        }

        // Diskon
        if (strlen($Diskon) <= $limitNominal) {
            $txtDiskon = str_pad($Diskon, $limitNominal, " ", STR_PAD_LEFT);
        } else {
            $txtDiskon = substr($Diskon, 0, $limitNominal);
        }

        // Total
        if (strlen($Total) <= $limitNominal) {
            $txtTotal = str_pad($Total, $limitNominal, " ", STR_PAD_LEFT);
        } else {
            $txtTotal = substr($Total, 0, $limitNominal);
        }

        $returnValue = "" . chr(10);
        $returnValue .= "                   Sub Total : " . $txtSubTotal . chr(10);
        $returnValue .= "                      Diskon : " . $txtDiskon . chr(10);
        $returnValue .= "                       TOTAL : " . $txtTotal . chr(10);
        $returnValue .= "----------------------------------------" . chr(10);
        $returnValue .= "Terima Kasih atas kunjungan Anda" . chr(10);
        $returnValue .= "" . chr(10);
        $returnValue .= "" . chr(10);
        return $returnValue;
    }
}
/* Location: ./application/controller/operator/Order.php */
