<?php

namespace Procuracion\Service;

use Procuracion\Service\TurnoService;
use Doctrine\ORM\EntityRepository;
use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\VisistaService;
use Procuracion\Entity\Persona;
use Procuracion\Entity\Colarecepcion;
use Procuracion\Entity\Visita;
use Doctrine\ORM\EntityManager as EntityManager;

class PersonaService {

    public function searchPersona(EntityManager $em, array $parametros) {
        $repository = $em->getRepository('Procuracion\Entity\Persona');
        $cadena = "SELECT p FROM Procuracion\Entity\Persona p WHERE (";
        if ($parametros['nombres'] != "")
            $cadena .= "p.nombres like '%" . $parametros['nombres'] . "%'";
        if ($parametros['apellidos'] != "")
            $cadena .= " AND p.apellidos like '%" . $parametros['apellidos'] . "%'";
        if ($parametros['documento'] != "")
            $cadena .= " AND p.numerodocumento like '%" . $parametros['documento'] . "%'";
        $cadena .= ")";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        //var_dump($products);
        return $products;
    }

    public function savePersona(EntityManager $em, array $nueva, array $extras, $que) {
        $np = new Persona();
        $np->setNombres($nueva['nombres']);
        $np->setApellidos($nueva['apellidos']);
        $np->setTipoDocumento($nueva['tipo']);
        $np->setNumeroDocumento($nueva['numero']);
        $np->setSexo($nueva['sexo']);
        $np->setLgbti($nueva['lgbti']);
        $np->setFechaNacimiento($nueva['nac']);
        $em->persist($np);
        $em->flush();

        if ($que == 1) {
            $emp = $em->getRepository('\Procuracion\Entity\Empleado')->find($extras['empleado']);
            $nvo = new Visita();
            $nvo->setFechaentrada($extras['fecha']);
            $nvo->setHoraentrada($extras['hora']);
            $nvo->setSede($extras['sede']);
            $nvo->setEmpleado($emp);
            $nvo->setInstitucion($extras['institucion']);
            $nvo->setTipoInstitucion($extras['tipo']);
            $nvo->setMotivoVisita($extras['motivo']);
            $nvo->setIdpersona($np);
            $visita = new VisitaService();
            $visita->save($em, $nvo);
        } else {
            //turno
            $turnos = new TurnoService();
            $datost = array('sede' => $extras['sede'], 'prioridad' => $extras['prioridad'], 'fecha' => $extras['fecha']);
            $turno = $turnos->initializeToday($em, $datost);
            $miTurno = $turnos->newTicket($em, $turno);
            ////
            $nvo = new Colarecepcion();
            $nvo->setFechaentrada($extras['fecha']);
            $nvo->setHoraentrada($extras['hora']);
            $nvo->setSede($extras['sede']);
            $nvo->setPrioridad($extras['prioridad']);
            $nvo->setTurno($miTurno);
            $nvo->setObservaciones($extras['obs']);
            $nvo->setLapiceroverde($extras['lapiceroverde']);
            $nvo->setIdpersona($np);
            $cola = new ColaRecepcionService();
            $cola->save($em, $nvo);
        }
        return $np->getId();
    }

    public function updatePersona(EntityManager $em, array $nueva, array $extras, $que) {
        $np = $em->getRepository('Procuracion\Entity\Persona')->find($nueva['id']);
        var_dump($np);
        $np->setNombres($nueva['nombres']);
        $np->setApellidos($nueva['apellidos']);
        $np->setTipoDocumento($nueva['tipo']);
        $np->setNumeroDocumento($nueva['numero']);
        $np->setSexo($nueva['sexo']);
        $np->setLgbti($nueva['lgbti']);
        $np->setFechaNacimiento($nueva['nac']);
        $em->flush();

        //deleting extras
        $visitaant = $em->getRepository('Procuracion\Entity\Visita')->find($extras['id']);
        if ($visitaant) {
            $em->remove($visitaant);
            $em->flush();
        }

        $colaant = $em->getRepository('Procuracion\Entity\Colarecepcion')->find($extras['id']);
        if ($colaant) {
            $suTurno = $colaant->getTurno();
            $em->remove($colaant);
            $em->flush();
        }

        if ($que == 1) {
            $emp = $em->getRepository('\Procuracion\Entity\Empleado')->find($extras['empleado']);
            $nvo = new Visita();
            $nvo->setFechaentrada($extras['fecha']);
            $nvo->setHoraentrada($extras['hora']);
            $nvo->setSede($extras['sede']);
            $nvo->setEmpleado($emp);
            $nvo->setInstitucion($extras['institucion']);
            $nvo->setTipoInstitucion($extras['tipo']);
            $nvo->setMotivoVisita($extras['motivo']);
            $nvo->setIdpersona($np);
            $visita = new VisitaService();
            $visita->save($em, $nvo);
        } else {
            //turno
            if ($suTurno != "") {
                $miTurno = $suTurno;
            } else {
                $turnos = new TurnoService();
                $datost = array('sede' => $extras['sede'], 'prioridad' => $extras['prioridad'], 'fecha' => date_create($extras['fecha']));
                $turno = $turnos->initializeToday($em, $datost);
                $miTurno = $turnos->newTicket($em, $turno);
            }
            ////
            $nvo = new Colarecepcion();
            $nvo->setFechaentrada($extras['fecha']);
            $nvo->setHoraentrada($extras['hora']);
            $nvo->setSede($extras['sede']);
            $nvo->setPrioridad($extras['prioridad']);
            $nvo->setTurno($miTurno);
            $nvo->setObservaciones($extras['obs']);
            $nvo->setLapiceroverde($extras['lapiceroverde']);
            $nvo->setIdpersona($np);
            $cola = new ColaRecepcionService();
            $cola->save($em, $nvo);
        }
        return $np->getId();
    }

    public function findByDPI(EntityManager $em, string $dpi) {
        $repository = $em->getRepository('Procuracion\Entity\Persona');
        $cadena = "SELECT p FROM Procuracion\Entity\Persona p WHERE p.documento = '" . $dpi . "'"; // like '%".$dpi."%'
        $query = $em->createQuery($cadena); //"SELECT p FROM Procuracion\Entity\Persona p WHERE (p.nombres like '%".$parametros['nombres']."%' OR p.apellidos like '%".$parametros['apellidos']."%' OR p.numerodocumento like '%".$parametros['documento']."%')");
        $products = $query->getResult();
        return $products;
    }

}
