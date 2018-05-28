<?php

use Doctrine\ORM\Query;

class Mainmenu_model extends CI_Model {

    public function getTopmenuTree() {
        $_max_nest = _t('mainmenu_max_nest_level');

        $dql = "SELECT m FROM mainmenu\models\Mainmenu m WHERE m.topmenu='Y' AND m.parent IS NULL";

        $dql .= " ORDER BY m.order ASC";
        $query = $this->doctrine->em->createQuery($dql);
        $menu = $query->getResult(Query::HYDRATE_OBJECT);

        return $menu;
    }
	
	public function getTopmenuTreeChild($parent) {
        $_max_nest = _t('mainmenu_max_nest_level');

        $dql = "SELECT m FROM mainmenu\models\Mainmenu m WHERE m.parent ={$parent}";

        $dql .= " ORDER BY m.order ASC";
        $query = $this->doctrine->em->createQuery($dql);
        $menu = $query->getResult(Query::HYDRATE_OBJECT);

        return $menu;
    }
	
	public function getParentFirstChild($id) {
        $_max_nest = _t('mainmenu_max_nest_level');

        $dql = "SELECT m FROM mainmenu\models\Mainmenu m WHERE m.parent ={$id}";

        $dql .= " ORDER BY m.order ASC ";
        $query = $this->doctrine->em->createQuery($dql);
		$query->setMaxResults(1);
        $menu = $query->getResult();

        return $menu;
    }

    public function getMainenuTree($parent = NULL) {
        $_max_nest = _t('mainmenu_max_nest_level');

        $dql = "SELECT m FROM mainmenu\models\Mainmenu m WHERE m.topmenu='N' AND m.parent";

        if (is_null($parent))
            $dql .= " IS NULL";
        else
            $dql .= " = {$parent}";

        $dql .= " ORDER BY m.order ASC";
		
		
        $query = $this->doctrine->em->createQuery($dql);
		
        $menu = $query->getResult(Query::HYDRATE_OBJECT);


        return $menu;
    }
	
	public function getParent($reference = NULL) {
		
		$_max_nest = _t('mainmenu_max_nest_level');
		
		/*$dql = "SELECT m FROM mainmenu\models\Mainmenu m WHERE m.parent IS NULL AND m.reference";*/
		$dql = "SELECT m FROM mainmenu\models\Mainmenu m WHERE m.reference";
		
		$dql .=" = '".$reference."'";
		
		//$dql .= " = {$reference}";	
		
		
		$dql .= " ORDER BY m.order ASC";	
				
		$query = $this->doctrine->em->createQuery($dql);
		$menu = $query->getResult(Query::HYDRATE_OBJECT);
		
		return $menu;
	}
   

    public function getMenuTree($parent = NULL) {
        $_max_nest = _t('mainmenu_max_nest_level');

        $dql = "SELECT m FROM mainmenu\models\Mainmenu m WHERE m.parent";

        if (is_null($parent))
            $dql .= " IS NULL";
        else
            $dql .= " = {$parent}";

        $dql .= " ORDER BY m.order ASC";
        $query = $this->doctrine->em->createQuery($dql);
        $menu = $query->getResult(Query::HYDRATE_OBJECT);

        return $menu;
    }

    public function getReferenceId($id) {

        $dql = "SELECT m.reference FROM mainmenu\models\Mainmenu m WHERE m.id";

        $dql .= " = {$id}";

        $query = $this->doctrine->em->createQuery($dql);
        $referenceid = $query->getResult();

        return $referenceid;
    }

    public function getAllMenus() {
        $dql = "SELECT m.id FROM mainmenu\models\Mainmenu m";
        $query = $this->doctrine->em->createQuery($dql);
        $menu = $query->getResult(Query::HYDRATE_SCALAR);
        $_menu = array();
        foreach ($menu as $_m)
            $_menu[] = $_m['id'];
        return $_menu;
    }
	
	public function getMenuInfo($id) {
		
		$_max_nest = _t('mainmenu_max_nest_level');
		
		$dql = "SELECT m FROM mainmenu\models\Mainmenu m WHERE m.id";
		
		$dql .= " = {$id}";
		
		$query = $this->doctrine->em->createQuery($dql);
		$menu = $query->getResult(Query::HYDRATE_OBJECT);
		
		return $menu;
	}

    public function _process_tree() {
        //$_existing_menu = $this->getAllMenus();
        $_input_tree = json_decode($this->input->post('serial'));

        $_to_remove = $this->input->post('remove');


        foreach ($_input_tree as $_i) {
            $this->_process_tree_single_level($_i);
        }

        //now remove those that were removed from the interface
        if (is_array($_to_remove)) {
            foreach ($_to_remove as $__m) {
                $_remove = $this->doctrine->em->find('mainmenu\models\Mainmenu', $__m);

                /*
                 * Log Creation.
                 */
                $moduleName = "mainmenu";
                $moduleId = $__m;
                $moduleTitle = $_remove->getLabel();
                $action = 3;

                /*
                 * Calling function of another 'admin' controller and passing arguments.
                 */
                echo Modules::run("control/logs/create", $moduleName, $moduleId, $moduleTitle, $action);
                if ($_remove)
                    $this->doctrine->em->remove($_remove);
            }
        }
        $this->doctrine->em->flush();
    }

    private function _process_tree_single_level(&$element, &$parent = NULL) {
        static $_processed_ids;
        $_processed_ids = array();
        $_existing_menu = $this->getAllMenus();

        $_i = $element;
        $_labels = $this->input->post('menulabel');
        $_types = $this->input->post('menutype');
        $_references = $this->input->post('reference');
        $_orders = $this->input->post('order');
        $_topmenus = $this->input->post('topmenu');

        $_label_index = 'label-' . $_i->id;

        $_label = $_labels[$_label_index];
        $_type = $_types[$_label_index];
        $_reference = $_references[$_label_index];
        $_order = $_orders[$_label_index];
		
		$_topmenu = 'N';

        if (isset($_topmenus) and $_topmenus != '') {
            if (array_key_exists($_label_index, $_topmenus)) {
                $_topmenu = $_topmenus[$_label_index];
            } else
                $_topmenu = 'N';
        }

        $_menu = NULL;
        $__index = array_search($_i->id, $_existing_menu);
        if ($__index || $__index === 0) {
            //it was an existing menu update it
            $_menu = $this->doctrine->em->find('mainmenu\models\Mainmenu', $_i->id);
            unset($_existing_menu[$__index]);
        } else {
            $_menu = new \mainmenu\models\Mainmenu;
            $_menu->setType($_type);
        }

        $_menu->setLabel($_label);
        $_menu->setReference($_reference);
        $_menu->setOrder($_order);
        $_menu->setTopmenu($_topmenu);

        if (!is_null($parent)) {
            $_menu->setParent($parent);
        }

        if (isset($_i->children)) {
            foreach ($_i->children as $_c) {
                $this->_process_tree_single_level($_c, $_menu);
            }
        }
        $this->doctrine->em->persist($_menu);
        $this->doctrine->em->flush();
        $mid = array();
        $mname = array();
        if ($_i->id >= '1000') {
            $mid[] = $_menu->id();
            $mname[] = $_menu->getLabel();
        }
        $result[] = array_merge($mid, $mname);


        foreach ($result as $r) {
            if (isset($r[0])) {
                $moduleName = "mainmenu";
                $moduleId = $r[0];
                $moduleTitle = $r[1];
                $action = 1;

                echo Modules::run("control/logs/create", $moduleName, $moduleId, $moduleTitle, $action);
            }
        }
        $_processed_ids[] = $_i->id;
    }

}

?>