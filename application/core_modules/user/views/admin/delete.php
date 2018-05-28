<div class="response error" >You are about to delete the user "<?php echo $user->getUsername()?>".</div>
<div class="section">
<h4>Delete user "<?php echo $user->getUsername()?>"</h4>
<div class="content">
	<?php
		$user_contents = $user->getContents();
    	if(($_numposts = $user_contents->count()) > 0)
		{
	?>
			There are <?php echo $_numposts?> posts authored by this user.
            What do you want to do with those posts?
	<?php		
		}else{
	?>
		There are no contents by this user.
	<?php
		}
	?>
    
    
</div>
</div>