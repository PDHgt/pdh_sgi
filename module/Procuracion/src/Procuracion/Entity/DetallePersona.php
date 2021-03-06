<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetallePersona
 *
 * @ORM\Table(name="detalle_persona", indexes={@ORM\Index(name="id_per", columns={"id_persona"}), @ORM\Index(name="Alfabeta", columns={"Alfabeta"}), @ORM\Index(name="Escolaridad", columns={"Escolaridad"}), @ORM\Index(name="EstadoConyugal", columns={"EstadoConyugal"}), @ORM\Index(name="PuebloPertenencia", columns={"PuebloPertenencia"}), @ORM\Index(name="nacionalidad", columns={"nacionalidad"}), @ORM\Index(name="Trabaja", columns={"Trabaja"}), @ORM\Index(name="Ocupacion", columns={"Ocupacion"}), @ORM\Index(name="Dedicacion", columns={"Dedicacion"}), @ORM\Index(name="Discapacidad", columns={"Discapacidad"}), @ORM\Index(name="TipoDiscapacidad", columns={"TipoDiscapacidad"})})
 * @ORM\Entity
 */
class DetallePersona
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
     *   @ORM\JoinColumn(name="Alfabeta", referencedColumnName="id")
     * })
     */
    private $alfabeta;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Dedicacion", referencedColumnName="id")
     * })
     */
    private $dedicacion;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Discapacidad", referencedColumnName="id")
     * })
     */
    private $discapacidad;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Escolaridad", referencedColumnName="id")
     * })
     */
    private $escolaridad;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EstadoConyugal", referencedColumnName="id")
     * })
     */
    private $estadoconyugal;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nacionalidad", referencedColumnName="id")
     * })
     */
    private $nacionalidad;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ocupacion", referencedColumnName="id")
     * })
     */
    private $ocupacion;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PuebloPertenencia", referencedColumnName="id")
     * })
     */
    private $pueblopertenencia;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TipoDiscapacidad", referencedColumnName="id")
     * })
     */
    private $tipodiscapacidad;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Trabaja", referencedColumnName="id")
     * })
     */
    private $trabaja;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ComunidadLinguistica", referencedColumnName="id")
     * })
     */
    private $comunidadLinguistica;

    /**
     * @var string
     *
     * @ORM\Column(name="Cargo", type="string", length=255, nullable=false)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="Institucion", type="string", length=255, nullable=false)
     */
    private $institucion;

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
     * Set alfabeta
     *
     * @param \Procuracion\Entity\DetalleCatalogo $alfabeta
     *
     * @return DetallePersona
     */
    public function setAlfabeta(\Procuracion\Entity\DetalleCatalogo $alfabeta = null)
    {
        $this->alfabeta = $alfabeta;
    
        return $this;
    }

    /**
     * Get alfabeta
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getAlfabeta()
    {
        return $this->alfabeta;
    }

    /**
     * Set dedicacion
     *
     * @param \Procuracion\Entity\DetalleCatalogo $dedicacion
     *
     * @return DetallePersona
     */
    public function setDedicacion(\Procuracion\Entity\DetalleCatalogo $dedicacion = null)
    {
        $this->dedicacion = $dedicacion;
    
        return $this;
    }

    /**
     * Get dedicacion
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getDedicacion()
    {
        return $this->dedicacion;
    }

    /**
     * Set discapacidad
     *
     * @param \Procuracion\Entity\DetalleCatalogo $discapacidad
     *
     * @return DetallePersona
     */
    public function setDiscapacidad(\Procuracion\Entity\DetalleCatalogo $discapacidad = null)
    {
        $this->discapacidad = $discapacidad;
    
        return $this;
    }

    /**
     * Get discapacidad
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getDiscapacidad()
    {
        return $this->discapacidad;
    }

    /**
     * Set escolaridad
     *
     * @param \Procuracion\Entity\DetalleCatalogo $escolaridad
     *
     * @return DetallePersona
     */
    public function setEscolaridad(\Procuracion\Entity\DetalleCatalogo $escolaridad = null)
    {
        $this->escolaridad = $escolaridad;
    
        return $this;
    }

    /**
     * Get escolaridad
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getEscolaridad()
    {
        return $this->escolaridad;
    }

    /**
     * Set estadoconyugal
     *
     * @param \Procuracion\Entity\DetalleCatalogo $estadoconyugal
     *
     * @return DetallePersona
     */
    public function setEstadoconyugal(\Procuracion\Entity\DetalleCatalogo $estadoconyugal = null)
    {
        $this->estadoconyugal = $estadoconyugal;
    
        return $this;
    }

    /**
     * Get estadoconyugal
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getEstadoconyugal()
    {
        return $this->estadoconyugal;
    }

    /**
     * Set nacionalidad
     *
     * @param \Procuracion\Entity\DetalleCatalogo $nacionalidad
     *
     * @return DetallePersona
     */
    public function setnacionalidad(\Procuracion\Entity\DetalleCatalogo $nacionalidad = null)
    {
        $this->nacionalidad = $nacionalidad;
    
        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getnacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set ocupacion
     *
     * @param \Procuracion\Entity\DetalleCatalogo $ocupacion
     *
     * @return DetallePersona
     */
    public function setOcupacion(\Procuracion\Entity\DetalleCatalogo $ocupacion = null)
    {
        $this->ocupacion = $ocupacion;
    
        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set pueblopertenencia
     *
     * @param \Procuracion\Entity\DetalleCatalogo $pueblopertenencia
     *
     * @return DetallePersona
     */
    public function setPueblopertenencia(\Procuracion\Entity\DetalleCatalogo $pueblopertenencia = null)
    {
        $this->pueblopertenencia = $pueblopertenencia;
    
        return $this;
    }

    /**
     * Get pueblopertenencia
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getPueblopertenencia()
    {
        return $this->pueblopertenencia;
    }

    /**
     * Set tipodiscapacidad
     *
     * @param \Procuracion\Entity\DetalleCatalogo $tipodiscapacidad
     *
     * @return DetallePersona
     */
    public function setTipodiscapacidad(\Procuracion\Entity\DetalleCatalogo $tipodiscapacidad = null)
    {
        $this->tipodiscapacidad = $tipodiscapacidad;
    
        return $this;
    }

    /**
     * Get tipodiscapacidad
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getTipodiscapacidad()
    {
        return $this->tipodiscapacidad;
    }

    /**
     * Set trabaja
     *
     * @param \Procuracion\Entity\DetalleCatalogo $trabaja
     *
     * @return DetallePersona
     */
    public function setTrabaja(\Procuracion\Entity\DetalleCatalogo $trabaja = null)
    {
        $this->trabaja = $trabaja;
    
        return $this;
    }

    /**
     * Get trabaja
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getTrabaja()
    {
        return $this->trabaja;
    }

    /**
     * Set comunidadLinguistica
     *
     * @param \Procuracion\Entity\DetalleCatalogo $comu
     *
     * @return DetallePersona
     */
    public function setComunidadLinguistica(\Procuracion\Entity\DetalleCatalogo $comu = null)
    {
        $this->comunidadLinguistica = $comu;
    
        return $this;
    }

    /**
     * Get comunidadLinguistica
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getComunidadLinguistica()
    {
        return $this->comunidadLinguistica;
    }

    /**
     * Set cargo
     *
     * @param string $nombres
     *
     * @return Persona
     */
    public function setCargo($nombres)
    {
        $this->cargo = $nombres;
    
        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set institucion
     *
     * @param string $nombres
     *
     * @return Persona
     */
    public function setInstitucion($nombres)
    {
        $this->institucion = $nombres;
    
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
     * Set idPersona
     *
     * @param \Procuracion\Entity\Persona $idPersona
     *
     * @return DetallePersona
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
