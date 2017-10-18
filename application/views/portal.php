<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/public/image/favicon-title.png') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url("assets/public/bootstrap/css/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/skpd/css/main.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/public/font-awesome/css/font-awesome.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/public/dist/css/AdminLTE.min.css"); ?>">
	<link async href="http://fonts.googleapis.com/css?family=Passero%20One" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>

	  <script src="<?php echo base_url("assets/public/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
	  <script src="<?php echo base_url("assets/public/bootstrap/js/bootstrap.min.js"); ?>"></script>
	  <script type="text/javascript"> 
	      var current_url = '<?php echo current_url(); ?>';
	  </script>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Archivo+Black|Nunito');

		.font-opd {
			font-size: 1em;
			margin-top: 10px;
		}
		.blue-bg {
			background: #2B6BAF;
		}
		.white {
			color: white;
			font-size: 1.2em;
			text-shadow: 1px 0px 1px black;
		}
		.welcome {
			color: white;
			text-shadow: 1px 0px 1px black;
    		font-weight: bold;
		}
		.radius {

			border-radius: 0px 60px 25px 60px;
		}
		.enjoy-css {
		  -webkit-box-sizing: content-box;
		  -moz-box-sizing: content-box;
		  box-sizing: content-box;
		  cursor: pointer;
		  border: none;
		  font: normal 2.4em/normal "Passero One", Helvetica, sans-serif;
		  color: rgba(255,255,255,1);
		  text-align: center;
		  -o-text-overflow: clip;
		  text-overflow: clip;
		  text-shadow: 0 1px 0 rgb(204,204,204) , 0 2px 0 rgb(201,201,201) , 0 3px 0 rgb(187,187,187) , 0 4px 0 rgb(185,185,185) , 0 5px 0 rgb(170,170,170) , 0 6px 1px rgba(0,0,0,0.0980392) , 0 0 5px rgba(0,0,0,0.0980392) , 0 1px 3px rgba(0,0,0,0.298039) , 0 3px 5px rgba(0,0,0,0.2) , 0 5px 10px rgba(0,0,0,0.247059) , 0 10px 10px rgba(0,0,0,0.2) , 0 20px 20px rgba(0,0,0,0.14902) ;
		  -webkit-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
		  -moz-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
		  -o-transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
		  transition: all 300ms cubic-bezier(0.42, 0, 0.58, 1);
		}

		.enjoy-css:hover {
		  color: #FF9E02;
		  text-shadow: 0 1px 0 rgba(255,255,255,1) , 0 2px 0 rgba(255,255,255,1) , 0 3px 0 rgba(255,255,255,1) , 0 4px 0 rgba(255,255,255,1) , 0 5px 0 rgba(255,255,255,1) , 0 6px 1px rgba(0,0,0,0.0980392) , 0 0 5px rgba(0,0,0,0.0980392) , 0 1px 3px rgba(0,0,0,0.298039) , 0 3px 5px rgba(0,0,0,0.2) , 0 -5px 10px rgba(0,0,0,0.247059) , 0 -7px 10px rgba(0,0,0,0.2) , 0 -15px 20px rgba(0,0,0,0.14902) ;
		  -webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
		  -moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
		  -o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
		  transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1) 10ms;
		}

		.shadow {
    		box-shadow: 2px 1px 10px black;
		}

		.text-shadow {
    		text-shadow: 2px 1px 2px  black;
		}

		.trigonal {
			 background: url('<?php echo base_url("assets/images/trigonal.png"); ?>') repeat; 
		}

	</style>
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
                <img src="<?php echo base_url("assets/public/image/logo-main.png"); ?>" class="logo-head" alt="Logo" width="440">
			</div>
		</div>
	<div class="line">
		<div class="box-line-orange">
			<span class="text-center">
					<div>Batas Waktu Entri data E-Sakip</div> <b><div  id="demo"></div></b>
			</span>
		</div>
	</div>
	</nav>
	<div class="container">
		<div class="row">			
	  		<div class="col-md-12 text-center" >
	  			<br>
	  			<h2 class="welcome"><b>Selamat Datang di Sistem Informasi Akuntabilitas Kinerja Instansi Pemeritah Kabupaten Bangka Tengah</b></h2> <br>
	  		</div>
			

			<div class="col-md-3">

		          <div class="box box-warning radius blue-bg shadow trigonal">
		            <div class="box-body box-profile ">
		            	 <h3 class="profile-username text-center font-opd enjoy-css">Informasi</h3>
		              <img class="profile-user-img img-responsive bg-blue img-circle" src="<?php echo base_url("assets/images/info.jpg"); ?>" alt="Login logo" >
		              	<br>		           
		              	<p class=" text-center white">Informasi E-Sakip</p>

		            </div>
		          </div>

			</div>

			<div class="col-md-3">

		          <div class="box box-warning radius blue-bg shadow trigonal">
		            <div class="box-body box-profile ">
		            	<a id="get-kontak"> <h3 class="profile-username text-center font-opd enjoy-css">Kontak</h3></a>
		              <img class="profile-user-img img-responsive bg-blue img-circle" src="<?php echo base_url("assets/images/kontak.jpg"); ?>" alt="kontak logo">
		              	<br>		           
		              	<p class=" text-center white">Kontak Pelayanan</p>

		            </div>
		          </div>

			</div>

			<div class="col-md-3">

		          <div class="box box-warning radius blue-bg shadow trigonal">
		            <div class="box-body box-profile ">
		            	 <h3 class="profile-username text-center font-opd enjoy-css">Publik</h3>
		              <img class="profile-user-img img-responsive bg-blue img-circle" src="<?php echo base_url("assets/images/public.jpg"); ?>" alt="Login logo">
		              	<br>		           
		              	<p class=" text-center white">Publikasi Rencana Strategis</p>

		            </div>
		          </div>

			</div>

			<div class="col-md-3">

		          <div class="box box-warning radius blue-bg shadow trigonal">
		            <div class="box-body box-profile ">
		            	<a id="get-login"><h3 class="profile-username text-center font-opd enjoy-css">Login OPD</h3></a>
		              <img  class="profile-user-img img-responsive bg-blue img-circle" src="<?php echo base_url("assets/images/login.jpg"); ?>" alt="Login logo">
		              	<br>		           
		              	<p class=" text-center white">Login E-Sakip OPD</p>
		            </div>
		          </div>

			</div>

		
			
		</div>
	</div>
