<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_m extends CI_Model
{
    public $table        = 'v_order';
    public $column_order = array(null, null, 'order_id', 'order_tanggal', 'order_nama',
        'meja_nama', 'order_waktu', null, null, 'order_status', 'order_status');
    public $column_search = array('order_id', 'order_tanggal', 'order_nama', 'meja_nama');
    public $order         = array('order_id' => 'desc');

    public $table1         = 'v_menu';
    public $column_order1  = array(null, null, 'menu_kode', 'menu_nama', 'kategori_nama', null, null);
    public $column_search1 = array('menu_kode', 'menu_nama');
    public $order1         = array('menu_nama' => 'asc');

    public $table2         = 'v_order_detail';
    public $column_order2  = array(null, null, null, null, null, null, null, null, null);
    public $column_search2 = array();
    public $order2         = array('menu_nama' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        if ($this->input->post('date_from', 'true')) {
            $tgl_dari = date('Y-m-d', strtotime($this->input->post('date_from', 'true')));
            $this->db->where('order_tanggal >=', $tgl_dari);
        }

        if ($this->input->post('date_to', 'true')) {
            $tgl_sampai = date('Y-m-d', strtotime($this->input->post('date_to', 'true')));
            $this->db->where('order_tanggal <=', $tgl_sampai);
        }

        if ($this->input->post('lstKonfirm', 'true')) {
            $this->db->where('order_status', $this->input->post('lstKonfirm', 'true'));
        }

        if ($this->input->post('lstStatus', 'true')) {
            $this->db->where('order_status', $this->input->post('lstStatus', 'true'));
        }

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

    public function confirm_data($id)
    {
        $data = array(
            'order_status' => 2,
            'order_update'  => date('Y-m-d H:i:s'),
        );

        $this->db->where('order_id', $id);
        $this->db->update('resto_order', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('order_id', $id);
        $this->db->delete('resto_order');
    }

    private function _get_menu_datatables_query()
    {
        $this->db->from($this->table1);

        $i = 0;
        foreach ($this->column_search1 as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search1) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order1)) {
            $order = $this->order1;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_menu_datatables()
    {
        $this->_get_menu_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_menu_filtered()
    {
        $this->_get_menu_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_menu_all()
    {
        $this->db->from($this->table1);
        return $this->db->count_all_results();
    }

    public function getnoorder($username)
    {
        $this->db->select('RIGHT(order_no, 5) as kode', false);
        $this->db->where('user_username', $username);
        $this->db->where('order_tanggal', date('Y-m-d'));
        $this->db->limit(1);
        $this->db->order_by('order_no', 'desc');
        $query = $this->db->get('resto_order');
        if ($query->num_rows() != 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }

        $nourut  = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $noorder = strtoupper(substr($username, 0, 3)) . '-' . date('Ymd') . '-' . $nourut;
        return $noorder;
    }

    private function _get_order_datatables_query($order_id)
    {
        $this->db->from($this->table2);
        $this->db->where('order_id', $order_id);

        $i = 0;
        foreach ($this->column_search2 as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search2) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order2)) {
            $order = $this->order2;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_order_datatables($order_id)
    {
        $this->_get_order_datatables_query($order_id);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_order_filtered($order_id)
    {
        $this->_get_order_datatables_query($order_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_order_all($order_id)
    {
        $this->db->from($this->table2);
        $this->db->where('order_id', $order_id);

        return $this->db->count_all_results();
    }

    public function insert_data_item()
    {
        $data = array(
            'order_id'              => $this->input->post('order_id', 'true'),
            'menu_id'               => $this->input->post('menu_id', 'true'),
            'order_detail_harga'    => intval(str_replace(",", "", $this->input->post('harga', 'true'))),
            'order_detail_qty'      => intval(str_replace(",", "", $this->input->post('qty', 'true'))),
            'order_detail_waktu'    => $this->input->post('waktu', 'true'),
            'order_detail_subtotal' => intval(str_replace(",", "", $this->input->post('total', 'true'))),
            'order_detail_update'   => date('Y-m-d H:i:s'),
        );

        $this->db->insert('resto_order_detail', $data);

        // Jumlahkan Order
        $order_id  = $this->input->post('order_id', 'true');
        $Order     = $this->db->select_sum('order_detail_qty', 'qty')->select_sum('order_detail_waktu', 'waktu')->select_sum('order_detail_subtotal', 'total')->get_where('resto_order_detail', array('order_id' => $order_id))->row();
        $dataOrder = array(
            'order_qty'   => $Order->qty,
            'order_waktu' => $Order->waktu,
            'order_total' => $Order->total,
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('resto_order', $dataOrder);
    }

    public function update_data_item()
    {
        $order_detail_id = $this->input->post('order_detail_id', 'true');
        $data            = array(
            'menu_id'               => $this->input->post('menu_id', 'true'),
            'order_detail_harga'    => intval(str_replace(",", "", $this->input->post('harga', 'true'))),
            'order_detail_qty'      => intval(str_replace(",", "", $this->input->post('qty', 'true'))),
            'order_detail_waktu'    => $this->input->post('waktu', 'true'),
            'order_detail_subtotal' => intval(str_replace(",", "", $this->input->post('total', 'true'))),
            'order_detail_update'   => date('Y-m-d H:i:s'),
        );

        $this->db->where('order_detail_id', $order_detail_id);
        $this->db->update('resto_order_detail', $data);

        // Jumlahkan Order
        $order_id  = $this->input->post('order_id', 'true');
        $Order     = $this->db->select_sum('order_detail_qty', 'qty')->select_sum('order_detail_waktu', 'waktu')->select_sum('order_detail_subtotal', 'total')->get_where('resto_order_detail', array('order_id' => $order_id))->row();
        $dataOrder = array(
            'order_qty'   => $Order->qty,
            'order_waktu' => $Order->waktu,
            'order_total' => $Order->total,
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('resto_order', $dataOrder);
    }

    public function delete_data_item($id)
    {
        $this->db->where('order_detail_id', $id);
        $this->db->delete('resto_order_detail');
    }
}
/* Location: ./application/models/operator/Order_m.php */
