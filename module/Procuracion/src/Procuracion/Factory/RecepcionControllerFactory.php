<?php

namespace Procuracion\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RecepcionControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $entityManager = $serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $authService = $serviceLocator->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $pdfService = $serviceLocator->getServiceLocator()->get('dompdf');
        return new \Procuracion\Controller\RecepcionController($entityManager, $authService, $pdfService);
    }

}
