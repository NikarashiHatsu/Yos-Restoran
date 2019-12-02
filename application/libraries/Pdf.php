<?php
    /**
     * Buat library FPDF untuk membuat dokumen dalam bentuk PDF,
     * in this case bakal dibuat nota pembayaran.
     * 
     * Tidak disarankan menggunakan nama class Fpdf lagi karena
     * akan menimbulkan konflik redeclare.
     */
    class pdf {
        /**
         * Memuat library third-party plugin FPDF
         * 
         * @return void
         */
        function __construct()
        {
            include_once APPPATH . '/third_party/fpdf/fpdf.php';
        }
    }
?>