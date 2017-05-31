<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteHechoDerecho
 *
 * @ORM\Table(name="expediente_hecho_derecho", indexes={@ORM\Index(name="expediente", columns={"id_expediente"}), @ORM\Index(name="id_hecho", columns={"id_hecho"})})
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
     * @var \Procuracion\Entity\DefHecho
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DefHecho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hecho", referencedColumnName="id")
     * })
     */
    private $idHecho;



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
     * Set idHecho
     *
     * @param \Procuracion\Entity\DefHecho $idHecho
     *
     * @return ExpedienteHechoDerecho
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
}
