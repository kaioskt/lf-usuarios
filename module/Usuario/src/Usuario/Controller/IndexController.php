<?php
namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel;

use Usuario\Form\User as FormUser;

class IndexController extends AbstractActionController{
	
public function registerAction() 
    {
        $form = new FormUser;
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get("Usuario\Service\User");
                if($service->insert($request->getPost()->toArray())) 
                {
                    $fm = $this->flashMessenger()
                            ->setNamespace('Usuario')
                            ->addMessage("Usu�rio cadastrado com sucesso");
                }
                
                return $this->redirect()->toRoute('usuario-register');
            }
        }
        
        $messages = $this->flashMessenger()
                ->setNamespace('Usuario')
                ->getMessages();
        
        return new ViewModel(array('form'=>$form,'messages'=>$messages));
    }
	 public function activateAction()
    {
        $activationKey = $this->params()->fromRoute('key');
        
        $userService = $this->getServiceLocator()->get('Usuario\Service\User');
        $result = $userService->activate($activationKey);
        
        if($result)
            return new ViewModel(array('user'=>$result));
        else
            return new ViewModel();
    }
}