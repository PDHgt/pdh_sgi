<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\DefDerecho;
use Procuracion\Entity\Derecho;
use Procuracion\Entity\ExpedienteHechoDerecho;
use Doctrine\ORM\EntityManager as EntityManager;

class CuboCalificacionService {

    public function listarDerechos(EntityManager $em) {
        $listado = $em->getRepository('Procuracion\Entity\Derecho')->findAll();
        return $listado;
    }

//    public function listarHechos(EntityManager $em, $derechos, $es) {
//        if ($es == 1)
//            $subcadena = "p.competencia = 1";
//        else
//            $subcadena = "p.orientacion = 1";
//        $cadena = "SELECT p FROM Procuracion\Entity\DefHecho p WHERE (
//			p.idDerecho IN (";
//        foreach ($derechos as $derecho) {
//            $cadena .= $derecho . ",";
//        }
//        $cadena = substr($cadena, 0, (strlen($cadena) - 1)) . ") and " . $subcadena . " )";
//        //echo $cadena;
//        $query = $em->createQuery($cadena);
//        $hechos = $query->getResult();
//        return $hechos;
//    }

    public function listarHechos(EntityManager $em, $derechos, $es) {
        if ($es == 1)
            $subcadena = "p.competencia = 1";
        else
            $subcadena = "p.orientacion = 1";
        $cadena = "SELECT p FROM Procuracion\Entity\DefHecho p WHERE (p.idDerecho = '" . $derechos . "' and " . $subcadena . " )";
        //echo $cadena;
        $query = $em->createQuery($cadena);
        $hechos = $query->getResult();
        return $hechos;
    }

    public function getCalificacion(EntityManager $em, $idExpediente) {
        $listado = $em->getRepository('Procuracion\Entity\ExpedienteHechoDerecho')->findByIdExpediente($idExpediente);
        return $listado;
    }

    public function getDerechos(EntityManager $em, $idExpediente) {
        $listado = $em->getRepository('Procuracion\Entity\ExpedienteHechoDerecho')->findByIdExpediente($idExpediente);
        $derechos = array();
        foreach ($listado as $hechoderecho) {
            $derechos[] = $hechoderecho->getIdHechoDerecho()->getIdDerecho();
        }
        $unicos = array_unique($derechos, SORT_REGULAR);
        return $unicos;
    }

    public function setCalificacion(EntityManager $em, array $hechosderechos, $idExpediente) {
        //borrar todo
        $cadena = "DELETE FROM Procuracion\Entity\ExpedienteHechoDerecho p WHERE p.idExpediente = " . $idExpediente->getId();
        $query = $em->createQuery($cadena);
        $query->execute();
        //insertar nuevos
        $exp = $em->getRepository('Procuracion\Entity\Expediente')->find($idExpediente->getId());
        foreach ($hechosderechos as $hechoderecho) {
            $hecho = new ExpedienteHechoDerecho();
            $hecho->setIdExpediente($exp);
            $hd = $em->getRepository('Procuracion\Entity\DefHecho')->find($hechoderecho);
            $hecho->setIdHecho($hd);
            $em->persist($hecho);
            $em->flush();
            //echo $hechoderecho['id'];
        } //exit(1);
    }

}
