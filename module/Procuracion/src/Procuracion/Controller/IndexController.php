<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Procuracion\Form\FormularioLogueo;

class IndexController extends AbstractActionController {

    protected $em;
    protected $usuario;
    protected $form;
    protected $authService;
    protected $authResult;
    protected $messages;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
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
        $messages = $authResult->getMessages();

        if ($authResult->isValid()) {
            return $this->redirect()->toRoute('recepcion');
        } else {
            return $this->forward()->dispatch('Procuracion\Controller\Index', array(
                        'action' => 'index',
                        'message' => $messages
            ));
            //return $this->redirect()->toRoute('inicio/procesar', array('action' => 'index', 'param' => $message));
        }
    }

    public function logoutAction() {

        $this->authService()->clearIdentity();
        return $this->redirect()->toRoute('inicio');
    }

}
