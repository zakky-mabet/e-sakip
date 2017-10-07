<html>
<head>
  <title>Reset Password</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="<?php echo base_url('assets/public/bootstrap/css/bootstrap.min.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url("assets/public/font-awesome/css/font-awesome.min.css"); ?>">
    <style type="text/css">
    .turun {margin-top: 10%;}
    </style>
</head>
<body>
<section class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default turun">
        <div class="panel-heading" style="background: #4E5FAD">
          <img src="<?php echo base_url("assets/public/image/logo.png"); ?>" class="pull-right" width="450">
          <h3 style="color: white"><i class="fa fa-key"></i> Reset Password</h3>
        </div>
        <?php echo form_open(current_url()); ?>
        <div class="panel-body">
          <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
              <label for="">Password :</label>
              <input type="password" class="form-control" name="password" value="<?php echo set_value('password') ?>">
              <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
              <label for="">Ulangi Password :</label>
              <input type="password" class="form-control" name="passconf" value="<?php echo set_value('passconf') ?>">
              <?php echo form_error('passconf', '<small class="text-danger">', '</small>'); ?>
            </div>

            <button type="submit" class="btn btn-warning btn-block">Reset Password</button>
          </div>
        </div>
        <?php echo form_close(); ?>
        <div class="panel-footer">
          <img src="<?php echo base_url("assets/public/image/teitralogo.png") ?>" width="250">
          <a href="<?php echo base_url("login"); ?>" class="btn btn-default pull-right"><i class="fa fa-sign-out"></i> Back to application</a>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>