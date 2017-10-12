<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Call Header Print (KOP)
 *
 * @author Vicky Nitinegoro http://vicky.work
 **/
$this->load->view('skpd/report/print/layout/header');

/**
 * Load Jenis Tabulasi
 *
 * @param string (jenisTabulasi)
 **/
$this->load->view("skpd/report/tabulasi/{$this->jenis}");

$this->load->view('skpd/report/print/layout/footer');

/* End of file indextabulasi.php */
/* Location: ./application/views/skpd/report/print/indextabulasi.php */