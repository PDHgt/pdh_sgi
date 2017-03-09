<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unidadadministrativa
 *
 * @ORM\Table(name="unidadadministrativa", indexes={@ORM\Index(name="sede", columns={"id_sede"})})
 * @ORM\Entity
 */
class Unidadadministrativa
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
     * @var \Procuracion\Entity\Sede
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Sede")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sede", referencedColumnName="id")
     * })
     */
    private $idSede;



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
     * @return Unidadadministrativa
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
     * Set idSede
     *
     * @param \Procuracion\Entity\Sede $idSede
     *
     * @return Unidadadministrativa
     */
    public function setIdSede(\Procuracion\Entity\Sede $idSede = null)
    {
        $this->idSede = $idSede;
    
        return $this;
    }

    /**
     * Get idSede
     *
     * @return \Procuracion\Entity\Sede
     */
    public function getIdSede()
    {
        return $this->idSede;
    }
}
