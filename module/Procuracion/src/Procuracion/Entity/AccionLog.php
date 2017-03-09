<?php

namespace Procuracion\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccionLog
 *
 * @ORM\Table(name="accion_log")
 * @ORM\Entity
 */
class AccionLog
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
     * @ORM\Column(name="ActividadLog", type="string", length=255, nullable=true)
     */
    private $actividadlog;

    /**
     * @var integer
     *
     * @ORM\Column(name="Activa", type="integer", nullable=true)
     */
    private $activa;



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
     * Set actividadlog
     *
     * @param string $actividadlog
     *
     * @return AccionLog
     */
    public function setActividadlog($actividadlog)
    {
        $this->actividadlog = $actividadlog;
    
        return $this;
    }

    /**
     * Get actividadlog
     *
     * @return string
     */
    public function getActividadlog()
    {
        return $this->actividadlog;
    }

    /**
     * Set activa
     *
     * @param integer $activa
     *
     * @return AccionLog
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;
    
        return $this;
    }

    /**
     * Get activa
     *
     * @return integer
     */
    public function getActiva()
    {
        return $this->activa;
    }
}
