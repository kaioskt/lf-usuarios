<?php
namespace Usuario\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
	Doctrine\Common\Persistence\ObjectManager;

use Usuario\Entity\User;

class LoadUser extends AbstractFixture {
	public function load(ObjectManager $manager) {
		$user = new User();
		$user->setNome("kaio")
		->setEmail("suporte.gpi@hotmail.com")
		->setPassword(123456);
	
		$manager->persist($user);
		
		$user = new User();
		$user->setNome("lucas")
		->setEmail("suporte@hotmail.com")
		->setPassword(456789);
		
		$manager->persist($user);
		
		$manager->flush();
	}
	
}