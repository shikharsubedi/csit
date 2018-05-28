

<?php 
	if($college){
		foreach($college as $c){
			?>
			
				<div class="job-spotlight">
			    	<img src="<?php echo base_url().'assets/upload/college/'.$c->getImage()?>" title="<?php echo $c->getName()?> ">								
					<p><?php echo $c->getName()?><br>Address : <?php echo $c->getAddress()?><br>Phone : <?php echo $c->getContact()?><br>Email : <?php echo $c->getEmail()?></p>
					<a href="<?php echo site_url('college/collegeDetail/'.$c->getSlug())?>" class="button">Detail Info »</a>
				</div>
			
			<?php 
		}
	}
?>
	


