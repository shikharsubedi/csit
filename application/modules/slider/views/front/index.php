<ul>
<?php 
	if($images){

		foreach($images as $i){

			?>
			<li data-fstransition="fade" data-transition="fade" data-slotamount="10" data-masterspeed="300">
				<img src="<?php echo base_url().'assets/upload/images/slider/'.$i['image']?>" alt="<?php echo $i['name']?>">
				<?php 
				$slider = $this->doctrine->em->find('slider\models\Slider',$i['id']);
				// $id = $this->doctrine->em->find()
				$id = $slider->getLink(); 
				$content = $this->doctrine->em->find('content\models\Content', $id);
				
				if($content){
					?>
					<div class="caption title sfb" data-x="center" data-y="165" data-speed="400" data-start="800"  data-easing="easeOutExpo">
					<h2><?php echo strtoupper($content->getTitle())?></h2>
					</div>

					<div class="caption text align-center sfb" data-x="center" data-y="240" data-speed="400" data-start="1200" data-easing="easeOutExpo">
						<p><?php echo strip_tags(word_limiter($content->getBody(), 15))?></p>
					</div>

					<div class="caption sfb" data-x="center" data-y="370" data-speed="400" data-start="1600" data-easing="easeOutExpo">
						<a href="<?php echo site_url('content/'.$content->getSlug()) ?>" class="button">Read More »</a>
						
					</div>
					<?php
				}
				?>
				
			</li>
			<?php
		}
	}
?>

			
</ul>