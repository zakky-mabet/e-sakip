<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php // echo (isset($title) ? $title.' - '.$this->setting->get('nama-website') : $this->setting->get('nama-website')) ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <link rel="stylesheet" href="<?php echo base_url("assets/public/bootstrap/css/bootstrap.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/font-awesome/css/font-awesome.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/ionicons/css/ionicons.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/plugins/select2/select2.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/AdminLTE.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/skins/skin-green-light.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/animate.css"); ?>">  
  <link rel="stylesheet" href="<?php echo base_url("assets/public/plugins/bootstrap-checkbox/awesome-bootstrap-checkbox.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/public/plugins/datepicker/datepicker3.min.css"); ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/public/image/avatar.jpg') ?>"/>
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
  <script type="text/javascript"> 
      var base_url   = '<?php echo site_url(); ?>';
      var base_path  = '<?php echo base_url('assets/public'); ?>';
      var current_url = '<?php echo current_url(); ?>';
  </script>
  <style>
    .content-wrapper { background: #F4F5F7 }
    * { font-family: 'Arial', sans-serif; font-size: 13px; }
    li > a > i.ion { font-size: 18px; }
    a.link { color:blue; }
    a.link:hover { color:#00C0EF; } 
    .mini-font { font-size:0.9em; }
    a.active { font-weight: bold; }
    a { cursor: pointer; }
    div.checkbox, label.checkbox { padding-top:0px; padding-bottom: 0px; }
    .bg-silver { background:rgb(249,250,252); border:#444; }
    .icon-button { font-size: 1.1em; margin: 5px 6px 0px 0px; }
    .text-line { text-decoration: line-through; color: rgb(173,0,0); }
    dt { text-align: left; }
    .top { margin-top: 20px; }
    div.kisaran > .ticks_labels { padding: 10px; }
    .bigger-font { font-size: 15px; }
     label.control-label { font-size: 12px !important; } 
     div.icon > i.ion  { font-size: 80px; }
     div.icon > i.fa { font-size: 60px; }
    .block-no-surat > strong { font-size: 16px; }
     input.no_surat { padding: 0px 0px 0px 0px; width:42px;   border-bottom: none;  border-top: none; border-right: none; border-left: none; text-align:center; font-size: 16px; font-weight: bold;
       position: inline; color:orange;
     }
    input.no_surat:focus { outline:none !important; }
    div.modal-sm {
      top:30%;
    }
    small > a { font-size:inherit; }
    iframe { width: 100%; min-height:530px;  }
    .bg-1 { background-color: #FB8C00 }
    .bg-2 { background-color: #FF9800 }
    .bg-3 { background-color: #FFA726 }
    .text-white { color: white }
  </style>
</head>
<?php
/* End of file header.php */
/* Location: ./application/views/template/header.php */