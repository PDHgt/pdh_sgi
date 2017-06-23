<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visita
 *
 * @ORM\Table(name="visita", indexes={@ORM\Index(name="idPersona", columns={"id_persona"})})
 * @ORM\Entity
 * @ORM\EntityListeners({"Procuracion\Listener\VisitaListener"}) 
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
     * @ORM\Column(name="FechaSalida", type="datetime", nullable=true)
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
    *@ORM\Column(name="LlamadasRealizadas", type="integer", nullable=true)
    */
    private $llamadasrealizadas;

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
     * @var \Procuracion\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id")
     * })
     */
    private $idPersona;

    /**
     * @var \Procuracion\Entity\Empleado
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Empleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Empleado", referencedColumnName="id")
     * })
     */
    private $empleado;

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
     * @param string $notaalsalir
     *
     * @return Visita
     */
    public function setNotaalsalir($notaalsalir)
    {
        $this->notaalsalir = $notaalsalir;
    
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
     * Set llamadasrealizadas
     *
     * @param integer $llamadas
     *
     * @return Visita
     */
    public function setLlamadasRealizadas($llamadas)
    {
        $this->llamadasrealizadas = $llamadas;
    
        return $this;
    }

    /**
     * Get llamadasrealizadas
     *
     * @return integer
     */
    public function getLlamadasRealizadas()
    {
        return $this->llamadasrealizadas;
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

    /**
     * Set idPersona
     *
     * @param \Procuracion\Entity\Persona $idPersona
     *
     * @return Visita
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

    /**
     * Set updated_by
     *
     * @param \Procuracion\Entity\Usuario $usuario
     *
     * @return Colarecepcion
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
}
