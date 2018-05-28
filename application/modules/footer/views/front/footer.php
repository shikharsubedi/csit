	
            	
	<?php 
		if ($footers):
			foreach ($footers as $f):
				$_url = $f['url']; 
				if ($f['type']=='internal') {
						$page = CI::$APP->doctrine->em->find('content\models\Content',$f['url']);
						if($page) { 
							$_url = site_url('content/'.$page->getSlug()); 
							unset($page); 
						} else $_url = 'javascript:;';
					}
				?>
			<a href="<?php echo $_url?>" <?php if (!is_numeric($f['url'])) echo 'target="_blank"'?>><?php echo $f['title']?></a>
		
				<?php 	if ($f != end($footers)) echo ' | ';	
			endforeach;
		endif;
	?>
                
    
			
		
            
				

					
