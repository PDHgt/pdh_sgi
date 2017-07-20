<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaVulnerable
 *
 * @ORM\Table(name="persona_vulnerable", indexes={@ORM\Index(name="grupo_persona", columns={"id_persona"}), @ORM\Index(name="grupo_vulnerable", columns={"grupo_vulnerable"})})
 * @ORM\Entity
 */
class PersonaVulnerable
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
     *   @ORM\JoinColumn(name="grupo_vulnerable", referencedColumnName="id")
     * })
     */
    private $grupoVulnerable;

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
     * Set grupoVulnerable
     *
     * @param \Procuracion\Entity\DetalleCatalogo $grupo
     *
     * @return DetallePersona
     */
    public function setGrupoVulnerable(\Procuracion\Entity\DetalleCatalogo $grupo = null)
    {
        $this->grupoVulnerable = $grupo;
    
        return $this;
    }

    /**
     * Get grupoVulnerable
     *
     * @return \Procuracion\Entity\DetalleCatalogo
     */
    public function getGrupoVulnerable()
    {
        return $this->grupoVulnerable;
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
