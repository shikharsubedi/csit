<?php 

use Doctrine\Common\ClassLoader,
Doctrine\ORM\Configuration,
Doctrine\ORM\EntityManager,
Doctrine\Common\Cache\ArrayCache,
Doctrine\Common\Annotations\AnnotationReader,
Doctrine\ORM\Mapping\Driver\AnnotationDriver,
Doctrine\DBAL\Logging\EchoSqlLogger,
Doctrine\DBAL\Event\Listeners\MysqlSessionInit,
Doctrine\ORM\Tools\SchemaTool,
Doctrine\Common\EventManager,
Gedmo\Timestampable\TimestampableListener,
Gedmo\Sluggable\SluggableListener,
Gedmo\Tree\TreeListener;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Doctrine {

	public $em = null;
	public $tool = null;

	public function __construct()
	{
		CI::$APP->benchmark->mark('doctrine_load_start');

	 // load database configuration from CodeIgniter
	 if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/database'.EXT))
	 {
	 	require(APPPATH.'config/'.ENVIRONMENT.'/database'.EXT);
	 }
	 else
	 {
	 	require(APPPATH.'config/database'.EXT);
	 }

	 if ( ! isset($active_group) OR ! isset($db[$active_group]))
	 {
	 	show_error('You have specified an invalid database connection group.');
	 }
	 // require_once APPPATH.'config/database.php';

	 // Set up class loading. You could use different autoloaders, provided by your favorite framework,
	 // if you want to.
	 require_once APPPATH.'third_party/Doctrine/Common/ClassLoader.php';

	 $doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'third_party');
	 $doctrineClassLoader->register();
	 /*$entitiesClassLoader = new ClassLoader('models', rtrim(APPPATH, "/" ));
	  $entitiesClassLoader->register();*/

	 // Set up Gedmo
		$classLoader = new ClassLoader('Gedmo', APPPATH.'third_party');
		$classLoader->register();

		$F1softExtensionsLoader = new ClassLoader('F1soft', APPPATH.'third_party');
		$F1softExtensionsLoader->register();

		$evm = new EventManager;
		// timestampable
		$evm->addEventSubscriber(new TimestampableListener);
		// sluggable
		$evm->addEventSubscriber(new SluggableListener);

		// Set up models loading
		$entitiesClassLoader = new ClassLoader('models', APPPATH);
		$entitiesClassLoader->register();


		foreach (glob(APPPATH.'modules/*', GLOB_ONLYDIR) as $m) {
			$module = str_replace(APPPATH.'modules/', '', $m);
			$entitiesClassLoader = new ClassLoader($module, APPPATH.'modules');
			$entitiesClassLoader->register();
		}
		
		foreach (glob(APPPATH.'core_modules/*', GLOB_ONLYDIR) as $m) {
			$module = str_replace(APPPATH.'core_modules/', '', $m);
			$entitiesClassLoader = new ClassLoader($module, APPPATH.'core_modules');
			$entitiesClassLoader->register();
		}

		$proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/proxies');
		$proxiesClassLoader->register();

		// Set up caches
		$config = new Configuration;
		$cache = new ArrayCache;
		$config->setMetadataCacheImpl($cache);
		$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
		$config->setMetadataDriverImpl($driverImpl);
		$config->setQueryCacheImpl($cache);

		$config->setQueryCacheImpl($cache);

		//load custom function
		$config->addCustomStringFunction('DATE', 'F1soft\DoctrineExtensions\Date');
		// Proxy configuration
		$config->setProxyDir(APPPATH.'models/proxies');
		$config->setProxyNamespace('Proxies');

		// Set up logger
		// $logger = new EchoSQLLogger;
		// $config->setSQLLogger($logger);

		$config->setAutoGenerateProxyClasses( TRUE );

		// Database connection information
		$connectionOptions = array(
				'driver' => 'pdo_mysql',
				'user' =>     $db[$active_group]['username'],
				'password' => $db[$active_group]['password'],
				'host' =>     $db[$active_group]['hostname'],
				'dbname' =>   $db[$active_group]['database']
		);

		// Create EntityManager
		$this->em = EntityManager::create($connectionOptions, $config,$evm);

		// Schema Tool
		$this->tool = new SchemaTool($this->em);

		CI::$APP->benchmark->mark('doctrine_load_end');
	}
}