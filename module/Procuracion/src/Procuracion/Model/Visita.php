<?php
namespace Application\Model;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Application\Model\VisitaRepository")
 */
class Visita
{

}

class VisitaRepository extends EntityRepository
{
    public function getVisitOfToday()
    {
        return $this->_em->createQuery('SELECT u FROM Application\Model\Visita u WHERE u.fechaentrada = "2016-12-12" order by horaentrada')
                         ->getResult();
    }
}