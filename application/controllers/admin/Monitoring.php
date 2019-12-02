<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/monitoring_m');
    }

    public function index()
    {
        $data['listData'] = $this->db->get_where('resto_meja')->result();
        $this->template->display('admin/monitoring/view', $data);
    }

    public function data_list()
    {
        $List = $this->monitoring_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $r->meja_nama;
            $row[] = $r->menu_kode;
            $row[] = $r->menu_nama;
            $row[] = number_format($r->order_detail_qty, 0, '', ',');
            $row[] = number_format($r->order_detail_harga, 0, '', ',');
            $row[] = $r->order_detail_waktu.' Menit';
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
            "recordsTotal"    => $this->monitoring_m->count_all(),
            "recordsFiltered" => $this->monitoring_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }
}
/* Location: ./application/controller/admin/Monitoring.php */
