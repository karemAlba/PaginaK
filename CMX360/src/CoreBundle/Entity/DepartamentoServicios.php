<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\DepartamentoServicios
 *
 * @ORM\Entity()
 * @ORM\Table(name="departamentoServicios", indexes={@ORM\Index(name="fk_departamento_unidadNegocio1_idx", columns={"idEmpresa"})})
 */
class DepartamentoServicios
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
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\OneToMany(targetEntity="Servicio", mappedBy="departamentoServicios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idDepartamentoServicio", nullable=false)
     */
    protected $servicios;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="departamentoServicios")
     * @ORM\JoinColumn(name="idEmpresa", referencedColumnName="id", nullable=false)
     */
    protected $empresa;

    public function __construct()
    {
        $this->servicios = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\DepartamentoServicios
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
     * @return \CoreBundle\Entity\DepartamentoServicios
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
     * @return \CoreBundle\Entity\DepartamentoServicios
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
     * @return \CoreBundle\Entity\DepartamentoServicios
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
     * Set the value of idEmpresa.
     *
     * @param integer $idEmpresa
     * @return \CoreBundle\Entity\DepartamentoServicios
     */
    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;

        return $this;
    }

    /**
     * Get the value of idEmpresa.
     *
     * @return integer
     */
    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    /**
     * Add Servicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Servicio $servicio
     * @return \CoreBundle\Entity\DepartamentoServicios
     */
    public function addServicio(Servicio $servicio)
    {
        $this->servicios[] = $servicio;

        return $this;
    }

    /**
     * Remove Servicio entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Servicio $servicio
     * @return \CoreBundle\Entity\DepartamentoServicios
     */
    public function removeServicio(Servicio $servicio)
    {
        $this->servicios->removeElement($servicio);

        return $this;
    }

    /**
     * Get Servicio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServicios()
    {
        return $this->servicios;
    }

    /**
     * Set Empresa entity (many to one).
     *
     * @param \CoreBundle\Entity\Empresa $empresa
     * @return \CoreBundle\Entity\DepartamentoServicios
     */
    public function setEmpresa(Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get Empresa entity (many to one).
     *
     * @return \CoreBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'fechaAlta', 'idEmpresa');
    }
}