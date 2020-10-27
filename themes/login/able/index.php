<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="description" content="Login Inves Kita">
		<title>Administrator | Login </title>
		<link rel="favicon" type="image/png" sizes="32x32" href="<?php echo ASSETS ;?>images/favicons/favicon-32x32.png">
		<link rel="favicon" type="image/png" sizes="16x16" href="<?php echo ASSETS ;?>images/favicons/favicon-16x16.png">
		<link rel="manifest" href="<?php echo ASSETS;?>images/favicons/site.webmanifest">
		<!-- Favicon icon -->
		<link rel="icon" href="<?php echo base_url() . ASSETS ;?>images/favicon.ico" type="image/x-icon">
		<!-- vendor css -->
		<link rel="stylesheet" href="<?php echo ASSETS ;?>css/style.css">
	</head>
    <body>
		<div class="auth-wrapper" style="background-image: ;background-size: cover">
			<div class="auth-content">
				<div class="card">
					<div class="row align-items-center text-center">
						<div class="col-md-12">
							<div class="card-body">
								<form method="post" action="<?php echo $link_post;?>">
									<h3><img src="<?php //echo ASSETS ;?>images/logo_lite.png" alt=""></h3>
									<hr>
									<div id="notif" class="form-group mb-3 alert alert-danger" style="display:none;"></div>
									<div class="input-group form-group d-flex">
									</div>
									<div class="form-group mb-4">
										<label class="floating-label" for="Password">Email</label>
										<input type="email" name="email" class="form-control" id="Email" placeholder="">
									</div>
									<div class="form-group mb-4">
										<label class="floating-label" for="Password">Password</label>
										<input type="password" name="password" class="form-control" id="Password" placeholder="">
									</div>
									<div class="custom-control custom-checkbox text-left mb-4 mt-2">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Ingatkan.</label>
									</div>
									<button class="btn btn-block btn-info mb-4">Login</button>
									<?php
										echo '
										<p class="mb-4 text-muted"> <a href="' . base_url() . 'login/reset" class="text-primary f-w-100">Lupa Password ?</a>
										</p>
										<p class="mb-2 text-muted">Belum punya akun ? Daftar</p> <p class="text-muted"> <a href="' . base_url() . 'registration/pendana" class="btn btn-sm btn-warning text-white f-w-400"> Pegawai</a> atau <a href="' . base_url() . 'registration/pemilik_proyek" class="btn btn-sm btn-warning text-white f-w-400">Perusahaan</a>
										</p>
										';
									?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo ASSETS;?>js/vendor-all.min.js"></script>
		<script src="<?php echo ASSETS;?>js/plugins/bootstrap.min.js"></script>
		<script src="<?php echo ASSETS;?>js/ripple.js"></script>
		<script src="<?php echo ASSETS;?>js/pcoded.min.js"></script>
		<script>
			$( document ).ready( function() {
				$( this ).val( $( this ).val().replace( /[^0-9]/g, '' ) );
			})
		</script>
    </body>
</html>