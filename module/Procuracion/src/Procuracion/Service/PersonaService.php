<?php

namespace Procuracion\Service;

use Procuracion\Service\TurnoService;
use Doctrine\ORM\EntityRepository;
use Procuracion\Service\ColaRecepcionService;
use Procuracion\Service\VisistaService;
use Procuracion\Entity\Persona;
use Procuracion\Entity\DetallePersona;
use Procuracion\Entity\ExpedientePersona;
use Procuracion\Entity\ColaRecepcion;
use Procuracion\Entity\Visita;
use Procuracion\Entity\Departamento;
use Procuracion\Entity\Municipio;
use Procuracion\Entity\PersonaVulnerable;
use Doctrine\ORM\EntityManager as EntityManager;

class PersonaService {

    public function devolverPersonas(EntityManager $em, $que, $idexpediente) {
        $catalogoservice = new CatalogoService();
        $tipopersona = $catalogoservice->obtenerDato($em, $que, 'TipoPersona');
        $listado = $em->getRepository('Procuracion\Entity\ExpedientePersona')->findBy(array('idExpediente' => $idexpediente, 'tipo' => $tipopersona[0]));
        return $listado;
    }

    public function yaExisteRelacion(EntityManager $em, $que, $idexpediente, $idpersona) {
        $catalogoservice = new CatalogoService();
        $tipopersona = $catalogoservice->obtenerDato($em, $que, 'TipoPersona');
        $listado = $em->getRepository('Procuracion\Entity\ExpedientePersona')->findBy(array('idExpediente' => $idexpediente, 'tipo' => $tipopersona[0], 'idPersona' => $idpersona));
        return $listado;
    }

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
        $usr = $em->getRepository('Procuracion\Entity\Usuario')->find($nueva['usuario']);
        $lasede = $em->getRepository('\Procuracion\Entity\Sede')->find($extras['sede']);
        if ($nueva['id'] > 0) {//ya existe la persona
            $np = $em->getRepository('Procuracion\Entity\Persona')->find($nueva['id']);
        } else {//es nueva
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
        $np->setEdad($nueva['edad']);
        $np->setUpdatedBy($usr);

        $em->persist($np);
        $em->flush();

        //extras
        //deleting extras
        $llamadas = 0;

        if ($extras['id'] > 0) {
            $visitaant = $em->getRepository('Procuracion\Entity\Visita')->find($extras['id']);
            if ($visitaant) {
                $llamadas = $visitaant->getLlamadasRealizadas();
                $em->remove($visitaant);
                $em->flush();
            }

            $colaant = $em->getRepository('Procuracion\Entity\ColaRecepcion')->find($extras['id']);
            if ($colaant) {
                $suTurno = $colaant->getTurno();
                $em->remove($colaant);
                $em->flush();
            }
        }
        //inserting extras
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
            $nvo->setLlamadasRealizadas($llamadas);
            $nvo->setUpdatedBy($usr);
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
            $nvo = new ColaRecepcion();
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
        return $np;
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
        if ($datos["idpersona"] > 0) {
            $usr = $em->getRepository('Procuracion\Entity\Usuario')->find($datos['usuario']);
            $np = $em->getRepository('Procuracion\Entity\Persona')->find($datos['idp']);
            //departamento
            $depto = $em->getRepository('Procuracion\Entity\Departamento')->findByCodigo($datos['departamento']);
            //municipio
            $muni = $em->getRepository('Procuracion\Entity\Municipio')->findByCodigo($datos['municipio']);
            //var_dump($np);
            $np->setNombres($datos['nombres']);
            $np->setApellidos($datos['apellidos']);
            $np->setTipoDocumento($datos['tipo']);
            $np->setNumeroDocumento($datos['numero']);
            $np->setSexo($datos['sexo']);
            $np->setLgbti($datos['lgbti']);
            $np->setFechaNacimiento($datos['fechanac']);
            $np->setEdad($datos['edad']);
            $np->setTelefono($datos['telefono']);
            $np->setCorreoElectronico($datos['correo']);
            $np->setDireccion($datos['direccion']);
            $np->setDepto($depto[0]);
            $np->setMuni($muni[0]);
            $np->setUpdatedBy($usr);
            $em->flush();
        } else {
            //no cambia nada
        }
    }

