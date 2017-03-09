<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HechoDerecho
 *
 * @ORM\Table(name="hecho_derecho", indexes={@ORM\Index(name="id_hecho", columns={"id_hecho"}), @ORM\Index(name="id_derecho", columns={"id_derecho"})})
 * @ORM\Entity
 */
class HechoDerecho
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
     * @var \Procuracion\Entity\Derecho
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Derecho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_derecho", referencedColumnName="id")
     * })
     */
    private $idDerecho;

    /**
     * @var \Procuracion\Entity\DefHecho
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DefHecho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_hecho", referencedColumnName="id")
     * })
     */
    private $idHecho;



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
     * Set idDerecho
     *
     * @param \Procuracion\Entity\Derecho $idDerecho
     *
     * @return HechoDerecho
     */
    public function setIdDerecho(\Procuracion\Entity\Derecho $idDerecho = null)
    {
        $this->idDerecho = $idDerecho;
    
        return $this;
    }

    /**
     * Get idDerecho
     *
     * @return \Procuracion\Entity\Derecho
     */
    public function getIdDerecho()
    {
        return $this->idDerecho;
    }

    /**
     * Set idHecho
     *
     * @param \Procuracion\Entity\DefHecho $idHecho
     *
     * @return HechoDerecho
     */
    public function setIdHecho(\Procuracion\Entity\DefHecho $idHecho = null)
    {
        $this->idHecho = $idHecho;
    
        return $this;
    }

    /**
     * Get idHecho
     *
     * @return \Procuracion\Entity\DefHecho
     */
    public function getIdHecho()
    {
        return $this->idHecho;
    }
}
