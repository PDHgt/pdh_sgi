<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Entity\Unidad;
use Zend\View\Model\JsonModel;

class UnidadadministrativaService {

    public function save(EntityManager $em, array $nvo) {

    }

    public function listAll(EntityManager $em) {
        //$listado = $em->getRepository('\Procuracion\Entity\Unidadadministrativa')->findAll();
        $listado = $em->getRepository('\Procuracion\Entity\Unidad')->findBy(array(), array('nombre' => 'ASC'));
        return $listado;
    }

    public function listOne(EntityManager $em, $id) {
        $usuario = $em->getRepository('\Procuracion\Entity\Unidad')->find($id);
        //return new JsonModel($enCola);
        return $usuario;
    }

    public function findByNombre(EntityManager $em, array $usr) {
        $data = $em->getRepository('Procuracion\Entity\Unidad')->findByNombre($usr['nombre']);
        return $data;
    }

}
