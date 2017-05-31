<?php

namespace Procuracion\Service;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Procuracion\Entity\Bitacora;
use Doctrine\ORM\EntityManager as EntityManager;


class PrePersistListener
{
    public function prePersist(PrePersistEventArgs  $args)
    {
        $entity = $args->getObject();
        $entityManager = $args->getObjectManager();
        

        if ($entity instanceof Colarecepcion) {
            echo "entra aqui!";
            $bita = new Bitacora();
            $bita->setFechaHora(date_create(date('Y-m-d H:i:s')));
            $bita->setAccion("probandito");
            $entityManager->persist($bita);
            $entityManager->flush();
            // do something with the Product
        }
    }
}