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

    public function listToday(EntityManager $em) {
        //var_dump($em);
        $hoy = date("Y-m-d");
        $listado = $em->getRepository('\Procuracion\Entity\Visita')->findBy(array('fechaentrada' => date_create($hoy), 'horasalida' => null), array('horaentrada' => 'ASC'));
        //var_dump($listado);
        //return new JsonModel($listado);
        return $listado;
    }

    public function listOne(EntityManager $em, $id) {
        $visita = $em->getRepository('\Procuracion\Entity\Visita')->find($id);
        //return new JsonModel($visita);
        return $visita;
    }

    public function departure(EntityManager $em, array $visita) {
        $data = $em->getReference('Procuracion\Entity\Visita', $visita['id']);
        $data->setHorasalida(date_create($visita['hora']));
        $data->setFechasalida(date_create($visita['fecha']));
        $data->setNotaalsalir($visita['obs']);
        $em->flush();
        return $data->getId();
    }

}
