<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\PlanClienteAsesor
 *
 * @ORM\Entity()
 * @ORM\Table(name="planClienteAsesor", indexes={@ORM\Index(name="fk_planClienteAsesor_personales1_idx", columns={"idPersona"}), @ORM\Index(name="fk_planClienteAsesor_plan_clientes1_idx", columns={"idPlanClientes"})})
 */
class PlanClienteAsesor
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
    protected $fechaAsignacion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idUsuarioAsigna;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="Prospeccion", mappedBy="planClienteAsesor")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPlanClienteAsesor", nullable=false)
     */
    protected $prospeccions;

    /**
     * @ORM\ManyToOne(targetEntity="Personales", inversedBy="planClienteAsesors")
     * @ORM\JoinColumn(name="idPersona", referencedColumnName="id", nullable=false)
     */
    protected $personales;

    /**
     * @ORM\ManyToOne(targetEntity="PlanClientes", inversedBy="planClienteAsesors")
     * @ORM\JoinColumn(name="idPlanClientes", referencedColumnName="id", nullable=false)
     */
    protected $planClientes;

    public function __construct()
    {
        $this->prospeccions = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PlanClienteAsesor
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
     * Set the value of fechaAsignacion.
     *
     * @param \DateTime $fechaAsignacion
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function setFechaAsignacion($fechaAsignacion)
    {
        $this->fechaAsignacion = $fechaAsignacion;

        return $this;
    }

    /**
     * Get the value of fechaAsignacion.
     *
     * @return \DateTime
     */
    public function getFechaAsignacion()
    {
        return $this->fechaAsignacion;
    }

    /**
     * Set the value of idUsuarioAsigna.
     *
     * @param integer $idUsuarioAsigna
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function setIdUsuarioAsigna($idUsuarioAsigna)
    {
        $this->idUsuarioAsigna = $idUsuarioAsigna;

        return $this;
    }

    /**
     * Get the value of idUsuarioAsigna.
     *
     * @return integer
     */
    public function getIdUsuarioAsigna()
    {
        return $this->idUsuarioAsigna;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PlanClienteAsesor
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
     * Set the value of idPersona.
     *
     * @param integer $idPersona
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;

        return $this;
    }

    /**
     * Get the value of idPersona.
     *
     * @return integer
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    /**
     * Set the value of idPlanClientes.
     *
     * @param integer $idPlanClientes
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function setIdPlanClientes($idPlanClientes)
    {
        $this->idPlanClientes = $idPlanClientes;

        return $this;
    }

    /**
     * Get the value of idPlanClientes.
     *
     * @return integer
     */
    public function getIdPlanClientes()
    {
        return $this->idPlanClientes;
    }

    /**
     * Add Prospeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Prospeccion $prospeccion
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function addProspeccion(Prospeccion $prospeccion)
    {
        $this->prospeccions[] = $prospeccion;

        return $this;
    }

    /**
     * Remove Prospeccion entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Prospeccion $prospeccion
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function removeProspeccion(Prospeccion $prospeccion)
    {
        $this->prospeccions->removeElement($prospeccion);

        return $this;
    }

    /**
     * Get Prospeccion entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProspeccions()
    {
        return $this->prospeccions;
    }

    /**
     * Set Personales entity (many to one).
     *
     * @param \CoreBundle\Entity\Personales $personales
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function setPersonales(Personales $personales = null)
    {
        $this->personales = $personales;

        return $this;
    }

    /**
     * Get Personales entity (many to one).
     *
     * @return \CoreBundle\Entity\Personales
     */
    public function getPersonales()
    {
        return $this->personales;
    }

    /**
     * Set PlanClientes entity (many to one).
     *
     * @param \CoreBundle\Entity\PlanClientes $planClientes
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function setPlanClientes(PlanClientes $planClientes = null)
    {
        $this->planClientes = $planClientes;

        return $this;
    }

    /**
     * Get PlanClientes entity (many to one).
     *
     * @return \CoreBundle\Entity\PlanClientes
     */
    public function getPlanClientes()
    {
        return $this->planClientes;
    }

    public function __sleep()
    {
        return array('id', 'fechaAsignacion', 'idUsuarioAsigna', 'activo', 'idPersona', 'idPlanClientes');
    }
}