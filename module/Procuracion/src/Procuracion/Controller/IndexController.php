<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Procuracion\Form\FormularioLogueo;

class IndexController extends AbstractActionController {

    protected $em;
    protected $form;

    public function indexAction() {

        $form = new FormularioLogueo();

        $this->layout('layout/index');
        return array(
            'form' => $form
        );
    }

    public function loginAction() {
        $data = $this->getRequest()->getPost();

        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        $adapter = $authService->getAdapter();
        $adapter->setIdentity($data['usuario']);
        $adapter->setCredential(md5($data['password']));
        $authResult = $authService->authenticate();

        if ($authResult->isValid()) {
            $user = $authResult->getIdentity()->getusuario();
            //echo $user;
            return $this->redirect()->toRoute('recepcion', array('usuario' => $user));            //
        } else {
            $messages = $authResult->getMessages();
            foreach ($messages as $message) {
                echo "<p class='bg-danger text-center'>" . $message . "<p>";
            }
            //return $this->redirect()->toRoute('inicio', array('mensajes' => $messages));
        }
    }

    public function logoutAction() {

        $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->clearIdentity();
        return $this->redirect()->toRoute('inicio');
    }

}
