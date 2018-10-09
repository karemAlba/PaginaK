<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\ClienteResponsables
 *
 * @ORM\Entity()
 * @ORM\Table(name="cliente_responsables", indexes={@ORM\Index(name="fk_cliente_responsables_responsableContactos1_idx", columns={"idResponsableContacto"}), @ORM\Index(name="fk_cliente_responsables_clientes1_idx", columns={"idCliente"})})
 */
class ClienteResponsables
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
     * @ORM\OneToMany(targetEntity="Usuarios", mappedBy="clienteResponsables")
     * @ORM\JoinColumn(name="id", referencedColumnName="idClienteResponsable", nullable=false)
     */
    protected $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="ResponsableContactos", inversedBy="clienteResponsables")
     * @ORM\JoinColumn(name="idResponsableContacto", referencedColumnName="id", nullable=false)
     */
    protected $responsableContactos;

    /**
     * @ORM\ManyToOne(targetEntity="Clientes", inversedBy="clienteResponsables")
     * @ORM\JoinColumn(name="idCliente", referencedColumnName="id", nullable=false)
     */
    protected $clientes;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\ClienteResponsables
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
     * @return \CoreBundle\Entity\ClienteResponsables
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
     * Set the value of idResponsableContacto.
     *
     * @param integer $idResponsableContacto
     * @return \CoreBundle\Entity\ClienteResponsables
     */
    public function setIdResponsableContacto($idResponsableContacto)
    {
        $this->idResponsableContacto = $idResponsableContacto;

        return $this;
    }

    /**
     * Get the value of idResponsableContacto.
     *
     * @return integer
     */
    public function getIdResponsableContacto()
    {
        return $this->idResponsableContacto;
    }

    /**
     * Set the value of idCliente.
     *
     * @param integer $idCliente
     * @return \CoreBundle\Entity\ClienteResponsables
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
     * Add Usuarios entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Usuarios $usuarios
     * @return \CoreBundle\Entity\ClienteResponsables
     */
    public function addUsuarios(Usuarios $usuarios)
    {
        $this->usuarios[] = $usuarios;

        return $this;
    }

    /**
     * Remove Usuarios entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Usuarios $usuarios
     * @return \CoreBundle\Entity\ClienteResponsables
     */
    public function removeUsuarios(Usuarios $usuarios)
    {
        $this->usuarios->removeElement($usuarios);

        return $this;
    }

    /**
     * Get Usuarios entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set ResponsableContactos entity (many to one).
     *
     * @param \CoreBundle\Entity\ResponsableContactos $responsableContactos
     * @return \CoreBundle\Entity\ClienteResponsables
     */
    public function setResponsableContactos(ResponsableContactos $responsableContactos = null)
    {
        $this->responsableContactos = $responsableContactos;

        return $this;
    }

    /**
     * Get ResponsableContactos entity (many to one).
     *
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function getResponsableContactos()
    {
        return $this->responsableContactos;
    }

    /**
     * Set Clientes entity (many to one).
     *
     * @param \CoreBundle\Entity\Clientes $clientes
     * @return \CoreBundle\Entity\ClienteResponsables
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
        return array('id', 'activo', 'idResponsableContacto', 'idCliente');
    }
}