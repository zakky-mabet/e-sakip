<body class="hold-transition skin-admin layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="<?php echo site_url('admin/main') ?>" class="">
                        <img src="<?php echo base_url("assets/public/image/logo.png"); ?>" class="logo-head" alt="Logo" width="440">
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown <?php echo active_link_multiple(array('opd')) ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">OPD <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="<?php echo active_link_controller('opd'); ?>">
                                    <a href="<?php echo site_url("admin/opd") ?>">Organisasi Perangkat Daerah</a>
                                </li>
                                <li><a href="">Kepala Dinas / OPD</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="">Action</a></li>
                                <li><a href="">Another action</a></li>
                                <li><a href="">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu" data-toggle="tooltip" data-placement="bottom" title="Pengaturan Login">
                            <a href="<?php echo site_url('admin/account'); ?>" style="font-size: 20px;">
                                <i class="glyphicon glyphicon-user" style="font-size: 16px;"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="font-size: 20px;" data-toggle="modal" data-target="#log-off" data-placement="bottom" title="Keluar dari Sistem">
                             <i class="fa fa-power-off"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
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



