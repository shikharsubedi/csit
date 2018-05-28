<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $_CONFIG['admin_name'];?></title>

<link href="<?php echo base_url();?>assets/css/login.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>

</head>

<body class="login">
	<div id="recover-pwd">
    <h1><a href="<?php echo site_url()?>" title="Powered by F1 Press :)">F1Soft CMS</a></h1>
    <?php echo validation_errors('<p class="error">','</p>'); ?>
    
    <?php
               if(isset($flashdata))
               echo $flashdata;
            ?>


<form name="recover-form" id="recover-form" action="" method="post">
	<p>
		<label>Username or Email<br>
		<input type="text" name="username" id="username" class="input" value="" size="20" tabindex="10"></label>
	</p>
	<p class="loginback"><a href="login">Login</a></p>
	<p class="submit">
		<input type="submit" class="button" name="submit-recover" id="submit-recover" value="Recover Password" tabindex="100" />
	</p>
</form>
	</div>
</body>
</html>