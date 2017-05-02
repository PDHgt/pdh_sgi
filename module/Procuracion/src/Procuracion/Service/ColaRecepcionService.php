<?php

namespace Procuracion\Service;

use Procuracion\Service\TurnoService;
use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\Colarecepcion;
use Procuracion\Entity\Persona;
use Doctrine\ORM\EntityManager as EntityManager;
use Zend\View\Model\JsonModel;
use Doctrine\ORM\QueryBuilder;

class ColaRecepcionService {

    public function save(EntityManager $em, Colarecepcion $nvo) {
        $em->persist($nvo);
        $em->flush();
        return $nvo->getId();
    }

    public function listToday(EntityManager $em, $sede) {
        //var_dump($em);
        $hoy = date("Y-m-d");
        $listado = $em->getRepository('\Procuracion\Entity\Colarecepcion')->findBy(array('fechaentrada' => date_create($hoy), 'sede' => $sede, 'horaatencion' => null), array('prioridad' => 'ASC', 'horaentrada' => 'ASC'));
        //var_dump($listado);
        //return new JsonModel($listado);
        return $listado;
    }

    public function listOne(EntityManager $em, $id) {
        $enCola = $em->getRepository('\Procuracion\Entity\Colarecepcion')->find($id);
        //return new JsonModel($enCola);
        return $enCola;
    }

    public function attend(EntityManager $em, array $cola) {
        $nvo = new Colarecepcion();
        $data = $em->getReference('Procuracion\Entity\Colarecepcion', $cola['id']);
        $data->setHoraatencion(date_create($cola['hora']));
        $em->flush();
        return $data->getId();
    }

    public function getEnCola(EntityManager $em, $idPersona) {
        $visitas = $em->getRepository('Procuracion\Entity\Colarecepcion')->findBy(array('idPersona' => $idPersona));
        // var_dump($visitas);
        return $visitas;
    }

    public function departure(EntityManager $em, array $cola) {
        $data = $em->getReference('Procuracion\Entity\Colarecepcion', $cola['id']);
        $data->setHoraAtencion(date_create($cola['hora']));
        //$data->setFechasalida(date_create($cola['fecha']));
        $data->setRazonsalida($cola['razon']);
        $em->flush();
        return $data->getId();
    }

    public function getPorFechas(EntityManager $em, $fechaUno, $fechaDos){
        $repository = $em->getRepository('Procuracion\Entity\Colarecepcion');
        $cadena = "SELECT p FROM Procuracion\Entity\Colarecepcion p WHERE p.fechaentrada BETWEEN '".$fechaUno."' AND '".$fechaDos."'";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        //var_dump($products);
        return $products;
    }
}
