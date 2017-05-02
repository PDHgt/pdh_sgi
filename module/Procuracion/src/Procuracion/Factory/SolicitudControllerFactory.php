<?php

namespace Procuracion\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SolicitudControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $entityManager = $serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $authService = $serviceLocator->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        return new \Procuracion\Controller\SolicitudController($entityManager, $authService);
    }

}
