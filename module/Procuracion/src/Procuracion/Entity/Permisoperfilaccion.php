<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permisoperfilaccion
 *
 * @ORM\Table(name="permisoperfilaccion")
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
     * @var integer
     *
     * @ORM\Column(name="id_perfil", type="integer", nullable=true)
     */
    private $idPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_accion", type="integer", nullable=true)
     */
    private $idAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_permiso", type="integer", nullable=true)
     */
    private $idPermiso;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return Permisoperfilaccion
     */
    public function setIdPerfil($idPerfil) {
        $this->idPerfil = $idPerfil;

        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer
     */
    public function getIdPerfil() {
        return $this->idPerfil;
    }

    /**
     * Set idAccion
     *
     * @param integer $idAccion
     *
     * @return Permisoperfilaccion
     */
    public function setIdAccion($idAccion) {
        $this->idAccion = $idAccion;

        return $this;
    }

    /**
     * Get idAccion
     *
     * @return integer
     */
    public function getIdAccion() {
        return $this->idAccion;
    }

    /**
     * Set idPermiso
     *
     * @param integer $idPermiso
     *
     * @return Permisoperfilaccion
     */
    public function setIdPermiso($idPermiso) {
        $this->idPermiso = $idPermiso;

        return $this;
    }

    /**
     * Get idPermiso
     *
     * @return integer
     */
    public function getIdPermiso() {
        return $this->idPermiso;
    }

}
