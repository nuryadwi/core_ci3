<?php
    $image_profile = ( ( !empty($this->user_info['user_image'])) ? $this->user_info['user_image'] : base_url( 'assets/images/default.png' ) );
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $this->template->get( 'title', "Module Title" );?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="" />
		<meta name="keywords" content="">
		<meta name="author" content="Phoenixcoded" />
		<link rel="icon" href="<?php echo base_url() . IMG;?>/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="<?php echo base_url() . CSS;?>plugins/dataTables.bootstrap4.min.css">

		<!-- owl carousel -->
		<link rel="stylesheet" href="<?php echo base_url() . CSS;?>owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo base_url() . CSS;?>owl.theme.default.min.css">
		<!-- <script src="<?php echo base_url() . JS;?>owl.carousel.min.js"></script> -->
		<script src="<?php echo base_url() . JS;?>jquery.min.js"></script>

		<!-- vendor css -->
		<link rel="stylesheet" href="<?php echo base_url() . CSS;?>style.css">
		<script src="<?php echo base_url() . JS;?>vendor-all.min.js"></script>

	</head>
    <body class="">
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue position-fixed">
            <div class="m-header bg-white">
				<a href="#!" class="b-brand">
					<h4 class="text-primary">ADMINISTRATOR</h4>
				</a>
				<a href="#!" class="mob-toggler">
					<i class="fa fa-bars"></i>
				</a>
				<hr>
			</div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item pl-0 mr-2">
						<a class="mobile-menu text-primary" id="mobile-collapse" href="#!"><span></span></a>
					</li>
                    <li class="nav-item">
						<a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
						<div class="search-bar">
							<input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
							<button type="button" class="close" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</li>
                </ul>
                <ul class="navbar-nav ml-auto">
					<li>
						<div class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
							<div class="dropdown-menu dropdown-menu-right notification">
								<div class="noti-head text-center">
									<h6 class="d-inline-block m-b-0">Notifications</h6>
									<!-- <div class="float-right">
										<a href="#!" class="m-r-10">mark as read</a>
										<a href="#!">clear all</a>
									</div> -->
								</div>
								<ul class="noti-body">
									<li class="n-title">
										<p class="m-b-0">NEW</p>
									</li>
									<li class="notification">
										<div class="media">
											<!-- <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image"> -->
											<!-- <div class="media-body">
												<p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
												<p>New ticket Added</p>
											</div> -->
										</div>
									</li>
									<li class="n-title">
										<p class="m-b-0">EARLIER</p>
									</li>
									<li class="notification">
										<div class="media">
											<!-- <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image"> -->
											<!-- <div class="media-body">
												<p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
												<p>Prchace New Theme and make payment</p>
											</div> -->
										</div>
									</li>
								</ul>
								<div class="noti-footer">
									<a href="#!" style="text-decoration: none;">Show All</a>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="dropdown drp-user">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Setting Account">
								<i class="fa fa-user-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right profile-notification">
								<div class="pro-head">
									<img src="<?php echo $image_profile;?>" class="img-radius" alt="User-Profile-Image">
									<span><?php echo $this->user_info['user_name'];?></span>
								</div>
								<ul class="pro-body">
									<li>
										<a href="<?php echo base_url( "admin/profile/edit_profile" );?>" class="dropdown-item"><i class="fa fa-user-edit"></i> Change Profile</a>
									</li>
									<li>
										<a href="<?php echo base_url( "admin/profile/edit_account" );?>" class="dropdown-item"><i class="fa fa-user-shield"></i> Change Account</a>
									</li>
									<li>
										<a href="<?php echo base_url( "admin/profile/edit_account" );?>" class="dropdown-item"><i class="fa fa-briefcase"></i> Change Company</a>
									</li>
									<li>
										<a href="<?php echo base_url( "logout" );?>" class="dropdown-item "><i class="feather icon-power"></i> Logout</a>
									</li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
            </div>
        </header>
        <nav class="pcoded-navbar menu-light position-fixed">
    			<div class="navbar-wrapper  ">
    				<div class="navbar-content scroll-div " >
    					<div class="">
    						<div class="main-menu-header">
                     <h5><?php echo $this->user_info['user_group_title']; ?></h5>
                     <img class="img-radius" src="<?php echo $image_profile;?> " alt="User-Profile-Image">
                     <div class="user-details">
   							<div id="more-details"><?php echo $this->user_info['user_name']; ?></div>
   						</div>
                </div>
                <ul class="nav pcoded-inner-navbar">
                     <?php require('nav.php'); ?>
                </ul>
              </div>
            </div>
          </div>
        </nav>
        <div class="pcoded-main-container">
            <div class="pcoded-content">
               <div class="page-header bg-transparent">
                  <div class="page-block">
                     <div class="row align-items-center">
                        <div class="col-md-12">
                           <div class="page-header-title">
                              <h4 class="m-b-10"><?php echo $this->template->get('title','Module title');?></h4>
                           </div>
                           <ul class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="<?php echo base_url( 'admin/dashboard/show' );?>"><i class="feather icon-home"></i>
                                 </a>
                              </li>
                              <?php
                                 $breadcrumb = $this->template->get('breadcrumb');
                                 if( is_array( $breadcrumb ) ) {
                                    $length = count( $breadcrumb );
                                    $num = 1;
                                    foreach ($breadcrumb as $title => $link) {
                                       $class_active = ( ( $num == $length ) ? "active" : null );
                                       echo '
                                          <li class="breadcrumb-item ' .$class_active. ' ">
                                             <a href=" '.base_url($link).' ">' .$title. '</a>
                                          </li>
                                       ';
                                    }
                                 }
                              ?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <?php echo $this->template->get('content');?>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
        </div>

      <div id="toast"></div>

      <script src="<?php echo base_url() . JS;?>plugins/bootstrap.min.js"></script>
		<script src="<?php echo base_url() . JS;?>ripple.js"></script>
		<script src="<?php echo base_url() . JS;?>pcoded.min.js"></script>
		<script src="<?php echo base_url() . JS;?>func/gen.js"></script>
		<script src="<?php echo base_url() . JS;?>plugins/Chart.min.js"></script>

      <?php echo $this->template->get( 'footer_script' );?>
    </body>
</html>
