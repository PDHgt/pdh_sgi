<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\Visita;
use Procuracion\Entity\Persona;
use Doctrine\ORM\EntityManager as EntityManager;
use Zend\View\Model\JsonModel;
use Procuracion\Entity\Empleado;

class VisitaService {

    public function save(EntityManager $em, Visita $nvo) {
        $em->persist($nvo);
        $em->flush();
        return $nvo->getId();
    }

    public function listToday(EntityManager $em, $sede) {
        $hoy = date("Y-m-d");
        //$sede = 1;
        $repository = $em->getRepository('Procuracion\Entity\Visita');
        $cadena = "SELECT p FROM Procuracion\Entity\Visita p WHERE ";
        $cadena .= "( p.fechaentrada like '%$hoy%' and p.sede = $sede and p.fechasalida is null )";
        $cadena .= " order by p.fechaentrada ASC";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        //var_dump($products);
        return $products;
        /*        //var_dump($em);
          $hoy = date("Y-m-d");
          $listado = $em->getRepository('\Procuracion\Entity\Visita')->findBy(array('fechaentrada' => date_create($hoy), 'horasalida' => null), array('horaentrada' => 'ASC'));
          //var_dump($listado);
          //return new JsonModel($listado);
          return $listado; */
    }

    public function listOne(EntityManager $em, $id) {
        $visita = $em->getRepository('\Procuracion\Entity\Visita')->find($id);
        //return new JsonModel($visita);
        return $visita;
    }

    public function departure(EntityManager $em, array $visita) {
        $data = $em->getReference('Procuracion\Entity\Visita', $visita['id']);
        //$data->setHorasalida(date_create($visita['hora']));
        $data->setFechasalida(date_create($visita['fecha']));
        $data->setNotaAlSalir($visita['obs']);
        $em->flush();
        return $data->getId();
    }

    public function getVisitas(EntityManager $em, $idPersona) {
        $visitas = $em->getRepository('Procuracion\Entity\Visita')->findBy(array('idPersona' => $idPersona));
        return $visitas;
    }

    public function getPorFechas(EntityManager $em, $fechaUno, $fechaDos) {
        $repository = $em->getRepository('Procuracion\Entity\Visita');
        $cadena = "SELECT p FROM Procuracion\Entity\Visita p WHERE p.fechaentrada BETWEEN '" . $fechaUno . "' AND '" . $fechaDos . "'";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        //var_dump($products);
        return $products;
    }

    public function haceLlamada(EntityManager $em, $id) {
        $visita = $em->getRepository('Procuracion\Entity\Visita')->find($id);
        $visita->setLlamadasRealizadas($visita->getLlamadasRealizadas() + 1);
        $em->flush();
    }

}
