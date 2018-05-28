<?php
namespace user\models;
 
use Doctrine\ORM\EntityRepository,
	F1soft\DoctrineExtensions\Paginate\Paginate,
	Doctrine\ORM\Query;
 
class UserRepository extends EntityRepository
{
	public function getGroups()
	{
		$query = $this->_em->createQuery("SELECT r FROM user\models\Group r");
		return $query->getResult();
	}
	
	public function getUsers($offset,$perpage)
	{
		$query = $this->_em->createQuery("SELECT r FROM user\models\User r");
		$query->setMaxResults($perpage);
		$query->setFirstResult($offset);
	
		$totalResults = Paginate::count($query);
	
		$users = $query->getResult();
		return array(
				'total'	=>	$totalResults,
				'users'	=>	$users
				);
	}
	
	
	public function getPermissions()
	{
		$query = $this->_em->createQuery("SELECT p FROM user\models\Permissions p");
		return $query->getResult();
	}
	
}


?>