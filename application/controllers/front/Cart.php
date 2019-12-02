<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->library('parser');
        $this->load->library('template_front');
        $this->load->model('front/cart_m');
    }

    public function index()
    {
        $cart_content = $this->cart->contents();
        if ($cart_content) {
            $total_waktu = 0;
            $total_qty   = 0;
            foreach ($cart_content as $key => $value) {
                $waktu                                  = $value['waktu'];
                $qty                                    = $value['qty'];
                $cart_content[$key]['waktu']            = $waktu;
                $cart_content[$key]['qty']              = $qty;
                $cart_content[$key]['price_format']     = number_format($value['price'], 0, '', ',');
                $cart_content[$key]['price_sub_format'] = number_format($value['price'] * $value['qty'], 0, '', ',');
                $total_waktu += $waktu;
                $total_qty += $qty;
            }

            $data['total_waktu']                   = $total_waktu;
            $data['total_qty']                     = $total_qty;
            $this->data['total_waktu']             = $total_waktu;
            $this->data['total_qty']               = $total_qty;
            $this->data['cart_count']              = count($cart_content);
            $this->data['cart_total']              = $this->cart->total();
            $this->data['cart_total_format']       = number_format($this->cart->total(), 0, '', '.');
            $this->data['cart_content']            = $cart_content;
            $this->data['cart_grand_total_format'] = number_format($this->cart->total(), 0, '', '.');
            $data['keranjang_belanja']             = $this->parser->parse('front/cart/keranjang_belanja.html', $this->data, true);
        } else {
            $data['keranjang_belanja'] = $this->parser->parse('front/cart/keranjang_kosong.html', $this->data, true);
        }

        $this->template_front->display('front/cart/view', $data);
    }

    public function additem()
    {
        if ($this->input->post()) {
            $param = $this->input->post();
            $this->db->where('menu_id', $param['data']['id']);
            $data = $this->db->get('resto_menu')->result_array();
            foreach ($data as $d_key => $d_value) {
                $data[$d_key]['id']      = $d_value['menu_id'];
                $data[$d_key]['qty']     = $param['data']['qty'];
                $data[$d_key]['name']    = $d_value['menu_nama'];
                $data[$d_key]['price']   = $d_value['menu_harga'];
                $data[$d_key]['waktu']   = $d_value['menu_waktu'];
                $data[$d_key]['img_src'] = $d_value['menu_foto'];
                $data[$d_key]['seo']     = $d_value['menu_seo'];
            }
            $this->cart->insert($data);
            $this->_display();
        }
    }

    public function remove_item($rowid = null)
    {
        if (isset($rowid) && !empty($rowid) && $this->input->is_ajax_request()) {
            $this->cart->remove($rowid);
        } else {
            echo 'Sorry, direct access is not allowed!';
        }
    }

    public function update_item()
    {
        $res = array();
        if ($this->input->post('rowid') && $this->input->post('qty')) {
            $param['rowid'] = $this->input->post('rowid');
            $param['qty']   = $this->input->post('qty');
            $this->cart->update($param);
            $cart_content = $this->cart->contents();
            foreach ($cart_content as $key => $value) {
                $cart_content[$key]['price_sub_format'] = number_format($cart_content[$key]['subtotal'], 0, '', ',');
            }
            $res['cart_content']      = $cart_content[$param['rowid']];
            $res['cart_total']        = $this->cart->total();
            $res['cart_total_format'] = number_format($res['cart_total'], 0, '', ',');
        }
        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($res);
        } else {
            opn($res);
        }
    }

    public function _display()
    {
        $cart_content = $this->cart->contents();
        if ($cart_content) {
            $res['cart_count']                     = count($cart_content);
            $res['cart_total']                     = $this->cart->total();
            $res['cart_total_format']              = number_format($res['cart_total'], 0, '', ',');
            $this->data['cart_total']              = $this->cart->total();
            $this->data['cart_count']              = count($cart_content);
            $this->data['cart_total_format']       = number_format($res['cart_total'], 0, '', ',');
            $this->data['cart_content']            = $cart_content;
            $this->data['cart_grand_total_format'] = number_format($this->cart->total(), 0, '', ',');
            $res['cart_dropdown_container']        = $this->parser->parse('front/cart/cart_dropdown_container.html', $this->data, true);
            $res['cart_count_footer']              = $this->parser->parse('front/cart/cart_count_footer.html', $this->data, true);
            $res['keranjang_belanja']              = $this->parser->parse('front/cart/keranjang_belanja.html', $this->data, true);
        } else {
            $res['cart_count']              = 0;
            $res['cart_total']              = 0;
            $res['cart_total_format']       = 0;
            $res['cart_dropdown_container'] = $this->parser->parse('front/cart/cart_dropdown_kosong.html', $this->data, true);
            $res['cart_count_footer']       = $this->parser->parse('front/cart/cart_count_footer_kosong.html', $this->data, true);
            $res['keranjang_belanja']       = $this->parser->parse('front/cart/keranjang_kosong.html', $this->data, true);
        }

        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($res);
        } else {
            opn($res);
        }
    }

    public function destroy()
    {
        $this->cart->destroy();
    }
}
/* Location: ./application/controller/front/Kategori.php */
