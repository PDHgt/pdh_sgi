<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Procuracion\Form\FormularioLogueo;

class IndexController extends AbstractActionController {

    protected $form;
    protected $authService;
    protected $authResult;
    protected $messages;

    public function indexAction() {

        $this->form = new FormularioLogueo();

        $this->layout('layout/index');

        return new ViewModel(array(
            'form' => $this->form
        ));
    }

    public function authService() {
        $this->authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        return $this->authService;
    }

    public function loginAction() {
        $data = $this->getRequest()->getPost();

        $authService = $this->authService();

        $adapter = $authService->getAdapter();
        $adapter->setIdentity($data['usuario']);
        $adapter->setCredential(md5($data['password']));
        $authResult = $authService->authenticate();
        $this->authResult = $authResult;

        if ($authResult->isValid()) {
            return $this->redirect()->toRoute('recepcion');
        } else {
            return $this->redirect()->toRoute('inicio');
        }
    }

    public function logoutAction() {

        $this->authService()->clearIdentity();
        return $this->redirect()->toRoute('inicio');
    }

}
