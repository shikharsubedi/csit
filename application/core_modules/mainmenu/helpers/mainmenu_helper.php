<?php

function getTopmenuTree($parent = NULL, $nestLevel = 0) {

    static $_max_nest;
    $_max_nest = _t('mainmenu_max_nest_level');

    CI::$APP->load->model('mainmenu/mainmenu_model', 'mm');
    $root = CI::$APP->mm->getTopmenuTree($parent);

    $menu = array();
    $selectMenu = NULL;

    if (!defined($selectMenu))
        $selectMenu = NULL;
    else
        $selectMenu = $selectMenu;

    foreach ($root as $_r) {

        $type = $_r->getType();
        $label = $_r->getlabel();
        $reference = $_r->getReference();
        $_children = NULL;
        $url = '';
        $children = NULL;
        $category = NULL;
        $content = NULL;
        $package = NULL;
        $brand = NULL;
        $product = NULL;
        $_slug = NULL;
        $mainid = $_r->id();
        $cparent = ($_r->getParent() != '') ? $_r->getParent()->id() : NULL;

        switch ($type) {

            case mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK:
                if (preg_match("@^http://@i", $reference))
                    $url = $reference;
                else
                    $url = site_url($reference);
                break;

            case mainmenu\models\Mainmenu::MAINMENU_TYPE_CATEGORY:
                $category = & CI::$APP->doctrine->em->find('\content\models\Taxonomy', $reference);

                if (!$category) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $category->getTerm()->getSlug();
                    $url = site_url('category/' . $_slug);
                }

                break;
				
			 case mainmenu\models\Mainmenu::MAINMENU_TYPE_MANAGEMENT:
                $management = & CI::$APP->doctrine->em->find('\management\models\ManagementType', $reference);

                if (!$management) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $management->getSlug();
                    
                    $url = site_url('management/'. $_slug);
                }

                break;
				
			case mainmenu\models\Mainmenu::MAINMENU_TYPE_PRODUCT:
                $product = & CI::$APP->doctrine->em->find('\product\models\Product', $reference);

                if (!$product) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $product->getSlug();
                    
                    $url = site_url('product/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_DOWNLOAD:
                $download = & CI::$APP->doctrine->em->find('\downloads\models\Download_category', $reference);
                
                if (!$download) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $download->getSlug();
                    
                    $url = site_url('downloads/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_REPORT:
                $report = & CI::$APP->doctrine->em->find('\report\models\Report_category', $reference);

                if (!$report) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $report->getSlug();
                    
                    $url = site_url('report/'. $_slug);
                }

                break;


            default:
                $content = & CI::$APP->doctrine->em->find('\content\models\Content', $reference);

                if (!$content) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $content->getSlug();
                    $url = site_url($_slug);
                }
        }

        $_children = $_r->getChildren();
        $child = count($_children);

        if ($_children->count() > 0 && $nestLevel < $_max_nest) {
           // $url = 'javascript:;';
            $children = getTopmenuTree($_r->id(), $nestLevel + 1);
        }

        if ($url == current_url()) {

            if ($cparent != "") {
                $selectMenu = $cparent;
            } else {
                $selectMenu = $mainid;
            }
            /* echo "<script>var parentMenu = '".$selectMenu."'</script>"; */
        }

        $menu[] = array('url' => $url,
            'label' => $label,
            'children' => $children,
            'slug' => $_slug,
            'mainid' => $mainid,
            'parent' => $cparent,
            'reference' => $reference,
            'child' => $child
        );

        unset($category);
        unset($content);
    }

    return $menu;
}

