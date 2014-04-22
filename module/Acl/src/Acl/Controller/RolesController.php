<?php

namespace Acl\Controller;

use Base\Controller\CrudController;
use Zend\View\Model\ViewModel;

class RolesController extends CrudController
{

    public function __construct() {
        $this->entity = "Acl\Entity\Role";
        $this->service = "Acl\Service\Role";
        $this->form = "Acl\Form\Role";
        $this->controller = "roles";
        $this->route = "sonacl-admin/default";
    }
    
    public function newAction()
    {
        $form = $this->getServiceLocator()->get('Acl\Form\Role');
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }
    
    public function editAction()
    {
        $form = $this->getServiceLocator()->get('Acl\Form\Role');
        $request = $this->getRequest();
        
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));
        
        if($this->params()->fromRoute('id',0))
            $form->setData($entity->toArray());
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }
    
    public function testeAction()
    {
        $acl = $this->getServiceLocator()->get("Acl\Permissions\Acl");
        
        echo $acl->isAllowed("Redator","Posts","Excluir")? "Permitido" : "Negado";
        die;
    }
}
