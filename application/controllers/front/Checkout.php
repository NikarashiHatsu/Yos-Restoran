<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('template_front');
        $this->load->library('pdf');
    }

    public function index()
    {
        redirect('index.php/checkout/review');
    }

    public function review()
    {
        $cart_content = $this->cart->contents();

        if ($cart_content) {
            $total_qty   = 0;
            $total_waktu = 0;
            foreach ($cart_content as $key => $value) {
                $waktu                          = $value['waktu'];
                $qty                            = $value['qty'];
                $cart_content[$key]['waktu']    = $waktu;
                $cart_content[$key]['qty']      = $qty;
                $cart_content[$key]['subtotal'] = number_format($value['price'] * $value['qty'], 0, '', ',');
                $total_qty += $qty;
                $total_waktu += $waktu;
            }

            $data['total_waktu']             = $total_waktu;
            $data['total_qty']               = $total_qty;
            $this->data['cart_count']        = count($cart_content);
            $this->data['total_waktu']       = $total_waktu;
            $this->data['total_qty']         = $total_qty;
            $this->data['cart_content']      = $cart_content;
            $this->data['cart_total']        = $this->cart->total();
            $this->data['cart_total_format'] = number_format($this->cart->total(), 0, '', '.');
            $this->data['resto_meja']        = $this->db->get('resto_meja')->result();
            $this->data['cart_total']        = $this->cart->total();
            $data['review_content']          = $this->parser->parse('front/checkout/review_content.html', $this->data, true);
            $this->template_front->display('front/checkout/review', $data);
        } else {
            redirect('/cart');
        }
    }

    // public function dobooking()
    // {
    //     if ($this->input->post()) {
    //         $resto_order        = json_decode($this->input->post('resto_order'), true);
    //         $resto_order_detail = json_decode($this->input->post('resto_order_detail'), true);
    //         $this->db->insert('resto_order', $resto_order);
    //         $order_id = $this->db->insert_id();
    //         $res             = array();
    //         $res['order_id'] = $order_id;
    //         foreach ($resto_order_detail as $key => $value) {
    //             $value['order_id'] = $order_id;
    //             $this->db->insert('resto_order_detail', $value);
    //         }
    //         $this->cart->destroy();
    //         if ($this->input->is_ajax_request()) {
    //             header('Content-Type: application/json');
    //             echo json_encode($res);
    //         } else {
    //             opn($res);
    //         }
    //     }
    // }

    public function konfirmasi()
    {
        if ($this->input->post()) {
            $param             = $this->input->post(null, true);
            $param_resto_order = $param['resto_order'];
            $dataOrder         = array(
                'meja_id'       => stripHTMLtags($param['resto_order']['meja_id']),
                'order_nama'    => strtoupper(stripHTMLtags(trim($param['resto_order']['nama']))),
                'order_tanggal' => date('Y-m-d'),
                'order_waktu'   => $param['resto_order']['total_waktu'],
                'order_qty'     => $param['resto_order']['total_qty'],
                'order_catatan' => $param['resto_order']['catatan'],
                'order_total'   => $param['resto_order']['total'],
                'order_update'  => date('Y-m-d H:i:s'),
            );

            $this->db->insert('resto_order', $dataOrder);
            $order_id     = $this->db->insert_id();
            $cart_content = $this->cart->contents();
            foreach ($cart_content as $key => $value) {
                $subtotal   = ($value['qty'] * $value['price']);
                $dataDetail = array(
                    'order_id'              => $order_id,
                    'menu_id'               => $value['id'],
                    'order_detail_harga'    => $value['price'],
                    'order_detail_qty'      => $value['qty'],
                    'order_detail_waktu'    => $value['waktu'],
                    'order_detail_subtotal' => $subtotal,
                    'order_detail_update'   => date('Y-m-d H:i:s'),
                );

                $this->db->insert('resto_order_detail', $dataDetail);
            }

            $res['order_id'] = $order_id;
            $this->cart->destroy();
            if ($this->input->is_ajax_request()) {
                header('Content-Type: application/json');
                echo json_encode($res);
            } else {
                opn($res);
            }
        }
    }

    public function selesai($order_id = null)
    {
        // $this->db->where('order_id', $order_id);
        // $resto_order = $this->db->get('resto_order')->result();
        // if ($resto_order) {
        //     foreach ($resto_order as $key => $value) {
        //         $this->db->where('order_id', $value->order_id);
        //         $this->db->join('resto_menu', 'resto_menu.menu_id = resto_order_detail.menu_id', 'left');
        //         $value->resto_order_detail = $this->db->get('resto_order_detail')->result();
        //     }
        //     $this->data['resto_order'] = $resto_order;
        //     $data['detail_content']    = $this->parser->parse('front/checkout/detail_content.html', $this->data, true);
        // } else {
        //     $data['detail_content'] = $this->parser->parse('front/checkout/detail_content_empty.html', $this->data, true);
        // }
        // $data['class'] = 'woocommerce-checkout';

        $data['Order']     = $this->db->get_where('v_order', array('order_id' => $order_id))->row();
        $data['listOrder'] = $this->db->get_where('v_order_detail', array('order_id' => $order_id))->result();
        $this->template_front->display('front/checkout/detail_v', $data);
    }

    /**
     * Membuat print view menggunakan FPDF library.
     * 
     * @param integer $order_id
     * @return FPDF_Output
     */
    public function print($order_id = null)
    {
        /**
         * Mengubah header PHP agar browser menganggap bahwa
         * ini adalah file PDF, bukan file HTML walaupun
         * secara otomatis browser akan menganggap ini
         * sebagai PDF namun mengubah header ini sangat
         * dianjurkan.
         */
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename='checkout.pdf'");
        
        /**
         * Mengambil records dari database.
         * Referensi $this->selesai()
         *
         * $Total digunakan untuk menambahkan total dari
         * detail order.
         */
        $Order     = $this->db->get_where('v_order', array('order_id' => $order_id))->row();
        $ListOrder = $this->db->get_where('v_order_detail', array('order_id' => $order_id))->result();
        $Total     = 0;

        /**
         * Inisiasi FPDF
         * ======================================
         * P = Custom page
         * MM = Milimeter
         * 250mm x 210mm
         * 
         * Tambah halaman baru.
         * 
         * Set font family ke Helvetica dengan
         * ukuran font 16px.
         * 
         * Masukkan string "Order Selesai" ke
         * kolom dengan panjang 190px, tinggi 7px
         * tanpa border, lalu kasih line break
         * dengan text alignment center.
         */
        $pdf = new FPDF('P','mm', array(250, 210));
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', '', 16);
        $pdf->Cell(190, 7, 'Order Selesai', 0, 1, 'C');

        /**
         * Set font family ke Helvetica dengan
         * ukuran font 10px
         * 
         * Baris kedua is self-explanatory
         * 
         * Baris ketiga ngasih space
         */
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->Cell(190, 10, 'Terima Kasih, Order Anda Kami Terima.', 0, 1, 'C');
        $pdf->Cell(0, 7, '', 0, 1);

        /**
         * Basically bikin header tabel
         */
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Cell(48, 10, ' NO. ORDER #', 1, 0);
        $pdf->Cell(48, 10, ' TANGGAL', 1, 0);
        $pdf->Cell(48, 10, ' QTY DAN WAKTU :', 1, 0);
        $pdf->Cell(48, 10, ' TOTAL', 1, 1);

        /**
         * Nampilin data order dari database
         */
        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Cell(48, 10, $Order->order_id, 1, 0);
        $pdf->Cell(48, 10, tgl_indo($Order->order_tanggal), 1, 0);
        $pdf->Cell(48, 10, $Order->order_qty.' / '.$Order->order_waktu.' Menit' , 1, 0);
        $pdf->Cell(48, 10, 'Rp. ' . number_format($Order->order_total,0,'',',') , 1, 1);

        /**
         * Spacing hehe
         */
        $pdf->Cell(0, 10, '', 0, 1);

        /**
         * Self-explanatory
         */
        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(0, 10, 'Detail Order', 0, 1);

        /**
         * Nampilin semua orderan beserta harga.
         * 
         * Disini $Total dipakai.
         */
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Cell(96, 10, ' MENU', 1, 0);
        $pdf->Cell(96, 10, ' TOTAL', 1, 1);
        foreach ($ListOrder as $row)
        {
            $pdf->Cell(96, 10, ucwords($row->menu_nama) . '     x' . $row->order_detail_qty, 1, 0);
            $pdf->Cell(96, 10, 'Rp. ' . number_format($row->order_detail_subtotal, 0, '', ','), 1, 1);

            $Total += $row->order_detail_subtotal;
        }

        /**
         * Nampilin footer tabel
         */
        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Cell(96, 10, ' Total :', 1, 0);
        $pdf->Cell(96, 10, 'Rp. ' . number_format($Total, 0, '', ','), 1, 1);

        /**
         * Spacing lagi hehe
         */
        $pdf->Cell(0, 10, '', 0, 1);

        /**
         * Self-explanatory
         */
        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(0, 10, 'Detail Pembeli', 0, 1);
        
        /**
         * This code is getting difficult to
         * documented. Sorry :D
         */
        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Cell(50, 10, ' Nama:', 1, 0);
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Cell(142, 10, '   ' . $Order->order_nama, 1, 1);
        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->Cell(50, 10, ' Nomor Antrian:', 1, 0);
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->Cell(142, 10, '   ' . $Order->meja_nama, 1, 1);

        $pdf->Output();

        /**
         * If you kind enough, please don't
         * delete the contributor Github's
         * account please :'D
         * 
         * https://github.com/NikarashiHatsu
         */
    }
}
/* Location: ./application/controller/front/Checkout.php */
