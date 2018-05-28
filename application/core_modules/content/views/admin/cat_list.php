<div class="section">
  <h4>
  <span class="ui-icon ui-icon-folder-open"></span>
  	Manage Categories
  	<a href="<?php echo admin_url('content/category/add')?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add New Category</span></a>
  </h4>
  <div class="content">
    <table class="data">
      <thead>
     	<th width="40%">Categories</th>
        <th width="5%">Articles</th>
        <th width="10%">Action</th>
        </thead>
      <tbody>
        <?php
		echo categoryGrid();
		?>
      </tbody>
    </table>
   
  </div>
</div>
<script type="text/javascript">
$(function(){
	//sub categories cannot be displayed in navigation
	//so hide the radio if parent is chosen
	
	$('.delete-category').bind('click',function(){
		var really = confirm("You really want to delete this category?");
		if(!really) return false;
	});
})
</script>