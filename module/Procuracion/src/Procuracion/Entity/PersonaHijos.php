<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaHijos
 *
 * @ORM\Table(name="persona_hijos", indexes={@ORM\Index(name="hijo_persona", columns={"id_persona"}), @ORM\Index(name="sexo_hijo", columns={"SexoHijo"}), @ORM\Index(name="edad_hijo", columns={"EdadHijo"})})
 * @ORM\Entity
 */
class PersonaHijos
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
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EdadHijo", referencedColumnName="id")
     * })
     */
    private $edadHijo;

    /**
     * @var \Procuracion\Entity\DetalleCatalogo
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\DetalleCatalogo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SexoHijo", referencedColumnName="id")
     * })
     */
    private $sexoHijo;
    /**
     * @var \Procuracion\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="Procuracion\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id")
     * })
     */
    private $idPersona;

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
     * Set edadHijo
     *
     * @param \Procuracion\Entity\DetalleCatalogo $edad
     *
     * @return DetallePersona
     */
    public function setEdadHijo(\Procuracion\Entity\DetalleCatalogo $edad = null)
    {
        $this->edadHijo = $edad;
    
        return $this;
    }

    /**
     * Get edadHijo
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getEdadHijo()
    {
        return $this->edadHijo;
    }

    /**
     * Set sexoHijo
     *
     * @param \Procuracion\Entity\DetalleCatalogo $sexo
     *
     * @return DetallePersona
     */
    public function setSexoHijo(\Procuracion\Entity\DetalleCatalogo $sexo = null)
    {
        $this->sexoHijo = $sexo;
    
        return $this;
    }

    /**
     * Get sexoHijo
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getSexoHijo()
    {
        return $this->sexoHijo;
    }

    /**
     * Set idPersona
     *
     * @param \Procuracion\Entity\Persona $idPersona
     *
     * @return DetallePersona
     */
    public function setIdPersona(\Procuracion\Entity\Persona $idPersona = null)
    {
        $this->idPersona = $idPersona;
    
        return $this;
    }

    /**
     * Get idPersona
     *
     * @return \Procuracion\Entity\Persona
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

}
