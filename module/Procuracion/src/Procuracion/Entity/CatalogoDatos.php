<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CatalogoDatos
 *
 * @ORM\Table(name="catalogo_datos")
 * @ORM\Entity
 */
class CatalogoDatos
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
     * @ORM\Column(name="Catalogo", type="string", length=255, nullable=true)
     */
    private $catalogo;



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
     * Set catalogo
     *
     * @param string $catalogo
     *
     * @return CatalogoDatos
     */
    public function setCatalogo($catalogo)
    {
        $this->catalogo = $catalogo;
    
        return $this;
    }

    /**
     * Get catalogo
     *
     * @return string
     */
    public function getCatalogo()
    {
        return $this->catalogo;
    }
}
