<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Procuracion\Form\Formulario;
use Procuracion\Service\VisitaService;
use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\EmpleadoService;
use Procuracion\Service\UnidadadministrativaService;
use Procuracion\Service\PersonaService;

class RecepcionController extends AbstractActionController {

    protected $em;
    protected $usuario;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction() {
        $this->usuario = $this->getEvent()->getRouteMatch()->getParam('usuario');

        return $this->redirect()->toRoute('visita', array('usuario' => $this->usuario));
    }

    public function visitaAction() {

        $form = new Formulario("form");
        $visitaservice = new VisitaService();
        $visitas = $visitaservice->listToday($this->getEntityManager());

        $header = new ViewModel();
        $header->setTemplate('recepcion/header');

        $aside = new ViewModel();
        $aside->setTemplate('recepcion/aside');

        $layout = $this->layout();
        $layout->addChild($header, 'header')
                ->addChild($aside, 'aside');

        $view = new ViewModel(array(
            'title' => 'Recepción de personas',
            'subtitle' => 'Registro de visitas',
            'form' => $form,
            'visitas' => $visitas,
            'usuario' => $this->usuario
        ));
        return $view;
    }

    public function colaAction() {
        $colaservice = new ColaRecepcionService();
        $cola = $colaservice->listToday($this->getEntityManager(), 1); //$usr->sede

        $header = new ViewModel();
        $header->setTemplate('recepcion/header');

        $aside = new ViewModel();
        $aside->setTemplate('recepcion/aside');

        $layout = $this->layout();
        $layout->addChild($header, 'header')
                ->addChild($aside, 'aside');

        $view = new ViewModel(array(
            'title' => 'Recepción de personas',
            'subtitle' => 'Cola de solicitantes',
            'cola' => $cola
        ));
        return $view;
    }

    public function consultaAction() {
        $header = new ViewModel();
        $header->setTemplate('recepcion/header');

        $aside = new ViewModel();
        $aside->setTemplate('recepcion/aside');

        $layout = $this->layout();
        $layout->addChild($header, 'header')
                ->addChild($aside, 'aside');

        $view = new ViewModel(array(
            'title' => 'Recepción de personas',
            'subtitle' => 'Consulta de expedientes'
        ));
        return $view;
    }

    public function registroAction() {

        $url = $this->getRequest()->getRequestUri();
        $value = explode("/", $url);
        $currenturl = end($value);

        $empleadoservice = new EmpleadoService();
        $empleados = $empleadoservice->listAll($this->getEntityManager());

        $unidadservice = new UnidadadministrativaService();
        $unidades = $unidadservice->listAll($this->getEntityManager());

        $form = new Formulario("form");

        $header = new ViewModel();
        $header->setTemplate('recepcion/header');

        $aside = new ViewModel();
        $aside->setTemplate('recepcion/aside');

        $layout = $this->layout();
        $layout->addChild($header, 'header')
                ->addChild($aside, 'aside');

        $view = new ViewModel(array(
            'title' => 'Recepción de personas',
            'subtitle' => 'Registro de ' . $currenturl,
            'form' => $form,
            'empleados' => $empleados,
            'unidades' => $unidades,
            'url' => $currenturl,
            'page' => $currenturl
        ));
        return $view;
    }

    public function guardarAction() {

        $data = $this->request->getPost();
        if (empty($data["nac"])) {
            $nac = NULL;
        } else {
            $nac = date_create($data["nac"]);
        }
        $persona = array(
            'nombres' => $data["nombre"],
            'apellidos' => $data["apellido"],
            'tipo' => $data["tipodoc"],
            'numero' => $data["numdoc"],
            'sexo' => $data["sexo"],
            'nac' => $nac,
            'lgbti' => $data["lgbti"]
        );
        $visita = array(
            'fecha' => date_create($data['fecha']),
            'hora' => date_create($data['hora']),
            'sede' => 1, //$data['sede'],
            'empleado' => $data['empleado'],
            'institucion' => $data['institucion'],
            'tipo' => $data['tipo'],
            'motivo' => $data['motivo'],
            'prioridad' => $data['prioridad']
        );
        $cola = array(
            'fecha' => date_create($data['fecha']),
            'hora' => date_create($data['hora']),
            'sede' => 1, //$data['sede'],
            'prioridad' => $data['prioridad'],
            'lapiceroverde' => $data['lapiceroverde'],
            'obs' => $data['obs']
        );
        $registro = new PersonaService();
        //guarda una visita nueva

        switch ($data['tipopersona']) {
            case 'visitante':
                $registro->savePersona($this->getEntityManager(), $persona, $visita, 1);
                return $this->forward()->dispatch('Procuracion\Controller\Recepcion', array(
                            'action' => 'visita'
                ));
            case 'solicitante':
                $registro->savePersona($this->getEntityManager(), $persona, $cola, 2);
                return $this->forward()->dispatch('Procuracion\Controller\Recepcion', array(
                            'action' => 'cola'
                ));
        }
    }

