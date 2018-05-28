<?php

use Transborder\Common\Util\Calculator;
use models\User,
    models\User\Group,
    models\User\Permission,
    models\Common\Logreport,
    models\Category\Category,
    models\Menu\Menu;

// Used for automatic database table manipulation. (Create, Update, etc.)
class Tools_Controller extends MY_Controller {

    var $schemas;

    public function __construct() {
        parent::__construct();
        $this->schemas = array(	
			$this->doctrine->em->getClassMetadata('slider\models\Slider'),		
			$this->doctrine->em->getClassMetadata('mainmenu\models\Mainmenu'),			
			//$this->doctrine->em->getClassMetadata('gallery\models\Album'),
			//$this->doctrine->em->getClassMetadata('gallery\models\Image') ,
			//$this->doctrine->em->getClassMetadata('video\models\Category'),
			//$this->doctrine->em->getClassMetadata('video\models\Video')
			//$this->doctrine->em->getClassMetadata('content\models\Content')
        );
    }

    public function index() {
        
    }

    // Creates the schema in the database.
    public function _install() {
        $this->drop();
        $this->doctrine->tool->createSchema($this->schemas);
        echo "Schemas created.";
    }

    // Updates the schema in the database.
    public function update() {
        $sql = $this->doctrine->tool->getUpdateSchemaSql($this->schemas, TRUE);
        $count = count($sql);

        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                if (substr($sql[$i], 0, 10) == 'DROP TABLE')
                    unset($sql[$i]);

// 			    $sessionTbl = trim(strstr($sql[$i],'f1_sessions',TRUE));
// 			    $optionsTbl = trim(strstr($sql[$i],'f1_options',TRUE));
// 			    if(($sessionTbl || $optionsTbl) == 'DROP TABLE')
// 			    	unset($sql[$i]);
            }
        }

        foreach ($sql as $statment) {
            echo($statment . '<br/ >');
            $this->doctrine->em->getConnection()->exec($statment);
        }

        //	$this->writePatch($sql);

        echo "Schemas updated.<br/><br/><br/>";

        return;
    }

    private function _writePatch(array $sql) {
        if (count($sql) == 0)
            return TRUE;

        $filepath = './dbpatch/db-' . time() . '.patch';

        if (!$fp = @fopen($filepath, FOPEN_WRITE_CREATE)) {
            return FALSE;
        }

        $message = '';
        foreach ($sql as $s) {
            $message .= $s . ";" . PHP_EOL;
        }

        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);

        @chmod($filepath, FILE_WRITE_MODE);
        return TRUE;
    }

    public function _cloneTest() {
        //working but need to clone the permissions to the new group too
        $s = $this->doctrine->em->find('models\User\Group', 1);
        $new = clone $s;
        $new->setName($s->getName() . '-clone-' . time());
        $this->doctrine->em->persist($new);
        $this->doctrine->em->flush();

        echo "<pre>";
        \Doctrine\Common\Util\Debug::dump($new);
    }

    public function _drop() {
        $this->doctrine->tool->dropSchema($this->schemas);
        echo "Schemas dropped.<br/><br/><br/>";

        return;
    }

    public function _countryfix() {
        $nepal = $this->doctrine->em->find('models\Common\Country', 1);
        $state = new State();
        $state->setCountry($nepal);
        $state->setName('Bagmati');
        $this->doctrine->em->persist($state);

        $mechi = new State();
        $mechi->setCountry($nepal);
        $mechi->setName('Mechi');
        $this->doctrine->em->persist($mechi);

        $kathmandu = new City();
        $kathmandu->setName('Kathmandu');
        $kathmandu->setState($state);
        $this->doctrine->em->persist($kathmandu);

        $ilam = new City();
        $ilam->setName('Ilam');
        $ilam->setState($mechi);
        $this->doctrine->em->persist($ilam);

        $this->doctrine->em->flush();
    }

}
