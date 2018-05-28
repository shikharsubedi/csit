
<div class="first_lt">
    <div class="flashbox">
        <div class="flashbox_left" >
            <div class="bx-wrapper">
    	<div class="bx-viewport">
            <ul class="bxslider">	
                <?php
                $cnt = 1;
                foreach ($images as $i):
                    ?>

                    <li>
                        <a href="<?php echo site_url('slider/view'); ?>" target="<?php //echo $target   ?>"><img src="<?php echo base_url() . 'assets/upload/images/slider/' . $i['image'] ?>" alt=" <?php echo $i['name']; ?>" height="282" width="419" />

                            <div class="bx-caption">
                                <span><?php echo $i['name']; ?></span>
                            </div>
                    </li>

                <?php endforeach; ?>

            </ul>  
        </div></div>

        </div>
    </div>
</div>




