<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Prospeccion
 *
 * @ORM\Entity()
 * @ORM\Table(name="prospeccion", indexes={@ORM\Index(name="fk_prospeccion_estatusSeguimientoProspeccion1_idx", columns={"idEstatusSeguimientoProspeccion"}), @ORM\Index(name="fk_prospeccion_planClienteAsesor1_idx", columns={"idPlanClienteAsesor"}), @ORM\Index(name="fk_prospeccion_responsableContactos1_idx", columns={"idResponsableContactos"})})
 */
class Prospeccion
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
    protected $fechaRegistro;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $horaInicio;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $horaFin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isReprogramada;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaReprograma;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $horaReprograma;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $observaciones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $rutaPropuesta;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costoTotal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idProspeccionPadre;

    /**
     * @ORM\OneToMany(targetEntity="ProspeccionServicio", mappedBy="prospeccion")
     * @ORM\JoinColumn(name="id", referencedColumnName="idProspeccion", nullable=false)
     */
    protected $prospeccionServicios;

    /**
     * @ORM\ManyToOne(targetEntity="EstatusSeguimientoProspeccion", inversedBy="prospeccions")
     * @ORM\JoinColumn(name="idEstatusSeguimientoProspeccion", referencedColumnName="id", nullable=false)
     */
    protected $estatusSeguimientoProspeccion;

    /**
     * @ORM\ManyToOne(targetEntity="PlanClienteAsesor", inversedBy="prospeccions")
     * @ORM\JoinColumn(name="idPlanClienteAsesor", referencedColumnName="id", nullable=false)
     */
    protected $planClienteAsesor;

    /**
     * @ORM\ManyToOne(targetEntity="ResponsableContactos", inversedBy="prospeccions")
     * @ORM\JoinColumn(name="idResponsableContactos", referencedColumnName="id", nullable=false)
     */
    protected $responsableContactos;

    public function __construct()
    {
        $this->prospeccionServicios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Prospeccion
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
     * @return \CoreBundle\Entity\Prospeccion
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
     * Set the value of fechaRegistro.
     *
     * @param \DateTime $fechaRegistro
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get the value of fechaRegistro.
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set the value of horaInicio.
     *
     * @param string $horaInicio
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get the value of horaInicio.
     *
     * @return string
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set the value of horaFin.
     *
     * @param string $horaFin
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get the value of horaFin.
     *
     * @return string
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set the value of isReprogramada.
     *
     * @param boolean $isReprogramada
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setIsReprogramada($isReprogramada)
    {
        $this->isReprogramada = $isReprogramada;

        return $this;
    }

    /**
     * Get the value of isReprogramada.
     *
     * @return boolean
     */
    public function getIsReprogramada()
    {
        return $this->isReprogramada;
    }

    /**
     * Set the value of fechaReprograma.
     *
     * @param \DateTime $fechaReprograma
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setFechaReprograma($fechaReprograma)
    {
        $this->fechaReprograma = $fechaReprograma;

        return $this;
    }

    /**
     * Get the value of fechaReprograma.
     *
     * @return \DateTime
     */
    public function getFechaReprograma()
    {
        return $this->fechaReprograma;
    }

    /**
     * Set the value of horaReprograma.
     *
     * @param string $horaReprograma
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setHoraReprograma($horaReprograma)
    {
        $this->horaReprograma = $horaReprograma;

        return $this;
    }

    /**
     * Get the value of horaReprograma.
     *
     * @return string
     */
    public function getHoraReprograma()
    {
        return $this->horaReprograma;
    }

    /**
     * Set the value of observaciones.
     *
     * @param string $observaciones
     * @return \CoreBundle\Entity\Prospeccion
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
     * Set the value of rutaPropuesta.
     *
     * @param string $rutaPropuesta
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setRutaPropuesta($rutaPropuesta)
    {
        $this->rutaPropuesta = $rutaPropuesta;

        return $this;
    }

    /**
     * Get the value of rutaPropuesta.
     *
     * @return string
     */
    public function getRutaPropuesta()
    {
        return $this->rutaPropuesta;
    }

    /**
     * Set the value of costoTotal.
     *
     * @param float $costoTotal
     * @return \CoreBundle\Entity\Prospeccion
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
     * Set the value of idProspeccionPadre.
     *
     * @param integer $idProspeccionPadre
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setIdProspeccionPadre($idProspeccionPadre)
    {
        $this->idProspeccionPadre = $idProspeccionPadre;

        return $this;
    }

    /**
     * Get the value of idProspeccionPadre.
     *
     * @return integer
     */
    public function getIdProspeccionPadre()
    {
        return $this->idProspeccionPadre;
    }

    /**
     * Set the value of idEstatusSeguimientoProspeccion.
     *
     * @param integer $idEstatusSeguimientoProspeccion
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setIdEstatusSeguimientoProspeccion($idEstatusSeguimientoProspeccion)
    {
        $this->idEstatusSeguimientoProspeccion = $idEstatusSeguimientoProspeccion;

        return $this;
    }

    /**
     * Get the value of idEstatusSeguimientoProspeccion.
     *
     * @return integer
     */
    public function getIdEstatusSeguimientoProspeccion()
    {
        return $this->idEstatusSeguimientoProspeccion;
    }

    /**
     * Set the value of idPlanClienteAsesor.
     *
     * @param integer $idPlanClienteAsesor
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setIdPlanClienteAsesor($idPlanClienteAsesor)
    {
        $this->idPlanClienteAsesor = $idPlanClienteAsesor;

        return $this;
    }

    /**
     * Get the value of idPlanClienteAsesor.
     *
     * @return integer
     */
    public function getIdPlanClienteAsesor()
    {
        return $this->idPlanClienteAsesor;
    }

    /**
     * Set the value of idResponsableContactos.
     *
     * @param integer $idResponsableContactos
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setIdResponsableContactos($idResponsableContactos)
    {
        $this->idResponsableContactos = $idResponsableContactos;

        return $this;
    }

    /**
     * Get the value of idResponsableContactos.
     *
     * @return integer
     */
    public function getIdResponsableContactos()
    {
        return $this->idResponsableContactos;
    }

    /**
     * Add ProspeccionServicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ProspeccionServicio $prospeccionServicio
     * @return \CoreBundle\Entity\Prospeccion
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
     * @return \CoreBundle\Entity\Prospeccion
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
     * Set EstatusSeguimientoProspeccion entity (many to one).
     *
     * @param \CoreBundle\Entity\EstatusSeguimientoProspeccion $estatusSeguimientoProspeccion
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setEstatusSeguimientoProspeccion(EstatusSeguimientoProspeccion $estatusSeguimientoProspeccion = null)
    {
        $this->estatusSeguimientoProspeccion = $estatusSeguimientoProspeccion;

        return $this;
    }

    /**
     * Get EstatusSeguimientoProspeccion entity (many to one).
     *
     * @return \CoreBundle\Entity\EstatusSeguimientoProspeccion
     */
    public function getEstatusSeguimientoProspeccion()
    {
        return $this->estatusSeguimientoProspeccion;
    }

    /**
     * Set PlanClienteAsesor entity (many to one).
     *
     * @param \CoreBundle\Entity\PlanClienteAsesor $planClienteAsesor
     * @return \CoreBundle\Entity\Prospeccion
     */
    public function setPlanClienteAsesor(PlanClienteAsesor $planClienteAsesor = null)
    {
        $this->planClienteAsesor = $planClienteAsesor;

        return $this;
    }

    /**
     * Get PlanClienteAsesor entity (many to one).
     *
     * @return \CoreBundle\Entity\PlanClienteAsesor
     */
    public function getPlanClienteAsesor()
    {
        return $this->planClienteAsesor;
    }

    /**
     * Set ResponsableContactos entity (many to one).
     *
     * @param \CoreBundle\Entity\ResponsableContactos $responsableContactos
     * @return \CoreBundle\Entity\Prospeccion
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

    public function __sleep()
    {
        return array('id', 'activo', 'fechaRegistro', 'horaInicio', 'horaFin', 'isReprogramada', 'fechaReprograma', 'horaReprograma', 'observaciones', 'rutaPropuesta', 'costoTotal', 'idProspeccionPadre', 'idEstatusSeguimientoProspeccion', 'idPlanClienteAsesor', 'idResponsableContactos');
    }
}