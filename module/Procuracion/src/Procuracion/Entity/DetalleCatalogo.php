<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetalleCatalogo
 *
 * @ORM\Table(name="detalle_catalogo", indexes={@ORM\Index(name="id_catalogo", columns={"id_catalogo"}), @ORM\Index(name="Codigo", columns={"Codigo"}), @ORM\Index(name="Codigo_2", columns={"Codigo"})})
 * @ORM\Entity
 */
class DetalleCatalogo
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
     * @var integer
     *
     * @ORM\Column(name="Codigo", type="integer", nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="Valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="Activo", type="integer", nullable=true)
     */
    private $activo;

    /**
     * @var \Procuracion\Entity\CatalogoDatos
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\CatalogoDatos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_catalogo", referencedColumnName="id")
     * })
     */
    private $idCatalogo;



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
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return DetalleCatalogo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return DetalleCatalogo
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return DetalleCatalogo
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

    /**
     * Set idCatalogo
     *
     * @param \Procuracion\Entity\CatalogoDatos $idCatalogo
     *
     * @return DetalleCatalogo
     */
    public function setIdCatalogo(\Procuracion\Entity\CatalogoDatos $idCatalogo = null)
    {
        $this->idCatalogo = $idCatalogo;
    
        return $this;
    }

    /**
     * Get idCatalogo
     *
     * @return \Procuracion\Entity\CatalogoDatos
     */
    public function getIdCatalogo()
    {
        return $this->idCatalogo;
    }
}
