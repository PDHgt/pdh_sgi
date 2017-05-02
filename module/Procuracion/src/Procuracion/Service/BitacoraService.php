<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\Usuario;
use Procuracion\Entity\Bitacora;
use Doctrine\ORM\EntityManager as EntityManager;


class BitacoraService{

	public function save(EntityManager $em, Usuario $nvo, $accion){
		$hoy = date("Y-m-d H:i:s");
        $bita = new Bitacora();
        $bita->setFechahora(date_create($hoy));
        $bita->setUsuario($nvo);
        $bita->setAccion($accion);
        $em->persist($bita);
        $em->flush();

		return $bita->getId();
	}

}