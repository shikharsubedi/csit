<div id="shortcuts" class="section clearfix" style="height:auto; display:block; overflow:hidden;">
            <h2 class="ico_shortcut">
            Panel Shortcuts
            <span class="back"><a href="<?php echo admin_url('user/profile/shortcuts')?>">Manage Shortcuts</a></span>
            </h2>
            <ul>
            	<?php 
			  		foreach($shortcuts->result() as $r)
			  		{
				 		if($r->is_permitted == 'Y')
						{
					?>
                    <li>
						<a href="<?php echo admin_url($r->menu_link);?>" class="<?php echo $r->menu_class;?>"><?php echo $r->shortcut_name;?> </a> </span>
				  </li>
					<?php
						}
					}
			?>
            </ul>
          </div>