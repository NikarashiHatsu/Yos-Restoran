<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/kategori_m');
    }

    public function index()
    {
        $this->template->display('admin/master/kategori_v');
    }

    public function data_list()
    {
        $List = $this->kategori_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row         = array();
            $kategori_id = $r->kategori_id;
            $row[]       = '<a title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $kategori_id . "'" . ')">
                            <i class="icon-pencil"></i>
                        </a>
                        <a onclick="hapusData(' . $kategori_id . ')" title="Delete Data">
                            <i class="icon-close"></i>
                        </a>';
            $row[]  = $no;
            $row[]  = $r->kategori_nama;
            $row[]  = $r->kategori_icon;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->kategori_m->count_all(),
            "recordsFiltered" => $this->kategori_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $this->kategori_m->insert_data();
    }

    public function get_data($id)
    {
        $data = $this->kategori_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        $this->kategori_m->update_data();
    }

    public function deletedata($id)
    {
        $this->kategori_m->delete_data($id);
    }
}
/* Location: ./application/controller/admin/Kategori.php */
