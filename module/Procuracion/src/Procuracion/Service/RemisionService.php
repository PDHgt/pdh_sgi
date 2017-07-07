<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\InstitucionPadre;
use Procuracion\Entity\InstitucionExterna;
use Procuracion\Entity\Remision;
use Doctrine\ORM\EntityManager as EntityManager;

class RemisionService {

    public function listarInstitucionPadre(EntityManager $em) {
        $listado = $em->getRepository('Procuracion\Entity\InstitucionPadre')->findAll();
        return $listado;
    }

    public function listarInstituciones(EntityManager $em, $padre) {
        $instituciones = $em->getRepository('Procuracion\Entity\InstitucionExterna')->findByIdPadre($padre, array("institucion" => "ASC"));
        return $instituciones;
    }

    public function getRemisiones(EntityManager $em, $idExpediente) {
        $listado = $em->getRepository('Procuracion\Entity\Remision')->findByIdExpediente($idExpediente);
        return $listado;
    }

    public function getPadres(EntityManager $em, $idExpediente) {
        $listado = $em->getRepository('Procuracion\Entity\Remision')->findByIdExpediente($idExpediente);
        $padres = array();
        foreach ($listado as $remi) {
            $padres[] = $remi->getIdPadre();
        }
        $unicos = array_unique($padres, SORT_REGULAR);
        return $unicos;
    }

    public function setRemision(EntityManager $em, array $instituciones, $idExpediente) {
        //borrar todo
        $cadena = "DELETE FROM Procuracion\Entity\Remision p WHERE p.idExpediente = " . $idExpediente->getId();
        $query = $em->createQuery($cadena);
        $query->execute();
        //insertar nuevos
        $inst = $instituciones["instituciones"];
        if ($inst > 0) {
            $exp = $em->getRepository('Procuracion\Entity\Expediente')->find($idExpediente->getId());
            foreach ($inst as $institucion) {
                $remi = new Remision();
                $remi->setIdExpediente($exp);
                $hd = $em->getRepository('Procuracion\Entity\InstitucionExterna')->find($institucion);
                $remi->setIdInstitucion($hd);
                $em->persist($remi);
                $em->flush();
                //echo $hechoderecho['id'];
            } //exit(1);
        }
    }

}