<div class="navbar navbar-inverse navbar-fixed-bottom" >
   <div class="container" >
      <small class="navbar-text pull-left">&copy; SEKRETARIAT DAERAH KABUPATEN BANGKA TENGAH 2017</small>
      <small class="navbar-text pull-right">Develop By <a href="http://www.teitramega.co.id" target="_blank"> Teitra Mega</a></small>
   </div>
</div>	
<script>

var countDownDate = new Date("10 16, 2017 00:00:00").getTime();


var x = setInterval(function() {

  var now = new Date().getTime();

  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("demo").innerHTML = days + " hari "+ hours + " jam "
  + minutes + " menit " + seconds + " detik ";

  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "";
  }
}, 0);


    $('#get-login').click( function() 
    {
        $('#modal-login').modal('show');

        $('#btn-login').attr('href', current_url + '/login/');
    });


    $('#get-kontak').click( function() 
    {
        $('#modal-kontak').modal('show');

    });
</script>

<div class="modal animated fadeIn modal-primary" id="modal-login" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> Perhatian !</h4>
                <span>Informasi Entri data E-Sakip. </span>    
            </div>
            <div class="modal-body">
				<p>	Assalamuallaikum wr. wb. dan selamat pagi. sehubungan akan dinilainya e-sakip oleh Kemenpan Rabu pada tanggal 18 Okt 2017 maka diminta kepada seluruh Kepala OPD untuk segera menugaskan Kasubag Perencanaan melakukan entry data mulai pada waktu sekarang hingga senin malam tgl 16 okt 2017. Demikian disampaikan, apabila ada yang ingin dikonfirmasi, dapat menghubungi bagian Organisasi Setda.
atas perhatian dan kerjasama kami ucapkan terimakasih.</p>
<p>	(cc: Bupati Bangka Tengah)</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a href="#" id="btn-login" class="btn btn-outline"> Mengerti </a>
            </div>
        </div>
    </div>
</div>


<div class="modal animated fadeIn " id="modal-kontak" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><i class="fa fa-info-circle"></i> Kontak Kami!</h3>
                <span> </span>    
            </div>
            <div class="modal-body">
				<p>
					<b>Untuk info lebih lanjut dapat menghubungi Kami di :</b>
				</p>
				<p>
					Telepon : (0718) 7362017
				</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>

            </div>
        </div>
    </div>
</div>

</body>
</html>