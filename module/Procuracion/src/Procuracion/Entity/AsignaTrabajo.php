<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsignaTrabajo
 *
 * @ORM\Table(name="asigna_trabajo", indexes={@ORM\Index(name="fk_etapa", columns={"id_etapa"}),@ORM\Index(name="fk_asignado", columns={"id_usuario_asignado"}), @ORM\Index(name="fk_asigna", columns={"id_usuario_asigna"})})
 * @ORM\Entity
 */
class AsignaTrabajo {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Procuracion\Entity\Etapa
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Etapa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_etapa", referencedColumnName="id")
     * })
     */
    private $idEtapa;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_expediente_cola", type="integer", nullable=true)
     *
     */
    private $idExpedienteCola;

    /**
     * @var \Procuracion\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_asignado", referencedColumnName="id")
     * })
     */
    private $idUsuarioAsignado;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asignacion", type="datetime", nullable=true)
     */
    private $fechaasignacion;

    /**
     * @var string
     *
     * @ORM\Column(name="funcion", type="string", length=255, nullable=true)
     */
    private $funcion;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idEtapa
     *
     * @param \Procuracion\Entity\Etapa $idEtapa
     *
     * @return AsignaTrabajo
     */
    public function setIdEtapa(\Procuracion\Entity\Etapa $idEtapa = null) {
        $this->idEtapa = $idEtapa;

        return $this;
    }

    /**
     * Get idEtapa
     *
     * @return \Procuracion\Entity\Etapa
     */
    public function getIdEtapa() {
        return $this->idEtapa;
    }

    /**
     * Set idExpedienteCola
     *
     * @param integer
     *
     * @return AsignaTrabajo
     */
    public function setIdExpedienteCola($id) {
        $this->idExpedienteCola = $id;

        return $this;
    }

    /**
     * Get idExpedienteCola
     *
     * @return integer
     */
    public function getIdExpedienteCola() {
        return $this->idExpedienteCola;
    }

    /**
     * Set idUsuarioAsignado
     *
     * @param \Procuracion\Entity\Usuario $idUsuario
     *
     * @return AsignaTrabajo
     */
    public function setIdUsuarioAsignado(\Procuracion\Entity\Usuario $idUsuario = null) {
        $this->idUsuarioAsignado = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuarioAsignado
     *
     * @return \Procuracion\Entity\Usuario
     */
    public function getIdUsuarioAsignado() {
        return $this->idUsuarioAsignado;
    }

    /**
     * Set idUsuarioAsigna
     *
     * @param \Procuracion\Entity\Usuario $idUsuarioAsigna
     *
     * @return AsignaTrabajo
     */
    public function setIdUsuarioAsigna(\Procuracion\Entity\Usuario $idUsuarioAsigna = null) {
        $this->idUsuarioAsigna = $idUsuarioAsigna;

        return $this;
    }

    /**
     * Get idUsuarioAsigna
     *
     * @return \Procuracion\Entity\Usuario
     */
    public function getIdUsuarioAsigna() {
        return $this->idUsuarioAsigna;
    }

    /**
     * Set fechaasignacion
     *
     * @param \DateTime $fechaasignacion
     *
     * @return TrabajoExpediente
     */
    public function setFechaasignacion($fechaasignacion) {
        $this->fechaasignacion = $fechaasignacion;

        return $this;
    }

    /**
     * Get fechaasignacion
     *
     * @return \DateTime
     */
    public function getFechaasignacion() {
        return $this->fechaasignacion;
    }

    /**
     * Set funcion
     *
     * @param string
     *
     * @return AsignaTrabajo
     */
    public function setFuncion($funcion) {
        $this->funcion = $funcion;

        return $this;
    }

    /**
     * Get funcion
     *
     * @return string
     */
    public function getFuncion() {
        return $this->funcion;
    }

}
