<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring_m extends CI_Model
{
    public $table        = 'v_order_detail';
    public $column_order = array(null, null, 'meja_nama', 'menu_kode', 'menu_nama',
        'order_detail_qty', 'order_detail_harga', 'order_detail_waktu', 'order_detail_subtotal',
        'order_detail_status');
    public $column_search = array('meja_nama', 'menu_kode', 'menu_nama',
        'order_detail_qty', 'order_detail_harga', 'order_detail_waktu', 'order_detail_subtotal',
        'order_detail_status');
    public $order = array('order_detail_id' => 'desc', 'meja_nama' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        if ($this->input->post('lstMeja', 'true')) {
            $this->db->where('meja_id', $this->input->post('lstMeja', 'true'));
        }

        if ($this->input->post('lstStatus', 'true')) {
            $this->db->where('order_detail_status', $this->input->post('lstStatus', 'true'));
        }

        $this->db->select('v.*');
        $this->db->from('v_order_detail v');
        $this->db->join('resto_akses a', 'v.kategori_id = a.kategori_id');
        $this->db->where('v.order_tanggal', date('Y-m-d'));
        $this->db->where('a.user_username', $this->session->userdata('username'));
        $this->db->where('v.order_status', 2);

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('v.*');
        $this->db->from('v_order_detail v');
        $this->db->join('resto_akses a', 'v.kategori_id = a.kategori_id');
        $this->db->where('v.order_tanggal', date('Y-m-d'));
        $this->db->where('a.user_username', $this->session->userdata('username'));
        $this->db->where('v.order_status', 2);

        return $this->db->count_all_results();
    }
}
/* Location: ./application/models/admin/Monitoring_m.php */
