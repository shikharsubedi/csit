<!--<ul class="sf-menu">
	<?php
		/*
		*	only supported upto depth 2
		*	can be done endlessly but need to put the html 
		*	generation code in a controller or a model
		*	can cause problems when html code is to be updated later
		*/
    	foreach($top_menu as $m)
		{
			if($m->menu_link == "javascript:void(0)" || $m->menu_link == "" || $m->menu_link == "javascript::void(0)")
			{
				$alink = "javascript:void(0)";	
			}else{
				$alink = admin_url($m->menu_link);
			}
	?>		
			<li>
        	<a href="<?php echo $alink;?>"><?php echo $m->menu_name;?></a>
            <?php
            	if(isset($m->sub) )
				{
					echo "<ul id='ul_".$m->menu_id."'>";
					foreach($m->sub as $s1)
					{
						if($s1->menu_link == "javascript:void(0)" || $s1->menu_link == "" || $s1->menu_link == "javascript::void(0)"){
							$alink = "javascript:void(0)";	
						}else{
							$alink = admin_url($s1->menu_link);
						}
						
				?>
						<li><a href="<?php echo $alink;?>" class="<?php echo $s1->menu_class;?>" ><?php echo $s1->menu_name;?></a>       
						  <?php
                          	if(isset($s1->sub))
							{	
								echo "<ul id='ul_".$s1->menu_id."'>";
								foreach($s1->sub as $s2)
								{
									if($s2->menu_link == "javascript:void(0)" || $s2->menu_link == "" || $s2->menu_link == "javascript::void(0)"){
										$alink = "javascript:void(0)";	
									}else{
										$alink = admin_url($s2->menu_link);
									}
							?>
									<li><a href="<?php echo $alink;?>" class="<?php echo $s2->menu_class;?>" ><?php echo $s2->menu_name;?></a></li>   
									  <?php
								}
								echo "</ul>";
							}
						  ?>
                       </li>  
				<?php
					}
					echo "</ul>";
				}
			?>
    	</li>
      <?php
		}
	?>
</ul>-->