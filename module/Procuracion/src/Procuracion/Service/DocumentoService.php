<?php

namespace Procuracion\Service;

use Procuracion\Entity\Expediente as Expediente;
use Procuracion\Entity\DocumentoExpediente;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Service\BitacoraService;
use Procuracion\Service\CuboCalificacionService;

class DocumentoService {

    public function Save(EntityManager $em, array $datos) {
        $hoy = date('Y-m-d');
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($datos['idexpediente']);
        $usr = $em->getRepository('Procuracion\Entity\Usuario')->find($datos['usuario']);
        $accion = $em->getRepository('Procuracion\Entity\Accion')->find($datos['accion']);
        //actaOrientacion=20;
        if ($datos['accion'] == 20) {//or cualquier otro que sea único...
            $documentoAnt = $em->getRepository('Procuracion\Entity\DocumentoExpediente')->findBy(array('idAccion' => $datos['accion'], 'idExpediente' => $datos['idexpediente']));
            foreach ($documentoAnt as $docAnt) {
                $em->remove($docAnt);
            }
            $documento = new DocumentoExpediente();
            $documento->setIdUsuario($usr);
            $documento->setIdAccion($accion);
            $documento->setIdExpediente($expediente);
            $documento->setUbicacion($datos['ruta']);
            $documento->setfecha(date_create($hoy));
            $documento->setUpdatedBy($usr);
            $documento->setDeleted(0);
            $em->persist($documento);
            $em->flush();
        } else {
            if ($datos['id'] > 0) {//update
                $documento = $em->getRepository('Procuracion\Entity\DocumentoExpediente')->find($datos['id']);
                $documento->setIdUsuario($usr);
                $documento->setIdAccion($accion);
                $documento->setIdExpediente($expediente);
                $documento->setUbicacion($datos['ruta']);
                $documento->setfecha(date_create($hoy));
                $documento->setUpdatedBy($usr);
                $em->flush();
            } else {//insert
                $documento = new DocumentoExpediente();
                $documento->setIdUsuario($usr);
                $documento->setIdAccion($accion);
                $documento->setIdExpediente($expediente);
                $documento->setUbicacion($datos['ruta']);
                $documento->setfecha(date_create($hoy));
                $documento->setUpdatedBy($usr);
                $documento->setDeleted(0);
                $em->persist($documento);
                $em->flush();
            }
        }
    }

    public function getDocumentos(EntityManager $em, $idExpediente) {
        $listado = $em->getRepository('Procuracion\Entity\DocumentoExpediente')->findBy(array('idExpediente' => $idExpediente, 'deleted' => 0));
        return $listado;
    }

    public function borrarDocumento(EntityManager $em, $id) {
        $cual = $em->getRepository('Procuracion\Entity\DocumentoExpediente')->find($id);
        $cual->setDeleted(1);
        $em->flush();
        return $cual;
    }

}
