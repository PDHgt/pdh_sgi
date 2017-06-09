<?php

namespace Procuracion\Service;

use Procuracion\Entity\Etapa;
use Procuracion\Entity\TipoExpediente;
use Procuracion\Entity\CaminoTipo;
use Procuracion\Entity\Expediente;
use Procuracion\Entity\TrabajoExpediente;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;


class CaminoService{
	public function TraerRuta(EntityManager $em, $tipo){//, $calificacion){
		//echo $tipo;
		$camino = $em->getRepository('Procuracion\Entity\CaminoTipo')->findBy(array('idTipoExpediente' => $tipo));
		return $camino;
	}

	public function CrearRutaExpediente(EntityManager $em, Expediente $expediente){
		$ruta = $this->TraerRuta($em, $expediente->getIdTipo());
		foreach ($ruta as $paso) {
			$nvo = new TrabajoExpediente();
			$nvo->setIdEtapa($paso->getIdEtapa());
			$nvo->setIdExpediente($expediente);
			$em->persist($nvo);
			$em->flush();

		}
	}

	public function TerminarEtapa(EntityManager $em, $datos){
		
	}

	public function IniciarEtapa(EntityManager $em, $datos){
		
	}
}
