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
     * @ORM\Column(name="NombreCorto", type="string", length=10, nullable=true)
     */
    private $nombrecorto;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var \Procuracion\Entity\Departamento
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Departamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Departamento", referencedColumnName="id")
     * })
     */
    private $departamento;

    /**
     * @var \Procuracion\Entity\Municipio
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Municipio", referencedColumnName="id")
     * })
     */
    private $municipio;

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
     * Set nombrecorto
     *
     * @param string $nombre
     *
     * @return Sede
     */
    public function setNombreCorto($nombre)
    {
        $this->nombrecorto = $nombre;
    
        return $this;
    }

    /**
     * Get nombrecorto
     *
     * @return string
     */
    public function getNombreCorto()
    {
        return $this->nombrecorto;
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
     * Set departamento
     *
     * @param \Procuracion\Entity\Departamento $departamento
     *
     * @return Expediente
     */
    public function setDepartamento(\Procuracion\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;
    
        return $this;
    }

    /**
     * Get departamento
     *
     * @return \Procuracion\Entity\Departamento
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set municipio
     *
     * @param \Procuracion\Entity\Municipio $municipio
     *
     * @return Expediente
     */
    public function setMunicipio(\Procuracion\Entity\Municipio $municipio = null)
    {
        $this->municipio = $municipio;
    
        return $this;
    }

    /**
     * Get municipio
     *
     * @return \Procuracion\Entity\Municipio
     */
    public function getMunicipio()
    {
        return $this->municipio;
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
