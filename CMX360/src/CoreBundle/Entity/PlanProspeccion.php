<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\PlanProspeccion
 *
 * @ORM\Entity()
 * @ORM\Table(name="planProspeccion", indexes={@ORM\Index(name="fk_planProspeccion_tipoClientes1_idx", columns={"idTipoClientes"}), @ORM\Index(name="fk_planProspeccion_campana1_idx", columns={"idCampana"}), @ORM\Index(name="fk_planProspeccion_marcas1_idx", columns={"idMarca"}), @ORM\Index(name="fk_planProspeccion_zonas1_idx", columns={"idZona"}), @ORM\Index(name="fk_planProspeccion_estados1_idx", columns={"idEstado"}), @ORM\Index(name="fk_planProspeccion_municipios1_idx", columns={"idMunicipio"}), @ORM\Index(name="fk_planProspeccion_estatusPlan1_idx", columns={"idEstatusPlan"}), @ORM\Index(name="fk_planProspeccion_estatusSeguimiento1_idx", columns={"idEstatusSeguimiento"}), @ORM\Index(name="fk_planProspeccion_convenios1_idx", columns={"idConvenio"})})
 */
class PlanProspeccion
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
    protected $codigoPostal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaInicio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaFin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $condicionesComerciales;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $numeroAsesores;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $cantidadClientes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $cantidadServicio;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costoTotal;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costoTotalCN;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costoTotalPropuesto;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costodeProspeccion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaEnvioRevisionDO;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaEnvioRevisionDG;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAutorizacionDO;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAutorizacionDG;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaEnvioaAdmin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $rutaFlyer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observacionesDO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observacionesDG;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idusuarioAutoriza;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idusuarioGenera;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $descuentoN;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isNegociable;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isIntegral;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isConvenio;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $json;

    /**
     * @ORM\OneToMany(targetEntity="PlanAsocUniGpo", mappedBy="planProspeccion")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPlanProspeccion", nullable=false)
     */
    protected $planAsocUniGpos;

    /**
     * @ORM\OneToMany(targetEntity="PlanClientes", mappedBy="planProspeccion")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPlanProspeccion", nullable=false)
     */
    protected $planClientes;

    /**
     * @ORM\OneToMany(targetEntity="PlanCombo", mappedBy="planProspeccion")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPlanProspeccion", nullable=false)
     */
    protected $planCombos;

    /**
     * @ORM\OneToMany(targetEntity="PlanServicio", mappedBy="planProspeccion")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPlanProspeccion", nullable=false)
     */
    protected $planServicios;

    /**
     * @ORM\OneToMany(targetEntity="PropuestasGeneral", mappedBy="planProspeccion")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPlanProspeccion", nullable=false)
     */
    protected $propuestasGenerals;

    /**
     * @ORM\ManyToOne(targetEntity="TipoClientes", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idTipoClientes", referencedColumnName="id")
     */
    protected $tipoClientes;

    /**
     * @ORM\ManyToOne(targetEntity="Campana", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idCampana", referencedColumnName="id")
     */
    protected $campana;

    /**
     * @ORM\ManyToOne(targetEntity="Marcas", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idMarca", referencedColumnName="id")
     */
    protected $marcas;

    /**
     * @ORM\ManyToOne(targetEntity="Zonas", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idZona", referencedColumnName="id")
     */
    protected $zonas;

    /**
     * @ORM\ManyToOne(targetEntity="Estados", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idEstado", referencedColumnName="id")
     */
    protected $estados;

    /**
     * @ORM\ManyToOne(targetEntity="Municipios", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idMunicipio", referencedColumnName="id")
     */
    protected $municipios;

    /**
     * @ORM\ManyToOne(targetEntity="EstatusPlan", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idEstatusPlan", referencedColumnName="id", nullable=false)
     */
    protected $estatusPlan;

    /**
     * @ORM\ManyToOne(targetEntity="EstatusSeguimiento", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idEstatusSeguimiento", referencedColumnName="id")
     */
    protected $estatusSeguimiento;

    /**
     * @ORM\ManyToOne(targetEntity="Convenios", inversedBy="planProspeccions")
     * @ORM\JoinColumn(name="idConvenio", referencedColumnName="id")
     */
    protected $convenios;

    public function __construct()
    {
        $this->planAsocUniGpos = new ArrayCollection();
        $this->planClientes = new ArrayCollection();
        $this->planCombos = new ArrayCollection();
        $this->planServicios = new ArrayCollection();
        $this->propuestasGenerals = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * Set the value of codigoPostal.
     *
     * @param string $codigoPostal
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get the value of codigoPostal.
     *
     * @return string
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * Set the value of fechaInicio.
     *
     * @param \DateTime $fechaInicio
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of fechaInicio.
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaFin.
     *
     * @param \DateTime $fechaFin
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get the value of fechaFin.
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set the value of fechaAlta.
     *
     * @param \DateTime $fechaAlta
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * Set the value of condicionesComerciales.
     *
     * @param string $condicionesComerciales
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setCondicionesComerciales($condicionesComerciales)
    {
        $this->condicionesComerciales = $condicionesComerciales;

        return $this;
    }

    /**
     * Get the value of condicionesComerciales.
     *
     * @return string
     */
    public function getCondicionesComerciales()
    {
        return $this->condicionesComerciales;
    }

    /**
     * Set the value of numeroAsesores.
     *
     * @param integer $numeroAsesores
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setNumeroAsesores($numeroAsesores)
    {
        $this->numeroAsesores = $numeroAsesores;

        return $this;
    }

    /**
     * Get the value of numeroAsesores.
     *
     * @return integer
     */
    public function getNumeroAsesores()
    {
        return $this->numeroAsesores;
    }

    /**
     * Set the value of cantidadClientes.
     *
     * @param integer $cantidadClientes
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setCantidadClientes($cantidadClientes)
    {
        $this->cantidadClientes = $cantidadClientes;

        return $this;
    }

    /**
     * Get the value of cantidadClientes.
     *
     * @return integer
     */
    public function getCantidadClientes()
    {
        return $this->cantidadClientes;
    }

    /**
     * Set the value of cantidadServicio.
     *
     * @param integer $cantidadServicio
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setCantidadServicio($cantidadServicio)
    {
        $this->cantidadServicio = $cantidadServicio;

        return $this;
    }

    /**
     * Get the value of cantidadServicio.
     *
     * @return integer
     */
    public function getCantidadServicio()
    {
        return $this->cantidadServicio;
    }

    /**
     * Set the value of costoTotal.
     *
     * @param float $costoTotal
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * Set the value of costoTotalCN.
     *
     * @param float $costoTotalCN
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setCostoTotalCN($costoTotalCN)
    {
        $this->costoTotalCN = $costoTotalCN;

        return $this;
    }

    /**
     * Get the value of costoTotalCN.
     *
     * @return float
     */
    public function getCostoTotalCN()
    {
        return $this->costoTotalCN;
    }

    /**
     * Set the value of costoTotalPropuesto.
     *
     * @param float $costoTotalPropuesto
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setCostoTotalPropuesto($costoTotalPropuesto)
    {
        $this->costoTotalPropuesto = $costoTotalPropuesto;

        return $this;
    }

    /**
     * Get the value of costoTotalPropuesto.
     *
     * @return float
     */
    public function getCostoTotalPropuesto()
    {
        return $this->costoTotalPropuesto;
    }

    /**
     * Set the value of costodeProspeccion.
     *
     * @param float $costodeProspeccion
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setCostodeProspeccion($costodeProspeccion)
    {
        $this->costodeProspeccion = $costodeProspeccion;

        return $this;
    }

    /**
     * Get the value of costodeProspeccion.
     *
     * @return float
     */
    public function getCostodeProspeccion()
    {
        return $this->costodeProspeccion;
    }

    /**
     * Set the value of fechaEnvioRevisionDO.
     *
     * @param \DateTime $fechaEnvioRevisionDO
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setFechaEnvioRevisionDO($fechaEnvioRevisionDO)
    {
        $this->fechaEnvioRevisionDO = $fechaEnvioRevisionDO;

        return $this;
    }

    /**
     * Get the value of fechaEnvioRevisionDO.
     *
     * @return \DateTime
     */
    public function getFechaEnvioRevisionDO()
    {
        return $this->fechaEnvioRevisionDO;
    }

    /**
     * Set the value of fechaEnvioRevisionDG.
     *
     * @param \DateTime $fechaEnvioRevisionDG
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setFechaEnvioRevisionDG($fechaEnvioRevisionDG)
    {
        $this->fechaEnvioRevisionDG = $fechaEnvioRevisionDG;

        return $this;
    }

    /**
     * Get the value of fechaEnvioRevisionDG.
     *
     * @return \DateTime
     */
    public function getFechaEnvioRevisionDG()
    {
        return $this->fechaEnvioRevisionDG;
    }

    /**
     * Set the value of fechaAutorizacionDO.
     *
     * @param \DateTime $fechaAutorizacionDO
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setFechaAutorizacionDO($fechaAutorizacionDO)
    {
        $this->fechaAutorizacionDO = $fechaAutorizacionDO;

        return $this;
    }

    /**
     * Get the value of fechaAutorizacionDO.
     *
     * @return \DateTime
     */
    public function getFechaAutorizacionDO()
    {
        return $this->fechaAutorizacionDO;
    }

    /**
     * Set the value of fechaAutorizacionDG.
     *
     * @param \DateTime $fechaAutorizacionDG
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setFechaAutorizacionDG($fechaAutorizacionDG)
    {
        $this->fechaAutorizacionDG = $fechaAutorizacionDG;

        return $this;
    }

    /**
     * Get the value of fechaAutorizacionDG.
     *
     * @return \DateTime
     */
    public function getFechaAutorizacionDG()
    {
        return $this->fechaAutorizacionDG;
    }

    /**
     * Set the value of fechaEnvioaAdmin.
     *
     * @param \DateTime $fechaEnvioaAdmin
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setFechaEnvioaAdmin($fechaEnvioaAdmin)
    {
        $this->fechaEnvioaAdmin = $fechaEnvioaAdmin;

        return $this;
    }

    /**
     * Get the value of fechaEnvioaAdmin.
     *
     * @return \DateTime
     */
    public function getFechaEnvioaAdmin()
    {
        return $this->fechaEnvioaAdmin;
    }

    /**
     * Set the value of rutaFlyer.
     *
     * @param string $rutaFlyer
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setRutaFlyer($rutaFlyer)
    {
        $this->rutaFlyer = $rutaFlyer;

        return $this;
    }

    /**
     * Get the value of rutaFlyer.
     *
     * @return string
     */
    public function getRutaFlyer()
    {
        return $this->rutaFlyer;
    }

    /**
     * Set the value of observacionesDO.
     *
     * @param string $observacionesDO
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setObservacionesDO($observacionesDO)
    {
        $this->observacionesDO = $observacionesDO;

        return $this;
    }

    /**
     * Get the value of observacionesDO.
     *
     * @return string
     */
    public function getObservacionesDO()
    {
        return $this->observacionesDO;
    }

    /**
     * Set the value of observacionesDG.
     *
     * @param string $observacionesDG
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setObservacionesDG($observacionesDG)
    {
        $this->observacionesDG = $observacionesDG;

        return $this;
    }

    /**
     * Get the value of observacionesDG.
     *
     * @return string
     */
    public function getObservacionesDG()
    {
        return $this->observacionesDG;
    }

    /**
     * Set the value of idusuarioAutoriza.
     *
     * @param integer $idusuarioAutoriza
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdusuarioAutoriza($idusuarioAutoriza)
    {
        $this->idusuarioAutoriza = $idusuarioAutoriza;

        return $this;
    }

    /**
     * Get the value of idusuarioAutoriza.
     *
     * @return integer
     */
    public function getIdusuarioAutoriza()
    {
        return $this->idusuarioAutoriza;
    }

    /**
     * Set the value of idusuarioGenera.
     *
     * @param integer $idusuarioGenera
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdusuarioGenera($idusuarioGenera)
    {
        $this->idusuarioGenera = $idusuarioGenera;

        return $this;
    }

    /**
     * Get the value of idusuarioGenera.
     *
     * @return integer
     */
    public function getIdusuarioGenera()
    {
        return $this->idusuarioGenera;
    }

    /**
     * Set the value of descuentoN.
     *
     * @param integer $descuentoN
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setDescuentoN($descuentoN)
    {
        $this->descuentoN = $descuentoN;

        return $this;
    }

    /**
     * Get the value of descuentoN.
     *
     * @return integer
     */
    public function getDescuentoN()
    {
        return $this->descuentoN;
    }

    /**
     * Set the value of isNegociable.
     *
     * @param boolean $isNegociable
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIsNegociable($isNegociable)
    {
        $this->isNegociable = $isNegociable;

        return $this;
    }

    /**
     * Get the value of isNegociable.
     *
     * @return boolean
     */
    public function getIsNegociable()
    {
        return $this->isNegociable;
    }

    /**
     * Set the value of isIntegral.
     *
     * @param boolean $isIntegral
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIsIntegral($isIntegral)
    {
        $this->isIntegral = $isIntegral;

        return $this;
    }

    /**
     * Get the value of isIntegral.
     *
     * @return boolean
     */
    public function getIsIntegral()
    {
        return $this->isIntegral;
    }

    /**
     * Set the value of isConvenio.
     *
     * @param boolean $isConvenio
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIsConvenio($isConvenio)
    {
        $this->isConvenio = $isConvenio;

        return $this;
    }

    /**
     * Get the value of isConvenio.
     *
     * @return boolean
     */
    public function getIsConvenio()
    {
        return $this->isConvenio;
    }

    /**
     * Set the value of json.
     *
     * @param string $json
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setJson($json)
    {
        $this->json = $json;

        return $this;
    }

    /**
     * Get the value of json.
     *
     * @return string
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * Set the value of idTipoClientes.
     *
     * @param integer $idTipoClientes
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdTipoClientes($idTipoClientes)
    {
        $this->idTipoClientes = $idTipoClientes;

        return $this;
    }

    /**
     * Get the value of idTipoClientes.
     *
     * @return integer
     */
    public function getIdTipoClientes()
    {
        return $this->idTipoClientes;
    }

    /**
     * Set the value of idCampana.
     *
     * @param integer $idCampana
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdCampana($idCampana)
    {
        $this->idCampana = $idCampana;

        return $this;
    }

    /**
     * Get the value of idCampana.
     *
     * @return integer
     */
    public function getIdCampana()
    {
        return $this->idCampana;
    }

    /**
     * Set the value of idMarca.
     *
     * @param integer $idMarca
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * Set the value of idZona.
     *
     * @param integer $idZona
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdZona($idZona)
    {
        $this->idZona = $idZona;

        return $this;
    }

    /**
     * Get the value of idZona.
     *
     * @return integer
     */
    public function getIdZona()
    {
        return $this->idZona;
    }

    /**
     * Set the value of idEstado.
     *
     * @param integer $idEstado
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get the value of idEstado.
     *
     * @return integer
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * Set the value of idMunicipio.
     *
     * @param integer $idMunicipio
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * Set the value of idEstatusPlan.
     *
     * @param integer $idEstatusPlan
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdEstatusPlan($idEstatusPlan)
    {
        $this->idEstatusPlan = $idEstatusPlan;

        return $this;
    }

    /**
     * Get the value of idEstatusPlan.
     *
     * @return integer
     */
    public function getIdEstatusPlan()
    {
        return $this->idEstatusPlan;
    }

    /**
     * Set the value of idEstatusSeguimiento.
     *
     * @param integer $idEstatusSeguimiento
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdEstatusSeguimiento($idEstatusSeguimiento)
    {
        $this->idEstatusSeguimiento = $idEstatusSeguimiento;

        return $this;
    }

    /**
     * Get the value of idEstatusSeguimiento.
     *
     * @return integer
     */
    public function getIdEstatusSeguimiento()
    {
        return $this->idEstatusSeguimiento;
    }

    /**
     * Set the value of idConvenio.
     *
     * @param integer $idConvenio
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setIdConvenio($idConvenio)
    {
        $this->idConvenio = $idConvenio;

        return $this;
    }

    /**
     * Get the value of idConvenio.
     *
     * @return integer
     */
    public function getIdConvenio()
    {
        return $this->idConvenio;
    }

    /**
     * Add PlanAsocUniGpo entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanAsocUniGpo $planAsocUniGpo
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function addPlanAsocUniGpo(PlanAsocUniGpo $planAsocUniGpo)
    {
        $this->planAsocUniGpos[] = $planAsocUniGpo;

        return $this;
    }

    /**
     * Remove PlanAsocUniGpo entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanAsocUniGpo $planAsocUniGpo
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function removePlanAsocUniGpo(PlanAsocUniGpo $planAsocUniGpo)
    {
        $this->planAsocUniGpos->removeElement($planAsocUniGpo);

        return $this;
    }

    /**
     * Get PlanAsocUniGpo entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanAsocUniGpos()
    {
        return $this->planAsocUniGpos;
    }

    /**
     * Add PlanClientes entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanClientes $planClientes
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * Add PlanCombo entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanCombo $planCombo
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function addPlanCombo(PlanCombo $planCombo)
    {
        $this->planCombos[] = $planCombo;

        return $this;
    }

    /**
     * Remove PlanCombo entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanCombo $planCombo
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function removePlanCombo(PlanCombo $planCombo)
    {
        $this->planCombos->removeElement($planCombo);

        return $this;
    }

    /**
     * Get PlanCombo entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanCombos()
    {
        return $this->planCombos;
    }

    /**
     * Add PlanServicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanServicio $planServicio
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function addPlanServicio(PlanServicio $planServicio)
    {
        $this->planServicios[] = $planServicio;

        return $this;
    }

    /**
     * Remove PlanServicio entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanServicio $planServicio
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function removePlanServicio(PlanServicio $planServicio)
    {
        $this->planServicios->removeElement($planServicio);

        return $this;
    }

    /**
     * Get PlanServicio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanServicios()
    {
        return $this->planServicios;
    }

    /**
     * Add PropuestasGeneral entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestasGeneral $propuestasGeneral
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function addPropuestasGeneral(PropuestasGeneral $propuestasGeneral)
    {
        $this->propuestasGenerals[] = $propuestasGeneral;

        return $this;
    }

    /**
     * Remove PropuestasGeneral entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestasGeneral $propuestasGeneral
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function removePropuestasGeneral(PropuestasGeneral $propuestasGeneral)
    {
        $this->propuestasGenerals->removeElement($propuestasGeneral);

        return $this;
    }

    /**
     * Get PropuestasGeneral entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropuestasGenerals()
    {
        return $this->propuestasGenerals;
    }

    /**
     * Set TipoClientes entity (many to one).
     *
     * @param \CoreBundle\Entity\TipoClientes $tipoClientes
     * @return \CoreBundle\Entity\PlanProspeccion
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
     * Set Campana entity (many to one).
     *
     * @param \CoreBundle\Entity\Campana $campana
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setCampana(Campana $campana = null)
    {
        $this->campana = $campana;

        return $this;
    }

    /**
     * Get Campana entity (many to one).
     *
     * @return \CoreBundle\Entity\Campana
     */
    public function getCampana()
    {
        return $this->campana;
    }

    /**
     * Set Marcas entity (many to one).
     *
     * @param \CoreBundle\Entity\Marcas $marcas
     * @return \CoreBundle\Entity\PlanProspeccion
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

    /**
     * Set Zonas entity (many to one).
     *
     * @param \CoreBundle\Entity\Zonas $zonas
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setZonas(Zonas $zonas = null)
    {
        $this->zonas = $zonas;

        return $this;
    }

    /**
     * Get Zonas entity (many to one).
     *
     * @return \CoreBundle\Entity\Zonas
     */
    public function getZonas()
    {
        return $this->zonas;
    }

    /**
     * Set Estados entity (many to one).
     *
     * @param \CoreBundle\Entity\Estados $estados
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setEstados(Estados $estados = null)
    {
        $this->estados = $estados;

        return $this;
    }

    /**
     * Get Estados entity (many to one).
     *
     * @return \CoreBundle\Entity\Estados
     */
    public function getEstados()
    {
        return $this->estados;
    }

    /**
     * Set Municipios entity (many to one).
     *
     * @param \CoreBundle\Entity\Municipios $municipios
     * @return \CoreBundle\Entity\PlanProspeccion
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

    /**
     * Set EstatusPlan entity (many to one).
     *
     * @param \CoreBundle\Entity\EstatusPlan $estatusPlan
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setEstatusPlan(EstatusPlan $estatusPlan = null)
    {
        $this->estatusPlan = $estatusPlan;

        return $this;
    }

    /**
     * Get EstatusPlan entity (many to one).
     *
     * @return \CoreBundle\Entity\EstatusPlan
     */
    public function getEstatusPlan()
    {
        return $this->estatusPlan;
    }

    /**
     * Set EstatusSeguimiento entity (many to one).
     *
     * @param \CoreBundle\Entity\EstatusSeguimiento $estatusSeguimiento
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setEstatusSeguimiento(EstatusSeguimiento $estatusSeguimiento = null)
    {
        $this->estatusSeguimiento = $estatusSeguimiento;

        return $this;
    }

    /**
     * Get EstatusSeguimiento entity (many to one).
     *
     * @return \CoreBundle\Entity\EstatusSeguimiento
     */
    public function getEstatusSeguimiento()
    {
        return $this->estatusSeguimiento;
    }

    /**
     * Set Convenios entity (many to one).
     *
     * @param \CoreBundle\Entity\Convenios $convenios
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function setConvenios(Convenios $convenios = null)
    {
        $this->convenios = $convenios;

        return $this;
    }

    /**
     * Get Convenios entity (many to one).
     *
     * @return \CoreBundle\Entity\Convenios
     */
    public function getConvenios()
    {
        return $this->convenios;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'codigoPostal', 'activo', 'fechaInicio', 'fechaFin', 'fechaAlta', 'condicionesComerciales', 'numeroAsesores', 'cantidadClientes', 'cantidadServicio', 'costoTotal', 'costoTotalCN', 'costoTotalPropuesto', 'costodeProspeccion', 'fechaEnvioRevisionDO', 'fechaEnvioRevisionDG', 'fechaAutorizacionDO', 'fechaAutorizacionDG', 'fechaEnvioaAdmin', 'rutaFlyer', 'observacionesDO', 'observacionesDG', 'idusuarioAutoriza', 'idusuarioGenera', 'descuentoN', 'isNegociable', 'isIntegral', 'isConvenio', 'json', 'idTipoClientes', 'idCampana', 'idMarca', 'idZona', 'idEstado', 'idMunicipio', 'idEstatusPlan', 'idEstatusSeguimiento', 'idConvenio');
    }
}