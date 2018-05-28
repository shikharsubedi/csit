<?php

function csit_mainmenu_max_nest_level() {
    return 3;
}

function cms_mainmenu() {

    CI::$APP->load->helper('mainmenu/mainmenu');

    $menutree = &getMenuTree();
    

    $max = 0;
   
    echo '<ul id="responsive">';
    //echo '<li><a class="home" href="'. site_url() .'"><img src="'.theme_url().'images/house.png"></a></li>';
    $icnt = count($menutree);
    foreach ($menutree as $_m) {
       // $lang = $_m['lang'];
 
        // if ($menutree[0] == $_m) {
        //     $clas = 'class="first"';
        // } else if (end($menutree) == $_m) {
        //     $clas = 'class="last"';
        // } else {
        //     $clas = '';
        // }
        
        $hassub = (!is_null($_m['children'])) ? 'nav-submenu' : "";
        $last = ($max == $icnt) ? 'last' : '';

        echo '<li>

                <a href="' . $_m['url']. '">' . strtoupper($_m['label']) . '</a>';

        if (!is_null($_m['children'])) {
            $count = count($_m['children']);
           
            echo '<ul>';
            
            $imax = 0;
            // $iicnt = count($_m['children']);
            foreach ($_m['children'] as $_mm) { 
                
                
               
                echo '<li>';
                echo '<a href="' . $_mm['url']. '">' . strtoupper($_mm['label']) . '</a>';

                if (isset($_mm['children'])) {
                    $count = count($_mm['children']);
                    if($count > 10){
                        $bigclass = "megamenu";
                    }else{
                        $bigclass = "";
                    }
                    echo '<ul class="'.$bigclass.'">';

                    foreach ($_mm['children'] as $_mmm) {
                        echo '<li><a href="' . $_mmm['url']. '">' . strtoupper($_mmm['label']) . '</a></li>';
                    }

                    echo '</ul>';
                }

                // echo '</li>';
                $imax++;
                echo '</li>';
            }
            
            echo '</ul>';
        } // _m
        echo '</li>';
        $max++;
    } // mm
    echo '</ul> <!--end ul#navigation-->';
    
}

function texas_mainmenu() {
    CI::$APP->load->helper('mainmenu/mainmenu');
    $menutree = &getMenuTree();
    $menucolour = '';

    $max = 0;
    echo "<ul>";


    $idx = 1;

    foreach ($menutree as $_m) {

        if ($_m['url'] == '#' or $_m['url'] == '')
            $url = 'href="#" ';
        else
            $url = 'href="' . $_m['url'] . '" ';

        $class = $_m['class'] ? 'class="' . $_m['class'] . '"' : '';

        echo '<li ' . $class . '>
				<a  ' . $url . '>' . ($_m['label']) . '</a>';


        if (!is_null($_m['children'])) {

            echo '<ul >';

            foreach ($_m['children'] as $_mm) {
                if (isset($_mm['children']))
//                    $c = 'double-drop';
                    $c = $_m['class'];
                else
                    $c = '';

                echo '<li class="' . $c . '">
							<a href="' . $_mm['url'] . '">' . $_mm['label'] . '</a>';

                if (isset($_mm['children'])) {

                    echo '<ul>';

                    foreach ($_mm['children'] as $_mmm) {

                        if (isset($_mmm['children']))
                            $ca = '';
                        else
                            $ca = '';


                        echo '<li class="' . $ca . '"><a href="' . $_mmm['url'] . '">' . $_mmm['label'] . '</a>';

                        if (isset($_mmm['children'])) {

                            echo '<ul>';

                            foreach ($_mmm['children'] as $_mmmm) {
                                if (end($_mmm['children']) == $_mmmm)
                                    $ccaa = 'last';
                                else
                                    $ccaa = '';

                                echo '<li class="' . $ccaa . '"><a href="' . $_mmmm['url'] . '">' . $_mmmm['label'] . '</a>';


                                echo '</li>';
                            }

                            echo '</ul>';
                        }

                        echo '</li>';
                    }

                    echo '</ul>';
                }

                echo '</li>';
            }

            echo '</ul>';
        } // _m
        echo '</li>';
        $idx++;
    } // mm   
    echo '</ul> <!--end ul#navigation-->';
}

