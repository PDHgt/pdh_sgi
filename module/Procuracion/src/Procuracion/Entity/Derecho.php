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
     * @var string
     *
     * @ORM\Column(name="AreaDerecho", type="text", nullable=true)
     */
    private $area;

    /**
     * @var integer
     *
     * @ORM\Column(name="Activo", type="integer", nullable=true)
     */
    private $activo;


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

    /**
     * Set area
     *
     * @param string $area
     *
     * @return Derecho
     */
    public function setArea($area)
    {
        $this->area = $area;
    
        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return Derecho
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return integer
     */
    public function getActivo()
    {
        return $this->activo;
    }

}
