<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_admin();
        $this->load->library('template');
        $this->load->model('admin/home_m');
    }

    public function index()
    {
        $data['TotalMenu']   = $this->db->get('resto_menu')->result();
        $data['TotalMonth'] = $this->db->select_sum('order_total', 'total')->get_where('resto_order', array('order_status' => 2, 'MONTH(order_tanggal)' => date('m'), 'YEAR(order_tanggal)' => date('Y')))->row();
        $data['TotalIncome']  = $this->db->select_sum('order_total', 'total')->get_where('resto_order', array('order_status' => 2))->row();
        $this->template->display('admin/home_v', $data);
    }
}
/* Location: ./application/controller/admin/Home.php */
