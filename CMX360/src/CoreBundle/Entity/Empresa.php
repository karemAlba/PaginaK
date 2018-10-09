<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Empresa
 *
 * @ORM\Entity()
 * @ORM\Table(name="empresa")
 */
class Empresa
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
     * @ORM\OneToMany(targetEntity="DepartamentoServicios", mappedBy="empresa")
     * @ORM\JoinColumn(name="id", referencedColumnName="idEmpresa", nullable=false)
     */
    protected $departamentoServicios;

    public function __construct()
    {
        $this->departamentoServicios = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Empresa
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
     * @return \CoreBundle\Entity\Empresa
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
     * @return \CoreBundle\Entity\Empresa
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
     * @return \CoreBundle\Entity\Empresa
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
     * Add DepartamentoServicios entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\DepartamentoServicios $departamentoServicios
     * @return \CoreBundle\Entity\Empresa
     */
    public function addDepartamentoServicios(DepartamentoServicios $departamentoServicios)
    {
        $this->departamentoServicios[] = $departamentoServicios;

        return $this;
    }

    /**
     * Remove DepartamentoServicios entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\DepartamentoServicios $departamentoServicios
     * @return \CoreBundle\Entity\Empresa
     */
    public function removeDepartamentoServicios(DepartamentoServicios $departamentoServicios)
    {
        $this->departamentoServicios->removeElement($departamentoServicios);

        return $this;
    }

    /**
     * Get DepartamentoServicios entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartamentoServicios()
    {
        return $this->departamentoServicios;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'fechaAlta');
    }
}