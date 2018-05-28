
    <div class="flashbox">

        <div class="flashbox_left bottom" >
            <ul class="bxslider">	
                <?php foreach ($images as $i): ?>
                    
                    <li><img src="<?php echo base_url() . 'assets/upload/images/slider/' . $i['image'] ?>" title="<?php echo $i['name'] ?>"/>
                        <div class="bx-caption bx-caption-entertainment">
                            <span><?php echo $i['description']; ?></span>
                           
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>                             

        </div>
    
    </div>





