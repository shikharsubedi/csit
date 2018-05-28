<ul id="mainNav" class="grid_12">
  <li><a href="<?php echo admin_url('dashboard')?>" <?php if($mainmenu == MAINMENU_DASHBOARD) echo 'class="active"'?>>DASHBOARD</a></li>
  <li><a href="<?php echo site_url()?>" target="_blank" title="go to site front end" >WEBSITE</a></li>
  <li><a href="<?php echo admin_url('user/profile')?>" <?php if($mainmenu == MAINMENU_PROFILE) echo 'class="active"'?>>MY PROFILE</a></li><!---->

  <?php if(user_access('administer content')): ?>
  <li><a href="<?php echo admin_url('content')?>" <?php if($mainmenu == MAINMENU_CONTENT) echo 'class="active"'?>>CONTENT</a></li>
  <?php endif;?>
  
  <?php if(user_access('administer user')): ?>
  <li><a href="<?php echo admin_url('user')?>" <?php if($mainmenu == MAINMENU_USER) echo 'class="active"'?>>USERS</a></li>
  <?php endif;?>
  
  <?php if(user_access('administer website settings')): ?>
  <li><a href="<?php echo admin_url('config')?>" <?php if($mainmenu == MAINMENU_SETTING) echo 'class="active"'?>>SETTINGS</a></li>
  <?php endif;?>
  
  <li class="logout"><a href="<?php echo site_url('console/logout')?>">LOGOUT</a></li>
</ul>
