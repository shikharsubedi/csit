<?php

function format_content_excerpt($content)
{
	//check for page break
	$pattern = "/<div style=\"page-break-after: always;\">/";	
	preg_match($pattern, $content, $matches,PREG_OFFSET_CAPTURE);
	
	$image = findImage($content);
	
	if(count($matches) > 0)
	{
		$content = substr($content,0,$matches[0][1]);
		
	}
	$content = strip_tags($content);
	
	if($image){
		//append the image
		$imgtag = "<img src='{$image['src']}' style='float:right;' />";
		$content = $imgtag.$content;
	}
	return $content;
}

function strip_only_image($content)
{
	//check for page break
	$pattern = "/<div style=\"page-break-after: always;\">/";	
	preg_match($pattern, $content, $matches,PREG_OFFSET_CAPTURE);
	if(count($matches) > 0)		$content = substr($content,0,$matches[0][1]);

	//replace image with empty char
	$img_pat = "/<img(.*?)>/";
	$_c = preg_replace($img_pat,"",$content);

   return $_c;
}

function findImage($content)
{
	//check if any images are there
	$img = array();
	$imgpattern = "/<img(.*?)>/";
	preg_match($imgpattern, $content, $imgMatches);
	
	if(count($imgMatches) > 0)
	{
		$image = $imgMatches[0];
		$attpattern = "/[^<\w+](.*?)=\"(.*?)\"/";
		preg_match_all($attpattern, $image, $attributes);
		
		$attributes[0] = array_merge($attributes[0]);
		foreach($attributes[0] as $a)
		{
			$kvp = explode('="',$a);
			$key = strtolower(trim($kvp[0]));
			$value = trim(substr(trim($kvp[1]),0,-1));

			if($key == 'style')
			{
				//check for the last semicolon
				if(substr($value,-1) == ';')
					$value = substr($value,0,-1);
					
				$sa = explode(';',$value);
				foreach($sa as $s)
				{
					$val = explode(':',$s);
					$k = trim($val[0]);
					$v = trim($val[1]);
					
					$img['style'][$k] = $v;
				}	
			}
			else{
				$img[$key] = $value;
			}
			
		}
		
		return $img;
	}
	return FALSE;
}

function categorySelectTree($selected = NULL,$mode = 'select')
{
	$categories = CI::$APP->doctrine->em->getRepository('content\models\Content')->getCategories();
	
	return _generateCategorySelectTree($categories,0,$mode,$selected);
}

