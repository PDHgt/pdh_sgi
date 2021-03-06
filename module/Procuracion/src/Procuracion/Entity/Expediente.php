<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expediente
 *
 * @ORM\Table(name="expediente", indexes={@ORM\Index(name="id_cola", columns={"id_cola"}), @ORM\Index(name="id_tipo", columns={"id_tipo"}), @ORM\Index(name="id_sede", columns={"id_sede"}), @ORM\Index(name="DeptoHechos", columns={"DeptoHechos"}), @ORM\Index(name="MuniHechos", columns={"MuniHechos"}), @ORM\Index(name="Area", columns={"Area"}), @ORM\Index(name="Reportado", columns={"ReportadoAnteriormente"})})
 * @ORM\Entity
 * @ORM\EntityListeners({"Procuracion\Listener\ExpedienteListener"})
 */
class Expediente {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Numero", type="string", length=255, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="Hechos", type="text", nullable=true)
     */
    private $hechos;

    /**
     * @var string
     *
     * @ORM\Column(name="LugarHechos", type="text", length=65535, nullable=true)
     */
    private $lugarhechos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaHechos", type="date", nullable=true)
     */
    private $fechahechos;

    /**
     * @var string
     *
     * @ORM\Column(name="Peticion", type="text", length=65535, nullable=true)
     */
    private $peticion;

    /**
     * @var string
     *
     * @ORM\Column(name="Pruebas", type="text", length=65535, nullable=true)
     */
    private $pruebas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaIngreso", type="date", nullable=true)
     */
    private $fechaingreso;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoAgresion", type="string", length=255, nullable=true)
     */
    private $tipoagresion;

