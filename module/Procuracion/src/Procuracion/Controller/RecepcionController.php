<?php

namespace Procuracion\Controller;

use Procuracion\Form\FormularioRecepcion;
use Procuracion\Service\VisitaService;
use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\EmpleadoService;
use Procuracion\Service\UnidadadministrativaService;
use Procuracion\Service\PersonaService;
use Procuracion\Service\UsuarioService;
use Procuracion\Service\CuboCalificacionService;
use Procuracion\Service\GeografiaService;
use Procuracion\Service\ExpedienteService;
use Procuracion\Service\RemisionService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService as AuthService;
use Doctrine\ORM\EntityManager as EntityManager;

class RecepcionController extends AbstractActionController {

    protected $entityManager;
    protected $authService;
    protected $usuario;

    public function __construct(EntityManager $entityManager, AuthService $authService) {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
//$this->perfil = $this->authService->getIdentity()->getUsuario();
    }

    public function indexAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            return $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
        }
    }

///****************************Métodos para mostrar grids de registros*******************************///

    public function visitaAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $sede = $identity->getIdEmpleado()->getIdsede()->getId();

            $form = new FormularioRecepcion();
            $visitaservice = new VisitaService();
            $visitas = $visitaservice->listToday($this->entityManager, $sede);

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');


            $view = new ViewModel(array('form' => $form, 'visitas' => $visitas, 'identity' => $identity, 'permisos' => $permisos));
            return $view;
        }
    }

    public function colaAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $sede = $identity->getIdEmpleado()->getIdsede()->getId();

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listToday($this->entityManager, $sede); //$usr->sede

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('cola' => $cola, 'identity' => $identity, 'permisos' => $permisos));
            return $view;
        }
    }

    public function consultaAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('identity' => $identity, 'permisos' => $permisos));
            return $view;
        }
    }

    public function buscarAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $form = new FormularioRecepcion();

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'identity' => $identity, 'permisos' => $permisos));
            return $view;
        }
    }

    public function resultadoAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $data = $this->request->getPost();

            $fechaInicio = date_create_from_format('d/m/Y', $data['fechaInicio']);
            $fechaFin = date_create_from_format('d/m/Y', $data['fechaFin']);

            $visitaservice = new VisitaService();
            $visitas = $visitaservice->getPorFechas($this->entityManager, $fechaInicio->format("Y-m-d H:i:s"), $fechaFin->format("Y-m-d H:i:s"));

            $solicitudservice = new ColaRecepcionService();
            $solicitudes = $solicitudservice->getPorFechas($this->entityManager, $fechaInicio->format("Y-m-d H:i:s"), $fechaFin->format("Y-m-d H:i:s"));

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('visitas' => $visitas, 'solicitudes' => $solicitudes, 'identity' => $identity));
            return $view;
        }
    }

