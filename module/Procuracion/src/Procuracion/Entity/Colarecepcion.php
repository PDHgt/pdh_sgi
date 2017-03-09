<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Colarecepcion
 *
 * @ORM\Table(name="colarecepcion", indexes={@ORM\Index(name="id_persona", columns={"id_persona"})})
 * @ORM\Entity
 */
class Colarecepcion
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
     * @ORM\Column(name="FechaEntrada", type="date", nullable=true)
     */
    private $fechaentrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HoraEntrada", type="time", nullable=true)
     */
    private $horaentrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="Sede", type="integer", nullable=true)
     */
    private $sede;

    /**
     * @var string
     *
     * @ORM\Column(name="Prioridad", type="string", length=20, nullable=true)
     */
    private $prioridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="LapiceroVerde", type="integer", nullable=true)
     */
    private $lapiceroverde;

    /**
     * @var string
     *
     * @ORM\Column(name="Turno", type="string", length=11, nullable=true)
     */
    private $turno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HoraAtencion", type="time", nullable=true)
     */
    private $horaatencion;

    /**
     * @var string
     *
     * @ORM\Column(name="Observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="RazonSalida", type="string", length=50, nullable=true)
     */
    private $razonsalida;

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
     * Set fechaentrada
     *
     * @param \DateTime $fechaentrada
     *
     * @return Colarecepcion
     */
    public function setFechaentrada($fechaentrada)
    {
        $this->fechaentrada = $fechaentrada;
    
        return $this;
    }

    /**
     * Get fechaentrada
     *
     * @return \DateTime
     */
    public function getFechaentrada()
    {
        return $this->fechaentrada;
    }

    /**
     * Set horaentrada
     *
     * @param \DateTime $horaentrada
     *
     * @return Colarecepcion
     */
    public function setHoraentrada($horaentrada)
    {
        $this->horaentrada = $horaentrada;
    
        return $this;
    }

    /**
     * Get horaentrada
     *
     * @return \DateTime
     */
    public function getHoraentrada()
    {
        return $this->horaentrada;
    }

    /**
     * Set sede
     *
     * @param integer $sede
     *
     * @return Colarecepcion
     */
    public function setSede($sede)
    {
        $this->sede = $sede;
    
        return $this;
    }

    /**
     * Get sede
     *
     * @return integer
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * Set prioridad
     *
     * @param string $prioridad
     *
     * @return Colarecepcion
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;
    
        return $this;
    }

    /**
     * Get prioridad
     *
     * @return string
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set lapiceroverde
     *
     * @param integer $lapiceroverde
     *
     * @return Colarecepcion
     */
    public function setLapiceroverde($lapiceroverde)
    {
        $this->lapiceroverde = $lapiceroverde;
    
        return $this;
    }

    /**
     * Get lapiceroverde
     *
     * @return integer
     */
    public function getLapiceroverde()
    {
        return $this->lapiceroverde;
    }

    /**
     * Set turno
     *
     * @param string $turno
     *
     * @return Colarecepcion
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;
    
        return $this;
    }

    /**
     * Get turno
     *
     * @return string
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Set horaatencion
     *
     * @param \DateTime $horaatencion
     *
     * @return Colarecepcion
     */
    public function setHoraatencion($horaatencion)
    {
        $this->horaatencion = $horaatencion;
    
        return $this;
    }

    /**
     * Get horaatencion
     *
     * @return \DateTime
     */
    public function getHoraatencion()
    {
        return $this->horaatencion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Colarecepcion
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set razonsalida
     *
     * @param string $razonsalida
     *
     * @return Colarecepcion
     */
    public function setRazonsalida($razonsalida)
    {
        $this->razonsalida = $razonsalida;
    
        return $this;
    }

    /**
     * Get razonsalida
     *
     * @return string
     */
    public function getRazonsalida()
    {
        return $this->razonsalida;
    }

    /**
     * Set idPersona
     *
     * @param \Procuracion\Entity\Persona $idPersona
     *
     * @return Colarecepcion
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
