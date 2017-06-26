<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedientePersona
 *
 * @ORM\Table(name="expediente_persona", indexes={@ORM\Index(name="id_expediente", columns={"id_expediente"}), @ORM\Index(name="persona", columns={"id_persona"}), @ORM\Index(name="Tipo", columns={"Tipo"}), @ORM\Index(name="Relacion", columns={"RelacionVictima"}), @ORM\Index(name="ConAgresor", columns={"RelacionAgresor"})})
 * @ORM\Entity
 */
class ExpedientePersona
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
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RelacionAgresor", referencedColumnName="id")
     * })
     */
    private $relacionagresor;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RelacionVictima", referencedColumnName="id")
     * })
     */
    private $relacionvictima;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo", referencedColumnName="id")
     * })
     */
    private $tipo;

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
     * @var \Procuracion\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id")
     * })
     */
    private $idPersona;



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
     * Set relacionagresor
     *
     * @param \Procuracion\Entity\DetalleCatalogo $relacionagresor
     *
     * @return ExpedientePersona
     */
    public function setRelacionagresor(\Procuracion\Entity\DetalleCatalogo $relacionagresor = null)
    {
        $this->relacionagresor = $relacionagresor;
    
        return $this;
    }

    /**
     * Get relacionagresor
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getRelacionagresor()
    {
        return $this->relacionagresor;
    }

    /**
     * Set relacionvictima
     *
     * @param \Procuracion\Entity\DetalleCatalogo $relacionvictima
     *
     * @return ExpedientePersona
     */
    public function setRelacionvictima(\Procuracion\Entity\DetalleCatalogo $relacionvictima = null)
    {
        $this->relacionvictima = $relacionvictima;
    
        return $this;
    }

    /**
     * Get relacionvictima
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getRelacionvictima()
    {
        return $this->relacionvictima;
    }

    /**
     * Set tipo
     *
     * @param \Procuracion\Entity\DetalleCatalogo $tipo
     *
     * @return ExpedientePersona
     */
    public function setTipo(\Procuracion\Entity\DetalleCatalogo $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set idExpediente
     *
     * @param \Procuracion\Entity\Expediente $idExpediente
     *
     * @return ExpedientePersona
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
     * Set idPersona
     *
     * @param \Procuracion\Entity\Persona $idPersona
     *
     * @return ExpedientePersona
     */
    public function setIdPersona(\Procuracion\Entity\Persona $idPersona = null)
    {
        $this->idPersona = $idPersona;
    
        return $this;
    }

    /**
     * Get idPersona
     *
     * @return \Procuracion\Entity\Persona
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }
}
