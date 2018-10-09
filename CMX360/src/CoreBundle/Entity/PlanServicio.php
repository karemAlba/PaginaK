<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PlanServicio
 *
 * @ORM\Entity()
 * @ORM\Table(name="planServicio", indexes={@ORM\Index(name="fk_planServicio_subservicio1_idx", columns={"idSubservicio"}), @ORM\Index(name="fk_planServicio_planProspeccion1_idx", columns={"idPlanProspeccion"})})
 */
class PlanServicio
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $descuento;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isCombo;

    /**
     * @ORM\ManyToOne(targetEntity="Subservicio", inversedBy="planServicios")
     * @ORM\JoinColumn(name="idSubservicio", referencedColumnName="id", nullable=false)
     */
    protected $subservicio;

    /**
     * @ORM\ManyToOne(targetEntity="PlanProspeccion", inversedBy="planServicios")
     * @ORM\JoinColumn(name="idPlanProspeccion", referencedColumnName="id", nullable=false)
     */
    protected $planProspeccion;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PlanServicio
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
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PlanServicio
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
     * Set the value of fechaAlta.
     *
     * @param \DateTime $fechaAlta
     * @return \CoreBundle\Entity\PlanServicio
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get the value of fechaAlta.
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set the value of descuento.
     *
     * @param integer $descuento
     * @return \CoreBundle\Entity\PlanServicio
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get the value of descuento.
     *
     * @return integer
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set the value of costo.
     *
     * @param float $costo
     * @return \CoreBundle\Entity\PlanServicio
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get the value of costo.
     *
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set the value of isCombo.
     *
     * @param boolean $isCombo
     * @return \CoreBundle\Entity\PlanServicio
     */
    public function setIsCombo($isCombo)
    {
        $this->isCombo = $isCombo;

        return $this;
    }

    /**
     * Get the value of isCombo.
     *
     * @return boolean
     */
    public function getIsCombo()
    {
        return $this->isCombo;
    }

    /**
     * Set the value of idSubservicio.
     *
     * @param integer $idSubservicio
     * @return \CoreBundle\Entity\PlanServicio
     */
    public function setIdSubservicio($idSubservicio)
    {
        $this->idSubservicio = $idSubservicio;

        return $this;
    }

    /**
     * Get the value of idSubservicio.
     *
     * @return integer
     */
    public function getIdSubservicio()
    {
        return $this->idSubservicio;
    }

    /**
     * Set the value of idPlanProspeccion.
     *
     * @param integer $idPlanProspeccion
     * @return \CoreBundle\Entity\PlanServicio
     */
    public function setIdPlanProspeccion($idPlanProspeccion)
    {
        $this->idPlanProspeccion = $idPlanProspeccion;

        return $this;
    }

    /**
     * Get the value of idPlanProspeccion.
     *
     * @return integer
     */
    public function getIdPlanProspeccion()
    {
        return $this->idPlanProspeccion;
    }

    /**
     * Set Subservicio entity (many to one).
     *
     * @param \CoreBundle\Entity\Subservicio $subservicio
     * @return \CoreBundle\Entity\PlanServicio
     */
    public function setSubservicio(Subservicio $subservicio = null)
    {
        $this->subservicio = $subservicio;

        return $this;
    }

    /**
     * Get Subservicio entity (many to one).
     *
     * @return \CoreBundle\Entity\Subservicio
     */
    public function getSubservicio()
    {
        return $this->subservicio;
    }

    /**
     * Set PlanProspeccion entity (many to one).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\PlanServicio
     */
    public function setPlanProspeccion(PlanProspeccion $planProspeccion = null)
    {
        $this->planProspeccion = $planProspeccion;

        return $this;
    }

    /**
     * Get PlanProspeccion entity (many to one).
     *
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function getPlanProspeccion()
    {
        return $this->planProspeccion;
    }

    public function __sleep()
    {
        return array('id', 'activo', 'fechaAlta', 'descuento', 'costo', 'isCombo', 'idSubservicio', 'idPlanProspeccion');
    }
}