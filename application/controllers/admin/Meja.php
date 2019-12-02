<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meja extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/meja_m');
    }

    public function index()
    {
        $this->template->display('admin/master/meja_v');
    }

    public function data_list()
    {
        $List = $this->meja_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row     = array();
            $meja_id = $r->meja_id;
            $row[]   = '<a title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $meja_id . "'" . ')">
                            <i class="icon-pencil"></i>
                        </a>
                        <a onclick="hapusData(' . $meja_id . ')" title="Delete Data">
                            <i class="icon-close"></i>
                        </a>';
            $row[]  = $no;
            $row[]  = $r->meja_nama;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->meja_m->count_all(),
            "recordsFiltered" => $this->meja_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $this->meja_m->insert_data();
    }

    public function get_data($id)
    {
        $data = $this->meja_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        $this->meja_m->update_data();
    }

    public function deletedata($id)
    {
        $this->meja_m->delete_data($id);
    }
}
/* Location: ./application/controller/admin/Meja.php */
