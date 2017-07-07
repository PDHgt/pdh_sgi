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
        foreach ($ruta as $paso) {
            $nvo = new TrabajoExpediente();
            $nvo->setIdEtapa($paso->getIdEtapa());
            $nvo->setIdExpediente($expediente);
            $em->persist($nvo);
            $em->flush();
        }
    }

    public function getSiguiente(EntityManager $em, $etapa, $tipo) {
        $registro = $em->getRepository('Procuracion\Entity\CaminoTipo')->findBy(array('idTipoExpediente' => $tipo, 'idEtapa' => $etapa));
        $siguiente = $registro[0]->getSiguiente();
        return $siguiente;
    }

    public function TerminarEtapa(EntityManager $em, $id, $usr) {
        //echo "here";
        $exp = $em->getRepository('Procuracion\Entity\Expediente')->find($id);
        $cadena = "select p from Procuracion\Entity\TrabajoExpediente p WHERE
                    (p.inicio is not NULL AND
                    p.fin is NULL AND
                    p.idExpediente = " . $id . ")";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        $products[0]->setFin(new \DateTime("now"));
        $em->flush();


        $siguiente = $this->getSiguiente($em, $products[0]->getIdEtapa(), $exp->getIdTipo());
        $bita = new BitacoraService();

        if ($siguiente) {
            $etapasiguiente = $em->getRepository('Procuracion\Entity\TrabajoExpediente')->findBy(array('idExpediente' => $id, 'idEtapa' => $siguiente->getId()));
            $etapasiguiente[0]->setInicio(new \DateTime("now"));
            $etapasiguiente[0]->setIdUsuario($usr);
            $datos = array(
                'usuario' => $usr,
                'accion' => "Finaliza la actividad " . $siguiente->getId() . " el expediente id $id"
            );
        } else {//finaliza el trabajo
            $datos = array(
                'usuario' => $usr,
                'accion' => "Finaliza expediente id $id"
            );
        }
        $bita->Movimiento($em, $datos);
        $em->flush();

        //echo "que es".$siguiente->getEtapa();
    }

    public function IniciarEtapa(EntityManager $em, $datos) {

    }

}