function getTopmenuTreeChild($parent = NULL,$nestLevel = 0)
{
    static $_max_nest;
    $_max_nest = _t('mainmenu_max_nest_level');
    
    CI::$APP->load->model('mainmenu/mainmenu_model','mm');
    $root = CI::$APP->mm->getTopmenuTreeChild($parent);
    
    $menu = array();
    
    foreach($root as $_r) {
        $type       = $_r->getType();
        $label  = $_r->getlabel();      
        $reference  = $_r->getReference();
        $url        = '';
        $children   = NULL;
        $category   = NULL;
        $content    = NULL;
        
        switch($type){ 
        
            case mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK:
                $url = $reference;
            break;
                
            case mainmenu\models\Mainmenu::MAINMENU_TYPE_CATEGORY:
                $category =& CI::$APP->doctrine->em->find('\content\models\Taxonomy',$reference); 
                
                if(!$category){
                    $url = '#';
                }else{
                    $_slug = $category->getTerm()->getSlug();
                    $url = site_url('content/category/'.$_slug);
                }
                
            break;
			
			 case mainmenu\models\Mainmenu::MAINMENU_TYPE_MANAGEMENT:
                $management = & CI::$APP->doctrine->em->find('\management\models\ManagementType', $reference);

                if (!$management) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $management->getSlug();
                    
                    $url = site_url('management/'. $_slug);
                }

                break;
				
			case mainmenu\models\Mainmenu::MAINMENU_TYPE_PRODUCT:
                $product = & CI::$APP->doctrine->em->find('\product\models\Product', $reference);

                if (!$product) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $product->getSlug();
                    
                    $url = site_url('product/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_DOWNLOAD:
                $download = & CI::$APP->doctrine->em->find('\downloads\models\Download_category', $reference);
                
                if (!$download) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $download->getSlug();
                    
                    $url = site_url('downloads/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_REPORT:
                $report = & CI::$APP->doctrine->em->find('\report\models\Report_category', $reference);

                if (!$report) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $report->getSlug();
                    
                    $url = site_url('report/'. $_slug);
                }

                break;
            
            default:
                $content =& CI::$APP->doctrine->em->find('\content\models\Content',$reference);
                
                if(!$content)
                {
                    $url = '#';
                }else{
                    $_slug = $content->getSlug();
                    $url = site_url($_slug);
                }               
        }

        $_children = $_r->getChildren();
        
        if($_children->count() > 0 && $nestLevel < $_max_nest) {
        //  $url = '#';
            $children = getMenuTree($_r->id(),$nestLevel+1);
        }
        
        $menu[] = array(    'url'       =>  $url,
                            'label'     =>  $label,                         
                            'children'  =>  $children,
                            'type'      =>  $type);
        
        unset($category);
        unset($content);
    }
    return $menu;
}

