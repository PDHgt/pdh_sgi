<?php

namespace Procuracion\Service;

use Procuracion\Entity\Etapa;
use Procuracion\Entity\TipoExpediente;
use Procuracion\Entity\CaminoTipo;
use Procuracion\Entity\Expediente;
use Procuracion\Entity\TrabajoExpediente;
use Procuracion\Service\BitacoraService;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;

class CaminoService {

    public function TraerRuta(EntityManager $em, $tipo) {//, $calificacion){
        //echo $tipo;
        $camino = $em->getRepository('Procuracion\Entity\CaminoTipo')->findBy(array('idTipoExpediente' => $tipo));
        return $camino;
    }

    public function CrearRutaExpediente(EntityManager $em, Expediente $expediente) {
        $ruta = $this->TraerRuta($em, $expediente->getIdTipo());
        $registro = $em->getRepository('Procuracion\Entity\Etapa')->find(7); //registro
        foreach ($ruta as $paso) {
            $nvo = new TrabajoExpediente();
            $nvo->setIdEtapa($paso->getIdEtapa());
            $nvo->setIdExpediente($expediente);
            if ($paso->getIdEtapa() == $registro) {
                $nvo->setInicio($expediente->getIdCola()->getHoraatencion());
                $nvo->setIdUsuario($expediente->getUpdatedBy());
                $nvo->setFechaasignacion($expediente->getIdCola()->getHoraatencion());
                $nvo->setIdUsuarioAsigna($expediente->getUpdatedBy());
            } else {
                //$nvo->setInicio(new \DateTime("now"));
            }
            $em->persist($nvo);
            $em->flush();
        }
    }

    /*
      parametros: EntityManager $em, Etapa $etapa, TipoExpediente $tipo
      regresa:  Etapa
     */

    public function getSiguienteEtapa(EntityManager $em, $etapa, $tipo) {
        $registro = $em->getRepository('Procuracion\Entity\CaminoTipo')->findBy(array('idTipoExpediente' => $tipo, 'idEtapa' => $etapa));
        $siguiente = $registro[0]->getSiguiente();
        return $siguiente;
    }

    public function getEtapaAnterior(EntityManager $em, $etapa, $tipo) {
        //var_dump($etapa);
        $registro = $em->getRepository('Procuracion\Entity\CaminoTipo')->findBy(array('idTipoExpediente' => $tipo, 'idEtapa' => $etapa));
        $anterior = $registro[0]->getAnterior();
        return $anterior;
    }

    /* public function getSiguiente(EntityManager $em, $etapa, $tipo) {
      $registro = $em->getRepository('Procuracion\Entity\CaminoTipo')->findBy(array('idTipoExpediente' => $tipo, 'idEtapa' => $etapa));
      $siguiente = $registro[0]->getSiguiente();
      return $siguiente;
      } */

    /*
      parametros: EntityManager $em, integer idExpediente $id
      regresa:  Etapa
     */

    public function enQueEtapa(EntityManager $em, $id) {
        $cadena = "select p from Procuracion\Entity\TrabajoExpediente p WHERE
                    p.inicio is not NULL AND p.fin is NULL AND
                    p.idExpediente = " . $id . " order by p.id";
        $query = $em->createQuery($cadena);
        $listado = $query->getResult();
        return $listado[0];
    }

    /*
      parametros: EntityManager $em, integer idExpediente $id, Usuario $usr
      regresa: Entity Etapa
     */

    public function TerminarEtapa(EntityManager $em, $id, $usr) {

        $exp = $em->getRepository('Procuracion\Entity\Expediente')->find($id);
        $cadena = "select p from Procuracion\Entity\TrabajoExpediente p WHERE
          (p.inicio is not NULL AND
          p.fin is NULL AND
          p.idExpediente = " . $id . ")";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        $date = new \DateTime("now");
        $products[0]->setFin($date);
        $em->flush();

        $siguiente = $this->getSiguienteEtapa($em, $products[0]->getIdEtapa(), $exp->getIdTipo());
        $bita = new BitacoraService();

        //echo $siguiente->getId();

        if ($siguiente) {
            $etapasiguiente = $em->getRepository('Procuracion\Entity\TrabajoExpediente')->findBy(array('idExpediente' => $id, 'idEtapa' => $siguiente->getId()));
            //$date = new \DateTime("now");
            $etapasiguiente[0]->setInicio($date);
            $etapasiguiente[0]->setIdUsuario($usr);
            $datos = array(
                'usuario' => $usr,
                'accion' => "Finaliza la actividad " . $siguiente->getId() . " el expediente id " . $id
            );
        } else {//finaliza el trabajo
            $datos = array(
                'usuario' => $usr,
                'accion' => "Finaliza expediente id $id"
            );
        }
        $bita->Movimiento($em, $datos);
        $em->flush();
    }

}
