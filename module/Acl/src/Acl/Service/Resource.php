<?php

namespace Acl\Service;

use SONBase\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class Resource extends AbstractService
{

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = "Acl\Entity\Resource";
    }
    
    
}
