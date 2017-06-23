<?php

namespace Procuracion\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Procuracion\Service\CaminoService;
use Procuracion\Service\BitacoraService;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Entity\Expediente as Expediente;

class ExpedienteListener {

    public function postPersist(Expediente $cola, LifecycleEventArgs $eventArgs) {
        $anio = date("Y");
        $entityManager = $eventArgs->getEntityManager();
        $cadena = "SELECT max(p.correlativo) as maximo FROM Procuracion\Entity\Expediente p
                    WHERE (p.anio = " . $anio . ")";
        $query = $entityManager->createQuery($cadena);
        $ultimo = $query->getResult();
        //var_dump($ultimo);


        $entity = $eventArgs->getObject();
        //var_dump($entity);

        foreach ($ultimo as $ulti) {
            if ($ulti['maximo'] > 0) {
                $nuevo = $ulti['maximo'] + 1;
            } else {
                $nuevo = 1;
            }
        }
        //$bitacora->setAccion($nuevo);//'probando los listeners');
        $usuario = $entity->getUpdatedBy();
        $entity->setCorrelativo($nuevo);
        $entity->setAnio($anio);
        $entity->setNumero("$nuevo-$anio");
        $entityManager->persist($entity);
        $entityManager->flush();

        //llamada a generar el recorrido del expediente...según el tipo
        $camino = new CaminoService();
        $camino->CrearRutaExpediente($entityManager, $entity);

        //Registra el ingreso
        $bitacora = new BitacoraService();
        $bitacora->Movimiento($entityManager, array('usuario' => $entity->getUpdatedBy(), 'accion' => "Ingresa nuevo expediente $nuevo-$anio"));
    }

    public function preUpdate($eventArgs) {

    }

}
