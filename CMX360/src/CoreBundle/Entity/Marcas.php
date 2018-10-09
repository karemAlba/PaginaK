<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Marcas
 *
 * @ORM\Entity()
 * @ORM\Table(name="marcas")
 */
class Marcas
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
     * @ORM\OneToMany(targetEntity="PlanProspeccion", mappedBy="marcas")
     * @ORM\JoinColumn(name="id", referencedColumnName="idMarca", nullable=false)
     */
    protected $planProspeccions;

    /**
     * @ORM\OneToMany(targetEntity="Productos", mappedBy="marcas")
     * @ORM\JoinColumn(name="id", referencedColumnName="idMarca", nullable=false)
     */
    protected $productos;

    /**
     * @ORM\OneToMany(targetEntity="PropuestaIndependiente", mappedBy="marcas")
     * @ORM\JoinColumn(name="id", referencedColumnName="idMarca", nullable=false)
     */
    protected $propuestaIndependientes;

    public function __construct()
    {
        $this->planProspeccions = new ArrayCollection();
        $this->productos = new ArrayCollection();
        $this->propuestaIndependientes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }


    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Marcas
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
     * @return \CoreBundle\Entity\Marcas
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
     * @return \CoreBundle\Entity\Marcas
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
     * Add PlanProspeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\Marcas
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
     * @return \CoreBundle\Entity\Marcas
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
     * Add Productos entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Productos $productos
     * @return \CoreBundle\Entity\Marcas
     */
    public function addProductos(Productos $productos)
    {
        $this->productos[] = $productos;

        return $this;
    }

    /**
     * Remove Productos entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Productos $productos
     * @return \CoreBundle\Entity\Marcas
     */
    public function removeProductos(Productos $productos)
    {
        $this->productos->removeElement($productos);

        return $this;
    }

    /**
     * Get Productos entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Add PropuestaIndependiente entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaIndependiente $propuestaIndependiente
     * @return \CoreBundle\Entity\Marcas
     */
    public function addPropuestaIndependiente(PropuestaIndependiente $propuestaIndependiente)
    {
        $this->propuestaIndependientes[] = $propuestaIndependiente;

        return $this;
    }

    /**
     * Remove PropuestaIndependiente entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaIndependiente $propuestaIndependiente
     * @return \CoreBundle\Entity\Marcas
     */
    public function removePropuestaIndependiente(PropuestaIndependiente $propuestaIndependiente)
    {
        $this->propuestaIndependientes->removeElement($propuestaIndependiente);

        return $this;
    }

    /**
     * Get PropuestaIndependiente entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropuestaIndependientes()
    {
        return $this->propuestaIndependientes;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}