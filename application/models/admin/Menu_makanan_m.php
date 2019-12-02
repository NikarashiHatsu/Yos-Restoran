<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_makanan_m extends CI_Model
{
    public $table        = 'v_menu';
    public $column_order = array(null, null, null, 'menu_kode', 'menu_nama', 'kategori_nama',
        'menu_waktu', 'menu_harga');
    public $column_search = array('menu_kode', 'menu_nama', 'kategori_nama');
    public $order         = array('menu_kode' => 'asc', 'menu_nama' => 'asc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {
        if ($this->input->post('lstKategori', 'true')) {
            $this->db->where('kategori_id', $this->input->post('lstKategori', 'true'));
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

    public function getkodeurut()
    {
        $this->db->select('menu_kode as kode', false);
        $this->db->limit(1);
        $this->db->order_by('menu_kode', 'desc');
        $query = $this->db->get('resto_menu');
        if ($query->num_rows() != 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemenu = str_pad($kode, 5, "0", STR_PAD_LEFT);
        return $kodemenu;
    }

    public function insert_data()
    {
        $kode = $this->menu_makanan_m->getkodeurut();
        $data = array(
            'menu_kode'      => $kode,
            'menu_nama'      => strtoupper(trim(stripHTMLtags($this->input->post('nama', 'true')))),
            'menu_seo'       => seo_title(trim(stripHTMLtags($this->input->post('nama', 'true')))),
            'menu_deskripsi' => trim($this->input->post('deskripsi', 'true')),
            'kategori_id'    => trim($this->input->post('lstKategori', 'true')),
            'menu_harga'     => intval(str_replace(",", "", $this->input->post('harga', 'true'))),
            'menu_waktu'     => intval(str_replace(",", "", $this->input->post('waktu', 'true'))),
            'menu_foto'      => $this->upload->file_name,
            'menu_update'    => date('Y-m-d H:i:s'),
        );

        $this->db->insert('resto_menu', $data);
    }

    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('resto_menu');
        $this->db->where('menu_id', $id);

        return $this->db->get();
    }

    public function update_data()
    {
        $menu_id = $this->input->post('id', 'true');

        if (!empty($_FILES['foto']['name'])) {
            $data = array(
                'menu_nama'      => strtoupper(trim(stripHTMLtags($this->input->post('nama', 'true')))),
                'menu_seo'       => seo_title(trim(stripHTMLtags($this->input->post('nama', 'true')))),
                'menu_deskripsi' => trim($this->input->post('deskripsi', 'true')),
                'kategori_id'    => trim($this->input->post('lstKategori', 'true')),
                'menu_harga'     => intval(str_replace(",", "", $this->input->post('harga', 'true'))),
                'menu_waktu'     => intval(str_replace(",", "", $this->input->post('waktu', 'true'))),
                'menu_foto'      => $this->upload->file_name,
                'menu_update'    => date('Y-m-d H:i:s'),
            );
        } else {
            $data = array(
                'menu_nama'      => strtoupper(trim(stripHTMLtags($this->input->post('nama', 'true')))),
                'menu_seo'       => seo_title(trim(stripHTMLtags($this->input->post('nama', 'true')))),
                'menu_deskripsi' => trim($this->input->post('deskripsi', 'true')),
                'kategori_id'    => trim($this->input->post('lstKategori', 'true')),
                'menu_harga'     => intval(str_replace(",", "", $this->input->post('harga', 'true'))),
                'menu_waktu'     => intval(str_replace(",", "", $this->input->post('waktu', 'true'))),
                'menu_update'    => date('Y-m-d H:i:s'),
            );
        }

        $this->db->where('menu_id', $menu_id);
        $this->db->update('resto_menu', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('menu_id', $id);
        $this->db->delete('resto_menu');
    }
}
/* Location: ./application/models/admin/Menu_makanan_m.php */
