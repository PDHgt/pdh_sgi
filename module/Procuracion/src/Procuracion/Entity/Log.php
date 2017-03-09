<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log", indexes={@ORM\Index(name="id_accion_log", columns={"id_accion_log"}), @ORM\Index(name="quien", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Log
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
     * @ORM\Column(name="Fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="ValorAnterior", type="string", length=255, nullable=true)
     */
    private $valoranterior;

    /**
     * @var string
     *
     * @ORM\Column(name="NuevoValor", type="string", length=255, nullable=true)
     */
    private $nuevovalor;

    /**
     * @var \Procuracion\Entity\AccionLog
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\AccionLog")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_accion_log", referencedColumnName="id")
     * })
     */
    private $idAccionLog;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Log
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
     * Set valoranterior
     *
     * @param string $valoranterior
     *
     * @return Log
     */
    public function setValoranterior($valoranterior)
    {
        $this->valoranterior = $valoranterior;
    
        return $this;
    }

    /**
     * Get valoranterior
     *
     * @return string
     */
    public function getValoranterior()
    {
        return $this->valoranterior;
    }

    /**
     * Set nuevovalor
     *
     * @param string $nuevovalor
     *
     * @return Log
     */
    public function setNuevovalor($nuevovalor)
    {
        $this->nuevovalor = $nuevovalor;
    
        return $this;
    }

    /**
     * Get nuevovalor
     *
     * @return string
     */
    public function getNuevovalor()
    {
        return $this->nuevovalor;
    }

    /**
     * Set idAccionLog
     *
     * @param \Procuracion\Entity\AccionLog $idAccionLog
     *
     * @return Log
     */
    public function setIdAccionLog(\Procuracion\Entity\AccionLog $idAccionLog = null)
    {
        $this->idAccionLog = $idAccionLog;
    
        return $this;
    }

    /**
     * Get idAccionLog
     *
     * @return \Procuracion\Entity\AccionLog
     */
    public function getIdAccionLog()
    {
        return $this->idAccionLog;
    }

    /**
     * Set idUsuario
     *
     * @param \Procuracion\Entity\Usuario $idUsuario
     *
     * @return Log
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
}
