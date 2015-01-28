<?php
/**
 *@desc  Social Connect Module manager
 *@author Gaurav Vashishtha
 *@version 1.0
 *@date-created 6 Jan, 2015
 */
namespace SocialConnect;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__
                )
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'SocialConnect' => 'SocialConnect\SocialConnect'
            )
        );
    }
}
