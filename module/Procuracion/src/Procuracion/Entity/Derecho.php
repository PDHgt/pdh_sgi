<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Derecho
 *
 * @ORM\Table(name="derecho")
 * @ORM\Entity
 */
class Derecho
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
     * @ORM\Column(name="Derecho", type="string", length=255, nullable=true)
     */
    private $derecho;



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
     * Set derecho
     *
     * @param string $derecho
     *
     * @return Derecho
     */
    public function setDerecho($derecho)
    {
        $this->derecho = $derecho;
    
        return $this;
    }

    /**
     * Get derecho
     *
     * @return string
     */
    public function getDerecho()
    {
        return $this->derecho;
    }
}