function getParentFirstChild($id = NULL,$nestLevel = 0){
	
    static $_max_nest;
    $_max_nest = _t('mainmenu_max_nest_level');
    
    CI::$APP->load->model('mainmenu/mainmenu_model','mm');
    $root = CI::$APP->mm->getParentFirstChild($id);
    
    $menu = array();    
    
	$type       = $root[0]->getType();
	$label  	= $root[0]->getlabel();      
	$reference  = $root[0]->getReference();
	$url        = '';
	$children   = NULL;
	$category   = NULL;
	$content    = NULL;
        
	switch($type){ 
	
		case mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK:
			$url = $reference;
		break;
			
		case mainmenu\models\Mainmenu::MAINMENU_TYPE_CATEGORY:
			$category =& CI::$APP->doctrine->em->find('\content\models\Taxonomy',$reference); 
			
			if(!$category){
				$url = '#';
			}else{
				$_slug = $category->getTerm()->getSlug();
				$url = site_url('content/category/'.$_slug);
			}
			
		break;
		
		 case mainmenu\models\Mainmenu::MAINMENU_TYPE_MANAGEMENT:
			$management = & CI::$APP->doctrine->em->find('\management\models\ManagementType', $reference);

			if (!$management) {
				$url = 'javascript:;';
			} else {
				$_slug = $management->getSlug();
				
				$url = site_url('management/'. $_slug);
			}

			break;
			
		case mainmenu\models\Mainmenu::MAINMENU_TYPE_PRODUCT:
			$product = & CI::$APP->doctrine->em->find('\product\models\Product', $reference);

			if (!$product) {
				$url = 'javascript:;';
			} else {
				$_slug = $product->getSlug();
				
				$url = site_url('product/'. $_slug);
			}

			break;

			case mainmenu\models\Mainmenu::MAINMENU_TYPE_DOWNLOAD:
			$download = & CI::$APP->doctrine->em->find('\downloads\models\Download_category', $reference);
			
			if (!$download) {
				$url = 'javascript:;';
			} else {
				$_slug = $download->getSlug();
				
				$url = site_url('downloads/'. $_slug);
			}

			break;

			case mainmenu\models\Mainmenu::MAINMENU_TYPE_REPORT:
			$report = & CI::$APP->doctrine->em->find('\report\models\Report_category', $reference);

			if (!$report) {
				$url = 'javascript:;';
			} else {
				$_slug = $report->getSlug();
				
				$url = site_url('report/'. $_slug);
			}

			break;
		
		default:
			$content =& CI::$APP->doctrine->em->find('\content\models\Content',$reference);
			
			if(!$content)
			{
				$url = '#';
			}else{
				$_slug = $content->getSlug();
				$url = site_url($_slug);
			}               
	}  
        
	$menu[] = array(    'url'       =>  $url,
						'label'     =>  $label,                         
						'children'  =>  $children,
						'type'      =>  $type);
	
	unset($category);
	unset($content);
		
    return $menu;
}

function getMenuTree($parent = NULL, $nestLevel = 0) {

    static $_max_nest;
    $_max_nest = _t('mainmenu_max_nest_level');

    CI::$APP->load->model('mainmenu/mainmenu_model', 'mm');
    $root = CI::$APP->mm->getMainenuTree($parent);

    $menu = array();
    $selectMenu = NULL;

    if (!defined($selectMenu))
        $selectMenu = NULL;
    else
        $selectMenu = $selectMenu;

    foreach ($root as $_r) {

        $type = $_r->getType();
        $label = $_r->getlabel();
        // $image = $_r->getImage();
        $reference = $_r->getReference();
        $_children = NULL;
        $url = '';
        $children = NULL;
        $category = NULL;
        $content = NULL;
        $package = NULL;
        $brand = NULL;
        $product = NULL;
        $_slug = NULL;
        $mainid = $_r->id();
        $cparent = ($_r->getParent() != '') ? $_r->getParent()->id() : NULL;

        switch ($type) {
            case mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK:

                if ($reference != '' && $reference != '#') {
                    if (preg_match("@^http://@i", $reference))
                        $url = $reference;
                    else
                        $url = site_url().$reference;
                }else if($reference =='')
                    $url = site_url();
                else
                    $url =$reference;
                break;

            case mainmenu\models\Mainmenu::MAINMENU_TYPE_CATEGORY:
                $category = & CI::$APP->doctrine->em->find('\content\models\Taxonomy', $reference);

                if (!$category) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $category->getTerm()->getSlug();
                    $url = site_url('category/' . $_slug);
                }

                break;

            

            case mainmenu\models\Mainmenu::MAINMENU_TYPE_PRODUCT:
                $product = & CI::$APP->doctrine->em->find('\product\models\Product', $reference);

                if (!$product) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $product->getSlug();
                    
                    $url = site_url('product/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_DOWNLOAD:
                $download = & CI::$APP->doctrine->em->find('\downloads\models\Download_category', $reference);
                
                if (!$download) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $download->getSlug();
                    
                    $url = site_url('downloads/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_REPORT:
                $report = & CI::$APP->doctrine->em->find('\report\models\Report_category', $reference);

                if (!$report) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $report->getSlug();
                    
                    $url = site_url('report/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_MANAGEMENT:
                $management = & CI::$APP->doctrine->em->find('\management\models\ManagementType', $reference);

                if (!$management) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $management->getSlug();
                    
                    $url = site_url('management/'. $_slug);
                }

                break;


            default:
                $content = & CI::$APP->doctrine->em->find('\content\models\Content', $reference);

                if (!$content) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $content->getSlug();
                    //$url = site_url('content/'.$_slug);
                    $url = site_url($_slug);
                }
        }

        $_children = $_r->getChildren();
        $child = count($_children);

        if ($_children->count() > 0 && $nestLevel < $_max_nest) {
            //$url      = 'javascript:;';
            $children = getMenuTree($_r->id(), $nestLevel + 1);
        }

        if ($url == current_url()) {

            if ($cparent != "") {
                $selectMenu = $cparent;
            } else {
                $selectMenu = $mainid;
            }
            /* echo "<script>var parentMenu = '".$selectMenu."'</script>"; */
        }

        $menu[] = array('url' => $url,
            'label' => $label,
            'children' => $children,
            'slug' => $_slug,
            'mainid' => $mainid,
            'parent' => $cparent,
            'reference' => $reference,
            'child' => $child,
            // 'image' =>$image
        );

        unset($category);
        unset($content);
    }

    return $menu;
}

