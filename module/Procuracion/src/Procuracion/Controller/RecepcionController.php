<?php

namespace Procuracion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Procuracion\Form\FormularioRecepcion;
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
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {

        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
//$this->usuario = $this->getEvent()->getRouteMatch()->getParam('usuario');
            return $this->redirect()->toRoute('recepcion/visita', array('action' => 'visita'));
        }
    }

    public function visitaAction() {

        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $form = new FormularioRecepcion("form");
            $visitaservice = new VisitaService();
            $visitas = $visitaservice->listToday($this->getEntityManager());

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('form' => $form, 'visitas' => $visitas, 'indentity' => $identity));
            return $view;
        }
    }

    public function colaAction() {

        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listToday($this->getEntityManager(), 1); //$usr->sede

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('cola' => $cola, 'identity' => $identity));
            return $view;
        }
    }

    public function consultaAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('identity' => $identity));
            return $view;
        }
    }

    public function registroAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $url = $this->getRequest()->getRequestUri();
            $value = explode("/", $url);
            $currenturl = end($value);

            $empleadoservice = new EmpleadoService();
            $empleados = $empleadoservice->listAll($this->getEntityManager());

            $unidadservice = new UnidadadministrativaService();
            $unidades = $unidadservice->listAll($this->getEntityManager());

            $form = new FormularioRecepcion("form");

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array(
                'subtitle' => 'Registro de ' . $currenturl,
                'form' => $form,
                'empleados' => $empleados,
                'unidades' => $unidades,
                'url' => $currenturl,
                'page' => $currenturl,
                'identity' => $identity
            ));
            return $view;
        }
    }

    public function guardarAction() {

        $data = $this->request->getPost();
        if (empty($data["nac"])) {
            $nac = NULL;
        } else {
            $nac = date_create_from_format('d/m/Y', $data["nac"]); /*
             * $nac = date_create(date("Y-m-d", ));
             */
        }
        $persona = array(
            'id' => $data["id"],
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

    public function editarvisitaAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $visitaservice = new VisitaService();
            $visita = $visitaservice->listOne($this->getEntityManager(), $id);

            $empleadoservice = new EmpleadoService();
            $empleados = $empleadoservice->listAll($this->getEntityManager());

            $unidadservice = new UnidadadministrativaService();
            $unidades = $unidadservice->listAll($this->getEntityManager());

            $form = new FormularioRecepcion("form");

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'visita' => $visita, 'empleados' => $empleados, 'unidades' => $unidades, 'identity' => $identity));
            return $view;
        }
    }

    public function editarcolaAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listOne($this->getEntityManager(), $id);

            $form = new FormularioRecepcion("form");

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'cola' => $cola, 'identity' => $identity));
            return $view;
        }
    }

    public function cambiartipoAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {

            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $id = $this->getEvent()->getRouteMatch()->getParam('id');
            $tipo = $this->getEvent()->getRouteMatch()->getParam('param1');
            $idtipo = $this->getEvent()->getRouteMatch()->getParam('param2');

            $form = new FormularioRecepcion("form");

            $personaservice = new PersonaService();
            $persona = $personaservice->listOne($this->getEntityManager(), $id);

            $visitaservice = new VisitaService();
            $visita = $visitaservice->listOne($this->getEntityManager(), $idtipo);

            $empleadoservice = new EmpleadoService();
            $empleados = $empleadoservice->listAll($this->getEntityManager());

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listOne($this->getEntityManager(), $idtipo);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'persona' => $persona, 'tipo' => $tipo, 'visita' => $visita, 'empleados' => $empleados, 'cola' => $cola, 'identity' => $identity));
            return $view;
        }
    }

    public function actualizarAction() {
        $data = $this->request->getPost();
        if (empty($data["nac"])) {
            $nac = NULL;
        } else {
            $nac = date_create_from_format('d/m/Y', $data["nac"]);
        }
        $persona = array(
            'id' => $data["pid"],
            'nombres' => $data["nombre"],
            'apellidos' => $data["apellido"],
            'tipo' => $data["tipodoc"],
            'numero' => $data["numdoc"],
            'sexo' => $data["sexo"],
            'nac' => $nac,
            'lgbti' => $data["lgbti"]
        );
        $visita = array(
            'id' => $data["id"],
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
            'id' => $data["id"],
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
                $registro->updatePersona($this->getEntityManager(), $persona, $visita, 1);
                return $this->forward()->dispatch('Procuracion\Controller\Recepcion', array(
                            'action' => 'visita'
                ));
            case 'solicitante':
                $registro->updatePersona($this->getEntityManager(), $persona, $cola, 2);
                return $this->forward()->dispatch('Procuracion\Controller\Recepcion', array(
                            'action' => 'cola'
                ));
        }
    }

    public function detallevisitaAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {

            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $visitaservice = new VisitaService();
            $visita = $visitaservice->listOne($this->getEntityManager(), $id);

            $this->layout('layout/modal');
            $view = new ViewModel(array('visita' => $visita));

            return $view;
        }
    }

    public function salidavisitaAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $form = new FormularioRecepcion();

        $this->layout('layout/modal');
        $view = new ViewModel(array('form' => $form, 'id' => $id));

        return $view;
    }

    public function salidacolaAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $form = new FormularioRecepcion();

        $this->layout('layout/modal');
        $view = new ViewModel(array('form' => $form, 'id' => $id));

        return $view;
    }

    public function salidatAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $data = $this->request->getPost();
        $departure = array('id' => $id, 'fecha' => $data['fecha'], 'hora' => $data['hora'], 'obs' => $data['obs']);

        $visitaservice = new VisitaService();
        $visitaservice->departure($this->getEntityManager(), $departure);

        $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
    }

    public function salidacAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $data = $this->request->getPost();
        $departure = array('id' => $id, 'hora' => $data['hora'], 'razon' => $data['obs']);

        $colaservice = new ColaRecepcionService();
        $colaservice->departure($this->getEntityManager(), $departure);

        return $this->forward()->dispatch('Procuracion\Controller\Recepcion', array(
                    'action' => 'cola'
        ));
        //$this->redirect()->toRoute('recepcion', array('action' => 'cola'));
    }

    public function detallecolaAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $colaservice = new ColaRecepcionService();
        $cola = $colaservice->listOne($this->getEntityManager(), $id);

        $this->layout('layout/modal');
        $view = new ViewModel(array('cola' => $cola));
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
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $form = new FormularioRecepcion("form");

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'identity' => $identity));
            return $view;
        }
    }

    public function resultadoAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $data = $this->request->getPost();

            $parametros = array('documento' => $data['numdoc'], 'nombres' => $data['nombre'], 'apellidos' => $data['apellido']);
            $personaservice = new PersonaService();
            $personas = $personaservice->searchPersona($this->getEntityManager(), $parametros);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('personas' => $personas, 'identity' => $identity));
            return $view;
        }
    }

    public function detallebuscarAction() {
        if (!$this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService')->getIdentity();

            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            //var_dump($id);

            $visitaservice = new VisitaService();
            $visitas = $visitaservice->getVisitas($this->getEntityManager(), $id);

            //var_dump($visitas);

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->getEnCola($this->getEntityManager(), $id);

            // var_dump($cola);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('recepcion/header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('recepcion/aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('visitas' => $visitas, 'solicitudes' => $cola, 'identity' => $identity));
            return $view;
        }
    }

    public function getTurnoAction() {
        $colaservice = new ColaRecepcionService();
        $cola = $colaservice->listToday($this->getEntityManager(), 1); //$usr->sede

        $this->layout('layout/index');

        $view = new ViewModel(array('cola' => $cola));
        return $view;
    }

    public function turnoAction() {

    }

}