///********************Métodos para mostrar formularios de captura de datos***************************///


    public function registroAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $param = $this->params()->fromRoute('id');

            $empleadoservice = new EmpleadoService();
            $empleados = $empleadoservice->listAll($this->entityManager);

            $unidadservice = new UnidadadministrativaService();
            $unidades = $unidadservice->listAll($this->entityManager);

            $form = new FormularioRecepcion();

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array(
                'subtitle' => 'Registro de ' . $param,
                'form' => $form,
                'empleados' => $empleados,
                'unidades' => $unidades,
                'url' => $param,
                'page' => $param,
                'identity' => $identity
            ));
            return $view;
        }
    }

    public function solicitudAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $form = new FormularioRecepcion();

            $geografiaService = new GeografiaService();
            $deptos = $geografiaService->ListarDeptos($this->entityManager);

            $derechoservice = new CuboCalificacionService();
            $derechos = $derechoservice->listarDerechos($this->entityManager);

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listOne($this->entityManager, $id);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array(
                'form' => $form,
                'cola' => $cola,
                'identity' => $identity,
                'id' => $id,
                'derechos' => $derechos,
                'permisos' => $permisos,
                'deptos' => $deptos
            ));
            return $view;
        }
    }

    public function orientacionaction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $form = new FormularioRecepcion();

            $geografiaService = new GeografiaService();
            $deptos = $geografiaService->ListarDeptos($this->entityManager);
            $munis = $geografiaService->ListarMunis($this->entityManager);

            $derechoservice = new CuboCalificacionService();
            $derechos = $derechoservice->listarDerechos($this->entityManager);

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            /* $colaservice = new ColaRecepcionService();
              $cola = $colaservice->listOne($this->entityManager, $id); */

            $expedienteservice = new ExpedienteService();
            $expediente = $expedienteservice->verExpediente($this->entityManager, $id);

            $institucionservice = new RemisionService();
            $institucion = $institucionservice->listarInstitucionPadre($this->entityManager);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array(
                'form' => $form,
                'expediente' => $expediente,
                'identity' => $identity,
                'id' => $id,
                'derechos' => $derechos,
                'permisos' => $permisos,
                'deptos' => $deptos,
                'munis' => $munis,
                'institucion' => $institucion
            ));
            return $view;
        }
    }

    public function resumenAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $idexpediente = $this->getEvent()->getRouteMatch()->getParam('id');

            echo $idexpediente;

            $form = new FormularioRecepcion();

            $geografiaService = new GeografiaService();
            $deptos = $geografiaService->ListarDeptos($this->entityManager);
            $munis = $geografiaService->ListarMunis($this->entityManager);

            $derechoservice = new CuboCalificacionService();
            $derechos = $derechoservice->listarDerechos($this->entityManager);

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            /* $colaservice = new ColaRecepcionService();
              $cola = $colaservice->listOne($this->entityManager, $id); */

            $expedienteservice = new ExpedienteService();
            $expediente = $expedienteservice->verExpediente($this->entityManager, $idexpediente);

            $institucionservice = new RemisionService();
            $institucion = $institucionservice->listarInstitucionPadre($this->entityManager);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array(
                'form' => $form,
                'expediente' => $expediente,
                'identity' => $identity,
                'idexpediente' => $idexpediente,
                'derechos' => $derechos,
                'permisos' => $permisos,
                'deptos' => $deptos,
                'munis' => $munis,
                'institucion' => $institucion
            ));
            return $view;
        }
    }

    public function editarvisitaAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {

            $identity = $this->authService->getIdentity();

            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $visitaservice = new VisitaService();
            $visita = $visitaservice->listOne($this->entityManager, $id);

            $empleadoservice = new EmpleadoService();
            $empleados = $empleadoservice->listAll($this->entityManager);

            $unidadservice = new UnidadadministrativaService();
            $unidades = $unidadservice->listAll($this->entityManager);

            $form = new FormularioRecepcion();

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'visita' => $visita, 'empleados' => $empleados, 'unidades' => $unidades, 'identity' => $identity));
            return $view;
        }
    }

    public function editarcolaAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $id = $this->getEvent()->getRouteMatch()->getParam('id');
            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listOne($this->entityManager, $id);

            $form = new FormularioRecepcion();

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'cola' => $cola, 'identity' => $identity));
            return $view;
        }
    }

    public function cambiartipoAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $id = $this->getEvent()->getRouteMatch()->getParam('id');
            $tipo = $this->getEvent()->getRouteMatch()->getParam('param1');
            $idtipo = $this->getEvent()->getRouteMatch()->getParam('param2');

            $form = new FormularioRecepcion();

            $personaservice = new PersonaService();
            $persona = $personaservice->listOne($this->entityManager, $id);

            $visitaservice = new VisitaService();
            $visita = $visitaservice->listOne($this->entityManager, $idtipo);

            $empleadoservice = new EmpleadoService();
            $empleados = $empleadoservice->listAll($this->entityManager);

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->listOne($this->entityManager, $idtipo);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');
            $view = new ViewModel(array('form' => $form, 'persona' => $persona, 'tipo' => $tipo, 'visita' => $visita, 'empleados' => $empleados, 'cola' => $cola, 'identity' => $identity));
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

