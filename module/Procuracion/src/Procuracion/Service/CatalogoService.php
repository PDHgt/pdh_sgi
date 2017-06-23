<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\CatalogoDatos;
use Procuracion\Entity\DetalleCatalogo;
use Doctrine\ORM\EntityManager as EntityManager;

class CatalogoService {

    public function obtenerDato(EntityManager $em, $dato, $nombrecatalogo) {
        //echo "entre";
        $catalogo = $em->getRepository('Procuracion\Entity\CatalogoDatos')->findBy(array('catalogo' => $nombrecatalogo));
        $dato = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->findBy(array('idCatalogo' => $catalogo, 'valor' => $dato));
        return $dato;
    }

}
