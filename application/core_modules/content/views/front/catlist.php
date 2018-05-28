
              
<div class="product">
    <p class="title">Information Center</p>
    <div class="product_holder">
        <?php
    foreach($articles->result() as $a):
?>
<div class="boxBody_2">
        <h3><?php echo $a->title;?></h3>
        <span class="date">October 11,2011</span>
        <span><?php echo $a->body?></span>
        <span class="hlink"><a href="<?php echo site_url('content/'.$a->prettyurl);?>">read more</a></span>
</div>
<?php endforeach;?>

    </div>
    <div class="product_crv">&nbsp;</div>
</div>