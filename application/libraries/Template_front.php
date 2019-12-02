<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Template_front
{
    protected $_ci;
    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->library('cart');
        $this->_ci->load->library('parser');
        $this->_ci->load->helper('opn');
    }

    public function display($template_front, $data = null)
    {
        if ($this->_ci->cart->contents()) {
            $cart_content = $this->_ci->cart->contents();
            $total_waktu  = 0;
            foreach ($cart_content as $key => $value) {
                $waktu                                  = $value['waktu'];
                $cart_content[$key]['waktu']            = $waktu;
                $cart_content[$key]['price_format']     = number_format($value['price'], 0, '', ',');
                $cart_content[$key]['price_sub_format'] = number_format($value['price'] * $value['qty'], 0, '', ',');
                $total_waktu += $waktu;
            }

            $data['cart_count']                    = count($cart_content) . ' Item';
            $data['cart_total']                    = $this->_ci->cart->total();
            $data['cart_total_format']             = number_format($data['cart_total'], 0, '', ',');
            $data['base']                          = rtrim(base_url(), '/');
            $data['total_waktu']                   = $total_waktu;
            $this->data['total_waktu']             = $total_waktu;
            $this->data['cart_count']              = count($cart_content);
            $this->data['cart_total']              = $this->_ci->cart->total();
            $this->data['cart_total_format']       = number_format($this->data['cart_total'], 0, '', ',');
            $this->data['base']                    = rtrim(base_url(), '/');
            $this->data['cart_content']            = $cart_content;
            $this->data['cart_grand_total_format'] = number_format($this->_ci->cart->total(), 0, '', ',');
            $cart_dropdown_container               = $this->_ci->parser->parse('front/cart/cart_dropdown_container.html', $this->data, true);
            $data['cart_dropdown_container']       = $cart_dropdown_container;
            $cart_count_footer                     = $this->_ci->parser->parse('front/cart/cart_count_footer.html', $this->data, true);
            $data['cart_count_footer']             = $cart_count_footer;
        } else {
            $data['cart_count']              = 0;
            $data['cart_total_format']       = 0;
            $data['cart_dropdown_container'] = '';
            $data['cart_count_footer']       = '';
        }

        $data['_header'] = $this->_ci->load->view('template_front/header', $data, true);
        $data['_footer'] = $this->_ci->load->view('template_front/footer', $data, true);
        $data['_proses'] = $this->_ci->load->view('template_front/proses', $data, true);
        $data['content'] = $this->_ci->load->view($template_front, $data, true);
        $this->_ci->load->view('/template_front.php', $data);
    }
}
/* Location: ./application/libraries/Template_front.php */
