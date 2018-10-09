<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PlanCombo
 *
 * @ORM\Entity()
 * @ORM\Table(name="planCombo", indexes={@ORM\Index(name="fk_planCombo_planProspeccion1_idx", columns={"idPlanProspeccion"}), @ORM\Index(name="fk_planCombo_comboServicios1_idx", columns={"idComboServicios"})})
 */
class PlanCombo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\ManyToOne(targetEntity="PlanProspeccion", inversedBy="planCombos")
     * @ORM\JoinColumn(name="idPlanProspeccion", referencedColumnName="id", nullable=false)
     */
    protected $planProspeccion;

    /**
     * @ORM\ManyToOne(targetEntity="ComboServicios", inversedBy="planCombos")
     * @ORM\JoinColumn(name="idComboServicios", referencedColumnName="id", nullable=false)
     */
    protected $comboServicios;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PlanCombo
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
     * Set the value of fechaAlta.
     *
     * @param \DateTime $fechaAlta
     * @return \CoreBundle\Entity\PlanCombo
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
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PlanCombo
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
     * Set the value of idPlanProspeccion.
     *
     * @param integer $idPlanProspeccion
     * @return \CoreBundle\Entity\PlanCombo
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
     * Set the value of idComboServicios.
     *
     * @param integer $idComboServicios
     * @return \CoreBundle\Entity\PlanCombo
     */
    public function setIdComboServicios($idComboServicios)
    {
        $this->idComboServicios = $idComboServicios;

        return $this;
    }

    /**
     * Get the value of idComboServicios.
     *
     * @return integer
     */
    public function getIdComboServicios()
    {
        return $this->idComboServicios;
    }

    /**
     * Set PlanProspeccion entity (many to one).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\PlanCombo
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

    /**
     * Set ComboServicios entity (many to one).
     *
     * @param \CoreBundle\Entity\ComboServicios $comboServicios
     * @return \CoreBundle\Entity\PlanCombo
     */
    public function setComboServicios(ComboServicios $comboServicios = null)
    {
        $this->comboServicios = $comboServicios;

        return $this;
    }

    /**
     * Get ComboServicios entity (many to one).
     *
     * @return \CoreBundle\Entity\ComboServicios
     */
    public function getComboServicios()
    {
        return $this->comboServicios;
    }

    public function __sleep()
    {
        return array('id', 'fechaAlta', 'activo', 'idPlanProspeccion', 'idComboServicios');
    }
}