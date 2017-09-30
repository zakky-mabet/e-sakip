<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <aside class="main-sidebar">
      <section class="sidebar">
      <div class="user-panel">
         <div class="pull-left image">
            <img src="<?php echo base_url('assets/public/image/avatar.jpg'); ?>" class="img-circle" alt="User Image">
         </div>
         <div class="pull-left info">
            <p><?php  echo $this->session->userdata('SKPD')->nama ?></p>
            <small><?php  echo $this->session->userdata('SKPD')->email ?></small>
         </div>
      </div>
      <ul class="sidebar-menu">
        <li class="<?php echo active_link_controller('home'); ?>">
            <a href="<?php  echo site_url('skpd/home') ?>">
               <i class="fa fa-dashboard"></i> <span>Home</span>
            </a>
        </li>
        <li class="treeview <?php  echo active_link_multiple(array('visi','misi','tujuan','strategi', 'sasaran','kebijakan','program','kegiatan', 'formulasi', 'target')); ?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Rencanan Strategis</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_link_method('index','visi'); ?>">
                <a href="<?php echo base_url("skpd/visi") ?>"> Visi</a>
            </li>
            <li class="<?php echo active_link_method('index','misi'); ?>">
                <a href="<?php echo base_url("skpd/misi") ?>"> Misi</a>
            </li>
            <li>
              <li class="treeview <?php  echo active_link_multiple(array('tujuan')); ?>">
                <a href="#">
                  <span>Tujuan</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo active_link_method('index','tujuan'); ?>"><a href="<?php echo base_url("skpd/tujuan") ?>"> Tujuan</a></li>
                  <li class="<?php echo active_link_method('indikator_tujuan','tujuan'); ?>"><a href="<?php echo base_url("skpd/tujuan/indikator_tujuan") ?>">Indikator dan Target</a></li>
                </ul>
              </li>
            </li>
            <li>
              <li class="treeview <?php  echo active_link_multiple(array('sasaran','formulasi','target')); ?>">
                <a href="#">
                  <span>Sasaran</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo active_link_method('index','sasaran'); ?>">
                    <a href="<?php echo base_url("skpd/sasaran") ?>"> Sasaran</a>
                  </li>
                  <li class="<?php echo active_link_method('indikator_sasaran','sasaran'); ?>">
                    <a href="<?php echo base_url("skpd/sasaran/indikator_sasaran") ?>">Indikator</a>
                  </li>
                  <li class="<?php echo active_link_method('index','target'); ?>">
                    <a href="<?php echo base_url('skpd/target'); ?>">Target</a>
                  </li>
                  <li class="<?php echo active_link_method('index','formulasi'); ?>">
                    <a href="<?php echo base_url("skpd/formulasi") ?>">Formulasi</a>
                  </li>
                </ul>
              </li>
            <li>
             <li class="<?php echo active_link_method('index','strategi'); ?>">
                <a href="<?php echo base_url("skpd/strategi") ?>"> Strategi</a>
             </li>
             <li class="<?php echo active_link_method('index','kebijakan'); ?>">
                <a href="<?php echo base_url("skpd/kebijakan") ?>"> Kebijakan</a>
             </li>
            <li>
              <li class="treeview <?php  echo active_link_multiple(array('program')); ?>">
                <a href="#">
                  <span>Program</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo active_link_method('index','program'); ?>">
                    <a href="<?php echo base_url("skpd/program") ?>"> Program</a>
                  </li>
                  <li class="<?php echo active_link_method('anggaran','program'); ?>">
                    <a href="<?php echo base_url("skpd/program/anggaran/{$this->periode_awal}") ?>">Anggaran Program</a>
                  </li>
                  <li class="<?php echo active_link_method('indikator','program'); ?>">
                    <a href="<?php echo base_url('skpd/program/indikator'); ?>">Indikator Kinerja Program</a>
                  </li>
                  <li class="<?php echo active_link_method('target','program'); ?>">
                    <a href="<?php echo base_url("skpd/program/target/{$this->periode_awal}") ?>"><small>Target Indikator Kinerja Program</small></a>
                  </li>
                </ul>
              </li>
            <li>
              <li class="treeview <?php echo active_link_multiple(array('kegiatan')); ?>">
                <a href="#">
                  <span>Kegiatan</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo active_link_method('index','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan"); ?>"> Kegiatan</a>
                  </li>
                  <li class="<?php echo active_link_method('penanggungjawab','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan/penanggungjawab/{$this->periode_awal}"); ?>"><small>Penanggung Jawab Kegiatan</small></a>
                  </li>
                  <li class="<?php echo active_link_method('anggaran','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan/anggaran/{$this->periode_awal}"); ?>">Anggaran Kegiatan</a>
                  </li>
                  <li class="<?php echo active_link_method('output','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan/output"); ?>">Output Kegiatan</a>
                  </li>
                  <li class="<?php echo active_link_method('target','kegiatan'); ?>">
                    <a href="<?php echo base_url("skpd/kegiatan/target/{$this->periode_awal}"); ?>">Target Output Kegiatan</a>
                  </li>
                </ul>
              </li>
            </li>
          </ul>
        </li>
        <li class="treeview <?php  echo active_link_multiple(array('rkt','rktprogram')); ?>">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>RKT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_link_method('index','rkt'); ?>">
                <a href="<?php echo base_url("skpd/rkt"); ?>"> Target RKT Idikator Sasaran</a>
            </li>
            <li class="<?php echo active_link_method('index','rktprogram'); ?>">
                <a href="<?php echo base_url("skpd/rktprogram") ?>"> Target RKT Idikator Program</a>
            </li>
            <li class="<?php echo active_link_method('rktoutputkegiatan','rktprogram'); ?>">
                <a href="<?php echo base_url("skpd/rktprogram/rktoutputkegiatan"); ?>"> Target RKT Ouput Kegiatan</a>
            </li>
            <li class="<?php echo active_link_method('anggaranprogramrkt','rktprogram'); ?>">
                <a href="<?php echo base_url("skpd/rktprogram/anggaranprogramrkt"); ?>"> Anggaran Program RKT</a>
            </li>
            <li class="<?php echo active_link_method('anggarankegiatanrkt','rktprogram'); ?>">
                <a href="<?php echo base_url("skpd/rktprogram/anggarankegiatanrkt"); ?>"> Anggaran Kegiatan RKT</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php  echo active_link_multiple(array('pkprogram')); ?>">
          <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>Program Kerja</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_link_method('rkt'); ?>">
              <li class="treeview <?php  echo active_link_multiple(array('sasarsdan')); ?>">
                <a href="#">
                  <span>Target PK Indikator Sasaran</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo active_link_method('index','dgd'); ?>">
                    <a href=""> Tahunan</a>
                  </li>
                  <li class="<?php echo active_link_method('indikator_sasaran','dgd'); ?>">
                    <a href="">Triwulan</a>
                  </li>
                </ul>
              </li>
            </li>
            <li class="<?php echo active_link_controller('pkprogram'); ?>">
              <li class="treeview <?php echo active_link_controller('pkprogram'); ?>">
                <a href="#">
                  <span>Target PK Indikator Program</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo active_link_method('index','pkprogram'); ?>">
                    <a href="<?php echo base_url("skpd/pkprogram"); ?>"> Tahunan</a>
                  </li>
                  <li class="<?php echo active_link_method('triwulan','pkprogram'); ?>">
                    <a href="<?php echo base_url("skpd/pkprogram/triwulan"); ?>">Triwulan</a>
                  </li>
                </ul>
              </li>
            <li class="<?php echo active_link_method('rkt'); ?>">
              <li class="treeview <?php  echo active_link_multiple(array('sasarsdan')); ?>">
                <a href="#">
                  <span>Target PK Output Kegiatan</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo active_link_method('index','dgd'); ?>">
                    <a href=""> Tahunan</a>
                  </li>
                  <li class="<?php echo active_link_method('indikator_sasaran','dgd'); ?>">
                    <a href="">Triwulan</a>
                  </li>
                </ul>
              </li>
            </li>
            <li class="<?php echo active_link_method('ww','rktprogram'); ?>">
                <a href=""> Anggaran Program PK</a>
            </li>
            <li class="<?php echo active_link_method('wd','rktprogram'); ?>">
                <a href=""> Anggaran Kegiatan PK</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php  echo active_link_multiple(array('pk')); ?>">
          <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>PK Perubahan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_link_method('i;ndex','visi'); ?>">
                <a href=""> Target RKT Idikator Sasaran</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php  echo active_link_multiple(array('pka')); ?>">
          <a href="#">
            <i class="fa fa-trophy"></i>
            <span>Kinerja</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_link_method('i;ndex','visi'); ?>">
                <a href=""> Target RKT Idikator Sasaran</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php  echo active_link_multiple(array('pka')); ?>">
          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_link_method('i;ndex','visi'); ?>">
                <a href=""> Target RKT Idikator Sasaran</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php  echo active_link_multiple(array('pka')); ?>">
          <a href="#">
            <i class="fa fa-bank"></i>
            <span>Instansi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_link_method('i;ndex','visi'); ?>">
                <a href=""> Profil Instansi</a>
            </li>
          </ul>
        </li>
        <li class="<?php echo active_link_controller('instansi'); ?>">
            <a href="<?php  echo site_url('skpd/home') ?>">
               <i class="fa fa-info-circle"></i> <span>Panduan Pengguna</span>
            </a>
        </li>
        </ul>
      </section>
   </aside>
   <div class="content-wrapper">
      <section class="content-header">
        <?php 
        /**
         * Generated Page Title
         *
         * @return stringsas
         **/
          echo $page_title;

        /**
         * Generate Breadcrumbs from library
         *
         * @var string
         **/
          echo $breadcrumbs; 
        ?>
      </section>
      <section class="content">

<?php  
/* End of file left_sidebar.php */
/* Location: ./application/views/template/left_sidebar.php */
?>
