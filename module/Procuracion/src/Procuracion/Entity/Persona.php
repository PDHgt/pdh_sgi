<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona", indexes={@ORM\Index(name="Depto", columns={"Depto"}), @ORM\Index(name="Muni", columns={"Muni"}), @ORM\Index(name="persona_ibfk_3", columns={"updated_by"})})
 * @ORM\Entity
 * @ORM\EntityListeners({"Procuracion\Listener\PersonaListener"})
 */
class Persona {

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
     * @var integer
     *
     * @ORM\Column(name="TipoPersona", type="integer", nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreColectivo", type="string", length=255, nullable=true)
     */
    private $nombreColectivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NombreContacto", type="string", length=255, nullable=true)
     */
    private $nombreContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombres", type="string", length=100, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellidos", type="string", length=100, nullable=true)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoDocumento", type="string", length=50, nullable=true)
     */
    private $tipodocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="NumeroDocumento", type="string", length=50, nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="NombreUsual", type="string", length=255, nullable=true)
     */
    private $nombreUsual;

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
     *   @ORM\JoinColumn(name="Depto", referencedColumnName="id")
     * })
     */
    private $depto;

    /**
     * @var \Procuracion\Entity\Municipio
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Muni", referencedColumnName="id")
     * })
     */
    private $muni;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefono", type="string", length=25, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="CorreoElectronico", type="string", length=100, nullable=true)
     */
    private $correoElectronico;

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
     * Set anonimo
     *
     * @param integer $anonimo
     *
     * @return Persona
     */
    public function setAnonimo($anonimo) {
        $this->anonimo = $anonimo;

        return $this;
    }

    /**
     * Get anonimo
     *
     * @return integer
     */
    public function getAnonimo() {
        return $this->anonimo;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Persona
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Persona
     */
    public function setNombres($nombres) {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres() {
        return $this->nombres;
    }

    /**
     * Set nombreColectivo
     *
     * @param string $nombres
     *
     * @return Persona
     */
    public function setNombreColectivo($nombres) {
        $this->nombreColectivo = $nombres;

        return $this;
    }

    /**
     * Get nombreColectivo
     *
     * @return string
     */
    public function getNombreColectivo() {
        return $this->nombreColectivo;
    }

    /**
     * Set nombreContacto
     *
     * @param string $nombrecontacto
     *
     * @return Persona
     */
    public function setNombreContacto($nombrecontacto) {
        $this->nombreContacto = $nombrecontacto;

        return $this;
    }

    /**
     * Get nombreContacto
     *
     * @return string
     */
    public function getNombreContacto() {
        return $this->nombreContacto;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Persona
     */
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos() {
        return $this->apellidos;
    }

    /**
     * Set tipodocumento
     *
     * @param string $tipodocumento
     *
     * @return Persona
     */
    public function setTipodocumento($tipodocumento) {
        $this->tipodocumento = $tipodocumento;

        return $this;
    }

    /**
     * Get tipodocumento
     *
     * @return string
     */
    public function getTipodocumento() {
        return $this->tipodocumento;
    }

    /**
     * Set numerodocumento
     *
     * @param string $numerodocumento
     *
     * @return Persona
     */
    public function setNumerodocumento($numerodocumento) {
        $this->numerodocumento = $numerodocumento;

        return $this;
    }

    /**
     * Get numerodocumento
     *
     * @return string
     */
    public function getNumerodocumento() {
        return $this->numerodocumento;
    }

    /**
     * Set sexo
     *
     * @param integer $sexo
     *
     * @return Persona
     */
    public function setSexo($sexo) {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return integer
     */
    public function getSexo() {
        return $this->sexo;
    }

    /**
     * Set lgbti
     *
     * @param string $lgbti
     *
     * @return Persona
     */
    public function setLgbti($lgbti) {
        $this->lgbti = $lgbti;

        return $this;
    }

    /**
     * Get lgbti
     *
     * @return string
     */
    public function getLgbti() {
        return $this->lgbti;
    }

    /**
     * Set nombreUsual
     *
     * @param string $nombreusual
     *
     * @return Persona
     */
    public function setNombreUsual($nombreusual) {
        $this->nombreUsual = $nombreusual;

        return $this;
    }

    /**
     * Get nombreUsual
     *
     * @return string
     */
    public function getNombreUsual() {
        return $this->nombreUsual;
    }

    /**
     * Set fechanacimiento
     *
     * @param \DateTime $fechanacimiento
     *
     * @return Persona
     */
    public function setFechanacimiento($fechanacimiento) {
        $this->fechanacimiento = $fechanacimiento;

        return $this;
    }

    /**
     * Get fechanacimiento
     *
     * @return \DateTime
     */
    public function getFechanacimiento() {
        return $this->fechanacimiento;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Persona
     */
    public function setEdad($edad) {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad() {
        return $this->edad;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Persona
     */
    public function setDireccion($direccion) {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set depto
     *
     * @param \Procuracion\Entity\Departamento $depto
     *
     * @return Persona
     */
    public function setDepto(\Procuracion\Entity\Departamento $depto = null) {
        $this->depto = $depto;

        return $this;
    }

    /**
     * Get depto
     *
     * @return \Procuracion\Entity\Departamento
     */
    public function getDepto() {
        return $this->depto;
    }

    /**
     * Set muni
     *
     * @param \Procuracion\Entity\Municipio $muni
     *
     * @return Persona
     */
    public function setMuni(\Procuracion\Entity\Municipio $muni = null) {
        $this->muni = $muni;

        return $this;
    }

    /**
     * Get muni
     *
     * @return \Procuracion\Entity\Municipio
     */
    public function getMuni() {
        return $this->muni;
    }

    /**
     * Set telefono
     *
     * @param string $numero
     *
     * @return Persona
     */
    public function setTelefono($numero) {
        $this->telefono = $numero;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set correoElectronico
     *
     * @param string $correo
     *
     * @return Persona
     */
    public function setCorreoElectronico($correo) {
        $this->correoElectronico = $correo;

        return $this;
    }

    /**
     * Get correoElectronico
     *
     * @return string
     */
    public function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    /**
     * Set updated_by
     *
     * @param \Procuracion\Entity\Usuario $usuario
     *
     * @return Colarecepcion
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
