<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\ResponsableContactos
 *
 * @ORM\Entity()
 * @ORM\Table(name="responsableContactos", indexes={@ORM\Index(name="fk_responsableContactos_tipoResponsables1_idx", columns={"idTipoResponsable"})})
 */
class ResponsableContactos
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $apellidos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $telefono;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $correo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observaciones;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="CampanaCliente", mappedBy="responsableContactos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idResponsableContacto", nullable=false)
     */
    protected $campanaClientes;

    /**
     * @ORM\OneToMany(targetEntity="ClienteResponsables", mappedBy="responsableContactos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idResponsableContacto", nullable=false)
     */
    protected $clienteResponsables;

    /**
     * @ORM\OneToMany(targetEntity="Prospeccion", mappedBy="responsableContactos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idResponsableContactos", nullable=false)
     */
    protected $prospeccions;

    /**
     * @ORM\ManyToOne(targetEntity="TipoResponsables", inversedBy="responsableContactos")
     * @ORM\JoinColumn(name="idTipoResponsable", referencedColumnName="id", nullable=false)
     */
    protected $tipoResponsables;

    public function __construct()
    {
        $this->campanaClientes = new ArrayCollection();
        $this->clienteResponsables = new ArrayCollection();
        $this->prospeccions = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\ResponsableContactos
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
     * @return \CoreBundle\Entity\ResponsableContactos
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
     * Set the value of apellidos.
     *
     * @param string $apellidos
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of apellidos.
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of telefono.
     *
     * @param string $telefono
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of telefono.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of correo.
     *
     * @param string $correo
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of correo.
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of observaciones.
     *
     * @param string $observaciones
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get the value of observaciones.
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\ResponsableContactos
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
     * Set the value of idTipoResponsable.
     *
     * @param integer $idTipoResponsable
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function setIdTipoResponsable($idTipoResponsable)
    {
        $this->idTipoResponsable = $idTipoResponsable;

        return $this;
    }

    /**
     * Get the value of idTipoResponsable.
     *
     * @return integer
     */
    public function getIdTipoResponsable()
    {
        return $this->idTipoResponsable;
    }

    /**
     * Add CampanaCliente entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\CampanaCliente $campanaCliente
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function addCampanaCliente(CampanaCliente $campanaCliente)
    {
        $this->campanaClientes[] = $campanaCliente;

        return $this;
    }

    /**
     * Remove CampanaCliente entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\CampanaCliente $campanaCliente
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function removeCampanaCliente(CampanaCliente $campanaCliente)
    {
        $this->campanaClientes->removeElement($campanaCliente);

        return $this;
    }

    /**
     * Get CampanaCliente entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampanaClientes()
    {
        return $this->campanaClientes;
    }

    /**
     * Add ClienteResponsables entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ClienteResponsables $clienteResponsables
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function addClienteResponsables(ClienteResponsables $clienteResponsables)
    {
        $this->clienteResponsables[] = $clienteResponsables;

        return $this;
    }

    /**
     * Remove ClienteResponsables entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ClienteResponsables $clienteResponsables
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function removeClienteResponsables(ClienteResponsables $clienteResponsables)
    {
        $this->clienteResponsables->removeElement($clienteResponsables);

        return $this;
    }

    /**
     * Get ClienteResponsables entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClienteResponsables()
    {
        return $this->clienteResponsables;
    }

    /**
     * Add Prospeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Prospeccion $prospeccion
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function addProspeccion(Prospeccion $prospeccion)
    {
        $this->prospeccions[] = $prospeccion;

        return $this;
    }

    /**
     * Remove Prospeccion entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Prospeccion $prospeccion
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function removeProspeccion(Prospeccion $prospeccion)
    {
        $this->prospeccions->removeElement($prospeccion);

        return $this;
    }

    /**
     * Get Prospeccion entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProspeccions()
    {
        return $this->prospeccions;
    }

    /**
     * Set TipoResponsables entity (many to one).
     *
     * @param \CoreBundle\Entity\TipoResponsables $tipoResponsables
     * @return \CoreBundle\Entity\ResponsableContactos
     */
    public function setTipoResponsables(TipoResponsables $tipoResponsables = null)
    {
        $this->tipoResponsables = $tipoResponsables;

        return $this;
    }

    /**
     * Get TipoResponsables entity (many to one).
     *
     * @return \CoreBundle\Entity\TipoResponsables
     */
    public function getTipoResponsables()
    {
        return $this->tipoResponsables;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'apellidos', 'telefono', 'correo', 'observaciones', 'activo', 'idTipoResponsable');
    }
}