    public function ingresarVictima(EntityManager $em, $usr, $datos, $idexpediente) {

        $departamento = $em->getRepository('Procuracion\Entity\Departamento')->findByCodigo($datos['victima_depto']);
        $municipio = $em->getRepository('Procuracion\Entity\Municipio')->findByCodigo($datos['victima_muni']);
        $usuario = $em->getRepository('Procuracion\Entity\Usuario')->find($usr);
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($idexpediente);
        if ($datos['victima_tipo'] <> 1) {
            $comunidad = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['victima_comunidad']);
            $pueblopertenencia = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['victima_pertenencia']);
            $nacionalidad = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['victima_nacionalidad']);
            $relacionvictima = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['victima_relacion']);
        }

        if ($datos['idpersona'] > 0) {
            $persona = $em->getRepository('Procuracion\Entity\Persona')->find($datos['idpersona']);
        } else {
            $persona = new Persona();
        }


        if ($datos['victima_tipo'] <> 1) {//es individual
            if (empty($datos["victima_fechanac"])) {
                $fechanac = NULL;
            } else {
                $fechanac = date_create_from_format('d/m/Y', $datos["victima_fechanac"]);
            }
            $persona->setNombres($datos['victima_nombres']);
            $persona->setApellidos($datos['victima_apellidos']);
            $persona->setTipoDocumento($datos['victima_tipodoc']);
            $persona->setNumeroDocumento($datos['victima_numdoc']);
            $persona->setSexo($datos['victima_sexo']);
            $persona->setLgbti($datos['victima_lgbti']);
            $persona->setNombreUsual($datos['victima_nombreusual']);
            $persona->setFechaNacimiento($fechanac);
            $persona->setEdad($datos['victima_edad']);
        } else {//colectiva
            $persona->setNombreColectivo($datos['victima_nombrecolectivo']);
            $persona->setNombreContacto($datos['victima_contacto']);
        }
        //var_dump($departamento[0]);;
        //var_dump($municipio[0]);
        $persona->setTipo($datos['victima_tipo']);
        $persona->setDireccion($datos['victima_direccion']);
        $persona->setDepto($departamento[0]);
        $persona->setMuni($municipio[0]);
        $persona->setTelefono($datos['victima_telefono']);
        $persona->setCorreoElectronico($datos['victima_correo']);
        $persona->setUpdatedBy($usuario);
        $em->persist($persona);
        //$em->flush();
        //guardar los complementos...
        if ($datos['victima_tipo'] <> 1) {
            $detalle = new DetallePersona();
            $detalle->setIdPersona($persona);
            $detalle->setComunidadlinguistica($comunidad);
            $detalle->setPueblopertenencia($pueblopertenencia);
            $detalle->setNacionalidad($nacionalidad);
            $em->persist($detalle);
        }
        //guardar relacion persona-expediente
        if (count($this->yaExisteRelacion($em, "Victima", $idexpediente, $persona->getId())) > 0) {

        } else {
            $expPer = new ExpedientePersona();
            $catalogoservice = new CatalogoService();
            $tipopersona = $catalogoservice->obtenerDato($em, "Víctima", 'TipoPersona');
            $expPer->setTipo($tipopersona[0]);
            $expPer->setRelacionvictima($relacionvictima);
            $expPer->setIdPersona($persona);
            $expPer->setIdExpediente($expediente);
            $em->persist($expPer);
        }
        //grupo vulnerable
        if (count($datos['victima_grupovulnerable']) > 0) {
            for ($i = 0; $i < (count($datos['victima_grupovulnerable'])); $i++) {
                $grupovulnerable = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['victima_grupovulnerable'][$i]);
                $grupoPer = new PersonaVulnerable();
                $grupoPer->setGrupoVulnerable($grupovulnerable);
                $grupoPer->setIdPersona($persona);
                $em->persist($grupoPer);
            }
        }
        $em->flush();
    }

    public function ingresarDenunciado(EntityManager $em, $usr, $datos, $idexpediente) {

        $departamento = $em->getRepository('Procuracion\Entity\Departamento')->findByCodigo($datos['denunciado_depto']);
        $municipio = $em->getRepository('Procuracion\Entity\Municipio')->findByCodigo($datos['denunciado_muni']);
        $usuario = $em->getRepository('Procuracion\Entity\Usuario')->find($usr);
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($idexpediente);
        if ($datos['denunciado_tipo'] <> 1) {
            $comunidad = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['denunciado_comunidad']);
            $pueblopertenencia = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['denunciado_pertenencia']);
            $nacionalidad = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['denunciado_nacionalidad']);
            $relacionagresor = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($datos['denunciado_relacion']);
        }

        if ($datos['idpersona'] > 0) {
            $persona = $em->getRepository('Procuracion\Entity\Persona')->find($datos['idpersona']);
        } else {
            $persona = new Persona();
        }
        if ($datos['denunciado_tipo'] <> 1) {//es individual
            if (empty($datos["victima_fechanac"])) {
                $fechanac = NULL;
            } else {
                $fechanac = date_create_from_format('d/m/Y', $datos["victima_fechanac"]);
            }
            $persona->setNombres($datos['denunciado_nombres']);
            $persona->setApellidos($datos['denunciado_apellidos']);
            $persona->setTipoDocumento($datos['denunciado_tipodoc']);
            $persona->setNumeroDocumento($datos['denunciado_numdoc']);
            $persona->setSexo($datos['denunciado_sexo']);
            $persona->setLgbti($datos['denunciado_lgbti']);
            $persona->setNombreUsual($datos['denunciado_nombreusual']);
            $persona->setFechaNacimiento($fechanac);
            $persona->setEdad($datos['denunciado_edad']);
        } else {//colectiva
            $persona->setNombreColectivo($datos['denunciado_nombrecolectivo']);
            $persona->setNombreContacto($datos['denunciado_contacto']);
        }

        $persona->setTipo($datos['denunciado_tipo']);
        $persona->setDireccion($datos['denunciado_direccion']);
        $persona->setDepto($departamento[0]);
        $persona->setMuni($municipio[0]);
        $persona->setTelefono($datos['denunciado_telefono']);
        $persona->setCorreoElectronico($datos['denunciado_correo']);
        $persona->setUpdatedBy($usuario);
        $em->persist($persona);
        //$em->flush();
        //guardar los complementos...
        $detalle = new DetallePersona();
        $detalle->setIdPersona($persona);
        if ($datos['denunciado_tipo'] <> 1) {
            $detalle->setComunidadlinguistica($comunidad);
            $detalle->setPueblopertenencia($pueblopertenencia);
            $detalle->setNacionalidad($nacionalidad);
        }
        $detalle->setCargo($datos['denunciado_cargo']);
        $detalle->setInstitucion($datos['denunciado_institucion']);
        $em->persist($detalle);

        //guardar relacion persona-expediente
        if (count($this->yaExisteRelacion($em, "Denunciado", $idexpediente, $persona->getId())) > 0) {

        } else {
            $expPer = new ExpedientePersona();
            $catalogoservice = new CatalogoService();
            $tipopersona = $catalogoservice->obtenerDato($em, "Denunciado", 'TipoPersona');
            $expPer->setTipo($tipopersona[0]);
            $expPer->setRelacionagresor($relacionagresor);
            $expPer->setIdPersona($persona);
            $expPer->setIdExpediente($expediente);
            $em->persist($expPer);
        }

        $em->flush();
    }

}
