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
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \Procuracion\Entity\Derecho
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Derecho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_derecho", referencedColumnName="id")
     * })
     */
    private $idDerecho;

    /**
     * @var integer
     *
     * @ORM\Column(name="Competencia", type="integer", nullable=true)
     */
    private $competencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="Orientacion", type="integer", nullable=true)
     */
    private $orientacion;

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

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return DefHecho
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idDerecho
     *
     * @param \Procuracion\Entity\Derecho $idDerecho
     *
     * @return HechoDerecho
     */
    public function setIdDerecho(\Procuracion\Entity\Derecho $idDerecho = null)
    {
        $this->idDerecho = $idDerecho;
    
        return $this;
    }

    /**
     * Get idDerecho
     *
     * @return \Procuracion\Entity\Derecho
     */
    public function getIdDerecho()
    {
        return $this->idDerecho;
    }

    /**
     * Set competencia
     *
     * @param integer $competencia
     *
     * @return HechoDerecho
     */
    public function setCompetencia($competencia)
    {
        $this->competencia = $competencia;
    
        return $this;
    }

    /**
     * Get competencia
     *
     * @return integer
     */
    public function getCompetencia()
    {
        return $this->competencia;
    }

    /**
     * Set orientacion
     *
     * @param integer $orientacion
     *
     * @return HechoDerecho
     */
    public function setOrientacion($orientacion)
    {
        $this->orientacion = $orientacion;
    
        return $this;
    }

    /**
     * Get orientacion
     *
     * @return integer
     */
    public function getOrientacion()
    {
        return $this->orientacion;
    }    
    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return Defhecho
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
