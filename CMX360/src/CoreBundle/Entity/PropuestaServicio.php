<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\PropuestaServicio
 *
 * @ORM\Entity()
 * @ORM\Table(name="propuestaServicio", indexes={@ORM\Index(name="fk_propuestaServicio_propuesta1_idx", columns={"idPropuesta"}), @ORM\Index(name="fk_propuestaServicio_subservicio1_idx", columns={"idSubservicio"})})
 */
class PropuestaServicio
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
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costoTotal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $descuento;

    /**
     * @ORM\OneToMany(targetEntity="PropuestaCliente", mappedBy="propuestaServicio")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPropuestaServicio", nullable=false)
     */
    protected $propuestaClientes;

    /**
     * @ORM\ManyToOne(targetEntity="PropuestaIndependiente", inversedBy="propuestaServicios")
     * @ORM\JoinColumn(name="idPropuesta", referencedColumnName="id", nullable=false)
     */
    protected $propuestaIndependiente;

    /**
     * @ORM\ManyToOne(targetEntity="Subservicio", inversedBy="propuestaServicios")
     * @ORM\JoinColumn(name="idSubservicio", referencedColumnName="id", nullable=false)
     */
    protected $subservicio;

    public function __construct()
    {
        $this->propuestaClientes = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PropuestaServicio
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
     * @return \CoreBundle\Entity\PropuestaServicio
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
     * Set the value of costo.
     *
     * @param float $costo
     * @return \CoreBundle\Entity\PropuestaServicio
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
     * Set the value of costoTotal.
     *
     * @param float $costoTotal
     * @return \CoreBundle\Entity\PropuestaServicio
     */
    public function setCostoTotal($costoTotal)
    {
        $this->costoTotal = $costoTotal;

        return $this;
    }

    /**
     * Get the value of costoTotal.
     *
     * @return float
     */
    public function getCostoTotal()
    {
        return $this->costoTotal;
    }

    /**
     * Set the value of descuento.
     *
     * @param string $descuento
     * @return \CoreBundle\Entity\PropuestaServicio
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get the value of descuento.
     *
     * @return string
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set the value of idPropuesta.
     *
     * @param integer $idPropuesta
     * @return \CoreBundle\Entity\PropuestaServicio
     */
    public function setIdPropuesta($idPropuesta)
    {
        $this->idPropuesta = $idPropuesta;

        return $this;
    }

    /**
     * Get the value of idPropuesta.
     *
     * @return integer
     */
    public function getIdPropuesta()
    {
        return $this->idPropuesta;
    }

    /**
     * Set the value of idSubservicio.
     *
     * @param integer $idSubservicio
     * @return \CoreBundle\Entity\PropuestaServicio
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
     * Add PropuestaCliente entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaCliente $propuestaCliente
     * @return \CoreBundle\Entity\PropuestaServicio
     */
    public function addPropuestaCliente(PropuestaCliente $propuestaCliente)
    {
        $this->propuestaClientes[] = $propuestaCliente;

        return $this;
    }

    /**
     * Remove PropuestaCliente entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaCliente $propuestaCliente
     * @return \CoreBundle\Entity\PropuestaServicio
     */
    public function removePropuestaCliente(PropuestaCliente $propuestaCliente)
    {
        $this->propuestaClientes->removeElement($propuestaCliente);

        return $this;
    }

    /**
     * Get PropuestaCliente entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropuestaClientes()
    {
        return $this->propuestaClientes;
    }

    /**
     * Set PropuestaIndependiente entity (many to one).
     *
     * @param \CoreBundle\Entity\PropuestaIndependiente $propuestaIndependiente
     * @return \CoreBundle\Entity\PropuestaServicio
     */
    public function setPropuestaIndependiente(PropuestaIndependiente $propuestaIndependiente = null)
    {
        $this->propuestaIndependiente = $propuestaIndependiente;

        return $this;
    }

    /**
     * Get PropuestaIndependiente entity (many to one).
     *
     * @return \CoreBundle\Entity\PropuestaIndependiente
     */
    public function getPropuestaIndependiente()
    {
        return $this->propuestaIndependiente;
    }

    /**
     * Set Subservicio entity (many to one).
     *
     * @param \CoreBundle\Entity\Subservicio $subservicio
     * @return \CoreBundle\Entity\PropuestaServicio
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

    public function __sleep()
    {
        return array('id', 'activo', 'costo', 'costoTotal', 'descuento', 'idPropuesta', 'idSubservicio');
    }
}