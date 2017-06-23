<?php

namespace Procuracion\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Procuracion\Service\BitacoraService;
use Procuracion\Entity\Colarecepcion;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Entity\Expediente as Expediente;

class ColaListener {

    public function postPersist(Colarecepcion $cola, LifecycleEventArgs $eventArgs) {
        //Registra el ingreso
        $entity = $eventArgs->getObject();
        $entityManager = $eventArgs->getEntityManager();
        $texto = "Ingresa a la cola de recepcion id ".$entity->getId();
        $bitacora = new BitacoraService();
        $bitacora->Movimiento($entityManager, array('usuario' => $entity->getUpdatedBy(), 'accion' => $texto));

    }

    public function preUpdate($eventArgs) {

    }

}
