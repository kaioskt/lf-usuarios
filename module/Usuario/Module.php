<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuario;

use Zend\Mvc\MvcEvent;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Usuario\Auth\Adapter as AuthAdapter;

use Zend\ModuleManager\ModuleManager;

class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    
    public function init(ModuleManager $moduleManager){
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        
        $sharedEvents->attach("Zend\Mvc\Controller\AbstractActionController", 
                MvcEvent::EVENT_DISPATCH,
                array($this,'validaAuth'),100);
    }

    
    public function validaAuth($e)
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage('Usuario'));
        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
        //echo $matchedRoute; die;
        
        if(!$auth->hasIdentity() and ($matchedRoute == "usuario-admin" OR $matchedRoute == "usuario-admin/paginator"))
            return $controller->redirect()->toRoute("usuario-auth");
    }
    
    public function getServiceConfig()
    {
        
        return array(
          'factories' => array(
              'Usuario\Mail\Transport' => function($sm) {
                $config = $sm->get('Config');
                
                $transport = new SmtpTransport;
                $options = new SmtpOptions($config['mail']);
                $transport->setOptions($options);
                
                return $transport;
              },
              'Usuario\Service\User' => function($sm) {
                  return new Service\User($sm->get('Doctrine\ORM\EntityManager'),
                                          $sm->get('Usuario\Mail\Transport'),
                                          $sm->get('View'));
              },
              'Usuario\Auth\Adapter' => function($sm)
              {
                  return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
              }
              
          )  
        );
        
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'UserIdentity' => new View\Helper\UserIdentity()
            )
        );
    }
}
