<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\ProspeccionServicio
 *
 * @ORM\Entity()
 * @ORM\Table(name="prospeccionServicio", indexes={@ORM\Index(name="fk_prospeccionServicio_prospeccion1_idx", columns={"idProspeccion"}), @ORM\Index(name="fk_prospeccionServicio_subservicio1_idx", columns={"idSubservicio"})})
 */
class ProspeccionServicio
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $descuento;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costoTotal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isAdicional;

    /**
     * @ORM\ManyToOne(targetEntity="Prospeccion", inversedBy="prospeccionServicios")
     * @ORM\JoinColumn(name="idProspeccion", referencedColumnName="id", nullable=false)
     */
    protected $prospeccion;

    /**
     * @ORM\ManyToOne(targetEntity="Subservicio", inversedBy="prospeccionServicios")
     * @ORM\JoinColumn(name="idSubservicio", referencedColumnName="id", nullable=false)
     */
    protected $subservicio;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\ProspeccionServicio
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
     * @return \CoreBundle\Entity\ProspeccionServicio
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
     * @return \CoreBundle\Entity\ProspeccionServicio
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
     * Set the value of descuento.
     *
     * @param string $descuento
     * @return \CoreBundle\Entity\ProspeccionServicio
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
     * Set the value of costoTotal.
     *
     * @param float $costoTotal
     * @return \CoreBundle\Entity\ProspeccionServicio
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
     * Set the value of isAdicional.
     *
     * @param boolean $isAdicional
     * @return \CoreBundle\Entity\ProspeccionServicio
     */
    public function setIsAdicional($isAdicional)
    {
        $this->isAdicional = $isAdicional;

        return $this;
    }

    /**
     * Get the value of isAdicional.
     *
     * @return boolean
     */
    public function getIsAdicional()
    {
        return $this->isAdicional;
    }

    /**
     * Set the value of idProspeccion.
     *
     * @param integer $idProspeccion
     * @return \CoreBundle\Entity\ProspeccionServicio
     */
    public function setIdProspeccion($idProspeccion)
    {
        $this->idProspeccion = $idProspeccion;

        return $this;
    }

    /**
     * Get the value of idProspeccion.
     *
     * @return integer
     */
    public function getIdProspeccion()
    {
        return $this->idProspeccion;
    }

    /**
     * Set the value of idSubservicio.
     *
     * @param integer $idSubservicio
     * @return \CoreBundle\Entity\ProspeccionServicio
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
     * Set Prospeccion entity (many to one).
     *
     * @param \CoreBundle\Entity\Prospeccion $prospeccion
     * @return \CoreBundle\Entity\ProspeccionServicio
     */
    public function setProspeccion(Prospeccion $prospeccion = null)
    {
        $this->prospeccion = $prospeccion;

        return $this;
    }

    /**
     * Get Prospeccion entity (many to one).
     *
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function getProspeccion()
    {
        return $this->prospeccion;
    }

    /**
     * Set Subservicio entity (many to one).
     *
     * @param \CoreBundle\Entity\Subservicio $subservicio
     * @return \CoreBundle\Entity\ProspeccionServicio
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
        return array('id', 'activo', 'costo', 'descuento', 'costoTotal', 'isAdicional', 'idProspeccion', 'idSubservicio');
    }
}