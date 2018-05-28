<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<?php 
	$config = Options::get('siteconfig');
	$adminname = $config['admin_name']
?>
<title><?php echo $adminname;?></title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?php echo theme_url()?>css/style.css">
<link rel="stylesheet" href="<?php echo theme_url()?>css/colors/blue.css" id="colors">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo theme_url() ?>images/favicon.ico">

 <!-- Owl Carousel Assets -->
    <link href="<?php echo theme_url()?>css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo theme_url()?>css/owl.theme.css" rel="stylesheet">
    <link href="<?php echo theme_url()?>css/owl.transitions.css" rel="stylesheet">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header>
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="<?php echo site_url()?>"><img src="<?php echo base_url()."assets/upload/images/config/".Options::get('brand_image')?>" alt="<?php echo $adminname;?>" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
		<?php echo cms_mainmenu()?>
			<ul class="responsive float-right">
            	<li><a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Home</a></li>
				
				<li><a href="#"><i class="fa fa-envelope"></i> <?php echo Options::get('feedback_email'); ?></a></li>
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>