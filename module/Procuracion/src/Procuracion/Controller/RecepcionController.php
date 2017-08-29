<?php

namespace Procuracion\Controller;

use Procuracion\Form\FormularioRecepcion;
use Procuracion\Form\FormularioPersona;
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
use Procuracion\Service\GeneraDocsService;
use Procuracion\Service\DocumentoService;
use Procuracion\Service\CaminoService;
use Procuracion\Service\CatalogoService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Authentication\AuthenticationService as AuthService;
use Doctrine\ORM\EntityManager as EntityManager;
use Dompdf\Dompdf;

class RecepcionController extends AbstractActionController {

    protected $entityManager;
    protected $authService;
    protected $pdfService;
    protected $usuario;

    public function __construct(EntityManager $entityManager, AuthService $authService, Dompdf $pdfService) {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
        $this->pdfService = $pdfService;
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

            $colaservice = new ColaRecepcionService(); //ExpedienteService();
            $atendidos = $colaservice->listarPendientes($this->entityManager, $identity->getId());

            $etapas = array(7, 3);

            $expedienteservice = new ExpedienteService();
            $iniciados = $expedienteservice->listarPendientes($this->entityManager, $identity->getId(), $etapas);

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity, 'atendidos' => $atendidos, 'iniciados' => $iniciados));
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

            $atendidos = $colaservice->listarPendientes($this->entityManager, $identity->getId());

            $etapas = array(7, 3);

            $expedienteservice = new ExpedienteService();
            $iniciados = $expedienteservice->listarPendientes($this->entityManager, $identity->getId(), $etapas);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity, 'atendidos' => $atendidos, 'iniciados' => $iniciados));
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

            $colaservice = new ColaRecepcionService(); //ExpedienteService();
            $atendidos = $colaservice->listarPendientes($this->entityManager, $identity->getId());

            $etapas = array(7, 3);

            $expedienteservice = new ExpedienteService();
            $iniciados = $expedienteservice->listarPendientes($this->entityManager, $identity->getId(), $etapas);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity, 'atendidos' => $atendidos, 'iniciados' => $iniciados));
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

            $colaservice = new ColaRecepcionService(); //ExpedienteService();
            $atendidos = $colaservice->listarPendientes($this->entityManager, $identity->getId());

            $etapas = array(7, 3);

            $expedienteservice = new ExpedienteService();
            $iniciados = $expedienteservice->listarPendientes($this->entityManager, $identity->getId(), $etapas);

            $form = new FormularioRecepcion();

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity, 'atendidos' => $atendidos, 'iniciados' => $iniciados));
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

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $fechaInicio = date_create_from_format('d/m/Y', $data['fechaInicio']);
            $fechaFin = date_create_from_format('d/m/Y', $data['fechaFin']);

            $visitaservice = new VisitaService();
            $visitas = $visitaservice->getPorFechas($this->entityManager, $fechaInicio->format("Y-m-d H:i:s"), $fechaFin->format("Y-m-d H:i:s"));

            $solicitudservice = new ColaRecepcionService();
            $solicitudes = $solicitudservice->getPorFechas($this->entityManager, $fechaInicio->format("Y-m-d H:i:s"), $fechaFin->format("Y-m-d H:i:s"));

            $atendidos = $solicitudservice->listarPendientes($this->entityManager, $identity->getId());

            $etapas = array(7, 3);

            $expedienteservice = new ExpedienteService();
            $iniciados = $expedienteservice->listarPendientes($this->entityManager, $identity->getId(), $etapas);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity, 'atendidos' => $atendidos, 'iniciados' => $iniciados));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('visitas' => $visitas, 'solicitudes' => $solicitudes, 'identity' => $identity, 'permisos' => $permisos));
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
            $munis = $geografiaService->ListarMunis($this->entityManager);

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
                'deptos' => $deptos,
                'munis' => $munis
            ));
            return $view;
        }
    }

    public function orientacionAction() {
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

    public function investigacionAction() {
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

            $expedienteservice = new ExpedienteService();
            $expediente = $expedienteservice->verExpediente($this->entityManager, $id);

            $institucionservice = new RemisionService();
            $institucion = $institucionservice->listarInstitucionPadre($this->entityManager);

            $catalogoservice = new CatalogoService();
            $relacionvicagr = $catalogoservice->obtenerCatalogo($this->entityManager, "RelacionVicAgr");

            $personaservice = new PersonaService();
            $victimas = $personaservice->devolverPersonas($this->entityManager, "víctima", $id);
            $denunciados = $personaservice->devolverPersonas($this->entityManager, "denunciado", $id);

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
                'institucion' => $institucion,
                'relacionvicagr' => $relacionvicagr,
                'victimas' => $victimas,
                'denunciados' => $denunciados
            ));
            return $view;
        }
    }

    public function editarexpedienteAction() {
        $data = $this->request->getPost();

        $identity = $this->authService->getIdentity();
        $sede = $identity->getIdEmpleado()->getIdsede()->getId();

        if (empty($data["solicitante_fechanac"])) {
            $fechanac = NULL;
        } else {
            $fechanac = date_create_from_format('d/m/Y', $data["solicitante_fechanac"]);
        }

        if (empty($data["hechos_fecha"])) {
            $fechahecho = NULL;
        } else {
            $fechahecho = date_create_from_format('d/m/Y', $data["hechos_fecha"]);
        }


        $persona = array(
            'idpersona' => $data["idpersona"],
            'idp' => $data["idp"],
            'nombres' => $data["solicitante_nombre"],
            'apellidos' => $data["solicitante_apellido"],
            'tipo' => $data["solicitante_tipodoc"],
            'numero' => $data["solicitante_numdoc"],
            'sexo' => $data["solicitante_sexo"],
            'fechanac' => $fechanac,
            'edad' => $data["solicitante_edad"],
            'lgbti' => $data["solicitante_lgbti"],
            'anonimo' => $data["solicitante_anonimo"],
            'correo' => $data["solicitante_correo"],
            'telefono' => $data["solicitante_telefono"],
            'direccion' => $data["solicitante_direccion"],
            'departamento' => $data["solicitante_depto"],
            'municipio' => $data["solicitante_muni"],
            'usuario' => $identity->getId()
        );

        $datos = array(
            'idexpediente' => $data["idexpediente"],
            'ide' => $data["ide"],
            'cola' => $data["idcola"],
            'usr' => $identity->getId(),
            'sede' => $sede,
            'tipo' => $data["tipoexpediente"],
            'departamento' => $data["hechos_depto"],
            'municipio' => $data["hechos_muni"],
            'area' => $data["hechos_ubicacion"],
            'hechos' => $data["hechos_descripcion"],
            'direccion' => $data["hechos_direccion"],
            'fecha' => $fechahecho,
            'peticion' => $data["hechos_peticion"],
            'pruebas' => $data["hechos_pruebas"]
        );

        $calificacion = array(
            'ide' => $data["ide"],
            'hechos' => $data["hechos"]
        );

        $expservice = new ExpedienteService();
        $expservice->puedeModificarExpediente($this->entityManager, $datos, $calificacion, $persona);

        return new JsonModel();
    }

    public function resumenAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $idexpediente = $this->getEvent()->getRouteMatch()->getParam('id');

            $form = new FormularioRecepcion();

            $geografiaService = new GeografiaService();
            $deptos = $geografiaService->ListarDeptos($this->entityManager);
            $munis = $geografiaService->ListarMunis($this->entityManager);

            $derechoservice = new CuboCalificacionService();
            $derechos = $derechoservice->listarDerechos($this->entityManager);

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $expedienteservice = new ExpedienteService();
            $expediente = $expedienteservice->verExpediente($this->entityManager, $idexpediente);
            $verorientacion = $expedienteservice->verOrientacion($this->entityManager, $idexpediente);
            $orientacion = $verorientacion["orientacion"][0];
            $remisiones = $verorientacion["remisiones"];

            $institucionservice = new RemisionService();
            $institucion = $institucionservice->listarInstitucionPadre($this->entityManager);

            $docservice = new DocumentoService();
            $docs = $docservice->getDocumentos($this->entityManager, $idexpediente);

            $url = $this->url()->fromRoute('recepcion', array('action' => 'imprimirdoc', 'id' => $idexpediente));

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
                'identity' => $identity,
                'permisos' => $permisos,
                'idexpediente' => $idexpediente,
                'expediente' => $expediente,
                'orientacion' => $orientacion,
                'remisiones' => $remisiones,
                'institucion' => $institucion,
                'derechos' => $derechos,
                'deptos' => $deptos,
                'munis' => $munis,
                'docs' => $docs,
                'url' => $url
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
        //echo $identity->getId();
        $sede = $identity->getIdEmpleado()->getIdsede()->getId();
        if (empty($data["fechanac"])) {
            $fechanac = NULL;
        } else {
            $fechanac = date_create_from_format('d/m/Y', $data["fechanac"]);
            $hoy = new \DateTime('now');
            $edad = $fechanac->diff($hoy)->y;
        }
        $persona = array(
            'id' => $data["id"],
            'nombres' => $data["nombre"],
            'apellidos' => $data["apellido"],
            'tipo' => $data["tipodoc"],
            'numero' => $data["numdoc"],
            'sexo' => $data["sexo"],
            'fechanac' => $fechanac,
            'edad' => $edad,
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


        if (empty($data["solicitante_fechanac"])) {
            $fechanac = NULL;
        } else {
            $fechanac = date_create_from_format('d/m/Y', $data["solicitante_fechanac"]);
        }

        if (empty($data["hechos_fecha"])) {
            $fechahecho = NULL;
        } else {
            $fechahecho = date_create_from_format('d/m/Y', $data["hechos_fecha"]);
        }
        $persona = array(
            'idpersona' => $data["idpersona"],
            'idp' => $data["idp"],
            'nombres' => $data["solicitante_nombre"],
            'apellidos' => $data["solicitante_apellido"],
            'tipo' => $data["solicitante_tipodoc"],
            'numero' => $data["solicitante_numdoc"],
            'sexo' => $data["solicitante_sexo"],
            'fechanac' => $fechanac,
            'edad' => $data["solicitante_edad"],
            'lgbti' => $data["solicitante_lgbti"],
            'anonimo' => $data["solicitante_anonimo"],
            'correo' => $data["solicitante_correo"],
            'telefono' => $data["solicitante_telefono"],
            'direccion' => $data["solicitante_direccion"],
            'departamento' => $data["solicitante_depto"],
            'municipio' => $data["solicitante_muni"],
            'usuario' => $identity->getId()
        );

        $datos = array(
            'idexpediente' => NULL,
            'ide' => NULL,
            'usr' => $identity->getId(),
            'sede' => $sede,
            'tipo' => $data["tipoexpediente"],
            'cola' => $data["id"],
            'departamento' => $data["hechos_depto"],
            'municipio' => $data["hechos_muni"],
            'area' => $data["hechos_ubicacion"],
            'hechos' => $data["hechos_descripcion"],
            'direccion' => $data["hechos_direccion"],
            'fecha' => $fechahecho,
            'peticion' => $data["hechos_peticion"],
            'pruebas' => $data["hechos_pruebas"]
        );

        $calificacion = array(
            'hechos' => $data["hechos"]
        );

        $expservice = new ExpedienteService();
        $expediente = $expservice->Save($this->entityManager, $datos, $calificacion, $persona);

        switch ($data["tipoexpediente"]) {
            case 1:
                $action = "orientacion";
                break;
            case 2:
                $action = "mediacion";
                break;
            case 3:
                $action = "accionespecifica";
                break;
            case 4:
                $action = "investigacion";
                break;
            default:
                break;
        }
        return $this->redirect()->toRoute('recepcion', array('action' => $action, 'id' => $expediente->getId()));
    }

    public function guardarorientacionAction() {

        $data = $this->request->getPost();
        $identity = $this->authService->getIdentity();
        //$sede = $identity->getIdEmpleado()->getIdsede()->getId();

        /* if (empty($data["solicitante_fechanac"])) {
          $fechanac = NULL;
          } else {
          $fechanac = date_create_from_format('d/m/Y', $data["solicitante_fechanac"]);
          }

          if (empty($data["hechos_fecha"])) {
          $fechahecho = NULL;
          } else {
          $fechahecho = date_create_from_format('d/m/Y', $data["hechos_fecha"]);
          }
          $persona = array(
          'idpersona' => $data["idpersona"],
          'idp' => $data["idp"],
          'nombres' => $data["solicitante_nombre"],
          'apellidos' => $data["solicitante_apellido"],
          'tipo' => $data["solicitante_tipodoc"],
          'numero' => $data["solicitante_numdoc"],
          'sexo' => $data["solicitante_sexo"],
          'fechanac' => $fechanac,
          'edad' => $data["solicitante_edad"],
          'lgbti' => $data["solicitante_lgbti"],
          'anonimo' => $data["solicitante_anonimo"],
          'correo' => $data["solicitante_correo"],
          'telefono' => $data["solicitante_telefono"],
          'direccion' => $data["solicitante_direccion"],
          'departamento' => $data["solicitante_depto"],
          'municipio' => $data["solicitante_muni"],
          'usuario' => $identity->getId()
          );

          $datos = array(
          'idexpediente' => $data["idexpediente"],
          'ide' => $data["ide"],
          'cola' => $data["idcola"],
          'usr' => $identity->getId(),
          'sede' => $sede,
          'tipo' => $data["tipoexpediente"],
          'departamento' => $data["hechos_depto"],
          'municipio' => $data["hechos_muni"],
          'area' => $data["hechos_ubicacion"],
          'hechos' => $data["hechos_descripcion"],
          'direccion' => $data["hechos_direccion"],
          'fecha' => $fechahecho,
          'peticion' => $data["hechos_peticion"],
          'pruebas' => $data["hechos_pruebas"]
          );

          $calificacion = array(
          'ide' => $data["ide"],
          'hechos' => $data["hechos"]
          ); */
        $idexpediente = $data["ide"];


        $orientacion = array(
            'idorientacion' => $data["idorientacion"],
            'ido' => $data["ido"],
            'detalle' => $data["detalleorientacion"],
            'remision' => $data["remision"]
        );

        $instituciones = array(
            'idorientacion' => $data["idorientacion"],
            'ide' => $data["ide"],
            'instituciones' => $data["instdependientes"]
        );


        $expservice = new ExpedienteService();
        $expservice->guardarOrientacion($this->entityManager, $orientacion, $instituciones, $idexpediente);

        $caminoservice = new CaminoService();
        //$caminoservice->TerminarEtapa($this->entityManager, $data["ide"], $identity);

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
            $hoy = new \DateTime('now');
            $edad = $fechanac->diff($hoy)->y;
        }
        $persona = array(
            'id' => $data["idp"],
            'nombres' => $data["nombre"],
            'apellidos' => $data["apellido"],
            'tipo' => $data["tipodoc"],
            'numero' => $data["numdoc"],
            'sexo' => $data["sexo"],
            'fechanac' => $fechanac,
            'edad' => $edad,
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
                $registro->savePersona($this->entityManager, $persona, $visita, 1);
                return $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
            case 'solicitante':
                $registro->savePersona($this->entityManager, $persona, $cola, 2);
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
        $llamada = new VisitaService();
        $llamada->haceLlamada($this->entityManager, $id);
        return $this->redirect()->toRoute('recepcion', array('action' => 'visita'));
    }

    public function imprimirdocAction() {

        $idexpediente = $this->getEvent()->getRouteMatch()->getParam('id');
        $identity = $this->authService->getIdentity();

        $expedienteservice = new ExpedienteService();
        $expediente = $expedienteservice->verExpediente($this->entityManager, $idexpediente);

        $tipoexpediente = $expediente["datos"]->getIdTipo()->getId();

        $nvoService = new GeneraDocsService();

        $ruta = $nvoService->makeDir($this->entityManager, $idexpediente, $identity->getId());

        switch ($tipoexpediente) {
            case 1:
                $nombreDoc = $ruta . "/actaOrientacion.pdf";
                $pdftext = $nvoService->GenerarOrientacion($this->entityManager, $idexpediente, $identity->getId(), $nombreDoc);
                $action = "resumen";
                break;
            case 2:

                break;
            case 3:

                break;
            case 4:
                $nombreDoc = $ruta . "/actaDenuncia.pdf";
                $pdftext = $nvoService->GenerarInvestigacion($this->entityManager, $idexpediente, $identity->getId(), $nombreDoc);
                $action = "resumeninv";
                break;
        }
        $this->pdfService->set_paper('folio', 'portrait');
        $this->pdfService->load_html($pdftext);
        $this->pdfService->render();

        if ((file_put_contents($nombreDoc, $this->pdfService->output()) !== false)) {
            $nvoService->guardarGenerado($this->entityManager, $nombreDoc, $identity->getId(), $idexpediente);
            $this->flashMessenger()->addMessage("Se generó exitósamente el archivo");
        } else {
            $this->flashMessenger()->addMessage("Error al generar el archivo");
        }

        return $this->redirect()->toRoute('recepcion', array('action' => $action, 'id' => $idexpediente));
    }

    public function terminarAction() {
        $idexpediente = $this->getEvent()->getRouteMatch()->getParam('id');
        $identity = $this->authService->getIdentity();

        $caminoservice = new CaminoService();
        $caminoservice->TerminarEtapa($this->entityManager, $idexpediente, $identity);

        return $this->redirect()->toRoute('recepcion', array('action' => 'cola'));
    }

    public function registrovictimaAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $idexpediente = $this->getEvent()->getRouteMatch()->getParam('id');
            $idpersona = $this->getEvent()->getRouteMatch()->getParam('param1');
            $param = $this->getEvent()->getRouteMatch()->getParam('param2');

            $form = new FormularioPersona("victima");

            $personaservice = new PersonaService();
            $persona = $personaservice->listOne($this->entityManager, $idpersona);

            $catalogoservice = new CatalogoService();
            $relaciondtevic = $catalogoservice->obtenerCatalogo($this->entityManager, "RelacionDteVic");
            $comunidadlinguistica = $catalogoservice->obtenerCatalogo($this->entityManager, "ComunidadLinguistica");
            $pueblopertenencia = $catalogoservice->obtenerCatalogo($this->entityManager, "PuebloPertenencia");
            $nacionalidad = $catalogoservice->obtenerCatalogo($this->entityManager, "Nacionalidad");
            $grupovulnerable = $catalogoservice->obtenerCatalogo($this->entityManager, "GrupoVulnerable");

            $geografiaService = new GeografiaService();
            $deptos = $geografiaService->ListarDeptos($this->entityManager);
            $munis = $geografiaService->ListarMunis($this->entityManager);

            $this->layout('layout/modal');

            $view = new ViewModel(array(
                'param' => $param,
                'expediente' => $idexpediente,
                'denunciante' => $persona,
                'form' => $form,
                'identity' => $identity,
                'relaciondtevic' => $relaciondtevic,
                'comunidadlinguistica' => $comunidadlinguistica,
                'pueblopertenencia' => $pueblopertenencia,
                'nacionalidad' => $nacionalidad,
                'grupovulnerable' => $grupovulnerable,
                'deptos' => $deptos,
                'munis' => $munis
            ));
            return $view;
        }
    }

    public function guardarvictimaAction() {

        $identity = $this->authService->getIdentity();
        $data = $this->request->getPost();
        $idexpediente = $data["idexpediente"];
        $personaservice = new PersonaService();
        $personaservice->ingresarVictima($this->entityManager, $identity, $data, $idexpediente);

        switch ($data["param"]) {
            case 1:
                $action = "investigacion";
                break;
            case 2:
                $action = "resumeninv";
                break;
        }
        return $this->redirect()->toRoute('recepcion', array('action' => $action, 'id' => $idexpediente));
    }

    public function registrodenunciadoAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();
            $idexpediente = $this->getEvent()->getRouteMatch()->getParam('id');
            $idpersona = $this->getEvent()->getRouteMatch()->getParam('param1');
            $param = $this->getEvent()->getRouteMatch()->getParam('param2');

            $form = new FormularioPersona("denunciado");

            $catalogoservice = new CatalogoService();
            $relacionvicagr = $catalogoservice->obtenerCatalogo($this->entityManager, "RelacionVicAgr");
            $comunidadlinguistica = $catalogoservice->obtenerCatalogo($this->entityManager, "ComunidadLinguistica");
            $pueblopertenencia = $catalogoservice->obtenerCatalogo($this->entityManager, "PuebloPertenencia");
            $nacionalidad = $catalogoservice->obtenerCatalogo($this->entityManager, "Nacionalidad");
            $grupovulnerable = $catalogoservice->obtenerCatalogo($this->entityManager, "GrupoVulnerable");

            $geografiaService = new GeografiaService();
            $deptos = $geografiaService->ListarDeptos($this->entityManager);
            $munis = $geografiaService->ListarMunis($this->entityManager);

            $this->layout('layout/modal');

            $view = new ViewModel(array(
                'param' => $param,
                'expediente' => $idexpediente,
                'form' => $form,
                'identity' => $identity,
                'relacionvicagr' => $relacionvicagr,
                'comunidadlinguistica' => $comunidadlinguistica,
                'pueblopertenencia' => $pueblopertenencia,
                'nacionalidad' => $nacionalidad,
                'grupovulnerable' => $grupovulnerable,
                'deptos' => $deptos,
                'munis' => $munis
            ));
            return $view;
        }
    }

    public function guardardenunciadoAction() {

        $identity = $this->authService->getIdentity();
        $data = $this->request->getPost();
        $idexpediente = $data["idexpediente"];

        $personaservice = new PersonaService();
        $personaservice->ingresarDenunciado($this->entityManager, $identity, $data, $idexpediente);
        switch ($data["param"]) {
            case 1:
                $action = "investigacion";
                break;
            case 2:
                $action = "resumeninv";
                break;
        }
        return $this->redirect()->toRoute('recepcion', array('action' => $action, 'id' => $idexpediente));
    }

    public function resumeninvAction() {
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

            $expedienteservice = new ExpedienteService();
            $expediente = $expedienteservice->verExpediente($this->entityManager, $id);

            $institucionservice = new RemisionService();
            $institucion = $institucionservice->listarInstitucionPadre($this->entityManager);

            $catalogoservice = new CatalogoService();
            $relacionvicagr = $catalogoservice->obtenerCatalogo($this->entityManager, "RelacionVicAgr");

            $personaservice = new PersonaService();
            $victimas = $personaservice->devolverPersonas($this->entityManager, "víctima", $id);
            $denunciados = $personaservice->devolverPersonas($this->entityManager, "denunciado", $id);

            $docservice = new DocumentoService();
            $docs = $docservice->getDocumentos($this->entityManager, $id);

            $url = $this->url()->fromRoute('recepcion', array('action' => 'imprimirdoc', 'id' => $id));

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
                'institucion' => $institucion,
                'relacionvicagr' => $relacionvicagr,
                'victimas' => $victimas,
                'denunciados' => $denunciados,
                'docs' => $docs,
                'url' => $url
            ));
            return $view;
        }
    }

    public function incompletoAction() {

        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $form = new FormularioRecepcion();

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $colaservice = new ColaRecepcionService(); //ExpedienteService();
            $atendidos = $colaservice->listarPendientes($this->entityManager, $identity->getId());

            $etapas = array(7, 3);

            $expedienteservice = new ExpedienteService();
            $iniciados = $expedienteservice->listarPendientes($this->entityManager, $identity->getId(), $etapas);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity, 'atendidos' => $atendidos, 'iniciados' => $iniciados));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('form' => $form, 'visitas' => $atendidos, 'identity' => $identity, 'permisos' => $permisos));
            return $view;
        }
    }

    public function expedienteincAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $usuarioservice = new UsuarioService();
            $permisos = $usuarioservice->getPermisos($this->entityManager, $identity->getUsuario());

            $colaservice = new ColaRecepcionService(); //ExpedienteService();
            $atendidos = $colaservice->listarPendientes($this->entityManager, $identity->getId());

            $etapas = array(7, 3);

            $expedienteservice = new ExpedienteService();
            $iniciados = $expedienteservice->listarPendientes($this->entityManager, $identity->getId(), $etapas);

            $header = new ViewModel();
            $header->setVariables(array('identity' => $identity));
            $header->setTemplate('header');

            $aside = new ViewModel();
            $aside->setVariables(array('identity' => $identity, 'atendidos' => $atendidos, 'iniciados' => $iniciados));
            $aside->setTemplate('aside');

            $layout = $this->layout();
            $layout->addChild($header, 'header')
                    ->addChild($aside, 'aside');

            $view = new ViewModel(array('form' => $form, 'visitas' => $iniciados, 'identity' => $identity, 'permisos' => $permisos));
            return $view;
        }
    }

    public function listadorevisionAction() {
        if (!$this->authService->hasIdentity()) {
            return $this->redirect()->toRoute('inicio', array('action' => 'login'));
        } else {
            $identity = $this->authService->getIdentity();

            $form = new FormularioRecepcion();

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
            $espedienteservice = new ExpedienteService();
            $listado = $espedienteservice->listarPendientes($this->entityManager, $identity->getId(), 8); //);//);//

            $view = new ViewModel(array('form' => $form, 'visitas' => $listado, 'identity' => $identity, 'permisos' => $permisos));
            return $view;
        }
    }

    public function continuarAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $identity = $this->authService->getIdentity();
        $hora = date("h:i:s");
        /* $attend = array('id' => $id, 'hora' => $hora, 'usuario' => $identity->getId());
          $colaservice = new ColaRecepcionService();
          $colaservice->attend($this->entityManager, $attend); */

        $expediente = new ExpedienteService();
        $datos = $expediente->unExpediente($this->entityManager, $id);
        $caminoservice = new CaminoService();
        $etapa = $caminoservice->enQueEtapa($this->entityManager, $id);

        switch ($etapa->getIdEtapa()->getId()) {
            case 7://registro
                switch ($datos->getIdTipo()->getId()) {
                    case 1:
                        $action = "orientacion";
                        break;
                    case 2:
                        $action = "mediacion";
                        break;
                    case 3:
                        $action = "accionespecifica";
                        break;
                    case 4:
                        $action = "investigacion";
                        break;
                }
                break;
            case 3://cierre
                switch ($datos->getIdTipo()) {
                    case 1:
                        $action = "orientacion";
                        break;
                    case 2:
                        $action = "mediacion";
                        break;
                    case 3:
                        $action = "accionespecifica";
                        break;
                    case 4:
                        $action = "investigacion";
                        break;
                }
                break;
            default:
                # code...
                break;
        }

        return $this->redirect()->toRoute('recepcion', array('action' => $action, 'id' => $datos->getId()));
    }

}
