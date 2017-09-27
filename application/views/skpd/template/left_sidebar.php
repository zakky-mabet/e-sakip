<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <aside class="main-sidebar">
      <section class="sidebar">
      <div class="user-panel">
         <div class="pull-left image">
            <img src="<?php echo base_url('assets/public/image/avatar.jpg') // echo (!$this->setting->get_admin()->photo) ? base_url("assets/public/image/avatar.jpg") : base_url("assets/public/image/{$this->setting->get_admin()->photo}"); ?>" class="img-circle" alt="User Image">
         </div>
         <div class="pull-left info">
            <p><?php // echo $this->session->userdata('account_admin')->nama_lengkap ?></p>
            <small style="text-transform: capitalize;"><?php // echo $this->session->userdata('account_admin')->hak_akses ?></small>
         </div>
      </div>
      <ul class="sidebar-menu">
        <li class="<?php  echo active_link_controller('home'); ?>">
            <a href="<?php  echo site_url('administrator/home') ?>">
               <i class="fa fa-dashboard"></i> <span>Dashboard</span>
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
