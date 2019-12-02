<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->cek_auth_operator();
        $this->load->library('template');
        $this->load->model('operator/home_m');
    }

    public function index()
    {
        // $data['TotalPasar']    = $this->db->get('sipp_pasar')->result();
        // $data['TotalPedagang'] = $this->db->get_where('sipp_dasar', array('dasar_data' => 1))->result();
        // $data['piutang']       = $this->db->select_sum('skrd_total', 'total')->get_where('sipp_skrd', array('YEAR(skrd_tgl)' => date('Y'), 'skrd_status' => 1))->row();
        // $data['bayar']         = $this->db->select_sum('skrd_total', 'total')->get_where('sipp_skrd', array('YEAR(skrd_tgl_bayar)' => date('Y'), 'skrd_status' => 2))->row();
        $this->template->display('operator/home_v');
    }
}
/* Location: ./application/controller/operator/Home.php */
