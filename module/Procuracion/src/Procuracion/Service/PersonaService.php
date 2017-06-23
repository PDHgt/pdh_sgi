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
        if ($parametros['nombres'] != "") {
            $cadena .= "p.nombres like '%" . $parametros['nombres'] . "%'";
            if ($parametros['apellidos'] != "") {
                $cadena .= " AND p.apellidos like '%" . $parametros['apellidos'] . "%'";
                if ($parametros['documento'] != "") {
                    $cadena .= " AND p.numerodocumento like '%" . $parametros['documento'] . "%'";
                }
            } else {
                if ($parametros['documento'] != "") {
                    $cadena .= " AND p.numerodocumento like '%" . $parametros['documento'] . "%'";
                }
            }
        } else {
            if ($parametros['apellidos'] != "") {
                $cadena .= "p.apellidos like '%" . $parametros['apellidos'] . "%'";
                if ($parametros['documento'] != "") {
                    $cadena .= " AND p.numerodocumento like '%" . $parametros['documento'] . "%'";
                }
            } else {
                if ($parametros['documento'] != "") {
                    $cadena .= "p.numerodocumento like '%" . $parametros['documento'] . "%'";
                }
            }
        }
        $cadena .= ")";
        $query = $em->createQuery($cadena);
        $products = $query->getResult();
        //var_dump($products);
        return $products;
    }

    public function savePersona(EntityManager $em, array $nueva, array $extras, $que) {
        //var_dump($nueva);
        $usr = $em->getRepository('Procuracion\Entity\Usuario')->find($nueva['usuario']);
        if ($nueva['id'] > 0) {
            $np = $em->getRepository('\Procuracion\Entity\Persona')->find($nueva['id']);
        } else {
            $np = new Persona();
        }
        $np->setAnonimo($nueva['anonimo']);
        $np->setNombres($nueva['nombres']);
        $np->setApellidos($nueva['apellidos']);
        $np->setTipoDocumento($nueva['tipo']);
        $np->setNumeroDocumento($nueva['numero']);
        $np->setSexo($nueva['sexo']);
        $np->setLgbti($nueva['lgbti']);
        $np->setFechaNacimiento($nueva['fechanac']);
        $np->setUpdatedBy($usr);

        $em->persist($np);
        $em->flush();
        //}
        //var_dump($np);
        if ($que == 1) {
            $emp = $em->getRepository('\Procuracion\Entity\Empleado')->find($extras['empleado']);
            $nvo = new Visita();
            $lasede = $em->getRepository('\Procuracion\Entity\Sede')->find($extras['sede']);
            $nvo->setFechaentrada($extras['fecha']);
            //$nvo->setHoraentrada($extras['hora']);
            $nvo->setSede($lasede);
            $nvo->setEmpleado($emp);
            $nvo->setInstitucion($extras['institucion']);
            $nvo->setTipoInstitucion($extras['tipo']);
            $nvo->setMotivoVisita($extras['motivo']);
            $nvo->setLlamadasRealizadas(0);
            $nvo->setUpdatedBy($usr);
            $nvo->setIdPersona($np);
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
            $lasede = $em->getRepository('\Procuracion\Entity\Sede')->find($extras['sede']);
            $nvo->setFechaentrada($extras['fecha']);
            //$nvo->setHoraentrada($extras['hora']);
            $nvo->setSede($lasede);
            $nvo->setPrioridad($extras['prioridad']);
            $nvo->setTurno($miTurno);
            $nvo->setObservaciones($extras['obs']);
            $nvo->setLapiceroverde($extras['lapiceroverde']);
            $nvo->setUpdatedBy($usr);
            $nvo->setIdpersona($np);
            $cola = new ColaRecepcionService();
            $cola->save($em, $nvo);
        }
        return $np->getId();
    }

    public function updatePersona(EntityManager $em, array $nueva, array $extras, $que) {
        $usr = $em->getRepository('Procuracion\Entity\Usuario')->find($nueva['usuario']);
        $np = $em->getRepository('Procuracion\Entity\Persona')->find($nueva['id']);
        //var_dump($np);
        $np->setNombres($nueva['nombres']);
        $np->setApellidos($nueva['apellidos']);
        $np->setTipoDocumento($nueva['tipo']);
        $np->setNumeroDocumento($nueva['numero']);
        $np->setSexo($nueva['sexo']);
        $np->setLgbti($nueva['lgbti']);
        $np->setFechaNacimiento($nueva['fechanac']);
        $np->setUpdatedBy($usr);
        $em->flush();

        //deleting extras
        $visitaant = $em->getRepository('Procuracion\Entity\Visita')->find($extras['id']);
        if ($visitaant) {
            $llamadas = $visitaant->getLlamadasRealizadas();
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
            $lasede = $em->getRepository('\Procuracion\Entity\Sede')->find($extras['sede']);
            $nvo = new Visita();
            $nvo->setFechaentrada($extras['fecha']);
            $nvo->setHoraentrada($extras['hora']);
            $nvo->setSede($lasede);
            $nvo->setEmpleado($emp);
            $nvo->setInstitucion($extras['institucion']);
            $nvo->setTipoInstitucion($extras['tipo']);
            $nvo->setMotivoVisita($extras['motivo']);
            $nvo->setUpdatedBy($usr);
            $nvo->setLlamadasRealizadas($llamadas);
            $nvo->setIdpersona($np);
            $visita = new VisitaService();
            $visita->save($em, $nvo);
        } else {
            //turno
            if (!empty($suTurno)) {
                $miTurno = $suTurno;
            } else {
                $turnos = new TurnoService();
                $datost = array('sede' => $extras['sede'], 'prioridad' => $extras['prioridad'], 'fecha' => $extras['fecha']);
                $turno = $turnos->initializeToday($em, $datost);
                $miTurno = $turnos->newTicket($em, $turno);
            }
            ////
            $lasede = $em->getRepository('\Procuracion\Entity\Sede')->find($extras['sede']);
            $nvo = new Colarecepcion();
            $nvo->setFechaentrada($extras['fecha']);
            $nvo->setHoraentrada($extras['hora']);
            $nvo->setSede($lasede);
            $nvo->setPrioridad($extras['prioridad']);
            $nvo->setTurno($miTurno);
            $nvo->setObservaciones($extras['obs']);
            $nvo->setLapiceroverde($extras['lapiceroverde']);
            $nvo->setUpdatedBy($usr);
            $nvo->setIdpersona($np);
            $cola = new ColaRecepcionService();
            $cola->save($em, $nvo);
        }
        return $np->getId();
    }

    public function findByDPI(EntityManager $em, $dpi) {
        //$repository = $em->getRepository('Procuracion\Entity\Persona');
        $cadena = "SELECT p FROM Procuracion\Entity\Persona p WHERE p.numerodocumento LIKE '%" . $dpi . "%'"; // like '%".$dpi."%'
        $query = $em->createQuery($cadena); //"SELECT p FROM Procuracion\Entity\Persona p WHERE (p.nombres like '%".$parametros['nombres']."%' OR p.apellidos like '%".$parametros['apellidos']."%' OR p.numerodocumento like '%".$parametros['documento']."%')");
        $products = $query->getResult();
        return $products;
    }

    public function selectByDPI(EntityManager $em, $dpi) {
        //$repository = $em->getRepository('Procuracion\Entity\Persona');
        $cadena = "SELECT p FROM Procuracion\Entity\Persona p WHERE p.numerodocumento = '" . $dpi . "'"; // like '%".$dpi."%'
        $query = $em->createQuery($cadena); //"SELECT p FROM Procuracion\Entity\Persona p WHERE (p.nombres like '%".$parametros['nombres']."%' OR p.apellidos like '%".$parametros['apellidos']."%' OR p.numerodocumento like '%".$parametros['documento']."%')");
        $products = $query->getResult();
        return $products;
    }

    public function listOne(EntityManager $em, $id) {
        $persona = $em->getRepository('\Procuracion\Entity\Persona')->find($id);
        //return new JsonModel($visita);
        return $persona;
    }

    public function puedeModificarPersona(EntityManager $em, array $datos) {
        if (isset($datos["id"])) {
            $usr = $em->getRepository('Procuracion\Entity\Usuario')->find($datos['usuario']);
            $np = $em->getRepository('Procuracion\Entity\Persona')->find($datos['id']);
            //var_dump($np);
            $np->setNombres($datos['nombres']);
            $np->setApellidos($datos['apellidos']);
            $np->setTipoDocumento($datos['tipo']);
            $np->setNumeroDocumento($datos['numero']);
            $np->setSexo($datos['sexo']);
            $np->setLgbti($datos['lgbti']);
            $np->setFechaNacimiento($datos['fechanac']);
            $np->setUpdatedBy($usr);
            $em->flush();
        } else {
            //no cambia nada
        }
    }

}
