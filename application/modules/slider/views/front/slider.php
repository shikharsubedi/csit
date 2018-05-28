
    <div class="flashbox">

        <div class="flashbox_left" >
            <ul class="bxslider">	
                <?php foreach ($images as $i): 
            //         if ($i['type'] == 'internal') {
    
            //     // Fetches the Content object using url(id).    
            //     $page = CI::$APP->doctrine->em->find('content\models\Content', $i['link']);
    
            //     if ($page) {    
            //         $_url = site_url($page->getSlug()); 
            //         unset($page);   
            //     }   
            // } else{
            
            //     if (preg_match("@^http://@i", $i['link']))
            //         $_url = $i['link'];
            //     else
            //         $_url = site_url($i['link']);                
            // }
            ?>
                    <li><img src="<?php echo base_url() . 'assets/upload/images/slider/' . $i['image'] ?>" title="<?php echo $i['name'] ?>"/>
                        <div class="bx-caption">
                            <a href="#"><span><?php echo $i['name']; ?></span></a>
                           
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>                             

        </div>
    
    
    </div>





