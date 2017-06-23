<?php

namespace Procuracion\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Procuracion\Service\CaminoService;
use Procuracion\Service\BitacoraService;
use Procuracion\Entity\Persona;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Entity\Expediente as Expediente;

class PersonaListener {

    public function postPersist(Persona $cola, LifecycleEventArgs $eventArgs) {
        //Registra el ingreso
        $entity = $eventArgs->getObject();
        $entityManager = $eventArgs->getEntityManager();
        $texto = "Ingresa a la persona id " . $entity->getId();
        $bitacora = new BitacoraService();
        $bitacora->Movimiento($entityManager, array('usuario' => $entity->getUpdatedBy(), 'accion' => $texto));
    }

    public function preUpdate($eventArgs) {

    }

}
