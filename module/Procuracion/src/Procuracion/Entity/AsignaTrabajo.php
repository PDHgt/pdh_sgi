<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsignaTrabajo
 *
 * @ORM\Table(name="asigna_trabajo", indexes={@ORM\Index(name="fk_trabajo", columns={"id_trabajo"}), @ORM\Index(name="fk_asignado", columns={"id_usuario_asignado"}), @ORM\Index(name="fk_asigna", columns={"id_usuario_asigna"})})
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
     * @var \Procuracion\Entity\TrabajoExpediente
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\TrabajoExpediente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trabajo", referencedColumnName="id")
     * })
     */
    private $idTrabajo;

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
     * Set idTrabajo
     *
     * @param \Procuracion\Entity\TrabajoExpediente $idTrabajo
     *
     * @return AsignaTrabajo
     */
    public function setIdTrabajo(\Procuracion\Entity\TrabajoExpediente $idTrabajo = null) {
        $this->idTrabajo = $idTrabajo;

        return $this;
    }

    /**
     * Get idTrabajo
     *
     * @return \Procuracion\Entity\TrabajoExpediente
     */
    public function getIdTrabajo() {
        return $this->idTrabajo;
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
