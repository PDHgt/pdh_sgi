<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Events;

/**
 * ColaRecepcion
 *
 * @ORM\Table(name="colarecepcion", indexes={@ORM\Index(name="id_persona", columns={"id_persona"})})
 * @ORM\Entity
 * @ORM\EntityListeners({"Procuracion\Listener\ColaListener"})
 *
 */
class ColaRecepcion {

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
     * @ORM\Column(name="FechaEntrada", type="datetime", nullable=true)
     */
    private $fechaentrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HoraEntrada", type="time", nullable=true)
     */
    private $horaentrada;

    /**
     * @var \Procuracion\Entity\Sede
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Sede")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Sede", referencedColumnName="id")
     * })
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
     * @ORM\Column(name="HoraAtencion", type="datetime", nullable=true)
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
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fechaentrada
     *
     * @param \DateTime $fechaentrada
     *
     * @return ColaRecepcion
     */
    public function setFechaentrada($fechaentrada) {
        $this->fechaentrada = $fechaentrada;

        return $this;
    }

    /**
     * Get fechaentrada
     *
     * @return \DateTime
     */
    public function getFechaentrada() {
        return $this->fechaentrada;
    }

    /**
     * Set horaentrada
     *
     * @param \DateTime $horaentrada
     *
     * @return ColaRecepcion
     */
    public function setHoraentrada($horaentrada) {
        $this->horaentrada = $horaentrada;

        return $this;
    }

    /**
     * Get horaentrada
     *
     * @return \DateTime
     */
    public function getHoraentrada() {
        return $this->horaentrada;
    }

    /**
     * Set sede
     *
     * @param integer $sede
     *
     * @return ColaRecepcion
     */
    public function setSede($sede) {
        $this->sede = $sede;

        return $this;
    }

    /**
     * Get sede
     *
     * @return integer
     */
    public function getSede() {
        return $this->sede;
    }

    /**
     * Set prioridad
     *
     * @param string $prioridad
     *
     * @return ColaRecepcion
     */
    public function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return string
     */
    public function getPrioridad() {
        return $this->prioridad;
    }

    /**
     * Set lapiceroverde
     *
     * @param integer $lapiceroverde
     *
     * @return ColaRecepcion
     */
    public function setLapiceroverde($lapiceroverde) {
        $this->lapiceroverde = $lapiceroverde;

        return $this;
    }

    /**
     * Get lapiceroverde
     *
     * @return integer
     */
    public function getLapiceroverde() {
        return $this->lapiceroverde;
    }

    /**
     * Set turno
     *
     * @param string $turno
     *
     * @return ColaRecepcion
     */
    public function setTurno($turno) {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return string
     */
    public function getTurno() {
        return $this->turno;
    }

    /**
     * Set horaatencion
     *
     * @param \DateTime $horaatencion
     *
     * @return ColaRecepcion
     */
    public function setHoraatencion($horaatencion) {
        $this->horaatencion = $horaatencion;

        return $this;
    }

    /**
     * Get horaatencion
     *
     * @return \DateTime
     */
    public function getHoraatencion() {
        return $this->horaatencion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return ColaRecepcion
     */
    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones() {
        return $this->observaciones;
    }

    /**
     * Set razonsalida
     *
     * @param string $razonsalida
     *
     * @return ColaRecepcion
     */
    public function setRazonsalida($razonsalida) {
        $this->razonsalida = $razonsalida;

        return $this;
    }

    /**
     * Get razonsalida
     *
     * @return string
     */
    public function getRazonsalida() {
        return $this->razonsalida;
    }

    /**
     * Set idPersona
     *
     * @param \Procuracion\Entity\Persona $idPersona
     *
     * @return ColaRecepcion
     */
    public function setIdPersona(\Procuracion\Entity\Persona $idPersona = null) {
        $this->idPersona = $idPersona;

        return $this;
    }

    /**
     * Get idPersona
     *
     * @return \Procuracion\Entity\Persona
     */
    public function getIdPersona() {
        return $this->idPersona;
    }

    /**
     * Set updated_by
     *
     * @param \Procuracion\Entity\Usuario $usuario
     *
     * @return ColaRecepcion
     */
    public function setUpdatedBy(\Procuracion\Entity\Usuario $usuario = null) {
        $this->updated_by = $usuario;

        return $this;
    }

    /**
     * Get updated_by
     *
     * @return \Procuracion\Entity\Usuario
     */
    public function getUpdatedBy() {
        return $this->updated_by;
    }

}
