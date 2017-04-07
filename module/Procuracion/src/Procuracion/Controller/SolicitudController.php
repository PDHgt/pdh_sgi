<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\UsuarioService;

/**
 * Description of SolicitudController
 *
 * @author Jorge Morales
 */
class SolicitudController extends AbstractActionController {

    protected $em;

    public function getEntityManager() {

        $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        return $this->em;
    }

    public function indexAction() {
        return $this->redirect()->toRoute('solicitud', array('action' => 'cola'));
        //return new ViewModel();
    }

    public function colaAction() {

        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->getEntityManager(), $identity->getUsuario());

            $sede = $identity->getIdEmpleado()->getUnidadadministrativa()->getIdSede()->getId();

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listToday($this->getEntityManager(), $sede); //$usr->sede


            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('cola' => $cola, 'identity' => $identity, 'permisos' => $permisos));
            return $view;
        }
    }

    public function solicitudAction() {

        return new ViewModel();
    }

}
