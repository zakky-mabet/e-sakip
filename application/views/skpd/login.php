<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The template for login the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Codeigniter
 * @subpackage Admin Template
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title; ?> Kabupaten Bangka Tengah</title>
	 <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/public/image/favicon-title.png') ?>"/>
	<link rel="shortcut icon" href="<?php echo base_url("public/image/site/favicon.png"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/public/bootstrap/css/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/public/font-awesome/css/font-awesome.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/skpd/css/style-login.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/animate.css"); ?>">
	<style type="text/css" media="screen">
		.bg {
			background: #4b7aea; /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, #4b7aea 18%, #467fdb 55%, #0956b5 91%, #06108b 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(18%,#4b7aea), color-stop(55%,#467fdb), color-stop(91%,#0956b5), color-stop(100%,#06108b)); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover, #4b7aea 18%,#467fdb 55%,#0956b5 91%,#06108b 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover, #4b7aea 18%,#467fdb 55%,#0956b5 91%,#06108b 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover, #4b7aea 18%,#467fdb 55%,#0956b5 91%,#06108b 100%); /* IE10+ */
background: radial-gradient(ellipse at center, #4b7aea 18%,#467fdb 55%,#0956b5 91%,#06108b 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4b7aea', endColorstr='#06108b',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
		}

		body {
			 background-image: url('http://localhost/kiss/assets/img/bg-big.jpg') ;
    background-attachment: fixed;
    background-repeat: no-repeat;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;

		}
	</style>
</head>
<body class="bg">
	<div class="container " style="border: 1pt solid black; padding-bottom: 300px">
		<div class="col-md-4 col-md-offset-4 box-login ">
			<div class="box-logo">
	      		<img src="<?php echo base_url("assets/images/logo-login.png"); ?>" alt="">
	      	</div>
	      	<?php  
	      	/**
	      	 * undocumented class variable
	      	 *
	      	 * @var string
	      	 **/
	      	if( $this->input->get('action') != 'lostpassword') :
	      	?>
	      	<div class="box-alert">
	      		<?php echo $this->session->flashdata('alert'); ?>
	      	</div>
	      	<div class="box-body animated <?php if($this->session->flashdata('alert')) echo "shake"; ?>">
	      		<form action="<?php echo current_url(); ?>" method="POST" role="form">
	      			<div class="form-group">
	      				<label for="">Username / E-Mail :</label>
	      				<input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control input-lg" autofocus="true">
	      				<p class="help-block"><?php echo form_error('username', '<small class="text-danger">', '</small>'); ?></p>
	      			</div>
	      			<div class="form-group">
	      				<label for="">Password :</label>
	      				<input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control input-lg">
	      				<p class="help-block"><?php echo form_error('password', '<small class="text-danger">', '</small>'); ?></p>
	      			</div>
	      			<button type="submit" class="btn btn-primary btn-block">Masuk</button>
	      		</form>
	      	</div>
	      	<?php else : ?>
	      	<div class="box-alert">
	      		<div class="alert alert-info">
	      			Silahkan masukkan namaalamat email Anda. Anda akan menerima sebuah tautan untuk membuat password baru melalui email.
	      		</div>
	      	</div>
	      	<div class="box-body animated ">
	      		<form action="<?php echo base_url("administrator/auth/forgot"); ?>" method="POST" role="form">
	      			<div class="form-group">
	      				<label for="">E-Mail :</label>
	      				<input type="email" name="email" class="form-control input-lg" autofocus="true">
	      			</div>
	      			<button type="submit" class="btn btn-primary btn-block">Dapatkan password baru</button>
	      		</form>
	      	</div>
	      	
	      	<?php endif; ?>
		</div>
	</div>
	<script src="<?php echo base_url("assets/public/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/public/bootstrap/js/bootstrap.min.js"); ?>"></script>
</body>
</html>
<?php  
/* End of file login.php */
/* Location: ./application/views/administrator/login.php */