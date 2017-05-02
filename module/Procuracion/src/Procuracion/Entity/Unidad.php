<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unidad
 *
 * @ORM\Table(name="unidad", indexes={@ORM\Index(name="direccion", columns={"id_direccion"})})
 * @ORM\Entity
 */
class Unidad
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
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var \Procuracion\Entity\Direccion
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Direccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_direccion", referencedColumnName="id")
     * })
     */
    private $id_direccion;



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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Unidad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set id_direccion
     *
     * @param \Procuracion\Entity\Direccion $idDireccion
     *
     * @return Unidad
     */
    public function setIdDireccion(\Procuracion\Entity\Direccion $idDireccion = null)
    {
        $this->id_direccion = $idDireccion;
    
        return $this;
    }

    /**
     * Get id_direccion
     *
     * @return \Procuracion\Entity\Direccion
     */
    public function getIdDireccion()
    {
        return $this->id_direccion;
    }
}
