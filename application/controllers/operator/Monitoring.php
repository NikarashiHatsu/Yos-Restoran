<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_operator();
        $this->load->library('template');
        $this->load->model('operator/monitoring_m');
    }

    public function index()
    {
        $data['listData'] = $this->db->get_where('resto_meja')->result();
        $this->template->display('operator/monitoring/view', $data);
    }

    public function data_list()
    {
        $List = $this->monitoring_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row             = array();
            $order_detail_id = $r->order_detail_id;
            if ($r->order_detail_status == 1) {
                $row[] = '<input type="checkbox" name="checked_id[]" class="checkbox" value="' . $order_detail_id . '"/>';
            } else {
                $row[] = '';
            }
            $row[] = $no;
            $row[] = $r->meja_nama;
            $row[] = $r->menu_kode;
            $row[] = $r->menu_nama;
            $row[] = number_format($r->order_detail_qty, 0, '', ',');
            $row[] = number_format($r->order_detail_harga, 0, '', ',');
            $row[] = $r->order_detail_waktu . ' Menit';
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

    public function prosesselesai()
    {
        header("Content-type:application/json");
        $post = $this->input->post('checked_id');
        if (is_array($post) && count($post) > 0) {
            $idArr = $this->input->post('checked_id', 'true');
            foreach ($idArr as $order_detail_id) {
                $data = array(
                    'order_detail_status' => 2,
                    'order_detail_update' => date('Y-m-d H:i:s'),
                );

                $this->db->where('order_detail_id', $order_detail_id);
                $this->db->update('resto_order_detail', $data);
            }
            $response['status'] = 'success';
        } else {
            $response['status'] = 'nodata';
        }

        echo json_encode($response);
    }
}
/* Location: ./application/controller/operator/Monitoring.php */
