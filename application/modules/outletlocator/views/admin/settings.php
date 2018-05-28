<div id="outlet-locator-settings-container" class="section">
  <h2 class="ico_gears">Outlet Locator Settings</h2>
  <form method="post" action="">
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"><label for="blogname">Module Title</label></th>
          <td><input name="module_title" type="text" id="module_title" value="<?php echo $locator['title'];?>" class="required regular-text"></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="blogdescription">Intro Text</label></th>
          <td><?php echo $introeditor;?>
            <span class="description">This appears just above the locator map.</span></td>
        </tr>
         <tr valign="top">
          <th scope="row"><label for="blogdescription">Footer Text</label></th>
          <td><?php echo $footereditor;?>
            <span class="description">This appears just below the locator map.</span></td>
        </tr>
        
        <tr valign="top">
          <th scope="row"><label for="blogdescription">Default Outlet</label></th>
          <td>
          	<select name="default_widget_outlet" id="default_widget_outlet">
            <option value=""> --- SELECT --- </option>
            <option class="parent_option" value="">Spares</option>
            <?php
                	foreach($outlets['atms'] as $oo)
					{
						$sel = (($locator['default_outlet']) == $oo->id) ? 'selected="selected"':'';
						echo "<option value='$oo->id'$sel>$oo->location</option>";
					}
				?>
            <option class="parent_option" value="">Workshop</option>
            	<?php
                	foreach($outlets['branches'] as $oo)
					{
						$sel = (($locator['default_outlet']) == $oo->id) ? 'selected="selected"':'';
						echo "<option value='$oo->id'>$oo->location</option>";
					}
				?>
            </select>
            <span class="description">This outlet is shown in the widgets by default.</span></td>
        </tr>
      </tbody>
    </table>
    <p class="submit">
      <input type="submit" name="submit" id="submit" class="button-primary" value="Save Settings">
    </p>
  </form>
</div>
