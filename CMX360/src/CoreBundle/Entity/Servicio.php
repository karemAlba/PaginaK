<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Servicio
 *
 * @ORM\Entity()
 * @ORM\Table(name="servicio", indexes={@ORM\Index(name="fk_servicio_departamento1_idx", columns={"idDepartamentoServicio"})})
 */
class Servicio
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
     * @ORM\OneToMany(targetEntity="Subservicio", mappedBy="servicio")
     * @ORM\JoinColumn(name="id", referencedColumnName="idServicio", nullable=false)
     */
    protected $subservicios;

    /**
     * @ORM\ManyToOne(targetEntity="DepartamentoServicios", inversedBy="servicios")
     * @ORM\JoinColumn(name="idDepartamentoServicio", referencedColumnName="id", nullable=false)
     */
    protected $departamentoServicios;

    public function __construct()
    {
        $this->subservicios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Servicio
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
     * @return \CoreBundle\Entity\Servicio
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
     * @return \CoreBundle\Entity\Servicio
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
     * @return \CoreBundle\Entity\Servicio
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
     * Set the value of idDepartamentoServicio.
     *
     * @param integer $idDepartamentoServicio
     * @return \CoreBundle\Entity\Servicio
     */
    public function setIdDepartamentoServicio($idDepartamentoServicio)
    {
        $this->idDepartamentoServicio = $idDepartamentoServicio;

        return $this;
    }

    /**
     * Get the value of idDepartamentoServicio.
     *
     * @return integer
     */
    public function getIdDepartamentoServicio()
    {
        return $this->idDepartamentoServicio;
    }

    /**
     * Add Subservicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Subservicio $subservicio
     * @return \CoreBundle\Entity\Servicio
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
     * @return \CoreBundle\Entity\Servicio
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

    /**
     * Set DepartamentoServicios entity (many to one).
     *
     * @param \CoreBundle\Entity\DepartamentoServicios $departamentoServicios
     * @return \CoreBundle\Entity\Servicio
     */
    public function setDepartamentoServicios(DepartamentoServicios $departamentoServicios = null)
    {
        $this->departamentoServicios = $departamentoServicios;

        return $this;
    }

    /**
     * Get DepartamentoServicios entity (many to one).
     *
     * @return \CoreBundle\Entity\DepartamentoServicios
     */
    public function getDepartamentoServicios()
    {
        return $this->departamentoServicios;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'fechaAlta', 'idDepartamentoServicio');
    }
}