<!DOCTYPE html>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_CONFIG['admin_name'];?></title>
<link rel="Stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/start/jquery-ui-1.8.6.custom.css"  />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>assets/css/admin-style.css" />
<?php
//add the custom stylesheets
if(count($stylesheets) > 0)
{
	foreach($stylesheets as $estyle)
		echo "<link rel='Stylesheet' type='text/css' href='".base_url()."assets/css/$estyle.css'  />";
}
?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom.js"></script>
<?php
//add the custom scripts
if(count($scripts) > 0){
	foreach($scripts as $es)
		echo "<script type='text/javascript' src='".base_url()."assets/js/$es.js'></script>";
}

?>
</head>

<body>
<div id="wrapper">
  <div id="header">
    <div class="brand"> <img src="<?php echo base_url()."assets/upload/images/config/".Options::get('brand_image')?>" /> </div>
    <div class="intro">
      <h1><?php echo $_CONFIG['admin_name']?></h1>
      <?php echo $_CONFIG['slogan']; ?> </div>
    <div class="clear"></div>
  </div>
  <?php
 $this->load->view('admin/topimenu');
   ?>
  <div id="containerHolder"  >
    <div id="container">
      <div id="mainholder">
        <?php
			//$this->load->view('admin/sidebar');
		?>
        <h2>
          <?php 
			echo $this->breadcrumb->output();
			//echo $breadcrumb;?>
        </h2>
        <div id="maincontent">
          <div id="main">
            <?php
				if($validation_errors = validation_errors('<p>','</p>'))
			 		echo '<div class="response error">'.$validation_errors.'</div>'; 
			?>
            <?php
				if(isset($upload_error)) echo '<div class="response error">'.$upload_error.'</div>';
			?>
            <?php
               if(isset($flashdata))
               echo $flashdata;
            ?>
            <?php
                //check if it is from the native application
            	$view = $maincontent;
                	$this->load->view($view);
            ?>
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <div id="footer"> asdasd </div>
      <!-- end #sidebar --> 
      
      <!-- end #shortcuts --> 
    </div>
    <!-- end #content_main --> 
    <!-- end #postedit --> 
    <!-- end #section --> 
  </div>
</div>
<!-- end container -->
</body>
</html>