<?php

namespace Procuracion\Service;

use Procuracion\Entity\Expediente as Expediente;
use Procuracion\Entity\ExpedientePersona;
use Procuracion\Entity\ExpedienteHechoDerecho;
use Procuracion\Entity\Departamento;
use Procuracion\Entity\Municipio;
use Procuracion\Entity\Sede;
use Procuracion\Entity\DetalleCatalogo;
use Procuracion\Entity\TipoExpediente;
use Procuracion\Entity\TrabajoExpediente;
use Procuracion\Entity\ColaRecepcion;
use Procuracion\Entity\InstitucionPadre;
use Procuracion\Entity\InstitucionExterna;
use Procuracion\Entity\Orientacion;
use Procuracion\Entity\Remision;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\PersonaService;
use Procuracion\Service\RemisionService;
use Procuracion\Service\CuboCalificacionService;

class ExpedienteService {

    public function Save(EntityManager $em, array $datos, array $calificacion, array $persona) {
        //sede
        $sede = $em->getRepository('Procuracion\Entity\Sede')->find($datos['sede']);
        //tipo
        $tipo = $em->getRepository('Procuracion\Entity\TipoExpediente')->find($datos['tipo']);
        //cola
        $cola = $em->getRepository('Procuracion\Entity\ColaRecepcion')->find($datos['cola']);
        //departamento
        $depto = $em->getRepository('Procuracion\Entity\Departamento')->findByCodigo($datos['departamento']);
        //municipio
        $muni = $em->getRepository('Procuracion\Entity\Municipio')->findByCodigo($datos['municipio']);
        //area
        $area = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->findByCodigo($datos['area']);
        //usuario
        $queusr = $em->getRepository('Procuracion\Entity\Usuario')->find($datos['usr']);

        //asignar datos
        if ($datos['idexpediente'] > 0) {
            $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($datos['idexpediente']);
        } else {
            $expediente = new Expediente();
            //expediente_persona

            $hoy = new \DateTime();
            //var_dump($hoy);
            $fechaexp = $hoy->format("Y-m-d");
            $expediente->setFechaIngreso(date_create($fechaexp));
            $expPer = new ExpedientePersona();
            $idPersona = $em->getRepository('Procuracion\Entity\Persona')->find($persona['idp']);
            $catalogoservice = new CatalogoService();
            $tipopersona = $catalogoservice->obtenerDato($em, 'Solicitante', 'TipoPersona');
            //var_dump($tipopersona[0]);
            //exit(1);
            $expPer->setTipo($tipopersona[0]);
            $expPer->setIdPersona($idPersona);
            $expPer->setIdExpediente($expediente);
            $em->persist($expPer);
            //$em->flush();
        }
        $expediente->setIdCola($cola);
        $expediente->setIdSede($sede);
        $expediente->setIdTipo($tipo);
        $expediente->setHechos($datos['hechos']);
        $expediente->setDeptohechos($depto[0]);
        $expediente->setMunihechos($muni[0]);
        $expediente->setLugarhechos($datos['direccion']);
        $expediente->setArea($area[0]);
        $expediente->setFechahechos($datos['fecha']);
        $expediente->setPeticion($datos['peticion']);
        $expediente->setPruebas($datos['pruebas']);
        $expediente->setUpdatedBy($queusr);
        $em->persist($expediente);
        $em->flush();

        //persona
        $personaservice = new PersonaService();
        $personaservice->puedeModificarPersona($em, $persona);

        //calificación
        $cubo = new CuboCalificacionService();
        if ($datos["idexpediente"] > 0) {
            $cubo->setCalificacion($em, $calificacion["hechos"], $calificacion["ide"]);
        } else {
            $cubo->setCalificacion($em, $calificacion["hechos"], $expediente->getId());
        }
        return $expediente;
    }

    public function puedeModificarExpediente(EntityManager $em, array $datos, array $calificacion, array $persona) {
        if ($datos['idexpediente'] > 0) {
            $this->Save($em, $datos, $calificacion, $persona);
        } elseif ($persona['idpersona'] > 0) {
            $personaservice = new PersonaService();
            $personaservice->puedeModificarPersona($em, $persona);
        }
    }

    public function guardarOrientacion(EntityManager $em, array $orientacion, array $instituciones, $idexpediente) {
        $exp = $em->getRepository('Procuracion\Entity\Expediente')->find($idexpediente);
        if ($orientacion['idorientacion'] > 0) {//update
            $nuevo = $em->getRepository('Procuracion\Entity\Orientacion')->find($orientacion['ido']);
            $nuevo->setDetalle($orientacion['detalle']);
            $nuevo->setRemite($orientacion['remision']);
            $em->flush();
        } else {//new
            //expediente
            // echo "here";
            $nuevo = new Orientacion();
            $nuevo->setDetalle($orientacion['detalle']);
            $nuevo->setRemite($orientacion['remision']);
            $nuevo->setIdExpediente($exp);
            $em->persist($nuevo);
            $em->flush();
        }

        //remisiones
        //if ($orientacion['remision'] == 1) {
        $remi = new RemisionService();
        $remi->setRemision($em, $instituciones, $exp);
        //}
        //$this->puedeModificarExpediente($em, $datos, $calificacion, $persona);
        return $nuevo;
    }

    public function verExpediente(EntityManager $em, $id) {
        $cubo = new CuboCalificacionService();
        $datos = $em->getRepository('Procuracion\Entity\Expediente')->find($id);
        //var_dump($datos);
        //echo $id;
        $denunciante = $em->getRepository('Procuracion\Entity\ExpedientePersona')->findByIdExpediente($id);
        //var_dump($denunciante);
        $persona = $em->getRepository('Procuracion\Entity\Persona')->find($denunciante[0]->getIdPersona());
        $calificacion = $cubo->getCalificacion($em, $id);
        $regresar = array(
            'datos' => $datos,
            'calificacion' => $calificacion,
            'persona' => $persona
        );
        return $regresar;
    }

    public function listarRemisiones(EntityManager $em, $id) {
        $remisiones = new RemisionService();
        $listado = $remisiones->getRemisiones($em, $id);
        return $listado;
    }

    public function verOrientacion(EntityManager $em, $id) {
        $nuevo = $em->getRepository('Procuracion\Entity\Orientacion')->findByIdExpediente($id);
        $datos['orientacion'] = $nuevo;
        $datos['remisiones'] = $this->listarRemisiones($em, $id);
        return $datos;
    }

    public function guardarDocumento(EntityManager $em, $datos) {

    }

    public function listarPendientes(EntityManager $em, $usuario, $etapa) {
        $commaList = implode(', ', $etapa);
        $cadena = "select p from Procuracion\Entity\TrabajoExpediente p WHERE
                    p.inicio is not NULL AND p.fin is NULL AND
                    p.idEtapa IN (" . $commaList . ")  AND exists
                    (select p2.id from Procuracion\Entity\AsignaTrabajo p2 where
                    p2.idUsuarioAsignado = " . $usuario . " AND p2.funcion = 'encargado')";
        //echo $cadena; exit(1);
        $query = $em->createQuery($cadena);
        $listado = $query->getResult();
        return $listado;
    }

    public function unExpediente(EntityManager $em, $id) {
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($id);
        return $expediente;
    }

}
