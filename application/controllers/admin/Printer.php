<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Printer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/printer_m');
    }

    public function index()
    {
        $this->template->display('admin/master/printer_v');
    }

    public function data_list()
    {
        $List = $this->printer_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row        = array();
            $printer_id = $r->printer_id;
            $row[]      = '<a title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $printer_id . "'" . ')">
                            <i class="icon-pencil"></i>
                        </a>
                        <a onclick="hapusData(' . $printer_id . ')" title="Delete Data">
                            <i class="icon-close"></i>
                        </a>';
            $row[]  = $no;
            $row[]  = $r->printer_nama;
            $row[]  = $r->printer_lokasi;
            $row[]  = $r->printer_tipe;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->printer_m->count_all(),
            "recordsFiltered" => $this->printer_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $this->printer_m->insert_data();
    }

    public function get_data($id)
    {
        $data = $this->printer_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        $this->printer_m->update_data();
    }

    public function deletedata($id)
    {
        $this->printer_m->delete_data($id);
    }
}
/* Location: ./application/controller/admin/Printer.php */
