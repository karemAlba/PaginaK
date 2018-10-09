<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\PlanClientes
 *
 * @ORM\Entity()
 * @ORM\Table(name="plan_clientes", indexes={@ORM\Index(name="fk_plan_clientes_planProspeccion1_idx", columns={"idPlanProspeccion"}), @ORM\Index(name="fk_plan_clientes_clientes1_idx", columns={"idCliente"})})
 */
class PlanClientes
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
     * @ORM\OneToMany(targetEntity="PlanClienteAsesor", mappedBy="planClientes")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPlanClientes", nullable=false)
     */
    protected $planClienteAsesors;

    /**
     * @ORM\ManyToOne(targetEntity="PlanProspeccion", inversedBy="planClientes")
     * @ORM\JoinColumn(name="idPlanProspeccion", referencedColumnName="id", nullable=false)
     */
    protected $planProspeccion;

    /**
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="planClientes")
     * @ORM\JoinColumn(name="idCliente", referencedColumnName="id", nullable=false)
     */
    protected $clientes;

    public function __construct()
    {
        $this->planClienteAsesors = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PlanClientes
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
     * @return \CoreBundle\Entity\PlanClientes
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
     * @return \CoreBundle\Entity\PlanClientes
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
     * @return \CoreBundle\Entity\PlanClientes
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
     * Set the value of idCliente.
     *
     * @param integer $idCliente
     * @return \CoreBundle\Entity\PlanClientes
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get the value of idCliente.
     *
     * @return integer
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Add PlanClienteAsesor entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanClienteAsesor $planClienteAsesor
     * @return \CoreBundle\Entity\PlanClientes
     */
    public function addPlanClienteAsesor(PlanClienteAsesor $planClienteAsesor)
    {
        $this->planClienteAsesors[] = $planClienteAsesor;

        return $this;
    }

    /**
     * Remove PlanClienteAsesor entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanClienteAsesor $planClienteAsesor
     * @return \CoreBundle\Entity\PlanClientes
     */
    public function removePlanClienteAsesor(PlanClienteAsesor $planClienteAsesor)
    {
        $this->planClienteAsesors->removeElement($planClienteAsesor);

        return $this;
    }

    /**
     * Get PlanClienteAsesor entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanClienteAsesors()
    {
        return $this->planClienteAsesors;
    }

    /**
     * Set PlanProspeccion entity (many to one).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\PlanClientes
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
     * Set Clientes entity (many to one).
     *
     * @param \CoreBundle\Entity\Clientes $clientes
     * @return \CoreBundle\Entity\PlanClientes
     */
    public function setClientes(Clientes $clientes = null)
    {
        $this->clientes = $clientes;

        return $this;
    }

    /**
     * Get Clientes entity (many to one).
     *
     * @return \CoreBundle\Entity\Clientes
     */
    public function getClientes()
    {
        return $this->clientes;
    }

    public function __sleep()
    {
        return array('id', 'fechaAlta', 'activo', 'idPlanProspeccion', 'idCliente');
    }
}