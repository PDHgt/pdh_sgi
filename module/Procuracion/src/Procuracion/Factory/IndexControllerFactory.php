<?php

namespace Procuracion\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $entityManager = $serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $authService = $serviceLocator->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        return new \Procuracion\Controller\IndexController($entityManager, $authService);
    }

}
