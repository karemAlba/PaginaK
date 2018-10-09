<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Municipios
 *
 * @ORM\Entity()
 * @ORM\Table(name="municipios", indexes={@ORM\Index(name="fk_municipio_estado1_idx", columns={"idEstado"})})
 */
class Municipios
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
     * @ORM\OneToMany(targetEntity="Colonias", mappedBy="municipios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idMunicipio", nullable=false)
     */
    protected $colonias;

    /**
     * @ORM\OneToMany(targetEntity="DomicilioClientes", mappedBy="municipios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idMunicipio", nullable=false)
     */
    protected $domicilioClientes;

    /**
     * @ORM\OneToMany(targetEntity="PlanProspeccion", mappedBy="municipios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idMunicipio", nullable=false)
     */
    protected $planProspeccions;

    /**
     * @ORM\ManyToOne(targetEntity="Estados", inversedBy="municipios")
     * @ORM\JoinColumn(name="idEstado", referencedColumnName="id", nullable=false)
     */
    protected $estados;

    public function __construct()
    {
        $this->colonias = new ArrayCollection();
        $this->domicilioClientes = new ArrayCollection();
        $this->planProspeccions = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Municipios
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
     * @return \CoreBundle\Entity\Municipios
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
     * @return \CoreBundle\Entity\Municipios
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
     * Set the value of idEstado.
     *
     * @param integer $idEstado
     * @return \CoreBundle\Entity\Municipios
     */
    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get the value of idEstado.
     *
     * @return integer
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * Add Colonias entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Colonias $colonias
     * @return \CoreBundle\Entity\Municipios
     */
    public function addColonias(Colonias $colonias)
    {
        $this->colonias[] = $colonias;

        return $this;
    }

    /**
     * Remove Colonias entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Colonias $colonias
     * @return \CoreBundle\Entity\Municipios
     */
    public function removeColonias(Colonias $colonias)
    {
        $this->colonias->removeElement($colonias);

        return $this;
    }

    /**
     * Get Colonias entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getColonias()
    {
        return $this->colonias;
    }

    /**
     * Add DomicilioClientes entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\DomicilioClientes $domicilioClientes
     * @return \CoreBundle\Entity\Municipios
     */
    public function addDomicilioClientes(DomicilioClientes $domicilioClientes)
    {
        $this->domicilioClientes[] = $domicilioClientes;

        return $this;
    }

    /**
     * Remove DomicilioClientes entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\DomicilioClientes $domicilioClientes
     * @return \CoreBundle\Entity\Municipios
     */
    public function removeDomicilioClientes(DomicilioClientes $domicilioClientes)
    {
        $this->domicilioClientes->removeElement($domicilioClientes);

        return $this;
    }

    /**
     * Get DomicilioClientes entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomicilioClientes()
    {
        return $this->domicilioClientes;
    }

    /**
     * Add PlanProspeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\Municipios
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
     * @return \CoreBundle\Entity\Municipios
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

    /**
     * Set Estados entity (many to one).
     *
     * @param \CoreBundle\Entity\Estados $estados
     * @return \CoreBundle\Entity\Municipios
     */
    public function setEstados(Estados $estados = null)
    {
        $this->estados = $estados;

        return $this;
    }

    /**
     * Get Estados entity (many to one).
     *
     * @return \CoreBundle\Entity\Estados
     */
    public function getEstados()
    {
        return $this->estados;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'idEstado');
    }
}