<?php

namespace Acl\Controller;

use Base\Controller\CrudController;
use Zend\View\Model\ViewModel;

class ResourcesController extends CrudController
{

    public function __construct() {
        $this->entity = "Acl\Entity\Resource";
        $this->service = "Acl\Service\Resource";
        $this->form = "Acl\Form\Resource";
        $this->controller = "Resources";
        $this->route = "sonacl-admin/default";
    }
    
}
