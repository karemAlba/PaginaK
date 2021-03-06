<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\PeriodoAplicacion
 *
 * @ORM\Entity()
 * @ORM\Table(name="periodoAplicacion")
 */
class PeriodoAplicacion
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
    protected $periodo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="Subservicio", mappedBy="periodoAplicacion")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPeriodoAplicacion", nullable=false)
     */
    protected $subservicios;

    public function __construct()
    {
        $this->subservicios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PeriodoAplicacion
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
     * Set the value of periodo.
     *
     * @param string $periodo
     * @return \CoreBundle\Entity\PeriodoAplicacion
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get the value of periodo.
     *
     * @return string
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PeriodoAplicacion
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
     * Add Subservicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Subservicio $subservicio
     * @return \CoreBundle\Entity\PeriodoAplicacion
     */
    public function addSubservicio(Subservicio $subservicio)
    {
        $this->subservicios[] = $subservicio;

        return $this;
    }

    /**
     * Remove Subservicio entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Subservicio $subservicio
     * @return \CoreBundle\Entity\PeriodoAplicacion
     */
    public function removeSubservicio(Subservicio $subservicio)
    {
        $this->subservicios->removeElement($subservicio);

        return $this;
    }

    /**
     * Get Subservicio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubservicios()
    {
        return $this->subservicios;
    }

    public function __sleep()
    {
        return array('id', 'periodo', 'activo');
    }
}