    /**
     * @var string
     *
     * @ORM\Column(name="ReportadoEn", type="string", length=255, nullable=true)
     */
    private $reportadoen;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Area", referencedColumnName="id")
     * })
     */
    private $area;

    /**
     * @var \Procuracion\Entity\Departamento
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Departamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DeptoHechos", referencedColumnName="id")
     * })
     */
    private $deptohechos;

    /**
     * @var \Procuracion\Entity\Municipio
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MuniHechos", referencedColumnName="id")
     * })
     */
    private $munihechos;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ReportadoAnteriormente", referencedColumnName="id")
     * })
     */
    private $reportadoanteriormente;

    /**
     * @var \Procuracion\Entity\ColaRecepcion
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\ColaRecepcion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cola", referencedColumnName="id")
     * })
     */
    private $idCola;

    /**
     * @var \Procuracion\Entity\Sede
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Sede")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sede", referencedColumnName="id")
     * })
     */
    private $idSede;

    /**
     * @var \Procuracion\Entity\TipoExpediente
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\TipoExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo", referencedColumnName="id")
     * })
     */
    private $idTipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="Correlativo", type="integer", nullable=true)
     */
    private $correlativo;

    /**
     * @var integer
     *
     * @ORM\Column(name="Anio", type="integer", nullable=true)
     */
    private $anio;

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
     * Set numero
     *
     * @param string $numero
     *
     * @return Expediente
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set hechos
     *
     * @param string $hechos
     *
     * @return Expediente
     */
    public function setHechos($hechos) {
        $this->hechos = $hechos;

        return $this;
    }

    /**
     * Get hechos
     *
     * @return string
     */
    public function getHechos() {
        return $this->hechos;
    }

    /**
     * Set lugarhechos
     *
     * @param string $lugarhechos
     *
     * @return Expediente
     */
    public function setLugarhechos($lugarhechos) {
        $this->lugarhechos = $lugarhechos;

        return $this;
    }

    /**
     * Get lugarhechos
     *
     * @return string
     */
    public function getLugarhechos() {
        return $this->lugarhechos;
    }

    /**
     * Set fechahechos
     *
     * @param \DateTime $fechahechos
     *
     * @return Expediente
     */
    public function setFechahechos($fechahechos) {
        $this->fechahechos = $fechahechos;

        return $this;
    }

    /**
     * Get fechahechos
     *
     * @return \DateTime
     */
    public function getFechahechos() {
        return $this->fechahechos;
    }

    /**
     * Set peticion
     *
     * @param string $peticion
     *
     * @return Expediente
     */
    public function setPeticion($peticion) {
        $this->peticion = $peticion;

        return $this;
    }

    /**
     * Get peticion
     *
     * @return string
     */
    public function getPeticion() {
        return $this->peticion;
    }

    /**
     * Set pruebas
     *
     * @param string $pruebas
     *
     * @return Expediente
     */
    public function setPruebas($pruebas) {
        $this->pruebas = $pruebas;

        return $this;
    }

    /**
     * Get pruebas
     *
     * @return string
     */
    public function getPruebas() {
        return $this->pruebas;
    }

    /**
     * Set fechaingreso
     *
     * @param \DateTime $fechaingreso
     *
     * @return Expediente
     */
    public function setFechaingreso($fechaingreso) {
        $this->fechaingreso = $fechaingreso;

        return $this;
    }

    /**
     * Get fechaingreso
     *
     * @return \DateTime
     */
    public function getFechaingreso() {
        return $this->fechaingreso;
    }

    /**
     * Set tipoagresion
     *
     * @param string $tipoagresion
     *
     * @return Expediente
     */
    public function setTipoagresion($tipoagresion) {
        $this->tipoagresion = $tipoagresion;

        return $this;
    }

    /**
     * Get tipoagresion
     *
     * @return string
     */
    public function getTipoagresion() {
        return $this->tipoagresion;
    }

    /**
     * Set reportadoen
     *
     * @param string $reportadoen
     *
     * @return Expediente
     */
    public function setRerortadoen($reportadoen) {
        $this->reportadoen = $reportadoen;

        return $this;
    }

    /**
     * Get reportadoen
     *
     * @return string
     */
    public function getReportadoen() {
        return $this->reportadoen;
    }

    /**
     * Set area
     *
     * @param \Procuracion\Entity\DetalleCatalogo $area
     *
     * @return Expediente
     */
    public function setArea(\Procuracion\Entity\DetalleCatalogo $area = null) {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getArea() {
        return $this->area;
    }

    /**
     * Set deptohechos
     *
     * @param \Procuracion\Entity\Departamento $deptohechos
     *
     * @return Expediente
     */
    public function setDeptohechos(\Procuracion\Entity\Departamento $deptohechos = null) {
        $this->deptohechos = $deptohechos;

        return $this;
    }

    /**
     * Get deptohechos
     *
     * @return \Procuracion\Entity\Departamento
     */
    public function getDeptohechos() {
        return $this->deptohechos;
    }

    /**
     * Set munihechos
     *
     * @param \Procuracion\Entity\Municipio $munihechos
     *
     * @return Expediente
     */
    public function setMunihechos(\Procuracion\Entity\Municipio $munihechos = null) {
        $this->munihechos = $munihechos;

        return $this;
    }

    /**
     * Get munihechos
     *
     * @return \Procuracion\Entity\Municipio
     */
    public function getMunihechos() {
        return $this->munihechos;
    }

    /**
     * Set reportadoanteriormente
     *
     * @param \Procuracion\Entity\DetalleCatalogo $reportadoanteriormente
     *
     * @return Expediente
     */
    public function setReportadoanteriormente(\Procuracion\Entity\DetalleCatalogo $reportadoanteriormente = null) {
        $this->reportadoanteriormente = $reportadoanteriormente;

        return $this;
    }

    /**
     * Get reportadoanteriormente
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getReportadoanteriormente() {
        return $this->reportadoanteriormente;
    }

    /**
     * Set idCola
     *
     * @param \Procuracion\Entity\ColaRecepcion $idCola
     *
     * @return Expediente
     */
    public function setIdCola(\Procuracion\Entity\ColaRecepcion $idCola = null) {
        $this->idCola = $idCola;

        return $this;
    }

    /**
     * Get idCola
     *
     * @return \Procuracion\Entity\ColaRecepcion
     */
    public function getIdCola() {
        return $this->idCola;
    }

    /**
     * Set idSede
     *
     * @param \Procuracion\Entity\Sede $idSede
     *
     * @return Expediente
     */
    public function setIdSede(\Procuracion\Entity\Sede $idSede = null) {
        $this->idSede = $idSede;

        return $this;
    }

    /**
     * Get idSede
     *
     * @return \Procuracion\Entity\Sede
     */
    public function getIdSede() {
        return $this->idSede;
    }

    /**
     * Set idTipo
     *
     * @param \Procuracion\Entity\TipoExpediente $idTipo
     *
     * @return Expediente
     */
    public function setIdTipo(\Procuracion\Entity\TipoExpediente $idTipo = null) {
        $this->idTipo = $idTipo;

        return $this;
    }

    /**
     * Get idTipo
     *
     * @return \Procuracion\Entity\TipoExpediente
     */
    public function getIdTipo() {
        return $this->idTipo;
    }

    /**
     * Set correlativo
     *
     * @param integer $correlativo
     *
     * @return Expediente
     */
    public function setCorrelativo($correlativo) {
        $this->correlativo = $correlativo;

        return $this;
    }

    /**
     * Get correlativo
     *
     * @return integer
     */
    public function getCorrelativo() {
        return $this->correlativo;
    }

    /**
     * Set anio
     *
     * @param integer $anio
     *
     * @return Expediente
     */
    public function setAnio($anio) {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return integer
     */
    public function getAnio() {
        return $this->anio;
    }

    /**
     * Set updated_by
     *
     * @param \Procuracion\Entity\Usuario $usuario
     *
     * @return Expediente
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
