<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteHechoDerecho
 *
 * @ORM\Table(name="expediente_hecho_derecho", indexes={@ORM\Index(name="expediente", columns={"id_expediente"}), @ORM\Index(name="id_hecho_derecho", columns={"id_hecho_derecho"})})
 * @ORM\Entity
 */
class ExpedienteHechoDerecho
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
     * @var \Procuracion\Entity\Expediente
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Expediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;

    /**
     * @var \Procuracion\Entity\HechoDerecho
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\HechoDerecho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hecho_derecho", referencedColumnName="id")
     * })
     */
    private $idHechoDerecho;



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
     * Set idExpediente
     *
     * @param \Procuracion\Entity\Expediente $idExpediente
     *
     * @return ExpedienteHechoDerecho
     */
    public function setIdExpediente(\Procuracion\Entity\Expediente $idExpediente = null)
    {
        $this->idExpediente = $idExpediente;
    
        return $this;
    }

    /**
     * Get idExpediente
     *
     * @return \Procuracion\Entity\Expediente
     */
    public function getIdExpediente()
    {
        return $this->idExpediente;
    }

    /**
     * Set idHechoDerecho
     *
     * @param \Procuracion\Entity\HechoDerecho $idHechoDerecho
     *
     * @return ExpedienteHechoDerecho
     */
    public function setIdHechoDerecho(\Procuracion\Entity\HechoDerecho $idHechoDerecho = null)
    {
        $this->idHechoDerecho = $idHechoDerecho;
    
        return $this;
    }

    /**
     * Get idHechoDerecho
     *
     * @return \Procuracion\Entity\HechoDerecho
     */
    public function getIdHechoDerecho()
    {
        return $this->idHechoDerecho;
    }
}