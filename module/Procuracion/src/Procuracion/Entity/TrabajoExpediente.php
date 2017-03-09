<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrabajoExpediente
 *
 * @ORM\Table(name="trabajo_expediente", indexes={@ORM\Index(name="id_exp", columns={"id_expediente"}), @ORM\Index(name="id_act", columns={"id_actividad"}), @ORM\Index(name="id_usr", columns={"id_usuario"}), @ORM\Index(name="id_usr_asig", columns={"id_usuario_asigna"})})
 * @ORM\Entity
 */
class TrabajoExpediente
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
     * @var \DateTime
     *
     * @ORM\Column(name="Inicio", type="datetime", nullable=true)
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fin", type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaAsignacion", type="date", nullable=true)
     */
    private $fechaasignacion;

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
     * @var \Procuracion\Entity\Expediente
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Expediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_expediente", referencedColumnName="id")
     * })
     */
    private $idExpediente;

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
     * @var \Procuracion\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_asigna", referencedColumnName="id")
     * })
     */
    private $idUsuarioAsigna;



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
     * Set inicio
     *
     * @param \DateTime $inicio
     *
     * @return TrabajoExpediente
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    
        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return TrabajoExpediente
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    
        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set fechaasignacion
     *
     * @param \DateTime $fechaasignacion
     *
     * @return TrabajoExpediente
     */
    public function setFechaasignacion($fechaasignacion)
    {
        $this->fechaasignacion = $fechaasignacion;
    
        return $this;
    }

    /**
     * Get fechaasignacion
     *
     * @return \DateTime
     */
    public function getFechaasignacion()
    {
        return $this->fechaasignacion;
    }

    /**
     * Set idActividad
     *
     * @param \Procuracion\Entity\Actividad $idActividad
     *
     * @return TrabajoExpediente
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
     * Set idExpediente
     *
     * @param \Procuracion\Entity\Expediente $idExpediente
     *
     * @return TrabajoExpediente
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
     * Set idUsuario
     *
     * @param \Procuracion\Entity\Usuario $idUsuario
     *
     * @return TrabajoExpediente
     */
    public function setIdUsuario(\Procuracion\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;
    
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
     * Set idUsuarioAsigna
     *
     * @param \Procuracion\Entity\Usuario $idUsuarioAsigna
     *
     * @return TrabajoExpediente
     */
    public function setIdUsuarioAsigna(\Procuracion\Entity\Usuario $idUsuarioAsigna = null)
    {
        $this->idUsuarioAsigna = $idUsuarioAsigna;
    
        return $this;
    }

    /**
     * Get idUsuarioAsigna
     *
     * @return \Procuracion\Entity\Usuario
     */
    public function getIdUsuarioAsigna()
    {
        return $this->idUsuarioAsigna;
    }
}