function getSinglemenuTree($parent = NULL, $nestLevel = 0){
    static $_max_nest;
    $_max_nest = _t('mainmenu_max_nest_level');

    CI::$APP->load->model('mainmenu/mainmenu_model', 'mm');
    $root = CI::$APP->mm->getMainenuTree($parent);
    // \Doctrine\Common\Util\Debug::dump($root); exit;
    $menu = array();
    $selectMenu = NULL;

    if (!defined($selectMenu))
        $selectMenu = NULL;
    else
        $selectMenu = $selectMenu;

    foreach ($root as $_r) {

        $type = $_r->getType();
        $label = $_r->getlabel();
        // $image = $_r->getImage();
        $reference = $_r->getReference();
        $_children = NULL;
        $url = '';
        $children = NULL;
        $category = NULL;
        $content = NULL;
        $package = NULL;
        $brand = NULL;
        $product = NULL;
        $_slug = NULL;
        $mainid = $_r->id();
        $cparent = ($_r->getParent() != '') ? $_r->getParent()->id() : NULL;
		$parentname = ($_r->getParent() != '') ? $_r->getParent()->getLabel() : NULL;

        switch ($type) {
            case mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK:

                if ($reference != '' && $reference != '#') {
                    if (preg_match("@^http://@i", $reference))
                        $url = $reference;
                    else
                        $url = site_url().$reference;
                }else if($reference =='')
                    $url = site_url();
                else
                    $url =$reference;
                break;

            case mainmenu\models\Mainmenu::MAINMENU_TYPE_CATEGORY:
                $category = & CI::$APP->doctrine->em->find('\content\models\Taxonomy', $reference);

                if (!$category) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $category->getTerm()->getSlug();
                    $url = site_url('category/' . $_slug);
                }

                break;

            

            case mainmenu\models\Mainmenu::MAINMENU_TYPE_PRODUCT:
                $product = & CI::$APP->doctrine->em->find('\product\models\Product', $reference);

                if (!$product) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $product->getSlug();
                    
                    $url = site_url('product/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_DOWNLOAD:
                $download = & CI::$APP->doctrine->em->find('\downloads\models\Download_category', $reference);
                
                if (!$download) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $download->getSlug();
                    
                    $url = site_url('downloads/'. $_slug);
                }

                break;

                case mainmenu\models\Mainmenu::MAINMENU_TYPE_REPORT:
                $report = & CI::$APP->doctrine->em->find('\report\models\Report_category', $reference);

                if (!$report) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $report->getSlug();
                    
                    $url = site_url('report/'. $_slug);
                }

                break;
                 case mainmenu\models\Mainmenu::MAINMENU_TYPE_MANAGEMENT:
                $management = & CI::$APP->doctrine->em->find('\management\models\ManagementType', $reference);

                if (!$management) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $management->getSlug();
                    
                    $url = site_url('management/'. $_slug);
                }

                break;

            default:
                $content = & CI::$APP->doctrine->em->find('\content\models\Content', $reference);

                if (!$content) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $content->getSlug();
                    //$url = site_url('content/'.$_slug);
                    $url = site_url($_slug);
                }
        }

        $_children = $_r->getChildren();
        $child = count($_children);

        // if ($_children->count() > 0 && $nestLevel < $_max_nest) {
        //     //$url      = 'javascript:;';
        //     $children = getMenuTree($_r->id(), $nestLevel + 1);
        // }

        if ($url == current_url()) {

            if ($cparent != "") {
                $selectMenu = $cparent;
            } else {
                $selectMenu = $mainid;
            }
            /* echo "<script>var parentMenu = '".$selectMenu."'</script>"; */
        }

        $menu[] = array(
			'url' 		=> $url,
            'label' 	=> $label,
            'children' 	=> $_children,
            'slug' 		=> $_slug,
            'mainid' 	=> $mainid,
            'parent' 	=> $cparent,
            'reference' => $reference,
            'child' 	=> $child, 
			'parentname'=> $parentname, 
            // 'image' =>$image
        );
		
		

        unset($category);
        unset($content);
    }
	//echo "<pre>";
	//\Doctrine\Common\Util\Debug::dump($menu);exit;

    return $menu;

}

