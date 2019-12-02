<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meta_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_detail($meta_id = 1)
    {
        $this->db->select('*');
        $this->db->from('resto_meta');
        $this->db->where('meta_id', $meta_id);

        return $this->db->get();
    }

    public function update_data()
    {
        $data = array(
            'meta_name'   => stripHTMLtags($this->input->post('name', 'true')),
            'meta_desc'   => trim($this->input->post('desc', 'true')),
            'meta_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('meta_id', 1);
        $this->db->update('resto_meta', $data);
    }
}
/* Location: ./application/models/admin/Meta_m.php */
