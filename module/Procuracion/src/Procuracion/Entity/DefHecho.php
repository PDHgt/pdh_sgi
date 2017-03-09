<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DefHecho
 *
 * @ORM\Table(name="def_hecho")
 * @ORM\Entity
 */
class DefHecho
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Hecho", type="text", nullable=true)
     */
    private $hecho;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hecho
     *
     * @param string $hecho
     *
     * @return DefHecho
     */
    public function setHecho($hecho)
    {
        $this->hecho = $hecho;
    
        return $this;
    }

    /**
     * Get hecho
     *
     * @return string
     */
    public function getHecho()
    {
        return $this->hecho;
    }
}
