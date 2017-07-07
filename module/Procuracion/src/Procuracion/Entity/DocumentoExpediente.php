<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoExpediente
 *
 * @ORM\Table(name="documento_expediente", indexes={@ORM\Index(name="doc_usuario", columns={"id_usuario"}), @ORM\Index(name="doc_updated", columns={"updated_by"}), @ORM\Index(name="id_accion", columns={"id_accion"})})
 * @ORM\Entity
 */
class DocumentoExpediente
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
     * @var \Procuracion\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * })
     */
    private $idUsuario;

    /**
     * @var \Procuracion\Entity\Accion
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Accion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_accion", referencedColumnName="id")
     * })
     */
    private $idAccion;

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
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Destinatario", type="string", length=255, nullable=true)
     */
    private $destinatario;

    /**
     * @var string
     *
     * @ORM\Column(name="Institucion", type="text", length=255, nullable=true)
     */
    private $institucion;

    /**
     * @var string
     *
     * @ORM\Column(name="Asunto", type="text", length=255, nullable=true)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="Resumen", type="text", length=65535, nullable=true)
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="Ubicacion", type="text", length=255, nullable=true)
     */
    private $ubicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="date", nullable=true)
     */
    private $updated_at;

    /**
     * @var \Procuracion\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updated_by", referencedColumnName="id")
     * })
     */
    private $updated_by;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=true)
     */
    private $deleted;

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
     * Set idUsuario
     *
     * @param \Procuracion\Entity\Usuario $usuario
     *
     * @return DocumentoExpediente
     */
    public function setIdUsuario(\Procuracion\Entity\Usuario $usuario = null)
    {
        $this->idUsuario = $usuario;
    
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \Procuracion\Entity\Usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set idAccion
     *
     * @param \Procuracion\Entity\Accion $accion
     *
     * @return DocumentoExpediente
     */
    public function setIdAccion(\Procuracion\Entity\Accion $accion = null)
    {
        $this->idAccion = $accion;
    
        return $this;
    }

    /**
     * Get idAccion
     *
     * @return \Procuracion\Entity\Accion
     */
    public function getIdAccion()
    {
        return $this->idAccion;
    }

    /**
     * Set idExpediente
     *
     * @param \Procuracion\Entity\Expediente $idExpediente
     *
     * @return Orientacion
     */
    public function setIdExpediente(\Procuracion\Entity\Expediente $idExpediente = null) {
        $this->idExpediente = $idExpediente;

        return $this;
    }

    /**
     * Get idExpediente
     *
     * @return \Procuracion\Entity\Expediente
     */
    public function getIdExpediente() {
        return $this->idExpediente;
    }
    
    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DocumentoExpediente
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set destinatario
     *
     * @param string $destinatario
     *
     * @return DocumentoExpediente
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    
        return $this;
    }

    /**
     * Get destinatario
     *
     * @return string
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     *
     * @return DocumentoExpediente
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;
    
        return $this;
    }

    /**
     * Get insitucion
     *
     * @return string
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return DocumentoExpediente
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    
        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     *
     * @return DocumentoExpediente
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;
    
        return $this;
    }

    /**
     * Get resumen
     *
     * @return string
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return DocumentoExpediente
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    
        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updated
     *
     * @return DocumentoExpediente
     */
    public function setUpdatedAt($updated)
    {
        $this->updated_at = $updated;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set updated_by
     *
     * @param \Procuracion\Entity\Usuario $usuario
     *
     * @return Expediente
     */
    public function setUpdatedBy(\Procuracion\Entity\Usuario $usuario = null)
    {
        $this->updated_by = $usuario;
    
        return $this;
    }     
    
    /**
     * Get updated_by
     *
     * @return \Procuracion\Entity\Usuario
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return DocumentoExpediente
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }     
    
    /**
     * Get deleted
     *
     * @return integer
     */
    public function getDeleted()
    {
        return $this->deleted;
    }    
}
