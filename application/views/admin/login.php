<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $_CONFIG['admin_name'];?></title>

<link href="<?php echo base_url();?>assets/css/login.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>

</head>

<body class="login">
	<div id="login"><h1><a href="<?php echo site_url()?>" title="Powered by F1 Press :)">DTN CMS</a></h1>
    
    <?php echo validation_errors('<p class="error">','</p>'); ?>
<?php 
               if(isset($flashdata))
               echo $flashdata;
            ?>
<form name="loginform" id="loginform" action="authenticate" method="post">
	<p>
		<label>Username<br>
		<input type="text" name="username" id="username" class="input" value="" size="20" tabindex="10"></label>
	</p>
	<p>
		<label>Password<br>
		<input type="password" name="password" id="password" class="input" value="" size="20" tabindex="20"></label>
	</p>
    <p>
      <label>Please enter this security code<span class="required"> * </span></label>
     <img src="<?php echo site_url('console/captcha')?>" id="captchaimg"  onclick="refreshCaptcha()"/>
     </p>
     <p> 
     <label>&nbsp;</label>
     <input type="text" class="input" id="capthacode" name="captchacode" size="10" tabindex="30" autocomplete="off">
     </p>
	<p class="forgetmenot"><a href="forgotpassword">Forgot Password</a></p>
	<p class="submit">
		<input type="submit"  name="wp-submit" id="wp-submit" class="button-primary" value="Log In" tabindex="100">
	</p>
</form>
<script>
function refreshCaptcha(){document.getElementById('captchaimg').src = '<?php echo site_url('console/captcha')?>?'+Math.floor((Math.random()*1000)+1);}

</script>
	</div>
</body>
</html>