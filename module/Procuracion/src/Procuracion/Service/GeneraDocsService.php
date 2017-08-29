<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager as EntityManager;
use Procuracion\Entity\Expediente;
use Procuracion\Entity\DocumentoExpediente;
use Procuracion\Entity\ExpedientePersona;
use Procuracion\Entity\Persona;
use Procuracion\Entity\ExpedienteHechoDerecho;
use Procuracion\Entity\HehoDerecho;
use Procuracion\Entity\Orientacion;
use Procuracion\Entity\Remision;
use Procuracion\Entity\Municipio;
use Procuracion\Entity\Departamento;
use Procuracion\Entity\Usuario;
use Procuracion\Service\BitacoraService;
use Procuracion\Service\DocumentoService;

class GeneraDocsService {

    public function GenerarInvestigacion(EntityManager $em, $idExpediente, $idUsuario, $nombre) {
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($idExpediente);
        $personas = new PersonaService();
        $victimas = $personas->devolverPersonas($em, "Victima", $idExpediente);
        $denunciados = $personas->devolverPersonas($em, "Denunciado", $idExpediente);
        $solicitante = $personas->devolverPersonas($em, "Solicitante", $idExpediente);
        //var_dump($solicitante); exit(1);

        $usuario = $em->getRepository('Procuracion\Entity\Usuario')->find($idUsuario);

        $hoy = date("d-m-Y");
        $hora = date("H:i");
        if (($solicitante[0]->getIdPersona()->getFechanacimiento()) == NULL) {
            $solicitante_fechanac = NULL;
        } else {
            $solicitante_fechanac = $solicitante[0]->getIdPersona()->getFechanacimiento()->format("d-m-Y");
        }

        if (($expediente->getFechahechos()) == NULL) {
            $fechahechos = $expediente->getFechahechos();
        } else {
            $fechahechos = $expediente->getFechahechos()->format("d-m-Y");
        }

        $text = "<html>
                    <head>
                        <meta charset='utf-8'>
                        <title>Acta de Investigaci&oacute;n</title>
                        <style>
                            encabezado {
                                font-family: Helvetica;
                                font-size: 16pt;
                                font-weight: bold;
                            }
                            encabezadoDos {
                                font-family: Helvetica;
                                font-size: 11pt;
                                font-weight: bold;
                            }
                            cuerpoNegrita {
                                font-family: Helvetica;
                                font-size: 12pt;
                                font-weight: bold;
                            }
                            cuerpoNormal {
                                font-family: Helvetica;
                                font-size: 12pt;
                            }
                            .tituloNormal {
                                font-family: Helvetica;
                                font-size: 14pt;
                            }
                            tituloNegrita {
                                font-family: Helvetica;
                                font-size: 14pt;
                                font-weight: bold;
                            }
                        </style>
                    </head>
                    <body>";
        $text .= "<table width=\"100%\" align=\"center\">
                    <tr>
                        <td width=\"13%\"><img src=\"" . BASE_PATH . "/public/img/logo.jpg\" width=\"167\" height=\"83\" align=\"left\"></td>
                        <td width=\"87%\">
                            <table width=\"100%\" align=\"center\">
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr align=\"center\">
                                    <td align=\"center\"><encabezado>PROCURADOR DE LOS DERECHOS HUMANOS</encabezado></td>
                                </tr>
                                <tr>
                                    <td align=\"center\"><encabezadoDos>12 Avenida 12-54 Zona 1 Guatemala, C.A. - PBX. 24241717 - Emergencias 1555</encabezadoDos></td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"><hr></td>
                    </tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr>
                        <td colspan=\"2\" align=\"center\"><tituloNegrita>EXPEDIENTE " . $expediente->getNumero() . "</tituloNegrita></td>
                    </tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr><td colspan=\"2\"class=\"tituloNormal\" high=\"20\">Se&ntilde;or<br/>Procurador de los Derechos Humanos</td></tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr>
                    <td colspan=\"2\" class=\"tituloNormal\">En el Municipio de " . $usuario->getIdEmpleado()->getIdsede()->getMunicipio()->getNombre() . ", Departamento de " . $usuario->getIdEmpleado()->getIdsede()->getDepartamento()->getNombre() . ", el d&iacute;a " . $hoy . " siendo las " . $hora . " horas,
                    me dirijo a usted para hacer de su conocimiento por medio de la presente denuncia, el hecho siguiente, para que se realicen los tr&aacute;mites pertinentes:</td>
                    </tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr>
                        <td colspan=\"2\"><tituloNegrita>SOLICITANTE</tituloNegrita></td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">
                            <table width=\"100%\">
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Nombre:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $solicitante[0]->getIdPersona()->getNombres() . " " . $solicitante[0]->getIdPersona()->getApellidos() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Fecha de nacimiento:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $solicitante_fechanac . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Documento de identificaci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $solicitante[0]->getIdPersona()->getTipodocumento() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>N&uacute;mero de identificaci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $solicitante[0]->getIdPersona()->getNumerodocumento() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Direcci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $solicitante[0]->getIdPersona()->getDireccion() . ", " . $solicitante[0]->getIdPersona()->getMuni()->getNombre() . ", " . $solicitante[0]->getIdPersona()->getDepto()->getNombre() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Tel&eacute;fono:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $solicitante[0]->getIdPersona()->getTelefono() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Correo electr&oacute;nico:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $solicitante[0]->getIdPersona()->getCorreoelectronico() . "</cuerpoNormal></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr>
                        <td colspan=\"2\"><tituloNegrita>V&Iacute;CTIMA(S)</tituloNegrita></td>
                    </tr>";
        foreach ($victimas as $victima) {
            //var_dump($victima);
            if (($victima->getIdPersona()->getFechanacimiento()) == NULL) {
                $victima_fechanac = NULL;
            } else {
                $victima_fechanac = $victima->getIdPersona()->getFechanacimiento()->format("d-m-Y");
            }
            //jalar complementos de la persona
            $detalle = $em->getRepository('Procuracion\Entity\DetallePersona')->findByIdPersona($victima->getIdPersona()->getId());
            $text .= "<tr>
                        <td colspan=\"2\">
                            <table width=\"100%\">";
            if ($victima->getIdPersona()->getTipo() != NULL) {//no individual
                $text .= "<tr>
                                    <td width=\"20%\"><cuerpoNormal>Nombre:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima->getIdPersona()->getNombreColectivo() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Nombre del contacto:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima->getIdPersona()->getNombreContacto() . "</cuerpoNormal></td>
                                </tr>";
            } else {//individual
                $text .= "<tr>
                                    <td width=\"20%\"><cuerpoNormal>Nombre:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima->getIdPersona()->getNombres() . " " . $victima->getIdPersona()->getApellidos() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Fecha de nacimiento:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima_fechanac . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Documento de identificaci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima->getIdPersona()->getTipodocumento() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>N&uacute;mero de identificaci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima->getIdPersona()->getNumerodocumento() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Nacionalidad:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $detalle[0]->getNacionalidad()->getValor() . "</cuerpoNormal></td>
                                </tr>
                                ";
            }
            $text .= "<tr>
                                    <td width=\"20%\"><cuerpoNormal>Direcci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima->getIdPersona()->getDireccion() . ", " . $victima->getIdPersona()->getMuni()->getNombre() . ", " . $victima->getIdPersona()->getDepto()->getNombre() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Tel&eacute;fono:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima->getIdPersona()->getTelefono() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Correo electr&oacute;nico:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $victima->getIdPersona()->getCorreoelectronico() . "</cuerpoNormal></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>";
        }
        $text .= "<tr>
                    <td colspan=\"2\">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan=\"2\"><tituloNegrita>DENUNCIADO(S)</tituloNegrita></td>
                </tr>";
        foreach ($denunciados as $denunciado) {
            if (($denunciado->getIdPersona()->getFechanacimiento()) == NULL) {
                $denunciado_fechanac = NULL;
            } else {
                $denunciado_fechanac = $denunciado->getIdPersona()->getFechanacimiento()->format("d-m-Y");
            }
            $extras = $em->getRepository('Procuracion\Entity\DetallePersona')->findByIdPersona($denunciado->getIdPersona()->getId());
            $text .= "<tr>
                        <td colspan=\"2\">
                            <table width=\"100%\">";
            if ($denunciado->getIdPersona()->getTipo()) {//no individual
                $text .= "<tr>
                                    <td width=\"20%\"><cuerpoNormal>Nombre:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $denunciado->getIdPersona()->getNombreColectivo() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Nombre del contacto:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $denunciado->getIdPersona()->getNombreContacto() . "</cuerpoNormal></td>
                                </tr>";
            } else {//individual
                $text .= "<tr>
                                    <td width=\"20%\"><cuerpoNormal>Nombre:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $denunciado->getIdPersona()->getNombres() . " " . $denunciado->getIdPersona()->getApellidos() . "</cuerpoNormal></td>
                                </tr>";
            }
            $text .= "<tr>
                                    <td width=\"20%\"><cuerpoNormal>Cargo:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $extras[0]->getCargo() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Instituci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $extras[0]->getInstitucion() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Direcci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $denunciado->getIdPersona()->getDireccion() . ", " . $denunciado->getIdPersona()->getMuni()->getNombre() . ", " . $denunciado->getIdPersona()->getDepto()->getNombre() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Tel&eacute;fono:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $denunciado->getIdPersona()->getTelefono() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Correo electr&oacute;nico:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $denunciado->getIdPersona()->getCorreoElectronico() . "</cuerpoNormal></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>";
        }
        $text .= "<tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"><tituloNegrita>HECHO DENUNCIADO</tituloNegrita></td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">
                            <table width=\"100%\">
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Fecha:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $fechahechos . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Lugar:<cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $expediente->getLugarhechos() . ", " . $expediente->getMunihechos()->getNombre() . ", " . $expediente->getDeptohechos()->getNombre() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Descripci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $expediente->getHechos() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Petici&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $expediente->getPeticion() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Pruebas presentadas:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $expediente->getPruebas() . "</cuerpoNormal></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\" align=\"left\"><table><tr><td><cuerpoNormal>" . $solicitante[0]->getIdPersona()->getNombres() . " " . $solicitante[0]->getIdPersona()->getApellidos() . "<br />Solicitante<cuerpoNormal></td></tr></table></td>
                    </tr>
                    <tr>
                        <td colspan=\"2\" align=\"right\"><table><tr><cuerpoNormal>" . $usuario->getIdEmpleado()->getNombres() . " " . $usuario->getIdEmpleado()->getApellidos() . "<br />" . $usuario->getIdEmpleado()->getPuesto() . "<cuerpoNormal></td></tr></table></td>
                    </tr>
                </table>";
        $text .= "</body>
                </html>";
        //guardarlo
        /* $lap = \strpos($nombre, 'public');
          $lodemas = substr($nombre, ($lap + 6), \strlen($nombre));

          $docservice = new DocumentoService();
          $datosdoc = array(
          'usuario' => $usuario,
          'accion' => 19,
          'idexpediente' => $expediente,
          'ruta' => $lodemas,
          'id' => 0
          );
          $docservice->save($em, $datosdoc);
          //bitacora
          $accion = "Generó el acta de la denuncia " . $expediente->getNumero();
          $bitacora = new BitacoraService();
          $bitacora->Movimiento($em, array('usuario' => $usuario, 'accion' => $accion)); */

        return $text;
    }

