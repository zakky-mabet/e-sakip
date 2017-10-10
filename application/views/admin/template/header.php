<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php  echo (isset($title)) ? $title : "Sistem Akuntabilitas Kinerja Instansi Pemerintah"; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/bootstrap/css/bootstrap.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/font-awesome/css/font-awesome.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/ionicons/css/ionicons.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/plugins/select2/select2.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/AdminLTE.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/skins/skin-admin.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/skpd/css/style-admin.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/animate.css"); ?>">  
  <link  rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/hover-min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/plugins/bootstrap-checkbox/awesome-bootstrap-checkbox.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/plugins/datepicker/datepicker3.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/summernote/summernote.css"); ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/public/image/favicon-title.png') ?>"/>

  <script src="<?php echo base_url("assets/public/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/bootstrap/js/bootstrap.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/plugins/slimScroll/jquery.slimscroll.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/plugins/fastclick/fastclick.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/dist/js/jquery.sticky.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/dist/js/app.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/dist/js/jquery.tableCheckbox.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/dist/js/jquery.printPage.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/plugins/bnotify/bootstrap-notify.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/dist/js/jquery.timeago.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/dist/js/moment.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/plugins/datepicker/bootstrap-datepicker.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/summernote/summernote.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/public/plugins/mask-money/jquery.maskMoney.min.js"); ?>"></script>
  <script type="text/javascript"> 
      var base_url   = '<?php echo site_url("admin"); ?>';
      var base_path  = '<?php echo base_url('assets/public'); ?>';
      var current_url = '<?php echo current_url(); ?>';
  </script>
  <style>
  .navbar-nav > li a { font-weight: bold; } 
  .btn-primary {  background: #000D8D !important; color: white; }
  .btn-primary:hover {  background: #000D8D !important; color: white; }
  .navbar-nav > li.dropdown .active { background: #000D8D;  }
  </style>
</head>
<?php
/* End of file header.php */
/* Location: ./application/views/template/header.php */