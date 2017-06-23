<?php

namespace Procuracion\Controller;

use Procuracion\Service\PersonaService;
use Procuracion\Service\EmpleadoService;
use Procuracion\Service\CuboCalificacionService;
use Procuracion\Service\GeografiaService;
use Procuracion\Service\RemisionService;
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
        foreach ($personas as $personaOption) {
            $personasOptions[$personaOption->getId()] = $personaOption->getNumerodocumento();
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
                $personasOptions['nombres'] = $personaOption->getNombres(),
                $personasOptions['apellidos'] = $personaOption->getApellidos(),
                $personasOptions['lgbti'] = $personaOption->getLgbti()
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

            $tmp = array();
            $hechosOptions = array();
            foreach ($hechos as $hechoOption) {
                //$hechosOptions[$hechoOption->getId()][] = $hechoOption->getHecho();
                $hechosOptions["id"] = $hechoOption->getId();
                $hechosOptions["hecho"] = $hechoOption->getHecho();
                $hechosOptions["desc"] = $hechoOption->getDescripcion();
                $tmp[] = $hechosOptions;
            }

            $model = new JsonModel($tmp);

            return $model;
        }
    }

    public function listarinstitucionesAction() {
        $data = $this->request->getPost();
        $institucion = $data["id"];


        if (!empty($data["id"])) {
            $institcionservice = new RemisionService();
            $instituciones = $institcionservice->listarInstituciones($this->entityManager, $institucion);

            $tmp = array();
            $institucionesOptions = array();
            foreach ($instituciones as $institucionOption) {
                //$hechosOptions[$hechoOption->getId()][] = $hechoOption->getHecho();
                $institucionesOptions["id"] = $institucionOption->getId();
                $institucionesOptions["institucion"] = $institucionOption->getInstitucion();
                $tmp[] = $institucionesOptions;
            }
            $model = new JsonModel($tmp);
            return $model;
        }
    }

    public function listarmunicipiosAction() {
        $data = $this->request->getPost();
        $depto = $data["depto"];
        if (!empty($data["depto"])) {
            $geografiaService = new GeografiaService();

            $municipios = $geografiaService->ListarMunisPorDepto($this->entityManager, $depto);

            $municipiosOptions = array();
            foreach ($municipios as $municipioOption) {
                $municipiosOptions[$municipioOption->getCodigo()] = $municipioOption->getNombre();
            }

            $model = new JsonModel($municipiosOptions);

            return $model;
        }
    }

    public function listarempleadosAction() {
        $data = $this->request->getPost();
        $unidad = $data["unidad"];
        if (!empty($data["unidad"])) {

            $empleadoservice = new EmpleadoService();

            $empleados = $empleadoservice->getEmpleadosPorUnidad($this->entityManager, $unidad);

            $empleadosOptions = array();
            foreach ($empleados as $empleadoOption) {
                $empleadosOptions[$empleadoOption->getId()] = $empleadoOption->getNombres() . " " . $empleadoOption->getApellidos();
            }

            $model = new JsonModel($empleadosOptions);

            return $model;
        }
    }

}
