<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\ComboSubservicio
 *
 * @ORM\Entity()
 * @ORM\Table(name="comboSubservicio", indexes={@ORM\Index(name="fk_comboSubservicio_comboServicios1_idx", columns={"idComboServicios"}), @ORM\Index(name="fk_comboSubservicio_subservicio1_idx", columns={"idSubservicio"})})
 */
class ComboSubservicio
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
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costoUnitario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $descuento;

    /**
     * @ORM\ManyToOne(targetEntity="ComboServicios", inversedBy="comboSubservicios")
     * @ORM\JoinColumn(name="idComboServicios", referencedColumnName="id", nullable=false)
     */
    protected $comboServicios;

    /**
     * @ORM\ManyToOne(targetEntity="Subservicio", inversedBy="comboSubservicios")
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
     * @return \CoreBundle\Entity\ComboSubservicio
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
     * @return \CoreBundle\Entity\ComboSubservicio
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
     * @return \CoreBundle\Entity\ComboSubservicio
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
     * Set the value of costoUnitario.
     *
     * @param float $costoUnitario
     * @return \CoreBundle\Entity\ComboSubservicio
     */
    public function setCostoUnitario($costoUnitario)
    {
        $this->costoUnitario = $costoUnitario;

        return $this;
    }

    /**
     * Get the value of costoUnitario.
     *
     * @return float
     */
    public function getCostoUnitario()
    {
        return $this->costoUnitario;
    }

    /**
     * Set the value of descuento.
     *
     * @param string $descuento
     * @return \CoreBundle\Entity\ComboSubservicio
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
     * Set the value of idComboServicios.
     *
     * @param integer $idComboServicios
     * @return \CoreBundle\Entity\ComboSubservicio
     */
    public function setIdComboServicios($idComboServicios)
    {
        $this->idComboServicios = $idComboServicios;

        return $this;
    }

    /**
     * Get the value of idComboServicios.
     *
     * @return integer
     */
    public function getIdComboServicios()
    {
        return $this->idComboServicios;
    }

    /**
     * Set the value of idSubservicio.
     *
     * @param integer $idSubservicio
     * @return \CoreBundle\Entity\ComboSubservicio
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
     * Set ComboServicios entity (many to one).
     *
     * @param \CoreBundle\Entity\ComboServicios $comboServicios
     * @return \CoreBundle\Entity\ComboSubservicio
     */
    public function setComboServicios(ComboServicios $comboServicios = null)
    {
        $this->comboServicios = $comboServicios;

        return $this;
    }

    /**
     * Get ComboServicios entity (many to one).
     *
     * @return \CoreBundle\Entity\ComboServicios
     */
    public function getComboServicios()
    {
        return $this->comboServicios;
    }

    /**
     * Set Subservicio entity (many to one).
     *
     * @param \CoreBundle\Entity\Subservicio $subservicio
     * @return \CoreBundle\Entity\ComboSubservicio
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
        return array('id', 'activo', 'fechaAlta', 'costoUnitario', 'descuento', 'idComboServicios', 'idSubservicio');
    }
}