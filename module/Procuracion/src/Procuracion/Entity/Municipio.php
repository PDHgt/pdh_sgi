<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipio
 *
 * @ORM\Table(name="municipio", indexes={@ORM\Index(name="Codigo", columns={"Codigo"})})
 * @ORM\Entity
 */
class Municipio
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
     * @var \Procuracion\Entity\Departamento
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Departamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_departamento", referencedColumnName="Codigo")
     * })
     */
    private $idDepartamento;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="Codigo", type="integer", nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;



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
     * Set depto
     *
     * @param \Procuracion\Entity\Departamento $depto
     *
     * @return Persona
     */
    public function setDepto(\Procuracion\Entity\Departamento $depto = null)
    {
        $this->idDepartamento = $depto;
    
        return $this;
    }

    /**
     * Get depto
     *
     * @return \Procuracion\Entity\Departamento
     */
    public function getDepto()
    {
        return $this->idDepartamento;
    }

    /**
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return Municipio
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Municipio
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
}
