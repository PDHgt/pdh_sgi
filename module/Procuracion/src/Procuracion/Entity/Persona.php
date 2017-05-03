<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona", indexes={@ORM\Index(name="Depto", columns={"Depto"}), @ORM\Index(name="Muni", columns={"Muni"})})
 * @ORM\Entity
 */
class Persona
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
     * @var integer
     *
     * @ORM\Column(name="Anonimo", type="integer", nullable=true)
     */
    private $anonimo;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombres", type="string", length=100, nullable=false)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellidos", type="string", length=100, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoDocumento", type="string", length=50, nullable=false)
     */
    private $tipodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="NumeroDocumento", type="string", length=50, nullable=false)
     */
    private $numerodocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="Sexo", type="integer", nullable=true)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="LGBTI", type="string", length=2, nullable=true)
     */
    private $lgbti;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaNacimiento", type="date", nullable=true)
     */
    private $fechanacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="Edad", type="integer", nullable=true)
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var \Procuracion\Entity\Departamento
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Departamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Depto", referencedColumnName="Codigo")
     * })
     */
    private $depto;

    /**
     * @var \Procuracion\Entity\Municipio
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Muni", referencedColumnName="Codigo")
     * })
     */
    private $muni;



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
     * Set anonimo
     *
     * @param integer $anonimo
     *
     * @return Persona
     */
    public function setAnonimo($anonimo)
    {
        $this->anonimo = $anonimo;
    
        return $this;
    }

    /**
     * Get anonimo
     *
     * @return integer
     */
    public function getAnonimo()
    {
        return $this->anonimo;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Persona
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Persona
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set tipodocumento
     *
     * @param string $tipodocumento
     *
     * @return Persona
     */
    public function setTipodocumento($tipodocumento)
    {
        $this->tipodocumento = $tipodocumento;
    
        return $this;
    }

    /**
     * Get tipodocumento
     *
     * @return string
     */
    public function getTipodocumento()
    {
        return $this->tipodocumento;
    }

    /**
     * Set numerodocumento
     *
     * @param string $numerodocumento
     *
     * @return Persona
     */
    public function setNumerodocumento($numerodocumento)
    {
        $this->numerodocumento = $numerodocumento;
    
        return $this;
    }

    /**
     * Get numerodocumento
     *
     * @return string
     */
    public function getNumerodocumento()
    {
        return $this->numerodocumento;
    }

    /**
     * Set sexo
     *
     * @param integer $sexo
     *
     * @return Persona
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    
        return $this;
    }

    /**
     * Get sexo
     *
     * @return integer
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set lgbti
     *
     * @param string $lgbti
     *
     * @return Persona
     */
    public function setLgbti($lgbti)
    {
        $this->lgbti = $lgbti;
    
        return $this;
    }

    /**
     * Get lgbti
     *
     * @return string
     */
    public function getLgbti()
    {
        return $this->lgbti;
    }

    /**
     * Set fechanacimiento
     *
     * @param \DateTime $fechanacimiento
     *
     * @return Persona
     */
    public function setFechanacimiento($fechanacimiento)
    {
        $this->fechanacimiento = $fechanacimiento;
    
        return $this;
    }

    /**
     * Get fechanacimiento
     *
     * @return \DateTime
     */
    public function getFechanacimiento()
    {
        return $this->fechanacimiento;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Persona
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    
        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Persona
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set depto
     *
     * @param \Procuracion\Entity\Departamento $depto
     *
     * @return Persona
     */
    public function setDepto(\Procuracion\Entity\Departamento $depto = null)
    {
        $this->depto = $depto;
    
        return $this;
    }

    /**
     * Get depto
     *
     * @return \Procuracion\Entity\Departamento
     */
    public function getDepto()
    {
        return $this->depto;
    }

    /**
     * Set muni
     *
     * @param \Procuracion\Entity\Municipio $muni
     *
     * @return Persona
     */
    public function setMuni(\Procuracion\Entity\Municipio $muni = null)
    {
        $this->muni = $muni;
    
        return $this;
    }

    /**
     * Get muni
     *
     * @return \Procuracion\Entity\Municipio
     */
    public function getMuni()
    {
        return $this->muni;
    }
}
