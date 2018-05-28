<?php get_header()?>
<link href="<?php echo theme_url()?>colorbox/colorbox.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="<?php echo theme_url()?>js/jquery.colorbox.js"></script>
<script type="text/javascript" src="<?php echo theme_url()?>js/jquery.colorbox-min.js"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=369358903229337&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php 
    $catArray = array(
			'one'=>16,
			'two'=>18,
			'three'=>19,
			'four'=>17,
			'five'=>15,
			'six'=>20,
			'seven'=>21,
			'eight'=>22,	
			'nine'=>25,
			'ten'=>23,
			'eleven'=>24,
			'twelve' =>26,
		); // default places of content categories
    
    $i=1;
    foreach($catArray as $place=>$catID) {
		$$place = '';
		if ($$place=='' or $$place==0) $$place=$catID;
    }
    
    
    ?>
<div id="mainbody">
  <div class="content">
    <div class="row first">
      <div class="inside_col2">
        <h3>Images</h3>
        <div class="">
          <?php 	
					$i = 1;
					 foreach($images as $i){	//show_pre($i);		
						?>
          <div class="gallery-hol">
            <p class="top"> <a class="colorbox" href="<?php echo base_url().'assets/upload/images/slider/'.$i['image']?>" title="<?php echo $i['name'];?>"> <img src="<?php echo base_url().'assets/upload/images/slider/'.$i['thumbnail']?>"  /> </a> </p>
          </div>
          <?php 
        
					 } ?>
        </div>
        <div class="fb-like-box" data-href="<?php echo Options::get('fb_page_url')?>" data-width="700" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
        <?php /*?><div class="sharenews"><img src="<?php echo theme_url()?>images/socail.jpg" /></div>
<?php */?>
      </div>
      <div class="adsection">
        <p> <a href="<?php echo site_url('horoscope');?>"><img src="<?php echo base_url()?>assets/upload/sidebanner/horoscope_banner.jpg" title="horoscope" alt="horoscope" /></a> </p>
        <?php 
				if(Options::get('enable_election','NO')=='YES'){
					$img 		= 	 Options::get('banner_img');
					
			
				?>
        <p> <a href="<?php echo site_url('election');?>"><img src="<?php echo base_url()?>assets/upload/images/election/<?php echo $img?>" title="Election Result" alt="Election Result" /></a> </p>
        <?php echo Modules::run('sidebanner/_three', '6');?>
        <?php } else{?>
        <?php echo Modules::run('sidebanner/_three', '7');?>
        <?php } ?>
      </div>
      <div class="clear"></div>
    </div>
    <?php echo Modules::run('midadvertise/_latest');?>
         <div class="row last">
            <div class="col3">
                <?php echo Modules::run('content/newsbycategory', 17); ?>
            </div>
            <div class="col3">
                <?php echo Modules::run('content/newsbycategory',44);?>
            </div>
            <div class="col3 last">
                <?php echo Modules::run('content/newsbycategory', 19); ?>
            </div>
            <div class="clear"></div>
        </div>
  </div>
</div>
<script type="text/javascript">
$(function() {
	
	$('.gallery-hol a').colorbox({
		rel:"colorbox", 
		maxWidth:window.innerWidth, 
		maxHeight:window.innerHeight 
		});
	});
</script> 
<script type="text/javascript">
	
		function printhiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
		
	</script> 
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'chakrapath'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>
<?php get_footer()?>
