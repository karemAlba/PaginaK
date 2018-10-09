<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\ComboServicios
 *
 * @ORM\Entity()
 * @ORM\Table(name="comboServicios")
 */
class ComboServicios
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
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="ComboSubservicio", mappedBy="comboServicios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idComboServicios", nullable=false)
     */
    protected $comboSubservicios;

    /**
     * @ORM\OneToMany(targetEntity="PlanCombo", mappedBy="comboServicios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idComboServicios", nullable=false)
     */
    protected $planCombos;

    public function __construct()
    {
        $this->comboSubservicios = new ArrayCollection();
        $this->planCombos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\ComboServicios
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
     * @return \CoreBundle\Entity\ComboServicios
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
     * Set the value of costo.
     *
     * @param float $costo
     * @return \CoreBundle\Entity\ComboServicios
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
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\ComboServicios
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
     * Add ComboSubservicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ComboSubservicio $comboSubservicio
     * @return \CoreBundle\Entity\ComboServicios
     */
    public function addComboSubservicio(ComboSubservicio $comboSubservicio)
    {
        $this->comboSubservicios[] = $comboSubservicio;

        return $this;
    }

    /**
     * Remove ComboSubservicio entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ComboSubservicio $comboSubservicio
     * @return \CoreBundle\Entity\ComboServicios
     */
    public function removeComboSubservicio(ComboSubservicio $comboSubservicio)
    {
        $this->comboSubservicios->removeElement($comboSubservicio);

        return $this;
    }

    /**
     * Get ComboSubservicio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComboSubservicios()
    {
        return $this->comboSubservicios;
    }

    /**
     * Add PlanCombo entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanCombo $planCombo
     * @return \CoreBundle\Entity\ComboServicios
     */
    public function addPlanCombo(PlanCombo $planCombo)
    {
        $this->planCombos[] = $planCombo;

        return $this;
    }

    /**
     * Remove PlanCombo entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanCombo $planCombo
     * @return \CoreBundle\Entity\ComboServicios
     */
    public function removePlanCombo(PlanCombo $planCombo)
    {
        $this->planCombos->removeElement($planCombo);

        return $this;
    }

    /**
     * Get PlanCombo entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanCombos()
    {
        return $this->planCombos;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'costo', 'activo');
    }
}