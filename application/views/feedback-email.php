<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Texas Collete - Feedback Email</title>
</head>

<body style="background: font-family:Calibri; font-size:14px; margin:50px 0 0 0; padding:0;color:#333333">

    <div style="width:640px; margin:0 auto;">
                            
        <div style="width:100%; float:left; text-align:center; padding:0 0 10px 0;">
            <p><img src="<?php echo base_url()?>assets/themes/texas/img/logo.png" alt="Texas College" title="Texas College" /></p>
        </div>						
        <div style="width:600px; float:left; padding:19px; 	-moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; background:#fff; 	-moz-box-shadow: 0 0 5px #888;-webkit-box-shadow: 0 0 5px#888; box-shadow: 0 0 5px #888; border:1px solid #fff;"> 
        	<h1 style="font-size:18px; color:#000; font-weight:normal; border-bottom:1px solid #cecece; padding:0 0 5px 0; margin:10px 0 10px 0; width:100%; float:left;">Feedback Detail</h1>	        	 
        	
            <p style="width:100%; border-bottom:1px solid #ccc; margin:0; float:left; padding:7px 0 7px 0;">
                <label style="width:130px; float:left; font-weight:bold">Name</label>
                <span style="width:400px;float:left"><?php echo $contact->getName()?></span>
            </p>
        
        	<p style="width:100%; border-bottom:1px solid #ccc; margin:0; float:left; padding:7px 0 7px 0;">
                <label style="width:130px; float:left; font-weight:bold">Email </label>
                <?php echo $contact->getEmail()?>
            </p>
        	
            <p style="width:100%; border-bottom:1px solid #ccc; margin:0; float:left; padding:7px 0 7px 0;">
                <label style="width:130px; float:left; font-weight:bold">Message</label>
                <span style="width:400px; float:left;"><?php echo nl2br($contact->getMessage())?></span>
            </p>
            
            <div style="clear:both"></div>
        </div>
    </div>
</body>
</html>

