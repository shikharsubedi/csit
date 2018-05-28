<div class="section">
  <h4>Search Content by Tags
  </h4>
	<div class="content">
		
	<form action="" name="frmSearch" method="post">
	<table class="form-table">
		<tr>
			<td><input type="text" name="term" id="term" size="40" value="<?php echo set_value('term')?>"/></td>
		</tr>
		<tr>
			<td><input type="submit" value="Search" name="btnSub" class="button"/></td>
		</tr>
	</table>
	</form>

	<?php if ($try and !$success) echo '<div class="response">Search results not found.</div>';?>

	<?php if ($success): echo '<hr/><div class="search-result">';
		CI::$APP->load->helper('text');
		foreach ($result as $r):?>
			<div class="results">
				<p class="ttl"><a href="<?php echo site_url('content/'.$r['slug'])?>" target="_blank"><?php echo $r['title']?></a></p>
				<p class="short"><?php echo word_limiter(strip_tags($r['body']),100)?></p>
				<p class="more"><a href="<?php echo site_url('content/'.$r['slug'])?>" target="_blank">View &raquo;</a></p>
			</div>
		<?php endforeach; echo '</div>';
	endif?>
	</div>
</div>
