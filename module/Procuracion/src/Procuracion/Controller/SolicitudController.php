<?php

namespace Procuracion\Controller;

use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\UsuarioService;
use Procuracion\Service\CuboCalificacionService;
use Procuracion\Form\FormularioRecepcion;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService as AuthService;
use Doctrine\ORM\EntityManager as EntityManager;

class SolicitudController extends AbstractActionController {

    protected $entityManager;
    protected $authService;

    public function __construct(EntityManager $entityManager, AuthService $authService) {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }

    public function indexAction() {

        return $this->redirect()->toRoute('solicitud', array('action' => 'cola'));
    }

    public function colaAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $sede = $identity->getIdEmpleado()->getIdsede()->getId();

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listToday($this->entityManager, $sede);


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

    public function atenderAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
//        $hora = date("h:i:s");
//        $attend = array('id' => $id, 'hora' => $hora);
//
//        $colaservice = new ColaRecepcionService();
//        $colaservice->attend($this->entityManager, $attend);

        $this->redirect()->toRoute('solicitud', array('action' => 'solicitud', 'id' => $id));
    }

    public function solicitudAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $form = new FormularioRecepcion();

            $derechos = new CuboCalificacionService();
            $listaderechos = $derechos->listarDerechos($this->entityManager);

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listOne($this->entityManager, $id);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'cola' => $cola, 'identity' => $identity, 'id' => $id, 'derechos' => $listaderechos, 'permisos' => $permisos));
            return $view;
        }
    }

    public function detallecolaAction() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $this->redirect()->toRoute('recepcion', array('action' => 'detallecola', 'id' => $id));
    }

    public function editarcolaAction() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $this->redirect()->toRoute('recepcion', array('action' => 'editarcola', 'id' => $id));
    }

}