function texas_responsivemenu() {

    CI::$APP->load->helper('mainmenu/mainmenu');
    $menutree = &getMenuTree();
    $menucolour = '';

    $max = 0;
    echo "<select class='ipadMenu'>";

    $idx = 1;
    foreach ($menutree as $_m) {

        if ($_m['url'] == '#' or $_m['url'] == '')
            $url = '';
        else
            $url = $_m['url'];
        if (!is_null($_m['children'])) {

            echo '<optgroup label="' . $_m["label"] . '">';

            foreach ($_m['children'] as $_mm) {

                if (isset($_mm['children'])) {

                    echo '<optgroup label="' . $_mm["label"] . '">';

                    foreach ($_mm['children'] as $_mmm) {

                        if (isset($_mmm['children'])) {

                            echo '<optgroup label="' . $_mmm["label"] . '">';
                            foreach ($_mmm['children'] as $_mmmm) {
                                echo '<option class="optgroup" value="' . $_mmmm['url'] . '">' . $_mmmm['label'] . '</option>';
                            }
                            echo '</optgroup>';
                        } else
                            echo '<option value="' . $_mmm['url'] . '">' . $_mmm['label'] . '</option>';
                    }
                    echo '</optgroup>';
                } else
                    echo '<option value="' . $_mm['url'] . '">' . $_mm['label'] . '</option>';
            }
            echo '</optgroup>';
        } else
            echo '<option value="' . $url . '">' . $_m["label"] . '</option>';
    }
    echo "</select>";
}

function texas_breadcrumb() {
    global $_ID;
    $nodes = array();

    $post = CI::$APP->doctrine->em->find('content\models\Content', $_ID);
    $_parent_post = $post->getParent();
    if ($_parent_post != NULL)
        $nodes[] = $_parent_post->id();

    //find the root node
    while ($_parent_post != NULL) {
        $_p = $_parent_post->getParent();
        if ($_p != NULL)
            $nodes[] = $_p->id();
        $_parent_post = $_p;
        unset($_p);
    }

    $nodes = array_reverse($nodes);
    //show_pre($nodes);
    unset($_parent_post);

    //now generate the breadcrumb
    echo "<div class='breadcrumb'><ul id='breadcrumb'>";
    // the home link
    echo "<li><a href='" . site_url() . "' class='home'>Home &raquo;</a></li>";

    foreach ($nodes as $_n) {
        $content = CI::$APP->doctrine->em->find('content\models\Content', $_n);
        $children = $content->getChildren();

        $url = (is_null($children)) ? site_url('content/' . $content->getSlug()) : '#';

        //the parent li
        echo "<li><a class='quicklink' href='" . $url . "'>" . $content->getTitle() . "</a>";

        if ($children) {
            echo "<ul>";
            foreach ($children as $c)
                echo "<li><a href='" . site_url('content/' . $c->getSlug()) . "'>" . $c->getTitle() . "</a></li>";
            echo "</ul>";
        }
    }

    //finally the current page
    echo "<li class='nolink'>" . $post->getTitle() . "</li>";
    echo "</ul></div>";
}

function get_aboutus() {

    $id = Options::get('homepage_content_right');
    $contentRight = CI::$APP->doctrine->em->find('content\models\Content', $id);
    if ($contentRight) {
        echo "<h1>" . $contentRight->getTitle() . "</h1>
		<p>" . substr(strip_tags($contentRight->getBody()), 0, 350) . "</p>
		<p> <a href='" . site_url($contentRight->getSlug()) . "'>Read More »</a></p> ";
    }
}

?>
