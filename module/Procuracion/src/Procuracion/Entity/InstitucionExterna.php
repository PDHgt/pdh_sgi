<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InstitucionExterna
 *
 * @ORM\Table(name="institucion_externa")
 * @ORM\Entity
 */
class InstitucionExterna
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
     * @var \Procuracion\Entity\InstitucionPadre
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\InstitucionPadre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_padre", referencedColumnName="id")
     * })
     */
    private $idPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="Institucion", type="string", length=255, nullable=true)
     */
    private $institucion;





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
     * Set idPadre
     *
     * @param \Procuracion\Entity\InstitucionPadre $idInstitucion
     *
     * @return Remision
     */
    public function setIdPadre(\Procuracion\Entity\InstitucionPadre $idInstitucion = null)
    {
        $this->idPadre = $idInstitucion;
    
        return $this;
    }

    /**
     * Get idPadre
     *
     * @return \Procuracion\Entity\InstitucionPadre
     */
    public function getIdPadre()
    {
        return $this->idPadre;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     *
     * @return InstitucionExterna
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;
    
        return $this;
    }

    /**
     * Get institucion
     *
     * @return string
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }
}
