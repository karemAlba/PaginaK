<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Subservicio
 *
 * @ORM\Entity()
 * @ORM\Table(name="subservicio", indexes={@ORM\Index(name="fk_subservicio_servicio1_idx", columns={"idServicio"}), @ORM\Index(name="fk_subservicio_tipos1_idx", columns={"idTipo"}), @ORM\Index(name="fk_subservicio_vigencia1_idx", columns={"idVigencia"}), @ORM\Index(name="fk_subservicio_periodicidad1_idx", columns={"idPeriodicidad"}), @ORM\Index(name="fk_subservicio_periodoCumplimiento1_idx", columns={"idPeriodoCumplimiento"}), @ORM\Index(name="fk_subservicio_tiempoRealizacion1_idx", columns={"idTiempoRealizacion"}), @ORM\Index(name="fk_subservicio_entregables1_idx", columns={"idEntregable"}), @ORM\Index(name="fk_subservicio_periodoAplicacion1_idx", columns={"idPeriodoAplicacion"})})
 */
class Subservicio
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
    protected $clave;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $caracteristicas;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isEnSitio;

    /**
     * @ORM\OneToMany(targetEntity="ComboSubservicio", mappedBy="subservicio")
     * @ORM\JoinColumn(name="id", referencedColumnName="idSubservicio", nullable=false)
     */
    protected $comboSubservicios;

    /**
     * @ORM\OneToMany(targetEntity="ConvenioSubservicios", mappedBy="subservicio")
     * @ORM\JoinColumn(name="id", referencedColumnName="idSubservicio", nullable=false)
     */
    protected $convenioSubservicios;

    /**
     * @ORM\OneToMany(targetEntity="PlanServicio", mappedBy="subservicio")
     * @ORM\JoinColumn(name="id", referencedColumnName="idSubservicio", nullable=false)
     */
    protected $planServicios;

    /**
     * @ORM\OneToMany(targetEntity="PropuestaServicio", mappedBy="subservicio")
     * @ORM\JoinColumn(name="id", referencedColumnName="idSubservicio", nullable=false)
     */
    protected $propuestaServicios;

    /**
     * @ORM\OneToMany(targetEntity="ProspeccionServicio", mappedBy="subservicio")
     * @ORM\JoinColumn(name="id", referencedColumnName="idSubservicio", nullable=false)
     */
    protected $prospeccionServicios;

    /**
     * @ORM\OneToMany(targetEntity="SubservicioPrecio", mappedBy="subservicio")
     * @ORM\JoinColumn(name="id", referencedColumnName="idSubservicio", nullable=false)
     */
    protected $subservicioPrecios;

    /**
     * @ORM\ManyToOne(targetEntity="Servicio", inversedBy="subservicios")
     * @ORM\JoinColumn(name="idServicio", referencedColumnName="id", nullable=false)
     */
    protected $servicio;

    /**
     * @ORM\ManyToOne(targetEntity="Tipos", inversedBy="subservicios")
     * @ORM\JoinColumn(name="idTipo", referencedColumnName="id", nullable=false)
     */
    protected $tipos;

    /**
     * @ORM\ManyToOne(targetEntity="Vigencia", inversedBy="subservicios")
     * @ORM\JoinColumn(name="idVigencia", referencedColumnName="id", nullable=false)
     */
    protected $vigencia;

    /**
     * @ORM\ManyToOne(targetEntity="Periodicidad", inversedBy="subservicios")
     * @ORM\JoinColumn(name="idPeriodicidad", referencedColumnName="id", nullable=false)
     */
    protected $periodicidad;

    /**
     * @ORM\ManyToOne(targetEntity="PeriodoCumplimiento", inversedBy="subservicios")
     * @ORM\JoinColumn(name="idPeriodoCumplimiento", referencedColumnName="id", nullable=false)
     */
    protected $periodoCumplimiento;

    /**
     * @ORM\ManyToOne(targetEntity="TiempoRealizacion", inversedBy="subservicios")
     * @ORM\JoinColumn(name="idTiempoRealizacion", referencedColumnName="id", nullable=false)
     */
    protected $tiempoRealizacion;

    /**
     * @ORM\ManyToOne(targetEntity="Entregables", inversedBy="subservicios")
     * @ORM\JoinColumn(name="idEntregable", referencedColumnName="id", nullable=false)
     */
    protected $entregables;

    /**
     * @ORM\ManyToOne(targetEntity="PeriodoAplicacion", inversedBy="subservicios")
     * @ORM\JoinColumn(name="idPeriodoAplicacion", referencedColumnName="id", nullable=false)
     */
    protected $periodoAplicacion;

    public function __construct()
    {
        $this->comboSubservicios = new ArrayCollection();
        $this->convenioSubservicios = new ArrayCollection();
        $this->planServicios = new ArrayCollection();
        $this->propuestaServicios = new ArrayCollection();
        $this->prospeccionServicios = new ArrayCollection();
        $this->subservicioPrecios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Subservicio
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
     * Set the value of clave.
     *
     * @param string $clave
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get the value of clave.
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\Subservicio
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
     * Set the value of caracteristicas.
     *
     * @param string $caracteristicas
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setCaracteristicas($caracteristicas)
    {
        $this->caracteristicas = $caracteristicas;

        return $this;
    }

    /**
     * Get the value of caracteristicas.
     *
     * @return string
     */
    public function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Subservicio
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
     * Set the value of isEnSitio.
     *
     * @param boolean $isEnSitio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIsEnSitio($isEnSitio)
    {
        $this->isEnSitio = $isEnSitio;

        return $this;
    }

    /**
     * Get the value of isEnSitio.
     *
     * @return boolean
     */
    public function getIsEnSitio()
    {
        return $this->isEnSitio;
    }

    /**
     * Set the value of idServicio.
     *
     * @param integer $idServicio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;

        return $this;
    }

    /**
     * Get the value of idServicio.
     *
     * @return integer
     */
    public function getIdServicio()
    {
        return $this->idServicio;
    }

    /**
     * Set the value of idTipo.
     *
     * @param integer $idTipo
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;

        return $this;
    }

    /**
     * Get the value of idTipo.
     *
     * @return integer
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * Set the value of idVigencia.
     *
     * @param integer $idVigencia
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIdVigencia($idVigencia)
    {
        $this->idVigencia = $idVigencia;

        return $this;
    }

    /**
     * Get the value of idVigencia.
     *
     * @return integer
     */
    public function getIdVigencia()
    {
        return $this->idVigencia;
    }

    /**
     * Set the value of idPeriodicidad.
     *
     * @param integer $idPeriodicidad
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIdPeriodicidad($idPeriodicidad)
    {
        $this->idPeriodicidad = $idPeriodicidad;

        return $this;
    }

    /**
     * Get the value of idPeriodicidad.
     *
     * @return integer
     */
    public function getIdPeriodicidad()
    {
        return $this->idPeriodicidad;
    }

    /**
     * Set the value of idPeriodoCumplimiento.
     *
     * @param integer $idPeriodoCumplimiento
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIdPeriodoCumplimiento($idPeriodoCumplimiento)
    {
        $this->idPeriodoCumplimiento = $idPeriodoCumplimiento;

        return $this;
    }

    /**
     * Get the value of idPeriodoCumplimiento.
     *
     * @return integer
     */
    public function getIdPeriodoCumplimiento()
    {
        return $this->idPeriodoCumplimiento;
    }

    /**
     * Set the value of idTiempoRealizacion.
     *
     * @param integer $idTiempoRealizacion
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIdTiempoRealizacion($idTiempoRealizacion)
    {
        $this->idTiempoRealizacion = $idTiempoRealizacion;

        return $this;
    }

    /**
     * Get the value of idTiempoRealizacion.
     *
     * @return integer
     */
    public function getIdTiempoRealizacion()
    {
        return $this->idTiempoRealizacion;
    }

    /**
     * Set the value of idEntregable.
     *
     * @param integer $idEntregable
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIdEntregable($idEntregable)
    {
        $this->idEntregable = $idEntregable;

        return $this;
    }

    /**
     * Get the value of idEntregable.
     *
     * @return integer
     */
    public function getIdEntregable()
    {
        return $this->idEntregable;
    }

    /**
     * Set the value of idPeriodoAplicacion.
     *
     * @param integer $idPeriodoAplicacion
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setIdPeriodoAplicacion($idPeriodoAplicacion)
    {
        $this->idPeriodoAplicacion = $idPeriodoAplicacion;

        return $this;
    }

    /**
     * Get the value of idPeriodoAplicacion.
     *
     * @return integer
     */
    public function getIdPeriodoAplicacion()
    {
        return $this->idPeriodoAplicacion;
    }

    /**
     * Add ComboSubservicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ComboSubservicio $comboSubservicio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function addComboSubservicio(ComboSubservicio $comboSubservicio)
    {
        $this->comboSubservicios[] = $comboSubservicio;

        return $this;
    }

    /**
     * Remove ComboSubservicio entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ComboSubservicio $comboSubservicio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function removeComboSubservicio(ComboSubservicio $comboSubservicio)
    {
        $this->comboSubservicios->removeElement($comboSubservicio);

        return $this;
    }

    /**
     * Get ComboSubservicio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComboSubservicios()
    {
        return $this->comboSubservicios;
    }

    /**
     * Add ConvenioSubservicios entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ConvenioSubservicios $convenioSubservicios
     * @return \CoreBundle\Entity\Subservicio
     */
    public function addConvenioSubservicios(ConvenioSubservicios $convenioSubservicios)
    {
        $this->convenioSubservicios[] = $convenioSubservicios;

        return $this;
    }

    /**
     * Remove ConvenioSubservicios entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ConvenioSubservicios $convenioSubservicios
     * @return \CoreBundle\Entity\Subservicio
     */
    public function removeConvenioSubservicios(ConvenioSubservicios $convenioSubservicios)
    {
        $this->convenioSubservicios->removeElement($convenioSubservicios);

        return $this;
    }

    /**
     * Get ConvenioSubservicios entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConvenioSubservicios()
    {
        return $this->convenioSubservicios;
    }

    /**
     * Add PlanServicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanServicio $planServicio
     * @return \CoreBundle\Entity\Subservicio
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
     * @return \CoreBundle\Entity\Subservicio
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
     * Add PropuestaServicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaServicio $propuestaServicio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function addPropuestaServicio(PropuestaServicio $propuestaServicio)
    {
        $this->propuestaServicios[] = $propuestaServicio;

        return $this;
    }

    /**
     * Remove PropuestaServicio entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaServicio $propuestaServicio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function removePropuestaServicio(PropuestaServicio $propuestaServicio)
    {
        $this->propuestaServicios->removeElement($propuestaServicio);

        return $this;
    }

    /**
     * Get PropuestaServicio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropuestaServicios()
    {
        return $this->propuestaServicios;
    }

    /**
     * Add ProspeccionServicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ProspeccionServicio $prospeccionServicio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function addProspeccionServicio(ProspeccionServicio $prospeccionServicio)
    {
        $this->prospeccionServicios[] = $prospeccionServicio;

        return $this;
    }

    /**
     * Remove ProspeccionServicio entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ProspeccionServicio $prospeccionServicio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function removeProspeccionServicio(ProspeccionServicio $prospeccionServicio)
    {
        $this->prospeccionServicios->removeElement($prospeccionServicio);

        return $this;
    }

    /**
     * Get ProspeccionServicio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProspeccionServicios()
    {
        return $this->prospeccionServicios;
    }

    /**
     * Add SubservicioPrecio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\SubservicioPrecio $subservicioPrecio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function addSubservicioPrecio(SubservicioPrecio $subservicioPrecio)
    {
        $this->subservicioPrecios[] = $subservicioPrecio;

        return $this;
    }

    /**
     * Remove SubservicioPrecio entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\SubservicioPrecio $subservicioPrecio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function removeSubservicioPrecio(SubservicioPrecio $subservicioPrecio)
    {
        $this->subservicioPrecios->removeElement($subservicioPrecio);

        return $this;
    }

    /**
     * Get SubservicioPrecio entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubservicioPrecios()
    {
        return $this->subservicioPrecios;
    }

    /**
     * Set Servicio entity (many to one).
     *
     * @param \CoreBundle\Entity\Servicio $servicio
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setServicio(Servicio $servicio = null)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get Servicio entity (many to one).
     *
     * @return \CoreBundle\Entity\Servicio
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set Tipos entity (many to one).
     *
     * @param \CoreBundle\Entity\Tipos $tipos
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setTipos(Tipos $tipos = null)
    {
        $this->tipos = $tipos;

        return $this;
    }

    /**
     * Get Tipos entity (many to one).
     *
     * @return \CoreBundle\Entity\Tipos
     */
    public function getTipos()
    {
        return $this->tipos;
    }

    /**
     * Set Vigencia entity (many to one).
     *
     * @param \CoreBundle\Entity\Vigencia $vigencia
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setVigencia(Vigencia $vigencia = null)
    {
        $this->vigencia = $vigencia;

        return $this;
    }

    /**
     * Get Vigencia entity (many to one).
     *
     * @return \CoreBundle\Entity\Vigencia
     */
    public function getVigencia()
    {
        return $this->vigencia;
    }

    /**
     * Set Periodicidad entity (many to one).
     *
     * @param \CoreBundle\Entity\Periodicidad $periodicidad
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setPeriodicidad(Periodicidad $periodicidad = null)
    {
        $this->periodicidad = $periodicidad;

        return $this;
    }

    /**
     * Get Periodicidad entity (many to one).
     *
     * @return \CoreBundle\Entity\Periodicidad
     */
    public function getPeriodicidad()
    {
        return $this->periodicidad;
    }

    /**
     * Set PeriodoCumplimiento entity (many to one).
     *
     * @param \CoreBundle\Entity\PeriodoCumplimiento $periodoCumplimiento
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setPeriodoCumplimiento(PeriodoCumplimiento $periodoCumplimiento = null)
    {
        $this->periodoCumplimiento = $periodoCumplimiento;

        return $this;
    }

    /**
     * Get PeriodoCumplimiento entity (many to one).
     *
     * @return \CoreBundle\Entity\PeriodoCumplimiento
     */
    public function getPeriodoCumplimiento()
    {
        return $this->periodoCumplimiento;
    }

    /**
     * Set TiempoRealizacion entity (many to one).
     *
     * @param \CoreBundle\Entity\TiempoRealizacion $tiempoRealizacion
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setTiempoRealizacion(TiempoRealizacion $tiempoRealizacion = null)
    {
        $this->tiempoRealizacion = $tiempoRealizacion;

        return $this;
    }

    /**
     * Get TiempoRealizacion entity (many to one).
     *
     * @return \CoreBundle\Entity\TiempoRealizacion
     */
    public function getTiempoRealizacion()
    {
        return $this->tiempoRealizacion;
    }

    /**
     * Set Entregables entity (many to one).
     *
     * @param \CoreBundle\Entity\Entregables $entregables
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setEntregables(Entregables $entregables = null)
    {
        $this->entregables = $entregables;

        return $this;
    }

    /**
     * Get Entregables entity (many to one).
     *
     * @return \CoreBundle\Entity\Entregables
     */
    public function getEntregables()
    {
        return $this->entregables;
    }

    /**
     * Set PeriodoAplicacion entity (many to one).
     *
     * @param \CoreBundle\Entity\PeriodoAplicacion $periodoAplicacion
     * @return \CoreBundle\Entity\Subservicio
     */
    public function setPeriodoAplicacion(PeriodoAplicacion $periodoAplicacion = null)
    {
        $this->periodoAplicacion = $periodoAplicacion;

        return $this;
    }

    /**
     * Get PeriodoAplicacion entity (many to one).
     *
     * @return \CoreBundle\Entity\PeriodoAplicacion
     */
    public function getPeriodoAplicacion()
    {
        return $this->periodoAplicacion;
    }

    public function __sleep()
    {
        return array('id', 'clave', 'nombre', 'caracteristicas', 'activo', 'isEnSitio', 'idServicio', 'idTipo', 'idVigencia', 'idPeriodicidad', 'idPeriodoCumplimiento', 'idTiempoRealizacion', 'idEntregable', 'idPeriodoAplicacion');
    }
}