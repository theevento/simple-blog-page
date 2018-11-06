<?php
/**
 * @link      http://github.com/zendframework/Blog for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Blog;

use Zend\Authentication\AuthenticationService;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function init(ModuleManager $moduleManager)
    {
        $eventManager = $moduleManager->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        $sharedEventManager->attach(__NAMESPACE__, 'dispatch',
            [$this, 'checkSecurity'], 100);
    }

    public function checkSecurity(MvcEvent $event)
    {
        /* @var $controller \Zend\Mvc\Controller\AbstractActionController */
        $controller = get_class($event->getController());
        $serviceManager = $event->getApplication()->getServiceManager();
        $authService = $serviceManager->get(AuthenticationService::class);
        $auth = $authService->hasIdentity();
        $securityConfig = $serviceManager->get('Config')['security'];
        $routeName = $event->getRouteMatch()->getMatchedRouteName();
        $loginForm = $securityConfig['form'];
        $formRedirect = $securityConfig['form_redirect'];
        $securityArea = $securityConfig['area'];

        if(in_array($routeName, $securityArea) && $auth === false)
        {
            $controller->redirect()->toRoute($loginForm);
        }

        if($auth === true && $routeName === $loginForm)
        {
            $controller->redirect()->toRoute($formRedirect);
        }
    }
}
