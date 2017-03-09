<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="id_empleado", columns={"id_empleado"}), @ORM\Index(name="idPerfilUsuario", columns={"id_perfil"})})
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
     * @var string
     *
     * @ORM\Column(name="Usuario", type="string", length=20, nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=32, nullable=true)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="Estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="modify_by", type="integer", nullable=true)
     */
    private $modifyBy = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modify_at", type="date", nullable=true)
     */
    private $modifyAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    private $createdAt;

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
     * @var \Procuracion\Entity\Empleado
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Empleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;



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
     * Set modifyBy
     *
     * @param integer $modifyBy
     *
     * @return Usuario
     */
    public function setModifyBy($modifyBy)
    {
        $this->modifyBy = $modifyBy;
    
        return $this;
    }

    /**
     * Get modifyBy
     *
     * @return integer
     */
    public function getModifyBy()
    {
        return $this->modifyBy;
    }

    /**
     * Set modifyAt
     *
     * @param \DateTime $modifyAt
     *
     * @return Usuario
     */
    public function setModifyAt($modifyAt)
    {
        $this->modifyAt = $modifyAt;
    
        return $this;
    }

    /**
     * Get modifyAt
     *
     * @return \DateTime
     */
    public function getModifyAt()
    {
        return $this->modifyAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Usuario
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
     * Set idPerfil
     *
     * @param \Procuracion\Entity\Perfil $idPerfil
     *
     * @return Usuario
     */
    public function setIdPerfil(\Procuracion\Entity\Perfil $idPerfil = null)
    {
        $this->idPerfil = $idPerfil;
    
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return \Procuracion\Entity\Perfil
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set idEmpleado
     *
     * @param \Procuracion\Entity\Empleado $idEmpleado
     *
     * @return Usuario
     */
    public function setIdEmpleado(\Procuracion\Entity\Empleado $idEmpleado = null)
    {
        $this->idEmpleado = $idEmpleado;
    
        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return \Procuracion\Entity\Empleado
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
}