///******************* Métodos para guardar datos *********************////

    public function guardarAction() {

        $data = $this->request->getPost();
        $identity = $this->authService->getIdentity();
        echo $identity->getId();
        $sede = $identity->getIdEmpleado()->getIdsede()->getId();
        if (empty($data["fechanac"])) {
            $fechanac = NULL;
        } else {
            $fechanac = date_create_from_format('d/m/Y', $data["fechanac"]); /*
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
            'fechanac' => $fechanac,
            'lgbti' => $data["lgbti"],
            'anonimo' => $data["anonimo"],
            'usuario' => $identity->getId()
        );
        $visita = array(
            'fecha' => date_create($data['fecha']),
            'hora' => date_create($data['hora']),
            'sede' => $sede, //$data['sede'],
            'empleado' => $data['empleado'],
            'institucion' => $data['institucion'],
            'tipo' => $data['tipo'],
            'motivo' => $data['motivo'],
            'prioridad' => $data['prioridad']
        );
        $cola = array(
            'fecha' => date_create($data['fecha']),
            'hora' => date_create($data['hora']),
            'sede' => $sede, //$data['sede'],
            'prioridad' => $data['prioridad'],
            'lapiceroverde' => $data['lapiceroverde'],
            'obs' => $data['obs']
        );
        $registro = new PersonaService();
        switch ($data['tipopersona']) {
            case 'visitante':
                $registro->savePersona($this->entityManager, $persona, $visita, 1);
                return $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
            case 'solicitante':
                $registro->savePersona($this->entityManager, $persona, $cola, 2);
                return $this->redirect()->toRoute('recepcion', array('action' => 'cola'));
        }
    }

    public function guardarsolicitudAction() {

        $data = $this->request->getPost();
        $identity = $this->authService->getIdentity();
        $sede = $identity->getIdEmpleado()->getIdsede()->getId();


        if (empty($data["fechanac"])) {
            $fechanac = NULL;
        } else {
            $fechanac = date_create_from_format('d/m/Y', $data["fechanac"]);
        }

        if (empty($data["fechahecho"])) {
            $fechahecho = NULL;
        } else {
            $fechahecho = date_create_from_format('d/m/Y', $data["fechahecho"]);
        }
        $persona = array(
            'id' => $data["pid"],
            'nombres' => $data["nombre"],
            'apellidos' => $data["apellido"],
            'tipo' => $data["tipodoc"],
            'numero' => $data["numdoc"],
            'sexo' => $data["sexo"],
            'fechanac' => $fechanac,
            'lgbti' => $data["lgbti"],
            'anonimo' => $data["anonimo"],
            'usuario' => $identity->getId()
        );

        $datos = array(
            'idpersona' => $data["idpersona"],
            'usr' => $identity->getId(),
            'sede' => $sede,
            'tipo' => $data["tipoexpediente"],
            'cola' => $data["id"],
            'departamento' => $data["depto"],
            'municipio' => $data["muni"],
            'area' => $data["areaubicacion"],
            'hechos' => $data["descripcionhechos"],
            'direccion' => $data["direccion"],
            'fecha' => $fechahecho,
            'peticion' => $data["peticion"],
            'pruebas' => $data["pruebas"]
        );

        $calificacion = $data["hechos"];

        //echo $identity->getId();

        $expservice = new ExpedienteService();
        $expediente = $expservice->Save($this->entityManager, $datos, $calificacion, $persona);

        return $this->redirect()->toRoute('recepcion', array('action' => 'orientacion', 'id' => $expediente->getId()));
    }

    public function guardarorientacionaction() {

        $data = $this->request->getPost();
        $idexpediente = $data["id"];
        $identity = $this->authService->getIdentity();
        $sede = $identity->getIdEmpleado()->getIdsede()->getId();

        if (empty($data["fechanac"])) {
            $fechanac = NULL;
        } else {
            $fechanac = date_create_from_format('d/m/Y', $data["fechanac"]);
        }

        if (empty($data["fechahecho"])) {
            $fechahecho = NULL;
        } else {
            $fechahecho = date_create_from_format('d/m/Y', $data["fechahecho"]);
        }
        $persona = array(
            'id' => $data["pid"],
            'nombres' => $data["nombre"],
            'apellidos' => $data["apellido"],
            'tipo' => $data["tipodoc"],
            'numero' => $data["numdoc"],
            'sexo' => $data["sexo"],
            'fechanac' => $fechanac,
            'lgbti' => $data["lgbti"],
            'anonimo' => $data["anonimo"],
            'usuario' => $identity->getId()
        );

        $datos = array(
            'idpersona' => $data["idpersona"],
            'usr' => $identity->getId(),
            'sede' => $sede,
            'tipo' => $data["tipoexpediente"],
            'cola' => $data["id"],
            'departamento' => $data["depto"],
            'municipio' => $data["muni"],
            'area' => $data["areaubicacion"],
            'hechos' => $data["descripcionhechos"],
            'direccion' => $data["direccion"],
            'fecha' => $fechahecho,
            'peticion' => $data["peticion"],
            'pruebas' => $data["pruebas"]
        );

        $calificacion = $data["hechos"];

        $orientacion = array(
            'idExpediente' => $data["id"],
            'detalle' => $data["detalleorientacion"],
            'remision' => $data["remision"]
        );

        $instituciones = $data["instdependientes"];

        $expservice = new ExpedienteService();
        $expservice->guardarOrientacion($this->entityManager, $orientacion, $instituciones);

        return $this->redirect()->toRoute('recepcion', array('action' => 'resumen', 'id' => $idexpediente));
    }

///************************Métodos para modificar registros*****************************///

    public function actualizarAction() {
        $identity = $this->authService->getIdentity();
        $sede = $identity->getIdEmpleado()->getIdsede()->getId();
        $data = $this->request->getPost();

        if (empty($data["fechanac"])) {
            $fechanac = NULL;
        } else {
            $fechanac = date_create_from_format('d/m/Y', $data["fechanac"]);
        }
        $persona = array(
            'id' => $data["pid"],
            'nombres' => $data["nombre"],
            'apellidos' => $data["apellido"],
            'tipo' => $data["tipodoc"],
            'numero' => $data["numdoc"],
            'sexo' => $data["sexo"],
            'fechanac' => $fechanac,
            'lgbti' => $data["lgbti"],
            'anonimo' => $data["anonimo"],
            'usuario' => $identity->getId()
        );
        $visita = array(
            'id' => $data["id"],
            'fecha' => date_create($data['fecha']),
            'hora' => date_create($data['hora']),
            'sede' => $sede, //$data['sede'],
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
            'sede' => $sede, //$data['sede'],
            'prioridad' => $data['prioridad'],
            'lapiceroverde' => $data['lapiceroverde'],
            'obs' => $data['obs']
        );
        $registro = new PersonaService();
//guarda una visita nueva

        switch ($data['tipopersona']) {
            case 'visitante':
                $registro->updatePersona($this->entityManager, $persona, $visita, 1);
                return $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
            case 'solicitante':
                $registro->updatePersona($this->entityManager, $persona, $cola, 2);
                return $this->redirect()->toRoute('recepcion', array('action' => 'cola'));
        }
    }

    public function salidatAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $data = $this->request->getPost();
        $departure = array('id' => $id, 'fecha' => $data['fecha'], 'hora' => $data['hora'], 'obs' => $data['obs']);

        $visitaservice = new VisitaService();
        $visitaservice->departure($this->entityManager, $departure);

        $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
    }

    public function salidacAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $data = $this->request->getPost();
        $departure = array('id' => $id, 'hora' => $data['hora'], 'razon' => $data['obs']);

        $colaservice = new ColaRecepcionService();
        $colaservice->departure($this->entityManager, $departure);

        return $this->redirect()->toRoute('recepcion', array('action' => 'cola'));
    }

    public function atenderAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $identity = $this->authService->getIdentity();
        $hora = date("h:i:s");
        $attend = array('id' => $id, 'hora' => $hora, 'usuario' => $identity->getId());

        $colaservice = new ColaRecepcionService();
        $colaservice->attend($this->entityManager, $attend);

        $this->redirect()->toRoute('recepcion', array('action' => 'solicitud', 'id' => $id));
    }

