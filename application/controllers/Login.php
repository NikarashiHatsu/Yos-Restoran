<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_m');
        $this->load->library('template_login');
    }

    public function index()
    {
        $this->template_login->display('admin/login_v');
    }

    public function validasi()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->template_login->display('admin/login_v');
        } else {
            $username  = stripHTMLtags(trim($this->input->post('username', 'true')));
            $password  = stripHTMLtags(trim($this->input->post('password', 'true')));
            $temp_user = $this->login_m->get_user($username)->row();
            $num_user  = count($temp_user);
            if ($num_user == 0) {
                $this->session->set_flashdata('notification', '<b>Username Anda Tidak Terdaftar.</b>');
                redirect(site_url('login'));
            } elseif ($num_user > 0) {
                $temp_account = $this->login_m->check_user_account($username, sha1($password))->row();
                $num_account  = count($temp_account);
                if ($num_account > 0) {
                    $array_item = array(
                        'username'        => trim($temp_account->user_username),
                        'pass'            => $temp_account->user_password,
                        'nama'            => strtoupper(trim($temp_account->user_name)),
                        'avatar'          => $temp_account->user_avatar,
                        'level'           => $temp_account->user_level,
                        'logged_in_resto' => true,
                    );

                    $this->session->set_userdata($array_item);
                    if ($this->session->userdata('level') == 'Admin') {
                        redirect(site_url('admin/home'));
                    } else {
                        redirect(site_url('operator/home'));
                    }
                } else {
                    $this->session->set_flashdata('notification', '<b>Username atau Password Anda Salah.</b>');
                    redirect(site_url('login'));
                }
            }
        }
    }

    public function logout()
    {
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-chace');
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

/* Location: ./application/controller/Login.php */
