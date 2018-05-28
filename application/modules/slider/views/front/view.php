<?php get_header()?>
<link rel="stylesheet" href="<?php echo theme_url()?>css/stylenew.css" />



<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=369358903229337&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


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
            

                <?php 	
                
					if($images ){
					?>
					
					<div class="slide-show-wrapper dark-bg uk-panel uk-panel-space">
                        <div class="uk-panel uk-margin-bottom"><h1 class="uk-float-left">Gallery<span class="title_rt"><a href="<?php echo site_url('slider/viewall');?>">View All</a></span></h1>
                        </div><hr>
                         <script type="text/javascript">
                        
							var theInt = null;
							var $crosslink, $navthumb;
							var curclicked = 0;
							
								theInterval = function(cur){
								clearInterval(theInt);
								
								if( typeof cur != 'undefined' )
								curclicked = cur;
								
								$crosslink.removeClass("active-thumb");
								$navthumb.eq(curclicked).parent().addClass("active-thumb");
								$(".stripNav ul li a").eq(curclicked).trigger('click');
								
								theInt = setInterval(function(){
								$crosslink.removeClass("active-thumb");
								$navthumb.eq(curclicked).parent().addClass("active-thumb");
								$(".stripNav ul li a").eq(curclicked).trigger('click');
								curclicked++;
								if( 6 == curclicked )
								curclicked = 0;
								
								}, 10000);
								};
							
							$(function(){
							
							$("#main-photo-slider").codaSlider();
							
							$navthumb = $(".nav-thumb");
							$crosslink = $(".cross-link");
							
							$navthumb
							.click(function() {
								var $this = $(this);
								theInterval($this.parent().attr('href').slice(1) - 1);
								return false;
							});
							
							theInterval();
							});
                        </script>
					
                        <div id="page-wrap">
                            <div id="main-photo-slider" class="csw">
                                <div class="panelContainer">
									<?php foreach($images as $i):?>
                                    
                                    
                                        <div class="panel" title="<?php echo $i['name']?>">
                                            <div class="photo-meta-data">
                                                <h3> 
<?php echo $i['name']?> </h3>
                                                <p><?php echo $i['description']?> </p>
                                                </div>
                                                <div class="wrapper">
                                                
                                               <img src="<?php echo base_url().'assets/upload/images/slider/'.$i['image']?>"  width="750px" height="505px" />
                                             
                                            </div>
                                        </div>
                                        
                                        
                                    <?php endforeach;?>
                                </div>
                            </div>
							<?php $k = 1;?>
                            
                            <div id="movers-row">
                            
								<?php foreach($images as $i): ?>
                                
                                	<div><a href="#<?php echo $k?>" class="cross-link"><img src="<?php echo base_url().'assets/upload/images/slider/'.$i['thumbnail']?>" class="nav-thumb" alt="temp-thumb"/></a></div>
                                
                                <?php $k++; endforeach;?>
                            	<div class="clear"></div>
                            </div>
                        </div>
					</div>
					<?php }?>
               
                
            	<div id="disqus_thread"></div>
				<script type="text/javascript">
                /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                var disqus_shortname = 'chakrapath'; // required: replace example with your forum shortname
                
                /* * * DON'T EDIT BELOW THIS LINE * * */
                (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
                </script>
            	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            	<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
            
            	<div class="fb-like-box" data-href="<?php echo Options::get('fb_page_url')?>" data-width="700" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
            	<div>
            
            		
            
            	</div>
            
            
            
            <?php /*?><div class="sharenews"><img src="<?php echo theme_url()?>images/socail.jpg" /></div>
            <?php */?>
            </div>
            
            <div class="adsection">
                <p>
                	<a href="<?php echo site_url('horoscope');?>"><img src="<?php echo base_url()?>assets/upload/sidebanner/horoscope_banner.jpg" title="horoscope" alt="horoscope" /></a>
                </p>
                
                <?php 
                if(Options::get('enable_election','NO')=='YES'){
                	$img 		= 	 Options::get('banner_img');
                
                
                ?>  
                	<p>
                		<a href="<?php echo site_url('election');?>"><img src="<?php echo base_url()?>assets/upload/images/election/<?php echo $img?>" title="Election Result" alt="Election Result" /></a>
                	</p>
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