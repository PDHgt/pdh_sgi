<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visita
 *
 * @ORM\Table(name="visita")
 * @ORM\Entity
 */
class Visita
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
     * @var integer $idpersona
     *
     * @ORM\ManyToOne(targetEntity="Persona", fetch="EAGER")
     * @ORM\JoinColumn(name="idpersona",referencedColumnName="id")
     */
    private $idpersona;

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
     * @var integer empleado
     *
     * @ORM\OneToOne(targetEntity="Empleado", fetch="EAGER")
     * @ORM\JoinColumn(name="empleado", referencedColumnName="id")
     */
    private $empleado;

    /**
     * @var string
     *
     * @ORM\Column(name="Institucion", type="string", length=255, nullable=true)
     */
    private $institucion;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoInstitucion", type="string", length=255, nullable=true)
     */
    private $tipoinstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="MotivoVisita", type="text", length=65535, nullable=true)
     */
    private $motivovisita;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaSalida", type="date", nullable=true)
     */
    private $fechasalida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HoraSalida", type="time", nullable=true)
     */
    private $horasalida;

    /**
     * @var string
     *
     * @ORM\Column(name="NotaAlSalir", type="text", length=65535, nullable=true)
     */
    private $notaalsalir;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="date", nullable=true)
     */
    private $updatedAt;



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
     * Set idpersona
     *
     * @param integer $idpersona
     *
     * @return Visita
     */
    public function setIdpersona($idpersona)
    {
        $this->idpersona = $idpersona;

        return $this;
    }

    /**
     * Get idpersona
     *
     * @return integer
     */
    public function getIdpersona()
    {
        return $this->idpersona;
    }

    /**
     * Set fechaentrada
     *
     * @param \DateTime $fechaentrada
     *
     * @return Visita
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
     * @return Visita
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
     * @return Visita
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
     * Set empleado
     *
     * @param integer $empleado
     *
     * @return Visita
     */
    public function setEmpleado($empleado)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return integer
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     *
     * @return Visita
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set tipoinstitucion
     *
     * @param string $tipoinstitucion
     *
     * @return Visita
     */
    public function setTipoinstitucion($tipoinstitucion)
    {
        $this->tipoinstitucion = $tipoinstitucion;

        return $this;
    }

    /**
     * Get tipoinstitucion
     *
     * @return string
     */
    public function getTipoinstitucion()
    {
        return $this->tipoinstitucion;
    }

    /**
     * Set motivovisita
     *
     * @param string $motivovisita
     *
     * @return Visita
     */
    public function setMotivovisita($motivovisita)
    {
        $this->motivovisita = $motivovisita;

        return $this;
    }

    /**
     * Get motivovisita
     *
     * @return string
     */
    public function getMotivovisita()
    {
        return $this->motivovisita;
    }

    /**
     * Set fechasalida
     *
     * @param \DateTime $fechasalida
     *
     * @return Visita
     */
    public function setFechasalida($fechasalida)
    {
        $this->fechasalida = $fechasalida;

        return $this;
    }

    /**
     * Get fechasalida
     *
     * @return \DateTime
     */
    public function getFechasalida()
    {
        return $this->fechasalida;
    }

    /**
     * Set horasalida
     *
     * @param \DateTime $horasalida
     *
     * @return Visita
     */
    public function setHorasalida($horasalida)
    {
        $this->horasalida = $horasalida;

        return $this;
    }

    /**
     * Get horasalida
     *
     * @return \DateTime
     */
    public function getHorasalida()
    {
        return $this->horasalida;
    }

    /**
     * Set notaalsalir
     *
     * @param string $nota
     *
     * @return Visita
     */
    public function setNotaalsalir($nota)
    {
        $this->notaalsalir = $nota;

        return $this;
    }

    /**
     * Get notaalsalir
     *
     * @return string
     */
    public function getNotaalsalir()
    {
        return $this->notaalsalir;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Visita
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Visita
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Visita
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}