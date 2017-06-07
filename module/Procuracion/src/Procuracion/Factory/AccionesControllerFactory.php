<?php

/*
 * Copyright (C) 2017 Procurador de los Derechos Humanos
 */

namespace Procuracion\Factory;

/**
 * Description of AccionesControllerFactory
 *
 * @author Jorge Morales
 */
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AccionesControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $entityManager = $serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $authService = $serviceLocator->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        return new \Procuracion\Controller\AccionesController($entityManager, $authService);
    }

}
