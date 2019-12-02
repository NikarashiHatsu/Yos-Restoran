<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/slider_m');
    }

    public function index()
    {
        $this->template->display('admin/master/slider_v');
    }

    public function data_list()
    {
        $List = $this->slider_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];

        foreach ($List as $r) {
            $no++;
            $row       = array();
            $slider_id = $r->slider_id;
            $row[]     = '  <a title="Edit Data" href="javascript:void(0)" onclick="edit_data(' . "'" . $slider_id . "'" . ')">
                        <i class="icon-pencil"></i>
                        </a>
                        <a onclick="hapusData(' . $slider_id . ')" title="Delete Data">
                            <i class="icon-close"></i>
                        </a>';
            $row[]  = $no;
            $row[]  = '<img src=' . base_url('img/slider_folder/' . $r->slider_image) . ' width="50%">';
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->slider_m->count_all(),
            "recordsFiltered" => $this->slider_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function savedata()
    {
        $jam                     = time();
        $config['file_name']     = 'Slider_' . $jam . '.jpg';
        $config['upload_path']   = './img/slider_folder/';
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['overwrite']     = true;
        $config['max_size']      = 0;
        $this->load->library('upload');
        $this->upload->initialize($config);
        // Resize
        $configThumb                   = array();
        $configThumb['image_library']  = 'gd2';
        $configThumb['source_image']   = '';
        $configThumb['maintain_ratio'] = true;
        $configThumb['overwrite']      = true;
        $configThumb['width']          = 1500;
        $configThumb['height']         = 600;
        $this->load->library('image_lib');
        if (!$this->upload->do_upload('foto')) {
            $response['status'] = 'error';
        } else {
            $upload                      = $this->upload->do_upload('foto');
            $upload_data                 = $this->upload->data();
            $name_array[]                = $upload_data['file_name'];
            $configThumb['source_image'] = $upload_data['full_path'];
            $this->image_lib->initialize($configThumb);
            $this->image_lib->resize();
            $this->slider_m->insert_data();
            $response['status'] = 'success';
        }
        echo json_encode($response);
    }

    public function get_data($id)
    {
        $data = $this->slider_m->select_by_id($id)->row();
        echo json_encode($data);
    }

    public function updatedata()
    {
        $jam                     = time();
        $config['file_name']     = 'Slider_' . $jam . '.jpg';
        $config['upload_path']   = './img/slider_folder/';
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $config['overwrite']     = true;
        $config['max_size']      = 0;
        $this->load->library('upload');
        $this->upload->initialize($config);
        // Resize
        $configThumb                   = array();
        $configThumb['image_library']  = 'gd2';
        $configThumb['source_image']   = '';
        $configThumb['maintain_ratio'] = true;
        $configThumb['overwrite']      = true;
        $configThumb['width']          = 1500;
        $configThumb['height']         = 600;
        $this->load->library('image_lib');

        if (!$this->upload->do_upload('foto')) {
            $response['status'] = 'error';
        } else {
            $upload                      = $this->upload->do_upload('foto');
            $upload_data                 = $this->upload->data();
            $name_array[]                = $upload_data['file_name'];
            $configThumb['source_image'] = $upload_data['full_path'];
            $this->image_lib->initialize($configThumb);
            $this->image_lib->resize();

            $this->slider_m->update_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function deletedata($id)
    {
        $this->slider_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Slider.php */
