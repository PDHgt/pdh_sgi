<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empleado
 *
 * @ORM\Table(name="empleado", indexes={@ORM\Index(name="UnidadAdministrativa", columns={"UnidadAdministrativa"})})
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
     * @var \Procuracion\Entity\Unidadadministrativa
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Unidadadministrativa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UnidadAdministrativa", referencedColumnName="id")
     * })
     */
    private $unidadadministrativa;



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
     * @param \Procuracion\Entity\Unidadadministrativa $unidadadministrativa
     *
     * @return Empleado
     */
    public function setUnidadadministrativa(\Procuracion\Entity\Unidadadministrativa $unidadadministrativa = null)
    {
        $this->unidadadministrativa = $unidadadministrativa;
    
        return $this;
    }

    /**
     * Get unidadadministrativa
     *
     * @return \Procuracion\Entity\Unidadadministrativa
     */
    public function getUnidadadministrativa()
    {
        return $this->unidadadministrativa;
    }
}
