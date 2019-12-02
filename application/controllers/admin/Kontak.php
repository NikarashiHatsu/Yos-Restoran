<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/kontak_m');
    }

    public function index()
    {
        $data['detail'] = $this->db->get_where('resto_contact', array('contact_id' => 1))->row();
        $this->template->display('admin/master/kontak_v', $data);
    }

    public function updatedata()
    {
        $this->kontak_m->update_data();
    }
}
/* Location: ./application/controllers/admin/Kontak.php */
