<?php

namespace Procuracion\Service;

use Procuracion\Entity\Departamento;
use Procuracion\Entity\Municipio;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;



class GeografiaService{
	public function ListarDeptos(EntityManager $em){
		$listado = $em->getRepository('Procuracion\Entity\Departamento')->findAll();
		return $listado;
	}

	public function ListarMunis(EntityManager $em, $dep){
		$depto = $em->getRepository('Procuracion\Entity\Departamento')->find($dep);//si es con el id
		//$depto = $em->getRepository('Procuracion\Entity\Departamento')->findByNombre($dep);//si es con nombre

		$listado = $em->getRepository('Procuracion\Entity\Municipio')->findByIdDepartamento($dep);
		return $listado;		
	}
}
