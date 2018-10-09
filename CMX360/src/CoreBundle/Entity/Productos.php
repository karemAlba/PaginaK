<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Productos
 *
 * @ORM\Entity()
 * @ORM\Table(name="productos", indexes={@ORM\Index(name="fk_productos_marcas1_idx", columns={"idMarca"})})
 */
class Productos
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
     * @ORM\OneToMany(targetEntity="ClientesProductos", mappedBy="productos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idProducto", nullable=false)
     */
    protected $clientesProductos;

    /**
     * @ORM\ManyToOne(targetEntity="Marcas", inversedBy="productos")
     * @ORM\JoinColumn(name="idMarca", referencedColumnName="id", nullable=false)
     */
    protected $marcas;

    public function __construct()
    {
        $this->clientesProductos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Productos
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
     * @return \CoreBundle\Entity\Productos
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
     * @return \CoreBundle\Entity\Productos
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
     * Set the value of idMarca.
     *
     * @param integer $idMarca
     * @return \CoreBundle\Entity\Productos
     */
    public function setIdMarca($idMarca)
    {
        $this->idMarca = $idMarca;

        return $this;
    }

    /**
     * Get the value of idMarca.
     *
     * @return integer
     */
    public function getIdMarca()
    {
        return $this->idMarca;
    }

    /**
     * Add ClientesProductos entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ClientesProductos $clientesProductos
     * @return \CoreBundle\Entity\Productos
     */
    public function addClientesProductos(ClientesProductos $clientesProductos)
    {
        $this->clientesProductos[] = $clientesProductos;

        return $this;
    }

    /**
     * Remove ClientesProductos entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ClientesProductos $clientesProductos
     * @return \CoreBundle\Entity\Productos
     */
    public function removeClientesProductos(ClientesProductos $clientesProductos)
    {
        $this->clientesProductos->removeElement($clientesProductos);

        return $this;
    }

    /**
     * Get ClientesProductos entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClientesProductos()
    {
        return $this->clientesProductos;
    }

    /**
     * Set Marcas entity (many to one).
     *
     * @param \CoreBundle\Entity\Marcas $marcas
     * @return \CoreBundle\Entity\Productos
     */
    public function setMarcas(Marcas $marcas = null)
    {
        $this->marcas = $marcas;

        return $this;
    }

    /**
     * Get Marcas entity (many to one).
     *
     * @return \CoreBundle\Entity\Marcas
     */
    public function getMarcas()
    {
        return $this->marcas;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'idMarca');
    }
}