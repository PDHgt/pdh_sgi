<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permisoperfilaccion
 *
 * @ORM\Table(name="permisoperfilaccion", indexes={@ORM\Index(name="id_perfil", columns={"id_perfil"}), @ORM\Index(name="id_accion", columns={"id_accion"})})
 * @ORM\Entity
 */
class Permisoperfilaccion {

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
     * @ORM\Column(name="Permisos", type="string", length=20, nullable=true)
     */
    private $permisos;

    /**
     * @var \Procuracion\Entity\Accion
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Accion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_accion", referencedColumnName="id")
     * })
     */
    private $idAccion;

    /**
     * @var \Procuracion\Entity\Perfil
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Perfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_perfil", referencedColumnName="id")
     * })
     */
    private $idPerfil;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set permisos
     *
     * @param string $permisos
     *
     * @return Permisoperfilaccion
     */
    public function setPermisos($permisos) {
        $this->permisos = $permisos;

        return $this;
    }

    /**
     * Get permisos
     *
     * @return string
     */
    public function getPermisos() {
        return $this->permisos;
    }

    /**
     * Set idAccion
     *
     * @param \Procuracion\Entity\Accion $idAccion
     *
     * @return Permisoperfilaccion
     */
    public function setIdAccion(\Procuracion\Entity\Accion $idAccion = null) {
        $this->idAccion = $idAccion;

        return $this;
    }

    /**
     * Get idAccion
     *
     * @return \Procuracion\Entity\Accion
     */
    public function getIdAccion() {
        return $this->idAccion;
    }

    /**
     * Set idPerfil
     *
     * @param \Procuracion\Entity\Perfil $idPerfil
     *
     * @return Permisoperfilaccion
     */
    public function setIdPerfil(\Procuracion\Entity\Perfil $idPerfil = null) {
        $this->idPerfil = $idPerfil;

        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return \Procuracion\Entity\Perfil
     */
    public function getIdPerfil() {
        return $this->idPerfil;
    }

}
