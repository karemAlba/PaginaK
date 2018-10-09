<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PersonalLaborales
 *
 * @ORM\Entity()
 * @ORM\Table(name="personal_laborales", indexes={@ORM\Index(name="fk_personal_laborales_tipoContratos1_idx", columns={"idTipoContrato"}), @ORM\Index(name="fk_personal_laborales_estatusContratos1_idx", columns={"idEstatusContrato"}), @ORM\Index(name="fk_personal_laborales_personales1_idx", columns={"idPersonal"})})
 */
class PersonalLaborales
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
    protected $fechaInicioContrato;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaFinContrato;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $sueldoMensual;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $sueldoDiario;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $sueldoIntegrado;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $tallaCB;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $tallaPV;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $tallaPM;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $tallaC;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\ManyToOne(targetEntity="TipoContratos", inversedBy="personalLaborales")
     * @ORM\JoinColumn(name="idTipoContrato", referencedColumnName="id", nullable=false)
     */
    protected $tipoContratos;

    /**
     * @ORM\ManyToOne(targetEntity="EstatusContratos", inversedBy="personalLaborales")
     * @ORM\JoinColumn(name="idEstatusContrato", referencedColumnName="id", nullable=false)
     */
    protected $estatusContratos;

    /**
     * @ORM\ManyToOne(targetEntity="Personales", inversedBy="personalLaborales")
     * @ORM\JoinColumn(name="idPersonal", referencedColumnName="id", nullable=false)
     */
    protected $personales;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PersonalLaborales
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
     * Set the value of fechaInicioContrato.
     *
     * @param \DateTime $fechaInicioContrato
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setFechaInicioContrato($fechaInicioContrato)
    {
        $this->fechaInicioContrato = $fechaInicioContrato;

        return $this;
    }

    /**
     * Get the value of fechaInicioContrato.
     *
     * @return \DateTime
     */
    public function getFechaInicioContrato()
    {
        return $this->fechaInicioContrato;
    }

    /**
     * Set the value of fechaFinContrato.
     *
     * @param \DateTime $fechaFinContrato
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setFechaFinContrato($fechaFinContrato)
    {
        $this->fechaFinContrato = $fechaFinContrato;

        return $this;
    }

    /**
     * Get the value of fechaFinContrato.
     *
     * @return \DateTime
     */
    public function getFechaFinContrato()
    {
        return $this->fechaFinContrato;
    }

    /**
     * Set the value of sueldoMensual.
     *
     * @param float $sueldoMensual
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setSueldoMensual($sueldoMensual)
    {
        $this->sueldoMensual = $sueldoMensual;

        return $this;
    }

    /**
     * Get the value of sueldoMensual.
     *
     * @return float
     */
    public function getSueldoMensual()
    {
        return $this->sueldoMensual;
    }

    /**
     * Set the value of sueldoDiario.
     *
     * @param float $sueldoDiario
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setSueldoDiario($sueldoDiario)
    {
        $this->sueldoDiario = $sueldoDiario;

        return $this;
    }

    /**
     * Get the value of sueldoDiario.
     *
     * @return float
     */
    public function getSueldoDiario()
    {
        return $this->sueldoDiario;
    }

    /**
     * Set the value of sueldoIntegrado.
     *
     * @param float $sueldoIntegrado
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setSueldoIntegrado($sueldoIntegrado)
    {
        $this->sueldoIntegrado = $sueldoIntegrado;

        return $this;
    }

    /**
     * Get the value of sueldoIntegrado.
     *
     * @return float
     */
    public function getSueldoIntegrado()
    {
        return $this->sueldoIntegrado;
    }

    /**
     * Set the value of tallaCB.
     *
     * @param string $tallaCB
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setTallaCB($tallaCB)
    {
        $this->tallaCB = $tallaCB;

        return $this;
    }

    /**
     * Get the value of tallaCB.
     *
     * @return string
     */
    public function getTallaCB()
    {
        return $this->tallaCB;
    }

    /**
     * Set the value of tallaPV.
     *
     * @param string $tallaPV
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setTallaPV($tallaPV)
    {
        $this->tallaPV = $tallaPV;

        return $this;
    }

    /**
     * Get the value of tallaPV.
     *
     * @return string
     */
    public function getTallaPV()
    {
        return $this->tallaPV;
    }

    /**
     * Set the value of tallaPM.
     *
     * @param string $tallaPM
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setTallaPM($tallaPM)
    {
        $this->tallaPM = $tallaPM;

        return $this;
    }

    /**
     * Get the value of tallaPM.
     *
     * @return string
     */
    public function getTallaPM()
    {
        return $this->tallaPM;
    }

    /**
     * Set the value of tallaC.
     *
     * @param string $tallaC
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setTallaC($tallaC)
    {
        $this->tallaC = $tallaC;

        return $this;
    }

    /**
     * Get the value of tallaC.
     *
     * @return string
     */
    public function getTallaC()
    {
        return $this->tallaC;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PersonalLaborales
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
     * Set the value of idTipoContrato.
     *
     * @param integer $idTipoContrato
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setIdTipoContrato($idTipoContrato)
    {
        $this->idTipoContrato = $idTipoContrato;

        return $this;
    }

    /**
     * Get the value of idTipoContrato.
     *
     * @return integer
     */
    public function getIdTipoContrato()
    {
        return $this->idTipoContrato;
    }

    /**
     * Set the value of idEstatusContrato.
     *
     * @param integer $idEstatusContrato
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setIdEstatusContrato($idEstatusContrato)
    {
        $this->idEstatusContrato = $idEstatusContrato;

        return $this;
    }

    /**
     * Get the value of idEstatusContrato.
     *
     * @return integer
     */
    public function getIdEstatusContrato()
    {
        return $this->idEstatusContrato;
    }

    /**
     * Set the value of idPersonal.
     *
     * @param integer $idPersonal
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setIdPersonal($idPersonal)
    {
        $this->idPersonal = $idPersonal;

        return $this;
    }

    /**
     * Get the value of idPersonal.
     *
     * @return integer
     */
    public function getIdPersonal()
    {
        return $this->idPersonal;
    }

    /**
     * Set TipoContratos entity (many to one).
     *
     * @param \CoreBundle\Entity\TipoContratos $tipoContratos
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setTipoContratos(TipoContratos $tipoContratos = null)
    {
        $this->tipoContratos = $tipoContratos;

        return $this;
    }

    /**
     * Get TipoContratos entity (many to one).
     *
     * @return \CoreBundle\Entity\TipoContratos
     */
    public function getTipoContratos()
    {
        return $this->tipoContratos;
    }

    /**
     * Set EstatusContratos entity (many to one).
     *
     * @param \CoreBundle\Entity\EstatusContratos $estatusContratos
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setEstatusContratos(EstatusContratos $estatusContratos = null)
    {
        $this->estatusContratos = $estatusContratos;

        return $this;
    }

    /**
     * Get EstatusContratos entity (many to one).
     *
     * @return \CoreBundle\Entity\EstatusContratos
     */
    public function getEstatusContratos()
    {
        return $this->estatusContratos;
    }

    /**
     * Set Personales entity (many to one).
     *
     * @param \CoreBundle\Entity\Personales $personales
     * @return \CoreBundle\Entity\PersonalLaborales
     */
    public function setPersonales(Personales $personales = null)
    {
        $this->personales = $personales;

        return $this;
    }

    /**
     * Get Personales entity (many to one).
     *
     * @return \CoreBundle\Entity\Personales
     */
    public function getPersonales()
    {
        return $this->personales;
    }

    public function __sleep()
    {
        return array('id', 'fechaInicioContrato', 'fechaFinContrato', 'sueldoMensual', 'sueldoDiario', 'sueldoIntegrado', 'tallaCB', 'tallaPV', 'tallaPM', 'tallaC', 'activo', 'idTipoContrato', 'idEstatusContrato', 'idPersonal');
    }
}