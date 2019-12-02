<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->model('front/kategori_m');
    }

    public function index()
    {
        redirect(site_url('my_error'));
    }

    public function tipe($kategori_seo)
    {
        $data['detail']   = $this->db->get_where('resto_kategori', array('kategori_seo' => $kategori_seo))->row();
        $data['listMenu'] = $this->db->order_by('menu_nama', 'asc')->get_where('v_menu', array('kategori_seo' => $kategori_seo))->result();
        $this->template_front->display('front/kategori_v', $data);
    }
}
/* Location: ./application/controller/front/Kategori.php */
