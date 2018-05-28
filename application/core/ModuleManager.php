<?php
class ModuleManager
{
	public static function readModules()
	{
		$perms = array();
		$mainmenu = array();
			
		foreach (Modules::$locations as $location => $offset)
		{		
			$dh = opendir($location);
			while($file = readdir($dh))
			{
				$path = $location.$file;
				if($file != "." AND $file != ".." AND is_dir($path))
				{
					$module = $file;
					if(file_exists($path."/setup.php"))
					{
						$_method = $module."_permissions";
						$permissions = $_method();
						//include($path."/setup.php"); 
						if(isset($permissions) && is_array($permissions))
						{
							$perms = array_merge($perms,$permissions);
						}
						unset($permissions);
					}
				}
			}
		}
		
		//now fix the permissions
		$CI =& get_instance();
		
		//build the in string
		$inString = '';
		foreach($perms as $k => $v)
			$inString .= "'$k',";
		$inString = substr($inString,0,strlen($inString)-1);
		
		$query = $CI->doctrine->em->createQuery("SELECT p.name FROM user\models\Permissions p WHERE p.name IN ($inString)");
		$permissions = $query->getResult();
		
		$dbperms = array();
		$modPerm = array();
		foreach($permissions as $p){
			foreach($p as $k => $v){
				array_push($dbperms,$v);
				//echo $v."\n";
			}
		}
		
		foreach($perms as $k => $v)
			array_push($modPerm,$k);
			
		$newPermissions = array_diff($modPerm,$dbperms);
			
		foreach($newPermissions as $k)
		{
			$permission = new user\models\Permissions;
			$permission->setName($k);
			$permission->setDesc($perms[$k]);
			$CI->doctrine->em->persist($permission);
		}
		
		$CI->doctrine->em->flush();
		unset($permissions);
		unset($perms);
		unset($newPermissions);
		unset($dbperms);
		unset($modPerm);
	}
	
	private function _sort_permissions($permissions)
	{
		
	}
}