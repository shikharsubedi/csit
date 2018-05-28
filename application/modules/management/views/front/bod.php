<?php if($team_cat):?>
	<?php foreach ($team_cat as $dc):?>
	
			<div class="mag_con">
				<?php foreach ($dc['items'] as $d):
				$class = ($d ==$dc['items'][0]) ? "first" : "" ;
				  
				?>
             
				<div class="main_list <?php echo $class;?>">
				<p class="mag_image "><a href="<?php echo site_url('management/profile/'.$d['id'])?>"  title="View Profile">
                <img class="show-caption" src="<?php echo base_url()?>/assets/upload/images/members/thumbs/<?php echo $d['image']?>"  title="<?php echo $d['name']?>" /> </a>
                </p>
				<p class="mag_name"><a href="<?php echo site_url('management/profile/'.$d['id'])?>"  title="View Profile"><?php echo $d['name']; ?></a></p>
                <p class="mag_pos"><?php echo $d['position'] ;?></p>
                
                </div>
				<?php endforeach?>
			</div>
		
	
	<?php endforeach?>
 <?php endif;?>