    public function GenerarOrientacion(EntityManager $em, $idExpediente, $idUsuario, $nombre) {
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($idExpediente);
        $expedientepersona = $em->getRepository('Procuracion\Entity\ExpedientePersona')->findByIdExpediente($expediente);

        $persona = $em->getRepository('Procuracion\Entity\Persona')->find($expedientepersona[0]->getIdPersona());
        $orientaciones = $em->getRepository('Procuracion\Entity\Orientacion')->findByIdExpediente($expediente);
        $orientacion = $orientaciones[0];

        $usuario = $em->getRepository('Procuracion\Entity\Usuario')->find($idUsuario);
        $remisiones = $em->getRepository('Procuracion\Entity\Remision')->findByIdExpediente($expediente);

        $hoy = date("d-n-Y");
        $hora = date("H:i");
        if (($persona->getFechanacimiento()) == NULL) {
            $fechanac = $persona->getFechanacimiento();
        } else {
            $fechanac = $persona->getFechanacimiento()->format("d-m-Y");
        }

        if (($expediente->getFechahechos()) == NULL) {
            $fechahechos = $expediente->getFechahechos();
        } else {
            $fechahechos = $expediente->getFechahechos()->format("d-m-Y");
        }

        $text = "<html>
                    <head>
                        <meta charset='utf-8'>
                        <title>Acta de orientaci&oacute;n</title>
                        <style>
                            encabezado {
                                font-family: Helvetica;
                                font-size: 16pt;
                                font-weight: bold;
                            }
                            encabezadoDos {
                                font-family: Helvetica;
                                font-size: 11pt;
                                font-weight: bold;
                            }
                            cuerpoNegrita {
                                font-family: Helvetica;
                                font-size: 12pt;
                                font-weight: bold;
                            }
                            cuerpoNormal {
                                font-family: Helvetica;
                                font-size: 12pt;
                            }
                            .tituloNormal {
                                font-family: Helvetica;
                                font-size: 14pt;
                            }
                            tituloNegrita {
                                font-family: Helvetica;
                                font-size: 14pt;
                                font-weight: bold;
                            }
                        </style>
                    </head>
                    <body>";
        $text .= "<table width=\"100%\" align=\"center\">
                    <tr>
                        <td width=\"13%\"><img src=\"" . BASE_PATH . "/public/img/logo.jpg\" width=\"167\" height=\"83\" align=\"left\"></td>
                        <td width=\"87%\">
                            <table width=\"100%\" align=\"center\">
                                <tr><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr align=\"center\">
                                    <td align=\"center\"><encabezado>PROCURADOR DE LOS DERECHOS HUMANOS</encabezado></td>
                                </tr>
                                <tr>
                                    <td align=\"center\"><encabezadoDos>12 Avenida 12-54 Zona 1 Guatemala, C.A. - PBX. 24241717 - Emergencias 1555</encabezadoDos></td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"><hr></td>
                    </tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr>
                        <td colspan=\"2\" align=\"center\"><tituloNegrita>ORIENTACION " . $expediente->getNumero() . "</tituloNegrita></td>
                    </tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr>
                    <td colspan=\"2\" class=\"tituloNormal\">En el Municipio de " . $usuario->getIdEmpleado()->getIdsede()->getMunicipio()->getNombre() . ", Departamento de " . $usuario->getIdEmpleado()->getIdsede()->getDepartamento()->getNombre() . ", el d&iacute;a " . $hoy . " siendo las " . $hora . " horas, hago constar que se present&oacute; a esta instituci&oacute;n:</td>
                    </tr>
                    <tr><td colspan=\"2\" high=\"20\">&nbsp;</td></tr>
                    <tr>
                        <td colspan=\"2\"><tituloNegrita>DATOS DE LA PERSONA</tituloNegrita></td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">
                            <table width=\"100%\">
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Nombre:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $persona->getNombres() . " " . $persona->getApellidos() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Fecha de nacimiento:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $fechanac . "</cuerpoNormal></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">
                            <table width=\"100%\">
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Documento de identificaci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $persona->getTipodocumento() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>N&uacute;mero de identificaci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $persona->getNumerodocumento() . "</cuerpoNormal></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"><tituloNegrita>HECHO</tituloNegrita></td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">
                            <table width=\"100%\">
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Fecha:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $fechahechos . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Lugar:<cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $expediente->getLugarhechos() . ", " . $expediente->getMunihechos()->getNombre() . ", " . $expediente->getDeptohechos()->getNombre() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Descripci&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $expediente->getHechos() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Petici&oacute;n:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $expediente->getPeticion() . "</cuerpoNormal></td>
                                </tr>
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Pruebas presentadas:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $expediente->getPruebas() . "</cuerpoNormal></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"><tituloNegrita>ORIENTACION BRINDADA</tituloNegrita></td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">
                            <table width=\"100%\">
                                <tr>
                                    <td width=\"20%\"><cuerpoNormal>Detalle:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>" . $orientacion->getDetalle() . "</cuerpoNormal></td>
                                </tr> ";
        if ($orientacion->getRemite() == 1) {
            $text .= "<tr>
                                    <td width=\"20%\"><cuerpoNormal>Remisiones:</cuerpoNormal></td>
                                    <td width=\"80%\"><cuerpoNormal>";
            foreach ($remisiones as $remision) {
                $text .= " - " . $remision->getIdInstitucion()->getInstitucion() . "<br>";
            }
            $text .= "</cuerpoNormal></td>
                                </tr>";
        }
        $text .= "
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\" align=\"left\"><table><tr><td><cuerpoNormal>" . $persona->getNombres() . " " . $persona->getApellidos() . "<br />Solicitante<cuerpoNormal></td></tr></table></td>
                    </tr>
                    <tr>
                        <td colspan=\"2\" align=\"right\"><table><tr><cuerpoNormal>" . $usuario->getIdEmpleado()->getNombres() . " " . $usuario->getIdEmpleado()->getApellidos() . "<br />" . $usuario->getIdEmpleado()->getPuesto() . "<cuerpoNormal></td></tr></table></td>
                    </tr>
                </table>";
        $text .= "</body>
                </html>";
        //guardarlo
        /* $lap = \strpos($nombre, 'public');
          $lodemas = substr($nombre, ($lap + 6), \strlen($nombre));

          $docservice = new DocumentoService();
          $datosdoc = array(
          'usuario' => $usuario,
          'accion' => 20,
          'idexpediente' => $expediente,
          'ruta' => $lodemas,
          'id' => 0
          );
          $docservice->save($em, $datosdoc);
          //bitacora
          $accion = "generó el acta de la orientación " . $expediente->getNumero();
          $bitacora = new BitacoraService();
          $bitacora->Movimiento($em, array('usuario' => $usuario, 'accion' => $accion)); */

        return $text;
    }

