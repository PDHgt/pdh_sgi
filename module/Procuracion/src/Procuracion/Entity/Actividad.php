<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actividad
 *
 * @ORM\Table(name="actividad")
 * @ORM\Entity
 */
class Actividad
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
     * @ORM\Column(name="Actividad", type="string", length=255, nullable=true)
     */
    private $actividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="Duracion", type="integer", nullable=true)
     */
    private $duracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="Activa", type="integer", nullable=true)
     */
    private $activa;



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
     * Set actividad
     *
     * @param string $actividad
     *
     * @return Actividad
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;
    
        return $this;
    }

    /**
     * Get actividad
     *
     * @return string
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     *
     * @return Actividad
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    
        return $this;
    }

    /**
     * Get duracion
     *
     * @return integer
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set activa
     *
     * @param integer $activa
     *
     * @return Actividad
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;
    
        return $this;
    }

    /**
     * Get activa
     *
     * @return integer
     */
    public function getActiva()
    {
        return $this->activa;
    }
}