function _generateCategorySelectTree(&$categories,$nestLevel = 0,$mode = 'select',$selected)
{
	static $select;
	$select = $selected;
	$html = '';
	foreach($categories as $c)
	{
		if($mode == 'select'){
			$sel = (!is_null($select) && $c->id() == $select) ? " selected='selected'":"";
			$html .= "<option value=".$c->id()." {$sel}>".repeater("&mdash;",$nestLevel).$c->getTerm()->getName()."</option>";
		}
		
		else if($mode == 'checkbox')
			$html .= "<p>".repeater("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$nestLevel)."<input type='checkbox' class='select_category level-{$nestLevel}' name='category' value='{$c->id()}' /><label>{$c->getTerm()->getName()}</label></p>";
		
		$children = $c->getChildren();
		if($children->count() > 0){
			$html .= _generateCategorySelectTree($children,$nestLevel+1,$mode,$selected);
		}
	}
	
	return $html;
}



function pageSelectTree($selected = NULL,$mode = 'select')
{
	$pages = CI::$APP->doctrine->em->getRepository('content\models\Content')->getAllPages();
	return _generatePageSelectTree($pages, 0, $mode, $selected);
}

function _generatePageSelectTree(&$pages,$nestLevel = 0,$mode = 'select',$selected)
{
	static $select;
	$select = $selected;
	$html = '';
	foreach($pages as $c)
	{
		if($mode == 'select'){
			$sel = (!is_null($select) && $c->id() == $select) ? " selected='selected'":"";
			
			$html .= "<option value=".$c->id()." {$sel}>".repeater("&mdash;",$nestLevel).$c->getTitle()."</option>";
		}
		
		else if($mode == 'checkbox')
			$html .= "<p>".repeater("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$nestLevel)."<input type='checkbox' class='select_page level-{$nestLevel}' name='page' value='{$c->id()}' /><label>{$c->getTitle()}</label></p>";

		$children = $c->getChildren();
		if($children->count() > 0){
			$html .= _generatePageSelectTree($children,$nestLevel+1,$mode,$selected);
		}
		
	}
	
	return $html;
}

function categoryGrid()
{
	$categories = CI::$APP->doctrine->em->getRepository('content\models\Content')->getCategories();
	
	return _generateCategoryGrid($categories,0);
}

function _generateCategoryGrid(&$categories,$nestLevel = 0)
{
	$html = '';
	
	foreach($categories as $c)	
	{
		$html .="<tr>
          <td>";
		 $_padding = " style='padding-left:".($nestLevel*20)."px;'";
		 $html .="<p class='td_title' id='catname_".$c->id()."'{$_padding}>".$c->getTerm()->getName()."</p></td>
          <td align='center'>".$c->getContents()->count()."</td>
          <td class='action'><div class='action-controls'>
          	<a href='".admin_url('content/category/edit/'.$c->id())."' class='action-button' title='Edit category'><span class='ui-icon ui-icon-pencil'></span></a>";
        if($c->id() != 1 and $c->id() !=2 and $c->id() !=3 and $c->id() !=4 and $c->id() !=5):
            $html .="<a href='".admin_url('content/category/delete/'.$c->id())."' class='action-button delete-category' title='Delete category'><span class='ui-icon ui-icon-trash'></span></a>";
             endif;
           $html .=" <a href='".admin_url('content/cat/'.$c->getTerm()->id())."' class='action-button' title='See Articles'><span class='ui-icon ui-icon-arrowthick-1-ne'></span></a>
              <div class='clear'></div>
            </div></td>
        </tr>";
		
		
		$children = $c->getChildren();
		if($children->count() > 0){
			//Doctrine\Common\Util\Debug::dump($children);
			$html .= _generateCategoryGrid($children,$nestLevel+1);
		}
	}
	
	return $html;
}

function contentSelectTree($selected = NULL,$mode = 'select')
{
	
	$categories = CI::$APP->doctrine->em->getRepository('content\models\Content')->getALl();
	return _generatePageSelectTree($categories,0,$mode,$selected);
}


function the_content()
{
	global $_content;
	
	//search for short codes
	$_short_code_pattern = '/\[(.*?)\]/';
	preg_match_all($_short_code_pattern,$_content,$matches);
//	show_pre($matches);exit;
	if(count($matches[1] > 0))
	{
		
		
		foreach($matches[1] as $shortcode)
		{
			//check if attributes exist
			$parts = explode(' ',$shortcode);
			
			$command = $parts[0];
			$args = NULL;
			
			if(count($parts) > 1)
			{
				array_shift($parts);
				//
				//now get the key value pair
				
				foreach($parts as $p)
				{
					
					$kvp = explode('=',$p);
					
					$key = trim($kvp[0]);
					$value = trim($kvp[1]);
					
					$args[$key] = $value;
					
				}
			}
		
			$_eq = do_shortcode($command,$args);
			
			if($_eq)
				$_content = str_replace('['.$shortcode.']',$_eq,$_content);
		}
	}
	//echo outlet_locator_map();
	echo $_content;
}

function the_subpages()
{
	global $_content, $_ID;
	
	// For Listing of Subpages
	$repo = CI::$APP->doctrine->em->getRepository('content\models\Content');
	$subpages = $repo->getChildrenPages($_ID);
	
	return $subpages;
}

function the_related_pages()
{
	global $_type,$_ID;
	
	if($_type != 'article'){
		// Getting Parent
		$content = CI::$APP->doctrine->em->find('content\models\Content',$_ID);
		if($content->getParent()){
			$parent_id = $content->getParent()->id();
		}else{
			$parent_id = NULL;
		}
	}else{
		$parent_id = NULL;
	}
	 
	// For Listing of Related Pages
	$repo = CI::$APP->doctrine->em->getRepository('content\models\Content');
	$relatedpages = $repo->getRelatedPages($_type,$parent_id);
	
	return $relatedpages;
}


function articleSelectTree($selected = NULL,$mode = 'select')
{
	$pages = CI::$APP->doctrine->em->getRepository('content\models\Content')->getArticles();
	return _generateArticleSelectTree($pages, 0, $mode, $selected);
}
function articleCatSelectTree($cat='',$selected = NULL,$mode = 'select' )
{
	$pages = CI::$APP->doctrine->em->getRepository('content\models\Content')->findContentByCategory($cat);
	//\Doctrine\Common\Util\Debug::dump($pages);
	return _generateArticleSelectTree($pages, 0, $mode, $selected);
}

function _generateArticleSelectTree(&$pages,$nestLevel = 0,$mode = 'select',$selected)
{
	static $select;
	$select = $selected;
	$html = '';
	foreach($pages as $c)
	{
		
		if($mode == 'select'){
			$sel = (!is_null($select) && $c->id() == $select) ? " selected='selected'":"";
			
			$html .= "<option value=".$c->id()." {$sel}>".repeater("&mdash;",$nestLevel).$c->getTitle()."</option>";
		}
		
		else if($mode == 'checkbox')
			$html .= "<p>".repeater("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$nestLevel)."<input type='checkbox' class='select_page level-{$nestLevel}' name='page' value='{$c->id()}' /><label>{$c->getTitle()}</label></p>";

		$children = $c->getChildren();
		if($children->count() > 0){
			$html .= _generatePageSelectTree($children,$nestLevel+1,$mode,$selected);
		}
		
	}
	
	return $html;
}


