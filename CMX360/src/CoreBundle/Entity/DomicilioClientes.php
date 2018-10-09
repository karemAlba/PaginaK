<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\DomicilioClientes
 *
 * @ORM\Entity()
 * @ORM\Table(name="domicilio_clientes", indexes={@ORM\Index(name="fk_domicilio_cliente_cliente1_idx", columns={"idCliente"}), @ORM\Index(name="fk_domicilio_clientes_municipios1_idx", columns={"idMunicipio"}), @ORM\Index(name="fk_domicilio_clientes_colonias1_idx", columns={"idColonia"})})
 */
class DomicilioClientes
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
    protected $calle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isFiscal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="domicilioClientes")
     * @ORM\JoinColumn(name="idCliente", referencedColumnName="id", nullable=false)
     */
    protected $clientes;

    /**
     * @ORM\ManyToOne(targetEntity="Colonias", inversedBy="domicilioClientes")
     * @ORM\JoinColumn(name="idColonia", referencedColumnName="id")
     */
    protected $colonias;

    /**
     * @ORM\ManyToOne(targetEntity="Municipios", inversedBy="domicilioClientes")
     * @ORM\JoinColumn(name="idMunicipio", referencedColumnName="id", nullable=false)
     */
    protected $municipios;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\DomicilioClientes
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
     * Set the value of calle.
     *
     * @param string $calle
     * @return \CoreBundle\Entity\DomicilioClientes
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get the value of calle.
     *
     * @return string
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set the value of isFiscal.
     *
     * @param boolean $isFiscal
     * @return \CoreBundle\Entity\DomicilioClientes
     */
    public function setIsFiscal($isFiscal)
    {
        $this->isFiscal = $isFiscal;

        return $this;
    }

    /**
     * Get the value of isFiscal.
     *
     * @return boolean
     */
    public function getIsFiscal()
    {
        return $this->isFiscal;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\DomicilioClientes
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
     * Set the value of idCliente.
     *
     * @param integer $idCliente
     * @return \CoreBundle\Entity\DomicilioClientes
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
     * Set the value of idColonia.
     *
     * @param integer $idColonia
     * @return \CoreBundle\Entity\DomicilioClientes
     */
    public function setIdColonia($idColonia)
    {
        $this->idColonia = $idColonia;

        return $this;
    }

    /**
     * Get the value of idColonia.
     *
     * @return integer
     */
    public function getIdColonia()
    {
        return $this->idColonia;
    }

    /**
     * Set the value of idMunicipio.
     *
     * @param integer $idMunicipio
     * @return \CoreBundle\Entity\DomicilioClientes
     */
    public function setIdMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;

        return $this;
    }

    /**
     * Get the value of idMunicipio.
     *
     * @return integer
     */
    public function getIdMunicipio()
    {
        return $this->idMunicipio;
    }

    /**
     * Set Clientes entity (many to one).
     *
     * @param \CoreBundle\Entity\Clientes $clientes
     * @return \CoreBundle\Entity\DomicilioClientes
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

    /**
     * Set Colonias entity (many to one).
     *
     * @param \CoreBundle\Entity\Colonias $colonias
     * @return \CoreBundle\Entity\DomicilioClientes
     */
    public function setColonias(Colonias $colonias = null)
    {
        $this->colonias = $colonias;

        return $this;
    }

    /**
     * Get Colonias entity (many to one).
     *
     * @return \CoreBundle\Entity\Colonias
     */
    public function getColonias()
    {
        return $this->colonias;
    }

    /**
     * Set Municipios entity (many to one).
     *
     * @param \CoreBundle\Entity\Municipios $municipios
     * @return \CoreBundle\Entity\DomicilioClientes
     */
    public function setMunicipios(Municipios $municipios = null)
    {
        $this->municipios = $municipios;

        return $this;
    }

    /**
     * Get Municipios entity (many to one).
     *
     * @return \CoreBundle\Entity\Municipios
     */
    public function getMunicipios()
    {
        return $this->municipios;
    }

    public function __sleep()
    {
        return array('id', 'calle', 'isFiscal', 'activo', 'idCliente', 'idColonia', 'idMunicipio');
    }
}