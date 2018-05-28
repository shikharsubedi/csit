<h1>News and Updates</h1>
<div class="updates">
	<div class="news-slide">
	<?php foreach($articles as $a): ?>
    <p class="title">
    	<a href="<?php echo site_url('content/'.$a['slug'])?>"><?php echo $a['title'];?></a><br/><span class="date">-<?php echo dateMysql($a['eventdate'])?></span>
    </p>
    <?php endforeach;?>
    </div>
    <p class="last"><a href="<?php echo site_url('content/category/'.$category_slug)?>" class="more">View All &raquo;</a></p>
</div>
<script type="text/javascript">
$(function(){
	var _holder = $('.news-slide');
	setTimeout(function(){
			var cycle = setInterval(function(){
				var first2 = _holder.children('p:nth-child(1)');
				
				first2.animate({'margin-top':'-62px'},1000,null,function(){
					first2.appendTo($('.news-slide'));
					first2.css({'margin-top':'0px'});
					_holder.children('p').show();
				});
				
				
				},10000);
		},5000);
})
</script>