    public function detallevisitaAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $visitaservice = new VisitaService();
        $visita = $visitaservice->listOne($this->getEntityManager(), $id);

        $this->layout('layout/modal');
        $view = new ViewModel(array('title' => 'Recepción de personas', 'subtitle' => 'Detalle de visita', 'visita' => $visita));

        return $view;
    }

    public function salidaAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $data = $this->request->getPost();
        $departure = array('id' => $id, 'fecha' => $data['fecha'], 'hora' => $data['hora'], 'obs' => $data['obs']);

        $visitaservice = new VisitaService();
        $visitaservice->departure($this->getEntityManager(), $departure);

        $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
    }

    public function detallecolaAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $colaservice = new ColaRecepcionService();
        $cola = $colaservice->listOne($this->getEntityManager(), $id);

        $this->layout('layout/modal');
        $view = new ViewModel(array('title' => 'Recepción de personas', 'subtitle' => 'Detalle de solicitante', 'visita' => $cola));
        return $view;
    }

    public function atenderAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $hora = date("h:i:s");
        $attend = array('id' => $id, 'hora' => $hora);

        $colaservice = new ColaRecepcionService();
        $colaservice->attend($this->getEntityManager(), $attend);

        $this->redirect()->toRoute('recepcion', array('action' => 'cola'));
    }

    public function buscarAction() {
        $form = new Formulario("form");

        $header = new ViewModel();
        $header->setTemplate('recepcion/header');

        $aside = new ViewModel();
        $aside->setTemplate('recepcion/aside');

        $layout = $this->layout();
        $layout->addChild($header, 'header')
                ->addChild($aside, 'aside');
        $view = new ViewModel(array('title' => 'Recepción de personas', 'subtitle' => 'Busqueda de personas', 'form' => $form));
        return $view;
    }

    public function resultadoAction() {
        $data = $this->request->getPost();

        if (empty($data['numdoc']) && empty($data['nombre']) && empty($data['apellido'])) {

        } else {
            $parametros = array('documento' => $data['numdoc'], 'nombres' => $data['nombre'], 'apellidos' => $data['apellido']);
            $personaservice = new PersonaService();
            $personas = $personaservice->searchPersona($this->getEntityManager(), $parametros);
        }
        $header = new ViewModel();
        $header->setTemplate('recepcion/header');

        $aside = new ViewModel();
        $aside->setTemplate('recepcion/aside');

        $layout = $this->layout();
        $layout->addChild($header, 'header')
                ->addChild($aside, 'aside');

        $view = new ViewModel(array('title' => 'Recepción de personas', 'subtitle' => 'Búsqueda de personas', 'personas' => $personas));
        return $view;
    }

    public function detallebuscarAction() {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $visitas = new VisitaService();
        $getvisitas = $visitas->getVisitas($this->getEntityManager(), $id);

        $solicitudes = new ColaRecepcionService();
        $getsolicitudes = $solicitudes->getEnCola($this->getEntityManager(), $id);

        $header = new ViewModel();
        $header->setTemplate('recepcion/header');

        $aside = new ViewModel();
        $aside->setTemplate('recepcion/aside');

        $layout = $this->layout();
        $layout->addChild($header, 'header')
                ->addChild($aside, 'aside');

        $view = new ViewModel(array(
            'title' => 'Recepción de personas',
            'subtitle_visitas' => 'Bitácora de visitas',
            'visitas' => $getvisitas,
            'subtitle_solicitudes' => 'Bitácora de solicitudes',
            'solicitudes' => $getsolicitudes
        ));
        return $view;
    }

}
