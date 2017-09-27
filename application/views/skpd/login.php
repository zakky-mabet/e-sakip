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
	<title><?php echo $title; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url("public/image/site/favicon.png"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/public/bootstrap/css/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/public/font-awesome/css/font-awesome.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/skpd/css/style-login.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/animate.css"); ?>">
</head>
<body>
	<div class="container">
		<div class="col-md-4 col-md-offset-4 box-login">
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
	      	<div class="box-footer">
	      		<a href="<?php echo base_url("administrator/auth"); ?>" class="forgot"><i class="fa fa-arrow-left"></i> Masuk</a>
	      	</div>
	      	<?php endif; ?>
		</div>
	</div>
	<script src="<?php echo base_url("assets/js/jquery-2.1.4.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/asset/js/bootstrap.min.js"); ?>"></script>
</body>
</html>
<?php  
/* End of file login.php */
/* Location: ./application/views/administrator/login.php */
