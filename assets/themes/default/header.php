<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo isset($title) ? $title : 'F1 CMS Front End'?></title>
<link href="<?php echo theme_url().'style/layout.css?'.time()?>" rel="stylesheet" media="screen" />
<link href="<?php echo theme_url().'style/style.css?'.time()?>"  rel="stylesheet" media="screen"/>
</head>
<body>
<div id="wrap" class="container_12">

<div id="header">
    <div class="brand grid_2">
        <a href="<?php echo site_url()?>"><img src="<?php echo base_url()."assets/upload/images/config/".Options::get('brand_image')?>" /></a>
    </div>
    
     <div class="intro grid_10">
        <h1><?php echo isset($title) ? $title : 'F1 CMS Demo'?></h1>
    </div>
    <div class="clear"></div>
</div>

<div id="navigation">
	<div class="grid_12" id="nav">
    	<ul>
        	<li><a href="#"><span>Link 1</span></a></li>
            <li><a href="#"><span>Link 2</span></a></li>
            <li><a href="#"><span>Link 3</span></a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div>