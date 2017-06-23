<?php

namespace Procuracion\Controller;

use Procuracion\Form\FormularioLogueo;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService as AuthService;
use Doctrine\ORM\EntityManager as EntityManager;

class IndexController extends AbstractActionController {

    protected $entityManager;
    protected $authService;
    protected $usuario;
    protected $form;
    protected $authResult;
    protected $messages;

    public function __construct(EntityManager $entityManager, AuthService $authService) {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }

    public function indexAction() {

        $this->form = new FormularioLogueo();

        $messages = $this->getEvent()->getRouteMatch()->getParam('message');

        $this->layout('layout/index');

        return new ViewModel(array(
            'form' => $this->form,
            'message' => $messages
        ));
    }

    public function loginaction() {
        $data = $this->getRequest()->getPost();

        //$adapter = $authService->getAdapter();
        $adapter = $this->authService->getAdapter();
        $adapter->setIdentity($data['usuario']);
        $adapter->setCredential(md5($data['password']));
        $authResult = $this->authService->authenticate();
        $messages = $authResult->getMessages();

        if ($authResult->isValid()) {
            return $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
        } else {
            return $this->forward()->dispatch('Procuracion\Controller\Index', array(
                        'action' => 'index',
                        'message' => $messages
            ));
        }
    }

    public function logoutAction() {

        $this->authService->clearIdentity();
        return $this->redirect()->toRoute('inicio');
    }

}
