<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController {

    public function indexAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

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

        $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();
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

    public function cambiarpassAction() {

        $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();
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
