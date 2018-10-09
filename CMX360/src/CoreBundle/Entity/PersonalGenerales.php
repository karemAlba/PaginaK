<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PersonalGenerales
 *
 * @ORM\Entity()
 * @ORM\Table(name="personal_generales", indexes={@ORM\Index(name="fk_personal_generales_personales1_idx", columns={"idPersonal"}), @ORM\Index(name="fk_personal_generales_parentescos1_idx", columns={"idParentesco"}), @ORM\Index(name="fk_personal_generales_gradoEstudios1_idx", columns={"idGradoEstudio"}), @ORM\Index(name="fk_personal_generales_tipoDescuentos1_idx", columns={"idTipoDescuento"}), @ORM\Index(name="fk_personal_generales_estadosCiviles1_idx", columns={"idEstadoCivil"}), @ORM\Index(name="fk_personal_generales_colonias1_idx", columns={"idColonia"})})
 */
class PersonalGenerales
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
    protected $fechaNacimiento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $lugarNacimiento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $domicilioINE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $especialidad;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $telefonoCasa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $llamarA;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $telefonoAviso;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $nss;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $clinica;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $tipoSangre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $noHijo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $noHija;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $noCedula;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $escuela;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $noContratoDescuento;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\ManyToOne(targetEntity="Personales", inversedBy="personalGenerales")
     * @ORM\JoinColumn(name="idPersonal", referencedColumnName="id", nullable=false)
     */
    protected $personales;

    /**
     * @ORM\ManyToOne(targetEntity="Parentescos", inversedBy="personalGenerales")
     * @ORM\JoinColumn(name="idParentesco", referencedColumnName="id", nullable=false)
     */
    protected $parentescos;

    /**
     * @ORM\ManyToOne(targetEntity="GradoEstudios", inversedBy="personalGenerales")
     * @ORM\JoinColumn(name="idGradoEstudio", referencedColumnName="id", nullable=false)
     */
    protected $gradoEstudios;

    /**
     * @ORM\ManyToOne(targetEntity="TipoDescuentos", inversedBy="personalGenerales")
     * @ORM\JoinColumn(name="idTipoDescuento", referencedColumnName="id", nullable=false)
     */
    protected $tipoDescuentos;

    /**
     * @ORM\ManyToOne(targetEntity="EstadosCiviles", inversedBy="personalGenerales")
     * @ORM\JoinColumn(name="idEstadoCivil", referencedColumnName="id", nullable=false)
     */
    protected $estadosCiviles;

    /**
     * @ORM\ManyToOne(targetEntity="Colonias", inversedBy="personalGenerales")
     * @ORM\JoinColumn(name="idColonia", referencedColumnName="id", nullable=false)
     */
    protected $colonias;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PersonalGenerales
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
     * Set the value of fechaNacimiento.
     *
     * @param \DateTime $fechaNacimiento
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get the value of fechaNacimiento.
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set the value of lugarNacimiento.
     *
     * @param string $lugarNacimiento
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setLugarNacimiento($lugarNacimiento)
    {
        $this->lugarNacimiento = $lugarNacimiento;

        return $this;
    }

    /**
     * Get the value of lugarNacimiento.
     *
     * @return string
     */
    public function getLugarNacimiento()
    {
        return $this->lugarNacimiento;
    }

    /**
     * Set the value of domicilioINE.
     *
     * @param string $domicilioINE
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setDomicilioINE($domicilioINE)
    {
        $this->domicilioINE = $domicilioINE;

        return $this;
    }

    /**
     * Get the value of domicilioINE.
     *
     * @return string
     */
    public function getDomicilioINE()
    {
        return $this->domicilioINE;
    }

    /**
     * Set the value of especialidad.
     *
     * @param string $especialidad
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get the value of especialidad.
     *
     * @return string
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set the value of telefonoCasa.
     *
     * @param string $telefonoCasa
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setTelefonoCasa($telefonoCasa)
    {
        $this->telefonoCasa = $telefonoCasa;

        return $this;
    }

    /**
     * Get the value of telefonoCasa.
     *
     * @return string
     */
    public function getTelefonoCasa()
    {
        return $this->telefonoCasa;
    }

    /**
     * Set the value of llamarA.
     *
     * @param string $llamarA
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setLlamarA($llamarA)
    {
        $this->llamarA = $llamarA;

        return $this;
    }

    /**
     * Get the value of llamarA.
     *
     * @return string
     */
    public function getLlamarA()
    {
        return $this->llamarA;
    }

    /**
     * Set the value of telefonoAviso.
     *
     * @param string $telefonoAviso
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setTelefonoAviso($telefonoAviso)
    {
        $this->telefonoAviso = $telefonoAviso;

        return $this;
    }

    /**
     * Get the value of telefonoAviso.
     *
     * @return string
     */
    public function getTelefonoAviso()
    {
        return $this->telefonoAviso;
    }

    /**
     * Set the value of nss.
     *
     * @param integer $nss
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setNss($nss)
    {
        $this->nss = $nss;

        return $this;
    }

    /**
     * Get the value of nss.
     *
     * @return integer
     */
    public function getNss()
    {
        return $this->nss;
    }

    /**
     * Set the value of clinica.
     *
     * @param integer $clinica
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setClinica($clinica)
    {
        $this->clinica = $clinica;

        return $this;
    }

    /**
     * Get the value of clinica.
     *
     * @return integer
     */
    public function getClinica()
    {
        return $this->clinica;
    }

    /**
     * Set the value of tipoSangre.
     *
     * @param string $tipoSangre
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setTipoSangre($tipoSangre)
    {
        $this->tipoSangre = $tipoSangre;

        return $this;
    }

    /**
     * Get the value of tipoSangre.
     *
     * @return string
     */
    public function getTipoSangre()
    {
        return $this->tipoSangre;
    }

    /**
     * Set the value of noHijo.
     *
     * @param integer $noHijo
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setNoHijo($noHijo)
    {
        $this->noHijo = $noHijo;

        return $this;
    }

    /**
     * Get the value of noHijo.
     *
     * @return integer
     */
    public function getNoHijo()
    {
        return $this->noHijo;
    }

    /**
     * Set the value of noHija.
     *
     * @param integer $noHija
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setNoHija($noHija)
    {
        $this->noHija = $noHija;

        return $this;
    }

    /**
     * Get the value of noHija.
     *
     * @return integer
     */
    public function getNoHija()
    {
        return $this->noHija;
    }

    /**
     * Set the value of noCedula.
     *
     * @param string $noCedula
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setNoCedula($noCedula)
    {
        $this->noCedula = $noCedula;

        return $this;
    }

    /**
     * Get the value of noCedula.
     *
     * @return string
     */
    public function getNoCedula()
    {
        return $this->noCedula;
    }

    /**
     * Set the value of escuela.
     *
     * @param string $escuela
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setEscuela($escuela)
    {
        $this->escuela = $escuela;

        return $this;
    }

    /**
     * Get the value of escuela.
     *
     * @return string
     */
    public function getEscuela()
    {
        return $this->escuela;
    }

    /**
     * Set the value of noContratoDescuento.
     *
     * @param string $noContratoDescuento
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setNoContratoDescuento($noContratoDescuento)
    {
        $this->noContratoDescuento = $noContratoDescuento;

        return $this;
    }

    /**
     * Get the value of noContratoDescuento.
     *
     * @return string
     */
    public function getNoContratoDescuento()
    {
        return $this->noContratoDescuento;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\PersonalGenerales
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
     * Set the value of idPersonal.
     *
     * @param integer $idPersonal
     * @return \CoreBundle\Entity\PersonalGenerales
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
     * Set the value of idParentesco.
     *
     * @param integer $idParentesco
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setIdParentesco($idParentesco)
    {
        $this->idParentesco = $idParentesco;

        return $this;
    }

    /**
     * Get the value of idParentesco.
     *
     * @return integer
     */
    public function getIdParentesco()
    {
        return $this->idParentesco;
    }

    /**
     * Set the value of idGradoEstudio.
     *
     * @param integer $idGradoEstudio
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setIdGradoEstudio($idGradoEstudio)
    {
        $this->idGradoEstudio = $idGradoEstudio;

        return $this;
    }

    /**
     * Get the value of idGradoEstudio.
     *
     * @return integer
     */
    public function getIdGradoEstudio()
    {
        return $this->idGradoEstudio;
    }

    /**
     * Set the value of idTipoDescuento.
     *
     * @param integer $idTipoDescuento
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setIdTipoDescuento($idTipoDescuento)
    {
        $this->idTipoDescuento = $idTipoDescuento;

        return $this;
    }

    /**
     * Get the value of idTipoDescuento.
     *
     * @return integer
     */
    public function getIdTipoDescuento()
    {
        return $this->idTipoDescuento;
    }

    /**
     * Set the value of idEstadoCivil.
     *
     * @param integer $idEstadoCivil
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setIdEstadoCivil($idEstadoCivil)
    {
        $this->idEstadoCivil = $idEstadoCivil;

        return $this;
    }

    /**
     * Get the value of idEstadoCivil.
     *
     * @return integer
     */
    public function getIdEstadoCivil()
    {
        return $this->idEstadoCivil;
    }

    /**
     * Set the value of idColonia.
     *
     * @param integer $idColonia
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setIdColonia($idColonia)
    {
        $this->idColonia = $idColonia;

        return $this;
    }

    /**
     * Get the value of idColonia.
     *
     * @return integer
     */
    public function getIdColonia()
    {
        return $this->idColonia;
    }

    /**
     * Set Personales entity (many to one).
     *
     * @param \CoreBundle\Entity\Personales $personales
     * @return \CoreBundle\Entity\PersonalGenerales
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

    /**
     * Set Parentescos entity (many to one).
     *
     * @param \CoreBundle\Entity\Parentescos $parentescos
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setParentescos(Parentescos $parentescos = null)
    {
        $this->parentescos = $parentescos;

        return $this;
    }

    /**
     * Get Parentescos entity (many to one).
     *
     * @return \CoreBundle\Entity\Parentescos
     */
    public function getParentescos()
    {
        return $this->parentescos;
    }

    /**
     * Set GradoEstudios entity (many to one).
     *
     * @param \CoreBundle\Entity\GradoEstudios $gradoEstudios
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setGradoEstudios(GradoEstudios $gradoEstudios = null)
    {
        $this->gradoEstudios = $gradoEstudios;

        return $this;
    }

    /**
     * Get GradoEstudios entity (many to one).
     *
     * @return \CoreBundle\Entity\GradoEstudios
     */
    public function getGradoEstudios()
    {
        return $this->gradoEstudios;
    }

    /**
     * Set TipoDescuentos entity (many to one).
     *
     * @param \CoreBundle\Entity\TipoDescuentos $tipoDescuentos
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setTipoDescuentos(TipoDescuentos $tipoDescuentos = null)
    {
        $this->tipoDescuentos = $tipoDescuentos;

        return $this;
    }

    /**
     * Get TipoDescuentos entity (many to one).
     *
     * @return \CoreBundle\Entity\TipoDescuentos
     */
    public function getTipoDescuentos()
    {
        return $this->tipoDescuentos;
    }

    /**
     * Set EstadosCiviles entity (many to one).
     *
     * @param \CoreBundle\Entity\EstadosCiviles $estadosCiviles
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setEstadosCiviles(EstadosCiviles $estadosCiviles = null)
    {
        $this->estadosCiviles = $estadosCiviles;

        return $this;
    }

    /**
     * Get EstadosCiviles entity (many to one).
     *
     * @return \CoreBundle\Entity\EstadosCiviles
     */
    public function getEstadosCiviles()
    {
        return $this->estadosCiviles;
    }

    /**
     * Set Colonias entity (many to one).
     *
     * @param \CoreBundle\Entity\Colonias $colonias
     * @return \CoreBundle\Entity\PersonalGenerales
     */
    public function setColonias(Colonias $colonias = null)
    {
        $this->colonias = $colonias;

        return $this;
    }

    /**
     * Get Colonias entity (many to one).
     *
     * @return \CoreBundle\Entity\Colonias
     */
    public function getColonias()
    {
        return $this->colonias;
    }

    public function __sleep()
    {
        return array('id', 'fechaNacimiento', 'lugarNacimiento', 'domicilioINE', 'especialidad', 'telefonoCasa', 'llamarA', 'telefonoAviso', 'nss', 'clinica', 'tipoSangre', 'noHijo', 'noHija', 'noCedula', 'escuela', 'noContratoDescuento', 'activo', 'idPersonal', 'idParentesco', 'idGradoEstudio', 'idTipoDescuento', 'idEstadoCivil', 'idColonia');
    }
}