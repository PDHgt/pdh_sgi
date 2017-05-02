<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empleado
 *
 * @ORM\Table(name="empleado", indexes={@ORM\Index(name="Unidad", columns={"UnidadAdministrativa"})})
 * @ORM\Entity
 */
class Empleado
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
     * @ORM\Column(name="Nombres", type="string", length=100, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellidos", type="string", length=100, nullable=true)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="Puesto", type="string", length=255, nullable=true)
     */
    private $puesto;

    /**
     * @var \Procuracion\Entity\Unidad
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Unidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UnidadAdministrativa", referencedColumnName="id")
     * })
     */
    private $unidadadministrativa;

    /**
     * @var \Procuracion\Entity\Sede
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Sede")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sede", referencedColumnName="id")
     * })
     */
    private $id_sede;

    /**
     * @var string
     *
     * @ORM\Column(name="Correo", type="string", length=255, nullable=true)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="Extension", type="string", length=10, nullable=true)
     */
    private $extension;    
 
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
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Empleado
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Empleado
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set puesto
     *
     * @param string $puesto
     *
     * @return Empleado
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;
    
        return $this;
    }

    /**
     * Get puesto
     *
     * @return string
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set unidadadministrativa
     *
     * @param \Procuracion\Entity\Unidad $unidadadministrativa
     *
     * @return Empleado
     */
    public function setUnidadadministrativa(\Procuracion\Entity\Unidad $unidadadministrativa = null)
    {
        $this->unidadadministrativa = $unidadadministrativa;
    
        return $this;
    }

    /**
     * Get unidadadministrativa
     *
     * @return \Procuracion\Entity\Unidad
     */
    public function getUnidadadministrativa()
    {
        return $this->unidadadministrativa;
    }

    /**
     * Set id_sede
     *
     * @param \Procuracion\Entity\Sede $sede
     *
     * @return Empleado
     */
    public function setIdsede(\Procuracion\Entity\Sede $sede = null)
    {
        $this->id_sede = $sede;
    
        return $this;
    }

    /**
     * Get id_sede
     *
     * @return \Procuracion\Entity\Sede
     */
    public function getIdsede()
    {
        return $this->id_sede;
    }


    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Empleado
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    
        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return Empleado
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    
        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

}
