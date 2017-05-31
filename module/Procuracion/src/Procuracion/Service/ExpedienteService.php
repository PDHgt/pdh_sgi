<?php

namespace Procuracion\Service;

use Procuracion\Entity\Expediente;
use Procuracion\Entity\ExpedientePersona;
use Procuracion\Entity\ExpedienteHechoDerecho;
use Procuracion\Entity\Departamento;
use Procuracion\Entity\Municipio;
use Procuracion\Entity\Sede;
use Procuracion\Entity\TipoExpediente;
use Procuracion\Entity\TrabajoExpediente;
use Procuracion\Entity\ColaRecepcion;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;

use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\PersonaService;
use Procuracion\Service\CuboCalificacionService;

class ExpedienteService {
	public function save(EntityManager $em, array $datos, $calificacion){
		
	}
}
