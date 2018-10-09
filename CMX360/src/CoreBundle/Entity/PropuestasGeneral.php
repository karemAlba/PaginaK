<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PropuestasGeneral
 *
 * @ORM\Entity()
 * @ORM\Table(name="propuestasGeneral", indexes={@ORM\Index(name="fk_propuestasGeneral_alcances1_idx", columns={"idAlcance"}), @ORM\Index(name="fk_propuestasGeneral_condicionesComerciales1_idx", columns={"idCondicionesComerciales"}), @ORM\Index(name="fk_propuestasGeneral_marcoJuridico1_idx", columns={"idMarcoJuridico"}), @ORM\Index(name="fk_propuestasGeneral_rutaImagenes1_idx", columns={"idRutaImagenes"}), @ORM\Index(name="fk_propuestasGeneral_planProspeccion1_idx", columns={"idPlanProspeccion"})})
 */
class PropuestasGeneral
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAsignacion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\ManyToOne(targetEntity="PlanProspeccion", inversedBy="propuestasGenerals")
     * @ORM\JoinColumn(name="idPlanProspeccion", referencedColumnName="id", nullable=false)
     */
    protected $planProspeccion;

    /**
     * @ORM\ManyToOne(targetEntity="Alcances", inversedBy="propuestasGenerals")
     * @ORM\JoinColumn(name="idAlcance", referencedColumnName="id", nullable=false)
     */
    protected $alcances;

    /**
     * @ORM\ManyToOne(targetEntity="CondicionesComerciales", inversedBy="propuestasGenerals")
     * @ORM\JoinColumn(name="idCondicionesComerciales", referencedColumnName="id", nullable=false)
     */
    protected $condicionesComerciales;

    /**
     * @ORM\ManyToOne(targetEntity="MarcoJuridico", inversedBy="propuestasGenerals")
     * @ORM\JoinColumn(name="idMarcoJuridico", referencedColumnName="id", nullable=false)
     */
    protected $marcoJuridico;

    /**
     * @ORM\ManyToOne(targetEntity="RutaImagenes", inversedBy="propuestasGenerals")
     * @ORM\JoinColumn(name="idRutaImagenes", referencedColumnName="id", nullable=false)
     */
    protected $rutaImagenes;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PropuestasGeneral
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
     * Set the value of fechaAsignacion.
     *
     * @param \DateTime $fechaAsignacion
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setFechaAsignacion($fechaAsignacion)
    {
        $this->fechaAsignacion = $fechaAsignacion;

        return $this;
    }

    /**
     * Get the value of fechaAsignacion.
     *
     * @return \DateTime
     */
    public function getFechaAsignacion()
    {
        return $this->fechaAsignacion;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PropuestasGeneral
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
     * Set the value of idPlanProspeccion.
     *
     * @param integer $idPlanProspeccion
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setIdPlanProspeccion($idPlanProspeccion)
    {
        $this->idPlanProspeccion = $idPlanProspeccion;

        return $this;
    }

    /**
     * Get the value of idPlanProspeccion.
     *
     * @return integer
     */
    public function getIdPlanProspeccion()
    {
        return $this->idPlanProspeccion;
    }

    /**
     * Set the value of idAlcance.
     *
     * @param integer $idAlcance
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setIdAlcance($idAlcance)
    {
        $this->idAlcance = $idAlcance;

        return $this;
    }

    /**
     * Get the value of idAlcance.
     *
     * @return integer
     */
    public function getIdAlcance()
    {
        return $this->idAlcance;
    }

    /**
     * Set the value of idCondicionesComerciales.
     *
     * @param integer $idCondicionesComerciales
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setIdCondicionesComerciales($idCondicionesComerciales)
    {
        $this->idCondicionesComerciales = $idCondicionesComerciales;

        return $this;
    }

    /**
     * Get the value of idCondicionesComerciales.
     *
     * @return integer
     */
    public function getIdCondicionesComerciales()
    {
        return $this->idCondicionesComerciales;
    }

    /**
     * Set the value of idMarcoJuridico.
     *
     * @param integer $idMarcoJuridico
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setIdMarcoJuridico($idMarcoJuridico)
    {
        $this->idMarcoJuridico = $idMarcoJuridico;

        return $this;
    }

    /**
     * Get the value of idMarcoJuridico.
     *
     * @return integer
     */
    public function getIdMarcoJuridico()
    {
        return $this->idMarcoJuridico;
    }

    /**
     * Set the value of idRutaImagenes.
     *
     * @param integer $idRutaImagenes
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setIdRutaImagenes($idRutaImagenes)
    {
        $this->idRutaImagenes = $idRutaImagenes;

        return $this;
    }

    /**
     * Get the value of idRutaImagenes.
     *
     * @return integer
     */
    public function getIdRutaImagenes()
    {
        return $this->idRutaImagenes;
    }

    /**
     * Set PlanProspeccion entity (many to one).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setPlanProspeccion(PlanProspeccion $planProspeccion = null)
    {
        $this->planProspeccion = $planProspeccion;

        return $this;
    }

    /**
     * Get PlanProspeccion entity (many to one).
     *
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function getPlanProspeccion()
    {
        return $this->planProspeccion;
    }

    /**
     * Set Alcances entity (many to one).
     *
     * @param \CoreBundle\Entity\Alcances $alcances
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setAlcances(Alcances $alcances = null)
    {
        $this->alcances = $alcances;

        return $this;
    }

    /**
     * Get Alcances entity (many to one).
     *
     * @return \CoreBundle\Entity\Alcances
     */
    public function getAlcances()
    {
        return $this->alcances;
    }

    /**
     * Set CondicionesComerciales entity (many to one).
     *
     * @param \CoreBundle\Entity\CondicionesComerciales $condicionesComerciales
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setCondicionesComerciales(CondicionesComerciales $condicionesComerciales = null)
    {
        $this->condicionesComerciales = $condicionesComerciales;

        return $this;
    }

    /**
     * Get CondicionesComerciales entity (many to one).
     *
     * @return \CoreBundle\Entity\CondicionesComerciales
     */
    public function getCondicionesComerciales()
    {
        return $this->condicionesComerciales;
    }

    /**
     * Set MarcoJuridico entity (many to one).
     *
     * @param \CoreBundle\Entity\MarcoJuridico $marcoJuridico
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setMarcoJuridico(MarcoJuridico $marcoJuridico = null)
    {
        $this->marcoJuridico = $marcoJuridico;

        return $this;
    }

    /**
     * Get MarcoJuridico entity (many to one).
     *
     * @return \CoreBundle\Entity\MarcoJuridico
     */
    public function getMarcoJuridico()
    {
        return $this->marcoJuridico;
    }

    /**
     * Set RutaImagenes entity (many to one).
     *
     * @param \CoreBundle\Entity\RutaImagenes $rutaImagenes
     * @return \CoreBundle\Entity\PropuestasGeneral
     */
    public function setRutaImagenes(RutaImagenes $rutaImagenes = null)
    {
        $this->rutaImagenes = $rutaImagenes;

        return $this;
    }

    /**
     * Get RutaImagenes entity (many to one).
     *
     * @return \CoreBundle\Entity\RutaImagenes
     */
    public function getRutaImagenes()
    {
        return $this->rutaImagenes;
    }

    public function __sleep()
    {
        return array('id', 'fechaAsignacion', 'activo', 'idPlanProspeccion', 'idAlcance', 'idCondicionesComerciales', 'idMarcoJuridico', 'idRutaImagenes');
    }
}