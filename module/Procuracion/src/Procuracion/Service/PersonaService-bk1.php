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
            $usr = $em->getRepository('\Procuracion\Entity\Usuario')->find($datos['usuario']);
            $np = $em->getRepository('\Procuracion\Entity\Persona')->find($datos['idpersona']);
            $depto = $em->getRepository('Procuracion\Entity\Departamento')->findByCodigo($datos['departamento']);
            $muni = $em->getRepository('Procuracion\Entity\Municipio')->findByCodigo($datos['municipio']);
            $np->setNombres($datos['nombres']);
            $np->setApellidos($datos['apellidos']);
            $np->setTipoDocumento($datos['tipo']);
            $np->setNumeroDocumento($datos['numero']);
            $np->setSexo($datos['sexo']);
            $np->setLgbti($datos['lgbti']);
            $np->setFechaNacimiento($datos['fechanac']);
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
        //verificar que vengan datos...
        if ($datos['victima_depto'])
            $victima_depto = $datos['victima_depto'];
        else
            $victima_depto = 99;
        if ($datos['victima_muni'])
            $victima_muni = $datos['victima_muni'];
        else
            $victima_muni = 9999;
        if ($datos['victima_relacion'])
            $victima_relacion = $datos['victima_relacion'];
        else
            $victima_relacion = 528;
        if ($datos['victima_comunidad'])
            $victima_comunidad = $datos['victima_comunidad'];
        else
            $victima_comunidad = 573;
        if ($datos['victima_pertenencia'])
            $victima_pertenencia = $datos['victima_pertenencia'];
        else
            $victima_pertenencia = 59;
        if ($datos['victima_nacionalidad'])
            $victima_nacionalidad = $datos['victima_nacionalidad'];
        else
            $victima_nacionalidad = 68;
        if ($datos['victima_nombres'])
            $victima_nombres = $datos['victima_nombres'];
        else
            $victima_nombres = "";
        if ($datos['victima_apellidos'])
            $victima_apellidos = $datos['victima_apellidos'];
        else
            $victima_apellidos = "";
        if ($datos['victima_tipodoc'])
            $victima_tipodoc = $datos['victima_tipodoc'];
        else
            $victima_tipodoc = "";
        if ($datos['victima_numdoc'])
            $victima_numdoc = $datos['victima_numdoc'];
        else
            $victima_numdoc = "";
        if ($datos['victima_sexo'])
            $victima_sexo = $datos['victima_sexo'];
        else
            $victima_sexo = 9;
        if ($datos['victima_lgbti'])
            $victima_lgbti = $datos['victima_lgbti'];
        else
            $victima_lgbti = "H";
        if ($datos['victima_nombreusual'])
            $victima_nombreusual = $datos['victima_nombreusual'];
        else
            $victima_nombreusual = "";
        if ($datos['victima_fechanac'])
            $victima_fechanac = $datos['victima_fechanac'];
        else
            $victima_fechanac = NULL;
        if ($datos['victima_edad'])
            $victima_edad = $datos['victima_edad'];
        else
            $victima_edad = 999;
        if ($datos['victima_nombrecolectivo'])
            $victima_nombrecolectivo = $datos['victima_nombrecolectivo'];
        else
            $victima_nombrecolectivo = "";
        if ($datos['victima_contacto'])
            $victima_contacto = $datos['victima_contacto'];
        else
            $victima_contacto = "";
        if ($datos['victima_direccion'])
            $victima_direccion = $datos['victima_direccion'];
        else
            $victima_direccion = "";
        if ($datos['victima_telefono'])
            $victima_telefono = $datos['victima_telefono'];
        else
            $victima_telefono = "";
        if ($datos['victima_correo'])
            $victima_correo = $datos['victima_correo'];
        else
            $victima_correo = "";


        $departamento = $em->getRepository('Procuracion\Entity\Departamento')->findByCodigo($victima_depto);
        //var_dump($departamento); exit(1);
        $municipio = $em->getRepository('Procuracion\Entity\Municipio')->findByCodigo($victima_muni);
        $usuario = $em->getRepository('Procuracion\Entity\Usuario')->find($usr);
        $relacionagresor = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($victima_relacion);
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($idexpediente);
        if ($datos['victima_tipo'] <> 1) {
            $comunidad = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($victima_comunidad);
            $pueblopertenencia = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($victima_pertenencia);
            $nacionalidad = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($victima_nacionalidad);
        }



        if ($datos['idpersona'] > 0) {
            $persona = $em->getRepository('Procuracion\Entity\Persona')->find($datos['idpersona']);
        } else {
            $persona = new Persona();
        }
        if ($datos['victima_tipo'] <> 1) {//es individual
            $persona->setNombres($victima_nombres);
            $persona->setApellidos($victima_apellidos);
            $persona->setTipoDocumento($victima_tipodoc);
            $persona->setNumeroDocumento($victima_numdoc);
            $persona->setSexo($victima_sexo);
            $persona->setLgbti($victima_lgbti);
            $persona->setNombreUsual($victima_nombreusual);
            $persona->setFechaNacimiento($victima_fechanac);
            $persona->setEdad($victima_edad);
        } else {//colectiva
            $persona->setNombreColectivo($victima_nombrecolectivo);
            $persona->setNombreContacto($victima_contacto);
        }
        $persona->setTipo($datos['victima_tipo']);
        $persona->setDireccion($victima_direccion);
        $persona->setDepto($departamento[0]);
        $persona->setMuni($municipio[0]);
        $persona->setTelefono($victima_telefono);
        $persona->setCorreoElectronico($victima_correo);
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
        $expPer = new ExpedientePersona();
        $catalogoservice = new CatalogoService();
        $tipopersona = $catalogoservice->obtenerDato($em, "Víctima", 'TipoPersona');
        $expPer->setTipo($tipopersona[0]);
        $expPer->setRelacionagresor($relacionagresor);
        $expPer->setIdPersona($persona);
        $expPer->setIdExpediente($expediente);
        $em->persist($expPer);

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
        //verificar que vengan datos...
        if ($datos['denunciado_depto'])
            $denunciado_depto = $datos['denunciado_depto'];
        else
            $denunciado_depto = 99;
        if ($datos['denunciado_muni'])
            $denunciado_muni = $datos['denunciado_muni'];
        else
            $denunciado_muni = 9999;
        if ($datos['denunciado_relacion'])
            $denunciado_relacion = $datos['denunciado_relacion'];
        else
            $denunciado_relacion = 528;
        if ($datos['denunciado_comunidad'])
            $denunciado_comunidad = $datos['denunciado_comunidad'];
        else
            $denunciado_comunidad = 573;
        if ($datos['denunciado_pertenencia'])
            $denunciado_pertenencia = $datos['denunciado_pertenencia'];
        else
            $denunciado_pertenencia = 59;
        if ($datos['denunciado_nacionalidad'])
            $denunciado_nacionalidad = $datos['denunciado_nacionalidad'];
        else
            $denunciado_nacionalidad = 68;
        if ($datos['denunciado_nombres'])
            $denunciado_nombres = $datos['denunciado_nombres'];
        else
            $denunciado_nombres = "";
        if ($datos['denunciado_apellidos'])
            $denunciado_apellidos = $datos['denunciado_apellidos'];
        else
            $denunciado_apellidos = "";
        if ($datos['denunciado_tipodoc'])
            $denunciado_tipodoc = $datos['denunciado_tipodoc'];
        else
            $denunciado_tipodoc = "";
        if ($datos['denunciado_numdoc'])
            $denunciado_numdoc = $datos['denunciado_numdoc'];
        else
            $denunciado_numdoc = "";
        if ($datos['denunciado_sexo'])
            $denunciado_sexo = $datos['denunciado_sexo'];
        else
            $denunciado_sexo = 9;
        if ($datos['denunciado_lgbti'])
            $denunciado_lgbti = $datos['denunciado_lgbti'];
        else
            $denunciado_lgbti = "H";
        if ($datos['denunciado_nombreusual'])
            $denunciado_nombreusual = $datos['denunciado_nombreusual'];
        else
            $denunciado_nombreusual = "";
        if ($datos['denunciado_fechanac'])
            $denunciado_fechanac = $datos['denunciado_fechanac'];
        else
            $denunciado_fechanac = NULL;
        if ($datos['denunciado_edad'])
            $denunciado_edad = $datos['denunciado_edad'];
        else
            $denunciado_edad = 999;
        if ($datos['denunciado_nombrecolectivo'])
            $denunciado_nombrecolectivo = $datos['denunciado_nombrecolectivo'];
        else
            $denunciado_nombrecolectivo = "";
        if ($datos['denunciado_contacto'])
            $denunciado_contacto = $datos['denunciado_contacto'];
        else
            $denunciado_contacto = "";
        if ($datos['denunciado_direccion'])
            $denunciado_direccion = $datos['denunciado_direccion'];
        else
            $denunciado_direccion = "";
        if ($datos['denunciado_telefono'])
            $denunciado_telefono = $datos['denunciado_telefono'];
        else
            $denunciado_telefono = "";
        if ($datos['denunciado_cargo'])
            $denunciado_cargo = $datos['denunciado_cargo'];
        else
            $denunciado_cargo = "";
        if ($datos['denunciado_institucion'])
            $denunciado_institucion = $datos['denunciado_institucion'];
        else
            $denunciado_institucion = "";

        $departamento = $em->getRepository('Procuracion\Entity\Departamento')->findByCodigo($denunciado_depto);
        //var_dump($departamento); exit(1);
        $municipio = $em->getRepository('Procuracion\Entity\Municipio')->findByCodigo($denunciado_muni);
        $usuario = $em->getRepository('Procuracion\Entity\Usuario')->find($usr);
        $relacionagresor = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($denunciado_relacion);
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($idexpediente);
        if ($datos['denunciado_tipo'] <> 1) {
            $comunidad = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($denunciado_comunidad);
            $pueblopertenencia = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($denunciado_pertenencia);
            $nacionalidad = $em->getRepository('Procuracion\Entity\DetalleCatalogo')->find($denunciado_nacionalidad);
        }



        if ($datos['idpersona'] > 0) {
            $persona = $em->getRepository('Procuracion\Entity\Persona')->find($datos['idpersona']);
        } else {
            $persona = new Persona();
        }
        if ($datos['denunciado_tipo'] <> 1) {//es individual
            $persona->setNombres($denunciado_nombres);
            $persona->setApellidos($denunciado_apellidos);
            $persona->setTipoDocumento($denunciado_tipodoc);
            $persona->setNumeroDocumento($denunciado_numdoc);
            $persona->setSexo($denunciado_sexo);
            $persona->setLgbti($denunciado_lgbti);
            $persona->setNombreUsual($denunciado_nombreusual);
            $persona->setFechaNacimiento($denunciado_fechanac);
            $persona->setEdad($denunciado_edad);
        } else {//colectiva
            $persona->setNombreColectivo($denunciado_nombrecolectivo);
            $persona->setNombreContacto($denunciado_contacto);
        }
        $persona->setTipo($datos['denunciado_tipo']);
        $persona->setDireccion($denunciado_direccion);
        $persona->setDepto($departamento[0]);
        $persona->setMuni($municipio[0]);
        $persona->setTelefono($denunciado_telefono);
        $persona->setCorreoElectronico($denunciado_correo);
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
        $detalle->setCargo($denunciado_cargo);
        $detalle->setInstitucion($denunciado_institucion);
        $em->persist($detalle);

        //guardar relacion persona-expediente
        $expPer = new ExpedientePersona();
        $catalogoservice = new CatalogoService();
        $tipopersona = $catalogoservice->obtenerDato($em, "Denunciado", 'TipoPersona');
        $expPer->setTipo($tipopersona[0]);
        $expPer->setRelacionagresor($relacionagresor);
        $expPer->setIdPersona($persona);
        $expPer->setIdExpediente($expediente);
        $em->persist($expPer);

        $em->flush();
    }

    public function devolverPersonas(EntityManager $em, $que, $idexpediente) {
        $catalogoservice = new CatalogoService();
        $tipopersona = $catalogoservice->obtenerDato($em, $que, 'TipoPersona');
        $listado = $em->getRepository('Procuracion\Entity\ExpedientePersona')->findBy(array('idExpediente' => $idexpediente, 'tipo' => $tipopersona[0]));
        return $listado;
    }

}
