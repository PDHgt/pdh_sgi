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
        //var_dump($persona);
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
        $expediente = new Expediente();
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
        /* $np = $em->getRepository('Procuracion\Entity\Persona')->find($persona['id']);
          //var_dump($np);
          $np->setNombres($persona['nombres']);
          $np->setApellidos($persona['apellidos']);
          $np->setTipoDocumento($persona['tipo']);
          $np->setNumeroDocumento($persona['numero']);
          $np->setSexo($persona['sexo']);
          $np->setLgbti($persona['lgbti']);
          $np->setFechaNacimiento($persona['nac']);
          $np->setUpdatedBy($queusr);
          $em->flush(); */

        //expediente_persona
        $expPer = new ExpedientePersona();
        $idPersona = $em->getRepository('Procuracion\Entity\Persona')->find($datos['idpersona']);
        $catalogoservice = new CatalogoService();
        $tipopersona = $catalogoservice->obtenerDato($em, 'Solicitante', 'TipoPersona');
        $expPer->setTipo($tipopersona[0]);
        $expPer->setIdPersona($idPersona);
        $expPer->setIdExpediente($expediente);
        $em->persist($expPer);
        $em->flush();

        //calificación
        $cubo = new CuboCalificacionService();
        $guardar = $cubo->setCalificacion($em, $calificacion, $expediente);

        return $expediente;
    }

    public function guardarOrientacion(EntityManager $em, array $datos, array $instituciones) {
        $exp = $em->getRepository('Procuracion\Entity\Expediente')->find($datos['idExpediente']);
        if ($datos['id'] > 0) {//update
            $nuevo = $em->getRepository('Procuracion\Entity\Orientacion')->find($datos['id']);
            $nuevo->setDetalle($datos['detalle']);
            $em->flush();
        } else {//new
            //expediente
            // echo "here";
            $nuevo = new Orientacion();
            $nuevo->setDetalle($datos['detalle']);
            $nuevo->setIdExpediente($exp);
            $em->persist($nuevo);
            $em->flush();
        }

        //remisiones

        $remi = new RemisionService();
        $remi->setRemision($em, $instituciones, $exp);
        /*   $cadena = "DELETE FROM Procuracion\Entity\Remision p WHERE p.idExpediente = " . $exp->getId();
          $query = $em->createQuery($cadena);
          $query->execute();
          foreach ($instituciones as $institucion) {
          $hecho = new Remision();
          $hecho->setIdExpediente($exp);
          $hd = $em->getRepository('Procuracion\Entity\InstitucionExterna')->find($institucion);
          $hecho->setIdInstitucion($hd);
          $em->persist($hecho);
          $em->flush();
          } */
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
    }

    public function puedeModificarExpediente(EntityManager $em, array $datos, array $calificacion, array $persona) {
        if ($datos['id'] > 0) {
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
            $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($datos['id']);
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
            $em->flush();

            //persona
            $personaservice = new PersonaService();
            $guardarPer = $personaservice->puedeModificarPersona($em, $persona);
            //calificación
            $cubo = new CuboCalificacionService();
            $guardar = $cubo->setCalificacion($em, $calificacion, $expediente);
        } else {
            //nada
        }
    }

    public function guardarDocumento(EntityManager $em, $datos) {

    }

}
