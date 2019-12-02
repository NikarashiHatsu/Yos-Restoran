<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Social extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/social_m');
    }

    public function index()
    {
        $this->template->display('admin/master/social_v');
    }

    public function data_list()
    {
        $List = $this->social_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row       = array();
            $social_id = $r->social_id;

            $row[] = '  <a title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $social_id . "'" . ')">
                        <i class="icon-pencil"></i>
                        </a>
                        <a onclick="hapusData(' . $social_id . ')" title="Delete Data">
                            <i class="icon-close"></i>
                        </a>';
            $row[] = $no;
            $row[] = $r->social_name;
            $row[] = $r->social_url;

            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->social_m->count_all(),
            "recordsFiltered" => $this->social_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $this->social_m->insert_data();
    }

    public function get_data($id)
    {
        $data = $this->social_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        $this->social_m->update_data();
    }

    public function deletedata($id)
    {
        $this->social_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Social.php */
