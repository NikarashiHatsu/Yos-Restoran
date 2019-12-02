<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menuorder extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->model('front/menuorder_m');
    }

    public function index()
    {
        redirect(site_url('my_error'));
    }

    public function detail($menu_seo)
    {
        $data['detail'] = $this->db->get_where('v_menu', array('menu_seo' => $menu_seo))->row();
        // $data['listMenu'] = $this->db->order_by('menu_nama', 'asc')->get_where('v_menu', array('kategori_seo' => $kategori_seo))->result();
        $this->template_front->display('front/menuorder_v', $data);
    }
}
/* Location: ./application/controller/front/Menuorder.php */
