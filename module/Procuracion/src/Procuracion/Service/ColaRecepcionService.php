<?php

namespace Procuracion\Service;

use Procuracion\Service\TurnoService;
use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\ColaRecepcion;
use Procuracion\Entity\Persona;
use Doctrine\ORM\EntityManager as EntityManager;
use Zend\View\Model\JsonModel;
use Doctrine\ORM\QueryBuilder;

class ColaRecepcionService {

    public function save(EntityManager $em, ColaRecepcion $nvo) {
        $em->persist($nvo);
        $em->flush();
        return $nvo->getId();
    }

    public function listToday(EntityManager $em, $sede) {
        $hoy = date("Y-m-d");
        $repository = $em->getRepository('Procuracion\Entity\ColaRecepcion');
        $cadena = "SELECT p FROM Procuracion\Entity\ColaRecepcion p WHERE ";
        $cadena .= "( p.fechaentrada like '%$hoy%' and p.sede = $sede and p.horaatencion is null )";
        $cadena .= " order by p.prioridad ASC, p.fechaentrada ASC";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        //var_dump($products);
        return $products;
    }

    /*        //var_dump($em);
      $hoy = date("Y-m-d");
      $listado = $em->getRepository('\Procuracion\Entity\ColaRecepcion')->findBy(array('fechaentrada' => date_create($hoy), 'sede' => $sede, 'horaatencion' => null), array('prioridad' => 'ASC', 'horaentrada' => 'ASC'));
      //var_dump($listado);
      //return new JsonModel($listado);
      return $listado;
      } */

    public function listOne(EntityManager $em, $id) {
        $enCola = $em->getRepository('\Procuracion\Entity\ColaRecepcion')->find($id);
        //return new JsonModel($enCola);
        return $enCola;
    }

    public function attend(EntityManager $em, array $cola) {
        //$nvo = new Colarecepcion();
        $data = $em->getReference('Procuracion\Entity\ColaRecepcion', $cola['id']);
        $data->setHoraatencion(date_create($cola['hora']));
        $em->flush();
        //Registra el ingreso
        $bitacora = new BitacoraService();
        $texto = "Atiende al de idCola " . $cola['id'];
        $bitacora->Movimiento($em, array('usuario' => $cola['usuario'], 'accion' => $texto));
        return $data->getId();
    }

    public function getEnCola(EntityManager $em, $idPersona) {
        $visitas = $em->getRepository('Procuracion\Entity\ColaRecepcion')->findBy(array('idPersona' => $idPersona));
        // var_dump($visitas);
        return $visitas;
    }

    public function departure(EntityManager $em, array $cola) {
        $data = $em->getReference('Procuracion\Entity\ColaRecepcion', $cola['id']);
        $data->setHoraAtencion(date_create($cola['hora']));
        //$data->setFechasalida(date_create($cola['fecha']));
        $data->setRazonsalida($cola['razon']);
        $em->flush();
        return $data->getId();
    }

    public function getPorFechas(EntityManager $em, $fechaUno, $fechaDos) {
        $repository = $em->getRepository('Procuracion\Entity\ColaRecepcion');
        $cadena = "SELECT p FROM Procuracion\Entity\ColaRecepcion p WHERE p.fechaentrada BETWEEN '" . $fechaUno . "' AND '" . $fechaDos . "'";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        //var_dump($products);
        return $products;
    }

}
