<?php if($team_cat):?>
	<?php foreach ($team_cat as $dc): ?>
	
		<h3><?php echo $dc['name'];?></h3>
		
			<ul>
				<?php foreach ($dc['items'] as $d):?>
				<li><?php if($dc['slug']!='department-heads') {?>
                <a href="<?php echo site_url('management/profile/'.$d['id'])?>" title="View Profile">
                <?php }?>
				<?php echo $d['name']; ?>
               <?php if($dc['slug']!='department-heads') {?> </a> <?php }?></li>
                  <p><?php echo $d['position'];?> </p>
                   
				<?php endforeach?>
			</ul>
		
	
	<?php endforeach?>
	<?php endif;?>
	