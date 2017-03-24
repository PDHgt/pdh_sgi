<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Procuracion\Service\PersonaService;

class ValidacionController extends AbstractActionController {

    public function validardpiAction() {

        $data = $this->request->getPost();
        $personaservice = new PersonaService();
        $personas = $personaservice->findByDPI($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $data["term"]);
        //print_r($personas);
        //$personasOptions = array();
        foreach ($personas as $personaOption) {
            $personasOptions[$personaOption->getId()] = $personaOption->getNumerodocumento();
            //'id' => $personasOptions[$personaOption->getId()] = $personaOption->getId() = 'numdoc' => $personasOptions[$personaOption->getId()] = $personaOption->getNumerodocumento();
        }
        $result = new JsonModel($personasOptions);
        return $result;
    }

    public function seleccionardpiAction() {
        $data = $this->request->getPost();

        $personaservice = new PersonaService();
        $personas = $personaservice->selectByDPI($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $data["term"]);

        foreach ($personas as $personaOption) {
            if(is_null($personaOption->getFechanacimiento())){
                $date = NULL;
            } else {
                $date = $personaOption->getFechanacimiento()->format("d/m/Y");
            }
            $item = array(
                $personasOptions['id'] = $personaOption->getId(),
                $personasOptions['tipodoc'] = $personaOption->getTipodocumento(),                
                $personasOptions['fechanac'] = $date,
                $personasOptions['sexo'] = $personaOption->getSexo(),
                //$personasOptions['numdoc'] = $personaOption->getTipodocumento(),
                $personasOptions['nombres'] = $personaOption->getNombres(),
                $personasOptions['apellidos'] = $personaOption->getApellidos()
            );
            //'id' => $personasOptions[$personaOption->getId()] = $personaOption->getId() = 'numdoc' => $personasOptions[$personaOption->getId()] = $personaOption->getNumerodocumento();
        }

        //print_r($item);
        //$persona = $personasevice->listOne($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'), $data["term"]);

        $result = new JsonModel($item);
        return $result;
    }

}
