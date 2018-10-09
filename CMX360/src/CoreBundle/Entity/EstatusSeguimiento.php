<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\EstatusSeguimiento
 *
 * @ORM\Entity()
 * @ORM\Table(name="estatusSeguimiento")
 */
class EstatusSeguimiento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="PlanProspeccion", mappedBy="estatusSeguimiento")
     * @ORM\JoinColumn(name="id", referencedColumnName="idEstatusSeguimiento", nullable=false)
     */
    protected $planProspeccions;

    public function __construct()
    {
        $this->planProspeccions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\EstatusSeguimiento
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\EstatusSeguimiento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\EstatusSeguimiento
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get the value of activo.
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Add PlanProspeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\EstatusSeguimiento
     */
    public function addPlanProspeccion(PlanProspeccion $planProspeccion)
    {
        $this->planProspeccions[] = $planProspeccion;

        return $this;
    }

    /**
     * Remove PlanProspeccion entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\EstatusSeguimiento
     */
    public function removePlanProspeccion(PlanProspeccion $planProspeccion)
    {
        $this->planProspeccions->removeElement($planProspeccion);

        return $this;
    }

    /**
     * Get PlanProspeccion entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanProspeccions()
    {
        return $this->planProspeccions;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}