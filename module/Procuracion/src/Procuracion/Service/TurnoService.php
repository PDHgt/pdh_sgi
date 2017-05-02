<?php

namespace Procuracion\Service;

use Doctrine\ORM\EntityRepository;
use Procuracion\Entity\Turno;
use Doctrine\ORM\EntityManager as EntityManager;
use Zend\View\Model\JsonModel;

class TurnoService {

    public function initializeToday(EntityManager $em, array $datos) {
        //var_dump($datos);
        $turno = $em->getRepository('\Procuracion\Entity\Turno')->findBy(array('sede' => $datos['sede'], 'fecha' => $datos['fecha'], 'prioridad' => $datos['prioridad']));
        if (empty($turno)) {
            //insertar
            $nvo = new Turno();
            $nvo->setSede($datos['sede']);
            $nvo->setFecha($datos['fecha']);
            $nvo->setPrioridad($datos['prioridad']);
            $nvo->setNumero(0);

            $em->persist($nvo);
            $em->flush();
            $turno = $em->getRepository('\Procuracion\Entity\Turno')->findBy(array('sede' => $datos['sede'], 'fecha' => $datos['fecha'], 'prioridad' => $datos['prioridad']));
            //return $nvo;
        } else {
            //regresar los valores
            //return $listado;//->id;
        }
        return $turno;
    }

    public function newTicket(EntityManager $em, array $turno) {// $prioridad, int $sede){
        //var_dump($turno);
        //$tu = $this->initializeToday($em,$datos);
        $uno = $turno[0];
        //$id = $tu['id'];
        //var_dump($tu);
        $nvo = $em->getRepository('Procuracion\Entity\Turno')->find($uno->getId());
        //var_dump($nvo);
        $nvo->setNumero($nvo->getNumero() + 1);
        $em->flush();
        //var_dump($turno);
        switch ($nvo->getPrioridad()) {
            case '1':
                $elTurno = "U-" . $nvo->getNumero();
                break;
            case '2':
                $elTurno = "I-" . $nvo->getNumero();
                break;
            case '3':
                $elTurno = "N-" . $nvo->getNumero();
                break;
            default:
                # code...
                break;
        }
        return $elTurno;
    }

}
