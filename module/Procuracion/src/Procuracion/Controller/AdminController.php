<?php

namespace Procuracion\Controller;

use Procuracion\Form\FormularioAdmin;
use Procuracion\Service\UsuarioService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService as AuthService;
use Doctrine\ORM\EntityManager as EntityManager;

class AdminController extends AbstractActionController {

    protected $entityManager;
    protected $authService;

    public function __construct(EntityManager $entityManager, AuthService $authService) {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }

    public function indexAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');


            $view = new ViewModel(array('identity' => $identity));
            return $view;
        }
    }

    public function perfilAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {

            $identity = $this->authService->getIdentity();

            $form = new FormularioAdmin();

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');


            $view = new ViewModel(array('identity' => $identity, 'form' => $form));
            return $view;
        }
    }

    public function cambiarpassAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $pass = md5($this->params()->fromPost('password'));
            //echo $pass;
            $usr = array('id' => $identity->getId(), 'password' => $pass);
            $registro = new UsuarioService();
            $registro->changePass($this->entityManager, $usr);
            return $this->redirect()->toRoute('admin', array('action' => 'perfil'));
        }
    }

}
