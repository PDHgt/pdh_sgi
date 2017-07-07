<?php

namespace Procuracion\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Procuracion\Service\BitacoraService;

use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Entity\DocumentoExpediente as DocumentoExpediente;

class DocumentoExpedienteListener {

    public function postPersist(DocumentoExpediente $cola, LifecycleEventArgs $eventArgs) {
        $hoy = new \DateTime("now");
        $entityManager = $eventArgs->getEntityManager();
        $entity = $eventArgs->getObject();
        $usuario = $entity->getUpdatedBy();
        $accion = $entity->getIdAccion();
        $expediente = $entity->getIdExpediente();
        $entity->setUpdatedAt($hoy);
        $entityManager->persist($entity);
        $entityManager->flush();

        //Registra el ingreso
        $bitacora = new BitacoraService();
        $texto = "Ingresó la acción ".$accion->getAccion()." al expediente ".$expediente->getNumero();
        $bitacora->Movimiento($entityManager, array('usuario' => $entity->getUpdatedBy(), 'accion' => $texto));
    }

    public function postUpdate(DocumentoExpediente $cola, LifecycleEventArgs $eventArgs) {
        $hoy = new \DateTime("now");
        $entityManager = $eventArgs->getEntityManager();
        $entity = $eventArgs->getObject();
        $usuario = $entity->getUpdatedBy();
        $accion = $entity->getIdAccion();
        $expediente = $entity->getIdExpediente();
        $entity->setUpdatedAt($hoy);
        $entityManager->persist($entity);
        $entityManager->flush();

        //Registra el ingreso
        $bitacora = new BitacoraService();
        if($entity->getDeleted() == 1){
            $texto = "Eliminó la acción ".$accion->getAccion()." al expediente ".$expediente->getNumero();
        }
        else{
            $texto = "Modificó la acción ".$accion->getAccion()." al expediente ".$expediente->getNumero();    
        }    
        $bitacora->Movimiento($entityManager, array('usuario' => $entity->getUpdatedBy(), 'accion' => $texto));
    }

}