function _getMenuTree($parent = NULL, $nestLevel = 0) {
    static $_max_nest;
    $_max_nest = _t('mainmenu_max_nest_level');

    CI::$APP->load->model('mainmenu/mainmenu_model', 'mm');
    $root = CI::$APP->mm->getMenuTree($parent);
    $menu = array();

    foreach ($root as $_r) {
        $type = $_r->getType();
        $label = $_r->getlabel();
        // $image = $_r->getImage();
        $topmenu = $_r->getTopmenu();
        $reference = $_r->getReference();
        $url = '';
        $children = NULL;

        switch ($type) {
            case mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK:
                if ($reference != '' && $reference != '#') {
                    $url = $reference;
                }
                break;

            case mainmenu\models\Mainmenu::MAINMENU_TYPE_CATEGORY:
                $category = CI::$APP->doctrine->em->find('\content\models\Taxonomy', $reference);

                if (!$category) {
                    $url = '#';
                } else {
                    $_slug = $category->getTerm()->getSlug();
                    $url = site_url($_slug);
                    unset($category);
                }
                break;

           

            case mainmenu\models\Mainmenu::MAINMENU_TYPE_PRODUCT:
                $product = & CI::$APP->doctrine->em->find('\product\models\Product', $reference);

                if (!$product) {
                    $url = '#';
                } else {
                    $_slug = $product->getSlug();
                    $url = site_url('product/' . $_slug);
                    unset($product);
                }

                break;
            case mainmenu\models\Mainmenu::MAINMENU_TYPE_DOWNLOAD:
            $download = & CI::$APP->doctrine->em->find('\downloads\models\Download_category', $reference);

            if (!$download) {
                $url = '#';
            } else {
                $_slug = $download->getSlug();
                $url = site_url('downloads/' . $_slug);
                unset($download);
            }

            break;

             case mainmenu\models\Mainmenu::MAINMENU_TYPE_REPORT:
            $report = & CI::$APP->doctrine->em->find('\report\models\Report_category', $reference);

            if (!$report) {
                $url = '#';
            } else {
                $_slug = $report->getSlug();
                $url = site_url('report/' . $_slug);
                unset($report);
            }

            break;
             case mainmenu\models\Mainmenu::MAINMENU_TYPE_MANAGEMENT:
                $management = & CI::$APP->doctrine->em->find('\management\models\ManagementType', $reference);

                if (!$management) {
                    $url = 'javascript:;';
                } else {
                    $_slug = $management->getSlug();
                    
                    $url = site_url('management/'. $_slug);
                     unset($management);
                }

                break;
            

            default:
                $content = CI::$APP->doctrine->em->find('\content\models\Content', $reference);
                if (!$content) {
                    $url = '#';
                } else {
                    $_slug = $content->getSlug();
                    $url = site_url($_slug);
                    unset($content);
                }
        }

        $_children = $_r->getChildren();

        if ($_children->count() > 0 && $nestLevel < $_max_nest) {
            //$url = '#';
            $children = _getMenuTree($_r->id(), $nestLevel + 1);
        }

        $menu[] = array('m_id' => $_r->id(),
            'url' => $url,
            'reference' => $reference,
            'topmenu' => $topmenu,
            'type' => $type,
            'label' => $label,
            // 'image' => $image,
            'children' => $children);
    }
    return $menu;
}

