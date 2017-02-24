<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario
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
     * @var integer idempleado
     *
     * @ORM\ManyToOne(targetEntity="Empleado", fetch="EAGER")
     * @ORM\JoinColumn(name="idempleado", referencedColumnName="id")
     */
    private $idempleado;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=10, nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=10, nullable=true)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="modify_by", type="integer", nullable=true)
     */
    private $modifyby;

    /**
     * @var date
     *
     * @ORM\Column(name="modify_at", type="date", nullable=true)
     */
    private $modifyat;

    /**
     * @var date
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    private $createdat;


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
     * Set idempleado
     *
     * @param integer $idempleado
     *
     * @return Usuario
     */
    public function setIdempleado($idempleado)
    {
        $this->idempleado = $idempleado;

        return $this;
    }

    /**
     * Get idempleado
     *
     * @return integer
     */
    public function getIdempleado()
    {
        return $this->idempleado;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     *
     * @return Usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Usuario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set modify_by
     *
     * @param integer $modify_by
     *
     * @return Usuario
     */
    public function setModifyby($modify_by)
    {
        $this->modifyby = $modify_by;

        return $this;
    }

    /**
     * Get modify_by
     *
     * @return integer
     */
    public function getModifyby()
    {
        return $this->modifyby;
    }

    /**
     * Set modify_at
     *
     * @param date $modify_at
     *
     * @return Usuario
     */
    public function setModifyat($modify_at)
    {
        $this->modifyat = $modify_at;

        return $this;
    }

    /**
     * Get modify_at
     *
     * @return date
     */
    public function getModifyat()
    {
        return $this->modifyat;
    }

    /**
     * Set created_at
     *
     * @param date $created_at
     *
     * @return Usuario
     */
    public function setCreatedat($created_at)
    {
        $this->createdat = $created_at;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return date
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

}
