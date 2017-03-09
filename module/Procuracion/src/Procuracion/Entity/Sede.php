<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sede
 *
 * @ORM\Table(name="sede")
 * @ORM\Entity
 */
class Sede
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
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefonos", type="string", length=255, nullable=true)
     */
    private $telefonos;

    /**
     * @var string
     *
     * @ORM\Column(name="Activa", type="string", length=255, nullable=true)
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Sede
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Sede
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     *
     * @return Sede
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;
    
        return $this;
    }

    /**
     * Get telefonos
     *
     * @return string
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set activa
     *
     * @param string $activa
     *
     * @return Sede
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;
    
        return $this;
    }

    /**
     * Get activa
     *
     * @return string
     */
    public function getActiva()
    {
        return $this->activa;
    }
}
