<?php

namespace Procuracion\Controller;

use Procuracion\Service\PersonaService;
use Procuracion\Service\EmpleadoService;
use Procuracion\Service\CuboCalificacionService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\Authentication\AuthenticationService as AuthService;
use Doctrine\ORM\EntityManager as EntityManager;

class ValidacionController extends AbstractActionController {

    protected $entityManager;
    protected $authService;

    public function __construct(EntityManager $entityManager, AuthService $authService) {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }

    public function validardpiAction() {

        $data = $this->request->getPost();
        $personaservice = new PersonaService();
        $personas = $personaservice->findByDPI($this->entityManager, $data["term"]);
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
        $personas = $personaservice->selectByDPI($this->entityManager, $data["term"]);

        foreach ($personas as $personaOption) {
            if (is_null($personaOption->getFechanacimiento())) {
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
        }


        $result = new JsonModel($item);
        return $result;
    }

    public function seleccionarempleadoAction() {
        $empleadoservice = new EmpleadoService();
        $empleados = $empleadoservice->listAll($this->entityManager);
        foreach ($empleados as $empleadoOption) {
            $empleadosOptions[$empleadoOption->getId()] = $empleadoOption->getNombres() . " " . $empleadoOption->getApellidos();
            //'id' => $personasOptions[$personaOption->getId()] = $personaOption->getId() = 'numdoc' => $personasOptions[$personaOption->getId()] = $personaOption->getNumerodocumento();
        }
        $result = new JsonModel($empleadosOptions);
        return $result;
    }

    public function listarhechosAction() {
        $data = $this->request->getPost();
        $derecho = $data["id"];
        $competencia = $data["comp"];

        if (!empty($data["id"])) {
            $calificaService = new CuboCalificacionService();

            $hechos = $calificaService->listarHechos($this->entityManager, $derecho, $competencia);
            //$derechos = $calificaService->listarDerechos($this->entityManager);

            $hechosOptions = array();
            foreach ($hechos as $hechoOption) {

                $hechosOptions[$hechoOption->getId()] = $hechoOption->getHecho();
            }

            $model = new JsonModel($hechosOptions);

            return $model;
        }

        //print_r($hechosOptions);
    }

}