///*****************************Métodos para mostrar detalles*****************************///

    public function detallevisitaAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {

            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $visitaservice = new VisitaService();
            $visita = $visitaservice->listOne($this->entityManager, $id);

            $this->layout('layout/modal');
            $view = new ViewModel(array('visita' => $visita));

            return $view;
        }
    }

    public function detallecolaAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $colaservice = new ColaRecepcionService();
        $cola = $colaservice->listOne($this->entityManager, $id);

        $this->layout('layout/modal');
        $view = new ViewModel(array('cola' => $cola));
        return $view;
    }

    public function detallebuscarAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $id = $this->getEvent()->getRouteMatch()->getParam('id');

            $visitaservice = new VisitaService();
            $visitas = $visitaservice->getVisitas($this->entityManager, $id);

            $colaservice = new ColaRecepcionService();
            $cola = $colaservice->getEnCola($this->entityManager, $id);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('visitas' => $visitas, 'solicitudes' => $cola, 'identity' => $identity));
            return $view;
        }
    }

    public function getturnoAction() {
        $identity = $this->authService->getIdentity();
        $sede = $identity->getIdEmpleado()->getIdsede()->getId();
        $colaservice = new ColaRecepcionService();
        $cola = $colaservice->listToday($this->entityManager, $sede); //$usr->sede

        $this->layout('layout/index');

        $view = new ViewModel(array('cola' => $cola));
        return $view;
    }

    public function turnoAction() {

    }

    public function hacellamadaAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        echo $id;
        $llamada = new VisitaService();
        $llamada->haceLlamada($this->entityManager, $id);
        return $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
    }

}
