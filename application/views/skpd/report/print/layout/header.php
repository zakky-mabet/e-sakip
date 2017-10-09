<!DOCTYPE html>
<html>
   <head>
      <title><?php echo $title; ?></title>
      <link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/style-print.css"); ?>">
      <link rel="stylesheet" href="<?php echo base_url("assets/public/font-awesome/css/font-awesome.min.css"); ?>">
      <link rel="stylesheet" href="<?php echo base_url("assets/public/ionicons/css/ionicons.min.css"); ?>">
      <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/public/image/favicon-title.png') ?>"/>
   </head>
   <body> <!--  onload="window.print()" -->
      <div class="wrapper">
         <div class="header">
            <table class="kop" align="center">
               <tr class="text-center">
                  <?php if($this->input->get('output') != 'pdf') : ?>
                  <td><img src="<?php echo base_url("assets/images/kop.png"); ?>" class="logo" alt="Logo Kop"></td>
                  <?php else : ?>
                  <td><img src="assets/images/kop.png" class="logo" alt="Logo Kop"></td>
                  <?php endif; ?>
                  <td>
                     <span class="kop-heading">PEMERINTAH KABUPATEN <?php echo $this->setting->get('kabupaten') ?></span> <br>
                     <span class="kop-heading-company"><?php echo $this->session->userdata('SKPD')->nama; ?></span> <br>
                     <span class="kop-heading-address">
                        Alamat : <?php echo $this->session->userdata('SKPD')->alamat; ?>. 
                        <?php if($this->input->get('output') != 'pdf') : ?>
                        <i class="fa fa-phone"></i> 
                        <?php else : ?>
                           Telepon :
                        <?php endif ?>
                        <?php echo $this->session->userdata('SKPD')->telepon; ?></span>
                  </td>
               </tr>
            </table>
            <div class="hr-small"></div>
         </div>
