<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function update_data()
    {
        $data = array(
            'contact_name'    => stripHTMLtags(trim($this->input->post('name', 'true'))),
            'contact_address' => stripHTMLtags(trim($this->input->post('address', 'true'))),
            'contact_phone'   => stripHTMLtags(trim($this->input->post('phone', 'true'))),
            'contact_email'   => stripHTMLtags(trim($this->input->post('email', 'true'))),
            'contact_web'     => stripHTMLtags(trim($this->input->post('web', 'true'))),
            'contact_update'  => date('Y-m-d H:i:s'),
        );

        $this->db->where('contact_id', 1);
        $this->db->update('resto_contact', $data);
    }
}
/* Location: ./application/model/admin/Kontak_m.php */
