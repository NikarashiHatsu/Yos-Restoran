<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_makanan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/menu_makanan_m');
        $this->resized_path = realpath(APPPATH . '../img/menu_folder');
        $this->thumbs_path  = realpath(APPPATH . '../img/menu_folder/thumbs');
    }

    public function index()
    {
        $data['listKategori'] = $this->db->order_by('kategori_nama', 'asc')->get('resto_kategori')->result();
        $this->template->display('admin/menu_makanan/view', $data);
    }

    public function data_list()
    {
        $List = $this->menu_makanan_m->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($List as $r) {
            $no++;
            $row      = array();
            $menu_id  = $r->menu_id;
            $linkedit = site_url('admin/menu_makanan/editdata/' . $menu_id);
            $row[]    = '  <a href="' . $linkedit . '" title="Edit Data">
                                <i class="icon-pencil"></i>
                            </a>
                            <a onclick="hapusData(' . $menu_id . ')" title="Hapus Data">
                                <i class="icon-close"></i>
                            </a>';
            $row[]  = $no;
            $row[]  = '<img src="' . base_url('img/menu_folder/thumbs/' . $r->menu_foto . '" width="150px" height="100px">');
            $row[]  = $r->menu_kode;
            $row[]  = $r->menu_nama;
            $row[]  = $r->kategori_nama;
            $row[]  = $r->menu_waktu;
            $row[]  = number_format($r->menu_harga, 0, '', ',');
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->menu_makanan_m->count_all(),
            "recordsFiltered" => $this->menu_makanan_m->count_filtered(),
            "data"            => $data,
        );

        echo json_encode($output);
    }

    public function adddata()
    {
        $data['listKategori'] = $this->db->order_by('kategori_nama', 'asc')->get('resto_kategori')->result();
        $this->template->display('admin/menu_makanan/add', $data);
    }

    private function nama_exists($nama)
    {
        $this->db->where('menu_nama', $nama);
        $query = $this->db->get('resto_menu');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register_nama_exists()
    {
        if (array_key_exists('nama', $_POST)) {
            if ($this->nama_exists(stripHTMLtags($this->input->post('nama', 'true'))) == true) {
                echo json_encode(false);
            } else {
                echo json_encode(true);
            }
        }
    }

    public function savedata()
    {
        if (!empty($_FILES['foto']['name'])) {
            $jam                     = time();
            $nama                    = seo_title(stripHTMLtags($this->input->post('nama')));
            $config['file_name']     = 'Menu_makanan_' . $nama . '_' . $jam . '.jpg';
            $config['upload_path']   = './img/menu_folder/';
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['overwrite']     = true;
            $config['max_size']      = 0;
            $config['width']         = 300;
            $config['height']        = 250;
            $this->load->library('upload');
            $this->upload->initialize($config);
            $configThumb                   = array();
            $configThumb['image_library']  = 'gd2';
            $configThumb['source_image']   = '';
            $configThumb['maintain_ratio'] = true;
            $configThumb['overwrite']      = true;
            $this->load->library('image_lib');
            if (!$this->upload->do_upload('foto')) {
                $response['status'] = 'error';
            } else {
                $upload      = $this->upload->do_upload('foto');
                $upload_data = $this->upload->data();
                $config      = array(
                    'file_name'      => $upload_data['file_name'],
                    'source_image'   => $upload_data['full_path'], //path to the uploaded image
                    'new_image'      => $this->resized_path, //path to
                    'maintain_ratio' => true,
                    'overwrite'      => true,
                    'width'          => 300,
                    'height'         => 300,
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $config = array(
                    'source_image'   => $upload_data['full_path'],
                    'new_image'      => $this->thumbs_path,
                    'maintain_ratio' => true,
                    'overwrite'      => true,
                    'width'          => 150,
                    'height'         => 125,
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $this->menu_makanan_m->insert_data();
                $response['status'] = 'success';
            }
        } else {
            $this->menu_makanan_m->insert_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function editdata($menu_id)
    {
        $data['listKategori'] = $this->db->order_by('kategori_nama', 'asc')->get('resto_kategori')->result();
        $data['detail']       = $this->db->get_where('resto_menu', array('menu_id' => $menu_id))->row();
        $this->template->display('admin/menu_makanan/edit', $data);
    }

    public function updatedata()
    {
        if (!empty($_FILES['foto']['name'])) {
            $jam                     = time();
            $nama                    = seo_title(stripHTMLtags($this->input->post('nama')));
            $config['file_name']     = 'Menu_makanan_' . $nama . '_' . $jam . '.jpg';
            $config['upload_path']   = './img/menu_folder/';
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['overwrite']     = true;
            $config['max_size']      = 0;
            $config['width']         = 300;
            $config['height']        = 250;
            $this->load->library('upload');
            $this->upload->initialize($config);
            $configThumb                   = array();
            $configThumb['image_library']  = 'gd2';
            $configThumb['source_image']   = '';
            $configThumb['maintain_ratio'] = true;
            $configThumb['overwrite']      = true;
            $this->load->library('image_lib');
            if (!$this->upload->do_upload('foto')) {
                $response['status'] = 'error';
            } else {
                $upload      = $this->upload->do_upload('foto');
                $upload_data = $this->upload->data();
                $config      = array(
                    'file_name'      => $upload_data['file_name'],
                    'source_image'   => $upload_data['full_path'], //path to the uploaded image
                    'new_image'      => $this->resized_path, //path to
                    'maintain_ratio' => true,
                    'overwrite'      => true,
                    'width'          => 300,
                    'height'         => 300,
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $config = array(
                    'source_image'   => $upload_data['full_path'],
                    'new_image'      => $this->thumbs_path,
                    'maintain_ratio' => true,
                    'overwrite'      => true,
                    'width'          => 150,
                    'height'         => 125,
                );

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $this->menu_makanan_m->update_data();
                $response['status'] = 'success';
            }
        } else {
            $this->menu_makanan_m->update_data();
            $response['status'] = 'success';
        }

        echo json_encode($response);
    }

    public function deletedata($id)
    {
        $this->menu_makanan_m->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
/* Location: ./application/controller/admin/Menu_makanan.php */