function _admin_manage_menu_tree(&$tree) {

    static $count = 0;
    $html = '';
   
    foreach ($tree as $_r) {

        $submenuToggle = '';

        $checked = ($_r['topmenu'] == 'Y') ? "checked" : "";

        $topmenu = ($_r['topmenu'] == 'Y') ? 'Y' : 'Y';

        if (!is_null($_r['children'])) {
            $submenuToggle = '<span class="submenu-toggle">Show Submenus</span>';
        }
        $html .= "<li id='menuitem-{$_r['m_id']}'><div>{$_r['label']} ( " . ucfirst($_r['type']) . " )<span class='item-control'></span>{$submenuToggle}</div><div class='menu_controls'>";

        if ($_r['type'] == mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK) {
            $html .= "<p>URL</p><p><input type='text' name='reference[label-{$_r['m_id']}]' class='regular-text' value='{$_r['reference']}' /></p>";
        }

        $html .= "<p>Label</p><p><input type='text' name='menulabel[label-{$_r['m_id']}]' class='regular-text' value='{$_r['label']}' />";

        $html .= "<p>Top Menu?</p><p><input type='checkbox' onclick='hideshowmenu()' {$checked} name='topmenu[label-{$_r['m_id']}]' class='regular-text' value='{$topmenu}' /><input type='hidden' name='menutype[label-{$_r['m_id']}]' value='{$_r['type']}' />";

       //  $html .= "<p>Image (max size: 50 *50 px)</p>"
       //         . "<p><input type='file' name='menuimage[image-{$_r['m_id']}]' value='{$_r['image']}' onchange=\"myFunction()\"/>";
       // if ($_r['image']) {
       //    $html .="<img src=\"".site_url()."assets/upload/images/mainmenu/".$_r['image']."\" alt=\"Image unavailable\" height=\"50\" width=\"50\">";
       //    $html .="<input type=checkbox name=menuRemoveImage[remove-{$_r['m_id']}] value=1 onchange=myFunction()>Remove";
       // }
        if ($_r['type'] != mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK)
            $html .= "<input type='hidden' name='reference[label-{$_r['m_id']}]' value='{$_r['reference']}' />";

        $html .= "<input type='hidden' class='order' name='order[label-{$_r['m_id']}]' value='" . $count++ . "' />";
        $html .= "<p><a href='#' class='remove_menuitem'>Remove</a></p></div>";

        if (!is_null($_r['children']))
            $html .= '<ol style="display:none;">' . _admin_manage_sub_menu_tree($_r['children']) . '</ol>';
        $html .= '</li>';
    }

    return $html;
}


