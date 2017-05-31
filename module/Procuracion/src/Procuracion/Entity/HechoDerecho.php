<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HechoDerecho
 *
 * @ORM\Table(name="hecho_derecho", indexes={@ORM\Index(name="id_hecho", columns={"id_hecho"}), @ORM\Index(name="id_derecho", columns={"id_derecho"})})
 * @ORM\Entity
 */
class HechoDerecho
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
     * @var \Procuracion\Entity\Derecho
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Derecho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_derecho", referencedColumnName="id")
     * })
     */
    private $idDerecho;

    /**
     * @var \Procuracion\Entity\DefHecho
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DefHecho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hecho", referencedColumnName="id")
     * })
     */
    private $idHecho;

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
     * Set idHecho
     *
     * @param \Procuracion\Entity\DefHecho $idHecho
     *
     * @return HechoDerecho
     */
    public function setIdHecho(\Procuracion\Entity\DefHecho $idHecho = null)
    {
        $this->idHecho = $idHecho;
    
        return $this;
    }

    /**
     * Get idHecho
     *
     * @return \Procuracion\Entity\DefHecho
     */
    public function getIdHecho()
    {
        return $this->idHecho;
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
     * @return HechoDerecho
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
