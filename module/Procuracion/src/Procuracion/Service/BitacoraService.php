<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\Usuario;
use Procuracion\Entity\Bitacora;
use Doctrine\ORM\EntityManager as EntityManager;


class BitacoraService{
	public function Movimiento(EntityManager $em, $datos){
		//echo "entre";
		$usuario = $em->getRepository('Procuracion\Entity\Usuario')->find($datos['usuario']);
		$registro = new Bitacora();
		$hoy = new \DateTime("now");
		$registro->setFechahora($hoy);
		$registro->setUsuario($usuario);
		$registro->setAccion($datos['accion']);
		$em->persist($registro);
		$em->flush();
	}

}