<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select_detail()
    {
        $username = $this->session->userdata('username');

        $this->db->select('*');
        $this->db->from('resto_users');
        $this->db->where('user_username', $username);

        return $this->db->get();
    }

    public function update_data_diri()
    {
        $user_username = $this->session->userdata('username');
        $data          = array(
            'user_name'        => strtoupper(stripHTMLtags($this->input->post('name', 'true'))),
            'user_email'       => trim(stripHTMLtags($this->input->post('email', 'true'))),
            'user_date_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('user_username', $user_username);
        $this->db->update('resto_users', $data);
    }

    public function update_avatar($username)
    {
        $data = array(
            'user_avatar'      => $this->upload->file_name,
            'user_date_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('user_username', $username);
        $this->db->update('resto_users', $data);
    }

    public function update_password()
    {
        $user_username = $this->session->userdata('username');
        $password      = trim($this->input->post('newpassword', 'true'));

        $data = array(
            'user_password'    => sha1($password),
            'user_date_update' => date('Y-m-d H:i:s'),
        );

        $this->db->where('user_username', $user_username);
        $this->db->update('resto_users', $data);
    }
}
/* Location: ./application/model/Profil_m.php */
