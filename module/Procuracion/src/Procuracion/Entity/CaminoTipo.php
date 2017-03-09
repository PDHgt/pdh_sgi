<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaminoTipo
 *
 * @ORM\Table(name="camino_tipo", indexes={@ORM\Index(name="id_actividad", columns={"id_actividad"}), @ORM\Index(name="id_tipo_expediente", columns={"id_tipo_expediente"})})
 * @ORM\Entity
 */
class CaminoTipo
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
     * @var integer
     *
     * @ORM\Column(name="Orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="Activo", type="integer", nullable=true)
     */
    private $activo;

    /**
     * @var \Procuracion\Entity\Actividad
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Actividad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_actividad", referencedColumnName="id")
     * })
     */
    private $idActividad;

    /**
     * @var \Procuracion\Entity\TipoExpediente
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\TipoExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_expediente", referencedColumnName="id")
     * })
     */
    private $idTipoExpediente;



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
     * Set orden
     *
     * @param integer $orden
     *
     * @return CaminoTipo
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    
        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return CaminoTipo
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

    /**
     * Set idActividad
     *
     * @param \Procuracion\Entity\Actividad $idActividad
     *
     * @return CaminoTipo
     */
    public function setIdActividad(\Procuracion\Entity\Actividad $idActividad = null)
    {
        $this->idActividad = $idActividad;
    
        return $this;
    }

    /**
     * Get idActividad
     *
     * @return \Procuracion\Entity\Actividad
     */
    public function getIdActividad()
    {
        return $this->idActividad;
    }

    /**
     * Set idTipoExpediente
     *
     * @param \Procuracion\Entity\TipoExpediente $idTipoExpediente
     *
     * @return CaminoTipo
     */
    public function setIdTipoExpediente(\Procuracion\Entity\TipoExpediente $idTipoExpediente = null)
    {
        $this->idTipoExpediente = $idTipoExpediente;
    
        return $this;
    }

    /**
     * Get idTipoExpediente
     *
     * @return \Procuracion\Entity\TipoExpediente
     */
    public function getIdTipoExpediente()
    {
        return $this->idTipoExpediente;
    }
}
