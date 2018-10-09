<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PropuestaCliente
 *
 * @ORM\Entity()
 * @ORM\Table(name="propuestaCliente", indexes={@ORM\Index(name="fk_propuestaCliente_propuestaServicio1_idx", columns={"idPropuestaServicio"}), @ORM\Index(name="fk_propuestaCliente_clientes1_idx", columns={"idCliente"})})
 */
class PropuestaCliente
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
     * @ORM\ManyToOne(targetEntity="PropuestaServicio", inversedBy="propuestaClientes")
     * @ORM\JoinColumn(name="idPropuestaServicio", referencedColumnName="id", nullable=false)
     */
    protected $propuestaServicio;

    /**
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="propuestaClientes")
     * @ORM\JoinColumn(name="idCliente", referencedColumnName="id", nullable=false)
     */
    protected $clientes;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PropuestaCliente
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
     * @return \CoreBundle\Entity\PropuestaCliente
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
     * Set the value of idPropuestaServicio.
     *
     * @param integer $idPropuestaServicio
     * @return \CoreBundle\Entity\PropuestaCliente
     */
    public function setIdPropuestaServicio($idPropuestaServicio)
    {
        $this->idPropuestaServicio = $idPropuestaServicio;

        return $this;
    }

    /**
     * Get the value of idPropuestaServicio.
     *
     * @return integer
     */
    public function getIdPropuestaServicio()
    {
        return $this->idPropuestaServicio;
    }

    /**
     * Set the value of idCliente.
     *
     * @param integer $idCliente
     * @return \CoreBundle\Entity\PropuestaCliente
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
     * Set PropuestaServicio entity (many to one).
     *
     * @param \CoreBundle\Entity\PropuestaServicio $propuestaServicio
     * @return \CoreBundle\Entity\PropuestaCliente
     */
    public function setPropuestaServicio(PropuestaServicio $propuestaServicio = null)
    {
        $this->propuestaServicio = $propuestaServicio;

        return $this;
    }

    /**
     * Get PropuestaServicio entity (many to one).
     *
     * @return \CoreBundle\Entity\PropuestaServicio
     */
    public function getPropuestaServicio()
    {
        return $this->propuestaServicio;
    }

    /**
     * Set Clientes entity (many to one).
     *
     * @param \CoreBundle\Entity\Clientes $clientes
     * @return \CoreBundle\Entity\PropuestaCliente
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

    public function __sleep()
    {
        return array('id', 'activo', 'idPropuestaServicio', 'idCliente');
    }
}