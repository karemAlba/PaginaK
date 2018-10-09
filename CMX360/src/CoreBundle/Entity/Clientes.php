<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Clientes
 *
 * @ORM\Entity()
 * @ORM\Table(name="clientes", indexes={@ORM\Index(name="fk_clientes_grupos1_idx", columns={"idGrupo"}), @ORM\Index(name="fk_clientes_tipoClientes1_idx", columns={"idTipoCliente"}), @ORM\Index(name="fk_clientes_categorias1_idx", columns={"idCategoria"})})
 */
class Clientes
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
    protected $folioGenerico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $numeroPermiso;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $estacionServicio;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $razonSocial;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $rfc;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $correoEmpresa;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $telefonoEmpresa;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $coordenadaX;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $coordenadaY;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaModificacion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaBaja;

    /**
     * @ORM\OneToMany(targetEntity="ClienteResponsables", mappedBy="clientes")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCliente", nullable=false)
     */
    protected $clienteResponsables;

    /**
     * @ORM\OneToMany(targetEntity="ClientesProductos", mappedBy="clientes")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCliente", nullable=false)
     */
    protected $clientesProductos;

    /**
     * @ORM\OneToMany(targetEntity="DomicilioClientes", mappedBy="clientes")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCliente", nullable=false)
     */
    protected $domicilioClientes;

    /**
     * @ORM\OneToMany(targetEntity="PlanClientes", mappedBy="clientes")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCliente", nullable=false)
     */
    protected $planClientes;

    /**
     * @ORM\OneToMany(targetEntity="PropuestaCliente", mappedBy="clientes")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCliente", nullable=false)
     */
    protected $propuestaClientes;

    /**
     * @ORM\ManyToOne(targetEntity="Grupos", inversedBy="clientes")
     * @ORM\JoinColumn(name="idGrupo", referencedColumnName="id")
     */
    protected $grupos;

    /**
     * @ORM\ManyToOne(targetEntity="TipoClientes", inversedBy="clientes")
     * @ORM\JoinColumn(name="idTipoCliente", referencedColumnName="id", nullable=false)
     */
    protected $tipoClientes;

    /**
     * @ORM\ManyToOne(targetEntity="Categorias", inversedBy="clientes")
     * @ORM\JoinColumn(name="idCategoria", referencedColumnName="id", nullable=false)
     */
    protected $categorias;

    public function __construct()
    {
        $this->clienteResponsables = new ArrayCollection();
        $this->clientesProductos = new ArrayCollection();
        $this->domicilioClientes = new ArrayCollection();
        $this->planClientes = new ArrayCollection();
        $this->propuestaClientes = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Clientes
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
     * Set the value of folioGenerico.
     *
     * @param string $folioGenerico
     * @return \CoreBundle\Entity\Clientes
     */
    public function setFolioGenerico($folioGenerico)
    {
        $this->folioGenerico = $folioGenerico;

        return $this;
    }

    /**
     * Get the value of folioGenerico.
     *
     * @return string
     */
    public function getFolioGenerico()
    {
        return $this->folioGenerico;
    }

    /**
     * Set the value of numeroPermiso.
     *
     * @param string $numeroPermiso
     * @return \CoreBundle\Entity\Clientes
     */
    public function setNumeroPermiso($numeroPermiso)
    {
        $this->numeroPermiso = $numeroPermiso;

        return $this;
    }

    /**
     * Get the value of numeroPermiso.
     *
     * @return string
     */
    public function getNumeroPermiso()
    {
        return $this->numeroPermiso;
    }

    /**
     * Set the value of estacionServicio.
     *
     * @param string $estacionServicio
     * @return \CoreBundle\Entity\Clientes
     */
    public function setEstacionServicio($estacionServicio)
    {
        $this->estacionServicio = $estacionServicio;

        return $this;
    }

    /**
     * Get the value of estacionServicio.
     *
     * @return string
     */
    public function getEstacionServicio()
    {
        return $this->estacionServicio;
    }

    /**
     * Set the value of razonSocial.
     *
     * @param string $razonSocial
     * @return \CoreBundle\Entity\Clientes
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    /**
     * Get the value of razonSocial.
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set the value of rfc.
     *
     * @param string $rfc
     * @return \CoreBundle\Entity\Clientes
     */
    public function setRfc($rfc)
    {
        $this->rfc = $rfc;

        return $this;
    }

    /**
     * Get the value of rfc.
     *
     * @return string
     */
    public function getRfc()
    {
        return $this->rfc;
    }

    /**
     * Set the value of correoEmpresa.
     *
     * @param string $correoEmpresa
     * @return \CoreBundle\Entity\Clientes
     */
    public function setCorreoEmpresa($correoEmpresa)
    {
        $this->correoEmpresa = $correoEmpresa;

        return $this;
    }

    /**
     * Get the value of correoEmpresa.
     *
     * @return string
     */
    public function getCorreoEmpresa()
    {
        return $this->correoEmpresa;
    }

    /**
     * Set the value of telefonoEmpresa.
     *
     * @param string $telefonoEmpresa
     * @return \CoreBundle\Entity\Clientes
     */
    public function setTelefonoEmpresa($telefonoEmpresa)
    {
        $this->telefonoEmpresa = $telefonoEmpresa;

        return $this;
    }

    /**
     * Get the value of telefonoEmpresa.
     *
     * @return string
     */
    public function getTelefonoEmpresa()
    {
        return $this->telefonoEmpresa;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Clientes
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
     * Set the value of coordenadaX.
     *
     * @param string $coordenadaX
     * @return \CoreBundle\Entity\Clientes
     */
    public function setCoordenadaX($coordenadaX)
    {
        $this->coordenadaX = $coordenadaX;

        return $this;
    }

    /**
     * Get the value of coordenadaX.
     *
     * @return string
     */
    public function getCoordenadaX()
    {
        return $this->coordenadaX;
    }

    /**
     * Set the value of coordenadaY.
     *
     * @param string $coordenadaY
     * @return \CoreBundle\Entity\Clientes
     */
    public function setCoordenadaY($coordenadaY)
    {
        $this->coordenadaY = $coordenadaY;

        return $this;
    }

    /**
     * Get the value of coordenadaY.
     *
     * @return string
     */
    public function getCoordenadaY()
    {
        return $this->coordenadaY;
    }

    /**
     * Set the value of fechaAlta.
     *
     * @param \DateTime $fechaAlta
     * @return \CoreBundle\Entity\Clientes
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
     * Set the value of fechaModificacion.
     *
     * @param \DateTime $fechaModificacion
     * @return \CoreBundle\Entity\Clientes
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get the value of fechaModificacion.
     *
     * @return \DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set the value of fechaBaja.
     *
     * @param \DateTime $fechaBaja
     * @return \CoreBundle\Entity\Clientes
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get the value of fechaBaja.
     *
     * @return \DateTime
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * Set the value of idGrupo.
     *
     * @param integer $idGrupo
     * @return \CoreBundle\Entity\Clientes
     */
    public function setIdGrupo($idGrupo)
    {
        $this->idGrupo = $idGrupo;

        return $this;
    }

    /**
     * Get the value of idGrupo.
     *
     * @return integer
     */
    public function getIdGrupo()
    {
        return $this->idGrupo;
    }

    /**
     * Set the value of idTipoCliente.
     *
     * @param integer $idTipoCliente
     * @return \CoreBundle\Entity\Clientes
     */
    public function setIdTipoCliente($idTipoCliente)
    {
        $this->idTipoCliente = $idTipoCliente;

        return $this;
    }

    /**
     * Get the value of idTipoCliente.
     *
     * @return integer
     */
    public function getIdTipoCliente()
    {
        return $this->idTipoCliente;
    }

    /**
     * Set the value of idCategoria.
     *
     * @param integer $idCategoria
     * @return \CoreBundle\Entity\Clientes
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get the value of idCategoria.
     *
     * @return integer
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Add ClienteResponsables entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ClienteResponsables $clienteResponsables
     * @return \CoreBundle\Entity\Clientes
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
     * @return \CoreBundle\Entity\Clientes
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
     * Add ClientesProductos entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ClientesProductos $clientesProductos
     * @return \CoreBundle\Entity\Clientes
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
     * @return \CoreBundle\Entity\Clientes
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
     * Add DomicilioClientes entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\DomicilioClientes $domicilioClientes
     * @return \CoreBundle\Entity\Clientes
     */
    public function addDomicilioClientes(DomicilioClientes $domicilioClientes)
    {
        $this->domicilioClientes[] = $domicilioClientes;

        return $this;
    }

    /**
     * Remove DomicilioClientes entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\DomicilioClientes $domicilioClientes
     * @return \CoreBundle\Entity\Clientes
     */
    public function removeDomicilioClientes(DomicilioClientes $domicilioClientes)
    {
        $this->domicilioClientes->removeElement($domicilioClientes);

        return $this;
    }

    /**
     * Get DomicilioClientes entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomicilioClientes()
    {
        return $this->domicilioClientes;
    }

    /**
     * Add PlanClientes entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanClientes $planClientes
     * @return \CoreBundle\Entity\Clientes
     */
    public function addPlanClientes(PlanClientes $planClientes)
    {
        $this->planClientes[] = $planClientes;

        return $this;
    }

    /**
     * Remove PlanClientes entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanClientes $planClientes
     * @return \CoreBundle\Entity\Clientes
     */
    public function removePlanClientes(PlanClientes $planClientes)
    {
        $this->planClientes->removeElement($planClientes);

        return $this;
    }

    /**
     * Get PlanClientes entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanClientes()
    {
        return $this->planClientes;
    }

    /**
     * Add PropuestaCliente entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaCliente $propuestaCliente
     * @return \CoreBundle\Entity\Clientes
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
     * @return \CoreBundle\Entity\Clientes
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
     * Set Grupos entity (many to one).
     *
     * @param \CoreBundle\Entity\Grupos $grupos
     * @return \CoreBundle\Entity\Clientes
     */
    public function setGrupos(Grupos $grupos = null)
    {
        $this->grupos = $grupos;

        return $this;
    }

    /**
     * Get Grupos entity (many to one).
     *
     * @return \CoreBundle\Entity\Grupos
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * Set TipoClientes entity (many to one).
     *
     * @param \CoreBundle\Entity\TipoClientes $tipoClientes
     * @return \CoreBundle\Entity\Clientes
     */
    public function setTipoClientes(TipoClientes $tipoClientes = null)
    {
        $this->tipoClientes = $tipoClientes;

        return $this;
    }

    /**
     * Get TipoClientes entity (many to one).
     *
     * @return \CoreBundle\Entity\TipoClientes
     */
    public function getTipoClientes()
    {
        return $this->tipoClientes;
    }

    /**
     * Set Categorias entity (many to one).
     *
     * @param \CoreBundle\Entity\Categorias $categorias
     * @return \CoreBundle\Entity\Clientes
     */
    public function setCategorias(Categorias $categorias = null)
    {
        $this->categorias = $categorias;

        return $this;
    }

    /**
     * Get Categorias entity (many to one).
     *
     * @return \CoreBundle\Entity\Categorias
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    public function __sleep()
    {
        return array('id', 'folioGenerico', 'numeroPermiso', 'estacionServicio', 'razonSocial', 'rfc', 'correoEmpresa', 'telefonoEmpresa', 'activo', 'coordenadaX', 'coordenadaY', 'fechaAlta', 'fechaModificacion', 'fechaBaja', 'idGrupo', 'idTipoCliente', 'idCategoria');
    }
}