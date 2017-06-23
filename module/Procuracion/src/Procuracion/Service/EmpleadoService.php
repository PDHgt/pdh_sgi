<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Entity\Empleado;
use Zend\View\Model\JsonModel;

class EmpleadoService {

    public function save(EntityManager $em, array $nvo) {

    }

    public function listAll(EntityManager $em) {
        //$listado = $em->getRepository('\Procuracion\Entity\Empleado')->findAll(array(), array('Nombres' => 'ASC'));
        $listado = $em->getRepository('\Procuracion\Entity\Empleado')->findByActivo(1, array('nombres' => 'ASC'));
        return $listado;
    }

    public function listOne(EntityManager $em, $id) {
        $usuario = $em->getRepository('\Procuracion\Entity\Empleado')->find($id);
        return $usuario;
    }

    public function findByNombres(EntityManager $em, array $usr) {
        $data = $em->getRepository('Procuracion\Entity\Empleado')->findByNombres($usr['nombres']);
        return $data;
    }

    public function getUnidadAdministrativa(EntityManager $em, $empleado) {
        $empleado = $em->getRepository('Procuracion\Entity\Empleado')->find($empleado);
        $ua = $empleado->getUnidadadministrativa();
        return $ua;
    }

    public function getEmpleadosPorUnidad(EntityManager $em, $id) {
        $listado = $em->getRepository('Procuracion\Entity\Empleado')->findByUnidadadministrativa($id, array('nombres' => 'ASC'));
        return $listado;
    }

}
