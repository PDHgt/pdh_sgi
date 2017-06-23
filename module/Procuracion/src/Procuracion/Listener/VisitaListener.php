<?php

namespace Procuracion\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Procuracion\Service\CaminoService;
use Procuracion\Service\BitacoraService;
use Procuracion\Entity\Visita;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Entity\Expediente as Expediente;

class VisitaListener {

    public function postPersist(Visita $cola, LifecycleEventArgs $eventArgs) {
        //Registra el ingreso
        $entity = $eventArgs->getObject();
        $entityManager = $eventArgs->getEntityManager();
        $texto = "Ingresa a la visita id " . $entity->getId();
        $bitacora = new BitacoraService();
        $bitacora->Movimiento($entityManager, array('usuario' => $entity->getUpdatedBy(), 'accion' => $texto));
    }

    public function postUpdate(Visita $cola, LifecycleEventArgs $eventArgs) {
        //Registra el ingreso
        $entity = $eventArgs->getObject();
        $entityManager = $eventArgs->getEntityManager();
        $texto = "Modifica a la visita id " . $entity->getId();
        $bitacora = new BitacoraService();
        $bitacora->Movimiento($entityManager, array('usuario' => $entity->getUpdatedBy(), 'accion' => $texto));
    }

}
