<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etapa
 *
 * @ORM\Table(name="etapa")
 * @ORM\Entity
 */
class Etapa
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
     * @ORM\Column(name="Etapa", type="string", length=255, nullable=true)
     */
    private $etapa;

    /**
     * @var integer
     *
     * @ORM\Column(name="Activo", type="integer", nullable=true)
     */
    private $activo;




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
     * Set etapa
     *
     * @param string $etapa
     *
     * @return Etapa
     */
    public function setEtapa($etapa)
    {
        $this->etapa = $etapa;
    
        return $this;
    }

    /**
     * Get etapa
     *
     * @return string
     */
    public function getEtapa()
    {
        return $this->etapa;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return TipoExpediente
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return integer
     */
    public function getActivo()
    {
        return $this->activo;
    }

}
