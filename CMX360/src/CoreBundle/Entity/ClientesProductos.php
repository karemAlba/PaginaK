<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\ClientesProductos
 *
 * @ORM\Entity()
 * @ORM\Table(name="clientes_productos", indexes={@ORM\Index(name="fk_clientes_productos_productos1_idx", columns={"idProducto"}), @ORM\Index(name="fk_clientes_productos_clientes1_idx", columns={"idCliente"})})
 */
class ClientesProductos
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
     * @ORM\ManyToOne(targetEntity="Productos", inversedBy="clientesProductos")
     * @ORM\JoinColumn(name="idProducto", referencedColumnName="id", nullable=false)
     */
    protected $productos;

    /**
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="clientesProductos")
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
     * @return \CoreBundle\Entity\ClientesProductos
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
     * @return \CoreBundle\Entity\ClientesProductos
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
     * Set the value of idProducto.
     *
     * @param integer $idProducto
     * @return \CoreBundle\Entity\ClientesProductos
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get the value of idProducto.
     *
     * @return integer
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set the value of idCliente.
     *
     * @param integer $idCliente
     * @return \CoreBundle\Entity\ClientesProductos
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
     * Set Productos entity (many to one).
     *
     * @param \CoreBundle\Entity\Productos $productos
     * @return \CoreBundle\Entity\ClientesProductos
     */
    public function setProductos(Productos $productos = null)
    {
        $this->productos = $productos;

        return $this;
    }

    /**
     * Get Productos entity (many to one).
     *
     * @return \CoreBundle\Entity\Productos
     */
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set Clientes entity (many to one).
     *
     * @param \CoreBundle\Entity\Clientes $clientes
     * @return \CoreBundle\Entity\ClientesProductos
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
        return array('id', 'activo', 'idProducto', 'idCliente');
    }
}