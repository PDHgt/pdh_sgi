<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaminoTipo
 *
 * @ORM\Table(name="camino_tipo", indexes={@ORM\Index(name="id_etapa", columns={"id_etapa"}), @ORM\Index(name="id_tipo_expediente", columns={"id_tipo_expediente"}), @ORM\Index(name="anterior", columns={"Anterior"}), @ORM\Index(name="siguiente", columns={"Siguiente"})})
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
     * @var \Procuracion\Entity\Etapa
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Etapa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etapa", referencedColumnName="id")
     * })
     */
    private $idEtapa;

    /**
     * @var \Procuracion\Entity\Etapa
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Etapa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Anterior", referencedColumnName="id")
     * })
     */
    private $anterior;    

    /**
     * @var \Procuracion\Entity\Etapa
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Etapa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Siguiente", referencedColumnName="id")
     * })
     */
    private $siguiente;    

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
     * @var integer
     *
     * @ORM\Column(name="Regresa", type="integer", nullable=true)
     */
    private $regresa;

    /**
     * @var integer
     *
     * @ORM\Column(name="Revision", type="integer", nullable=true)
     */
    private $revision;    



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
     * Set idEtapa
     *
     * @param \Procuracion\Entity\Etapa $idEtapa
     *
     * @return CaminoTipo
     */
    public function setIdEtapa(\Procuracion\Entity\Etapa $idEtapa = null)
    {
        $this->idEtapa = $idEtapa;
    
        return $this;
    }

    /**
     * Get idEtapa
     *
     * @return \Procuracion\Entity\Etapa
     */
    public function getIdEtapa()
    {
        return $this->idEtapa;
    }

    /**
     * Set anterior
     *
     * @param \Procuracion\Entity\Etapa $anterior
     *
     * @return CaminoTipo
     */
    public function setAnterior(\Procuracion\Entity\Etapa $anterior = null)
    {
        $this->anterior = $anterior;
    
        return $this;
    }

    /**
     * Get anterior
     *
     * @return \Procuracion\Entity\Etapa
     */
    public function getAnterior()
    {
        return $this->anterior;
    }

    /**
     * Set siguiente
     *
     * @param \Procuracion\Entity\Etapa $siguiente
     *
     * @return CaminoTipo
     */
    public function setSiguiente(\Procuracion\Entity\Etapa $siguiente = null)
    {
        $this->siguiente = $siguiente;
    
        return $this;
    }

    /**
     * Get siguiente
     *
     * @return \Procuracion\Entity\Etapa
     */
    public function getSiguiente()
    {
        return $this->siguiente;
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

    /**
     * Set regresa
     *
     * @param integer $regresa
     *
     * @return CaminoTipo
     */
    public function setRegresa($regresa)
    {
        $this->regresa = $regresa;
    
        return $this;
    }

    /**
     * Get regresa
     *
     * @return integer
     */
    public function getRegresa()
    {
        return $this->regresa;
    }

    /**
     * Set revision
     *
     * @param integer $revision
     *
     * @return CaminoTipo
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;
    
        return $this;
    }

    /**
     * Get revision
     *
     * @return integer
     */
    public function getRevision()
    {
        return $this->revision;
    }


}
