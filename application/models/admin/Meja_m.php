<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meja_m extends CI_Model
{
    public $table         = 'resto_meja';
    public $column_order  = array(null, null, 'meja_nama');
    public $column_search = array('meja_nama');
    public $order         = array('meja_nama' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function insert_data()
    {
        $data = array(
            'meja_nama'   => strtoupper(trim(stripHTMLtags($this->input->post('name', 'true')))),
            'meja_update' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('resto_meja', $data);
    }

    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('resto_meja');
        $this->db->where('meja_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $meja_id = $this->input->post('id', 'true');
        $data    = array(
            'meja_nama'   => strtoupper(trim(stripHTMLtags($this->input->post('name', 'true')))),
            'meja_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('meja_id', $meja_id);
        $this->db->update('resto_meja', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('meja_id', $id);
        $this->db->delete('resto_meja');
    }
}
/* Location: ./application/models/admin/Meja_m.php */