    public function guardarGenerado(EntityManager $em, $nombre, $idUsuario, $idexpediente) {
        $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($idexpediente);
        $usuario = $em->getRepository('Procuracion\Entity\Usuario')->find($idUsuario);

        $tipoexpediente = $expediente->getIdTipo()->getId();
        switch ($tipoexpediente) {
            case 1:
                $accion = 20;
                break;
            /* case 2:
              $accion =;
              break;
              case 3:
              $accion =;
              break; */
            case 4:
                $accion = 19;
                break;
        }

        //guardarlo
        $lap = \strpos($nombre, 'public');
        $lodemas = substr($nombre, ($lap + 6), \strlen($nombre));

        $docservice = new DocumentoService();
        $datosdoc = array(
            'usuario' => $usuario,
            'accion' => $accion,
            'idexpediente' => $expediente,
            'ruta' => $lodemas,
            'id' => 0
        );
        $docservice->save($em, $datosdoc);
        //bitacora
        $accion = "Generó el acta de la denuncia " . $expediente->getNumero();
        $bitacora = new BitacoraService();
        $bitacora->Movimiento($em, array('usuario' => $usuario, 'accion' => $accion));
    }

    public function revisar(EntityManager $em, $idExpediente) {
        $atras = "";
        $otros = $em->getRepository('Procuracion\Entity\DocumentoExpediente')->findByIdExpediente($idExpediente);
        if ($otros) {
            //echo "hay ".$otros[0]->getUbicacion();
            $lapos = strpos($otros[0]->getUbicacion(), "exp ");
            $atras = substr($otros[0]->getUbicacion(), 0, $lapos);
            //echo "pos $atras";
        }
        return $atras;
    }

    public function makeDir(EntityManager $em, $idExpediente, $idUsuario) {
        $existente = $this->revisar($em, $idExpediente);
        if ($existente == "") {
            $expediente = $em->getRepository('Procuracion\Entity\Expediente')->find($idExpediente);
            $fecha = $expediente->getFechaingreso();
            $hoyAnio = $fecha->format("Y");
            $hoyMes = $fecha->format("M");
            $hoyDia = $fecha->format("Dd");
            //revisar si ya existe la ruta del expediente
            $ruta = BASE_PATH . '/public/expediente_electronico/' . $hoyAnio . '/' . $hoyMes . '/' . $hoyDia . '/exp-' . $expediente->getNumero();
            if (\file_exists($ruta)) {
                return $ruta;
            } else {
                if (\mkdir($ruta, 0777, true)) {
                    //bitacora
                    $accion = "generó la carpeta del archivo " . $expediente->getNumero();
                    $bitacora = new BitacoraService();
                    $bitacora->Movimiento($em, array('usuario' => $idUsuario, 'accion' => $accion));
                    return $ruta;
                } else {
                    return "";
                }
            }
        } else
            $ruta = $existente . '\\exp ' . $expediente->getNumero();
        return $ruta;
    }

}
