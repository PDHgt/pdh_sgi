<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Procuracion\Service\PersonaService;

class ValidacionController extends AbstractActionController {

    public function validardpiAction() {

        $data = $this->request->getPost();
        $personasevice = new PersonaService();
        $personas = $personasevice->findByDPI($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $data["term"]);
        //print_r($personas);

        $personasOptions = array();
        foreach ($personas as $personaOption) {
            $personasOptions[$personaOption->getId()] = $personaOption->getNumerodocumento();
        }
        echo json_encode($personasOptions);
    }

}
