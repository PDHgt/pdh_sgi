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
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\PersonaService;
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
        $em->persist($expediente);
        $em->flush();

        //persona
        $np = $em->getRepository('Procuracion\Entity\Persona')->find($persona['id']);
        //var_dump($np);
        $np->setNombres($persona['nombres']);
        $np->setApellidos($persona['apellidos']);
        $np->setTipoDocumento($persona['tipo']);
        $np->setNumeroDocumento($persona['numero']);
        $np->setSexo($persona['sexo']);
        $np->setLgbti($persona['lgbti']);
        $np->setFechaNacimiento($persona['nac']);
        $em->flush();

        //expediente_persona
        $expPer = new ExpedientePersona();
        $expPer->setIdPersona($np);
        $expPer->setIdExpediente($expediente);
        $expPer->setTipo();
        $em->persist($expPer);
        $em->flush();

        //calificación
        $cubo = new CuboCalificacionService();
        $guardar = $cubo->setCalificacion($em, $calificacion, $expediente);
    }

}