function _admin_manage_sub_menu_tree(&$tree) {

    static $count = 0;
    $html = '';
   
    foreach ($tree as $_r) {
        $submenuToggle = '';

        $checked = ($_r['topmenu'] == 'Y') ? "checked" : "";

        $topmenu = ($_r['topmenu'] == 'Y') ? 'Y' : 'Y';

        if (!is_null($_r['children'])) {
            $submenuToggle = '<span class="submenu-toggle">Show Submenus</span>';
        }
        $html .= "<li id='menuitem-{$_r['m_id']}'><div>{$_r['label']} ( " . ucfirst($_r['type']) . " )<span class='item-control'></span>{$submenuToggle}</div><div class='menu_controls'>";

        if ($_r['type'] == mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK) {
            $html .= "<p>URL</p><p><input type='text' name='reference[label-{$_r['m_id']}]' class='regular-text' value='{$_r['reference']}' /></p>";
        }

        $html .= "<p>Label</p><p><input type='text' name='menulabel[label-{$_r['m_id']}]' class='regular-text' value='{$_r['label']}' />";

        $html .= "<p>Top Menu?</p><p><input type='checkbox' onclick='hideshowmenu()' {$checked} name='topmenu[label-{$_r['m_id']}]' class='regular-text' value='{$topmenu}' /><input type='hidden' name='menutype[label-{$_r['m_id']}]' value='{$_r['type']}' />";

       
        if ($_r['type'] != mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK)
            $html .= "<input type='hidden' name='reference[label-{$_r['m_id']}]' value='{$_r['reference']}' />";

        $html .= "<input type='hidden' class='order' name='order[label-{$_r['m_id']}]' value='" . $count++ . "' />";
        $html .= "<p><a href='#' class='remove_menuitem'>Remove</a></p></div>";

        if (!is_null($_r['children']))
            $html .= '<ol style="display:none;">' . _admin_manage_sub_menu_tree($_r['children']) . '</ol>';
        $html .= '</li>';
    }

    return $html;
}

function __menu_tree() {
    
}

function getRightMenu($reference,$nestLevel = 0) {
    
    
    static $_max_nest;  
    $_max_nest = _t('mainmenu_max_nest_level');
    
    CI::$APP->load->model('mainmenu/mainmenu_model', 'mm');   
    
    $lroot = CI::$APP->mm->getParent($reference);       
    if($lroot){ 
    
        $parent =  $lroot[0]->id(); 
    
        $parentinfo = CI::$APP->mm->getMenuInfo($parent);
        
        $root = CI::$APP->mm->getMenuTree($parent);
        
        $menu = array();
        
        foreach($root as $_r) {
            
            $type       = $_r->getType();
            $label      = $_r->getlabel();
            $reference  = $_r->getReference();
            $url        = '';
            $children   = NULL;
            $category   = NULL;
            $content    = NULL;
            
            switch($type) {
                
                case mainmenu\models\Mainmenu::MAINMENU_TYPE_LINK:
                    $url = $reference;
                break;
                    
                case mainmenu\models\Mainmenu::MAINMENU_TYPE_CATEGORY:
                    $category =& CI::$APP->doctrine->em->find('\content\models\Taxonomy',$reference); 
                    
                    if(!$category){
                        $url = '#';
                    }else{
                        $_slug = $category->getTerm()->getSlug();
                        $url = site_url('category/'.$_slug);
                    }
                    
                break;
                
                default:
                    $content =& CI::$APP->doctrine->em->find('\content\models\Content',$reference);
                    
                    if(!$content)
                    {
                        $url = '#';
                    }else{
                        $_slug = $content->getSlug();
                        $url = site_url($_slug);
                    }
                    
            }
    
            $_children = $_r->getChildren();
            
            if($_children->count() > 0 && $nestLevel < $_max_nest)
            {
            //  $url = '#';
                $children = getMenuTree($_r->id(),$nestLevel+1);
            }
            
            
            $menu[] = array(    'parentname'=> $parentinfo[0]->getLabel(),
                                'url'       =>  $url,
                                'label'     =>  $label,
                                'children'  =>  $children);
            
            unset($category);
            unset($content);
        }
        return $menu;
    }else{
        return false;   
    }
}

?>