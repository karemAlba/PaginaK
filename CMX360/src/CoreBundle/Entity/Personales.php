<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Personales
 *
 * @ORM\Entity()
 * @ORM\Table(name="personales", indexes={@ORM\Index(name="fk_personales_generos1_idx", columns={"idGenero"}), @ORM\Index(name="fk_personales_estatusLaborales1_idx", columns={"idEstatusLaboral"})})
 */
class Personales
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $noi;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $curp;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $rfc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $apPaterno;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $apMaterno;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $edad;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $telefono;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $correo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaIngreso;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaBaja;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $antiguedad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $rutaFotografia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $rutaFirma;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="PersonalEmpresas", mappedBy="personales")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPersonal", nullable=false)
     */
    protected $personalEmpresas;

    /**
     * @ORM\OneToMany(targetEntity="PersonalGenerales", mappedBy="personales")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPersonal", nullable=false)
     */
    protected $personalGenerales;

    /**
     * @ORM\OneToMany(targetEntity="PersonalLaborales", mappedBy="personales")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPersonal", nullable=false)
     */
    protected $personalLaborales;

    /**
     * @ORM\OneToMany(targetEntity="PlanClienteAsesor", mappedBy="personales")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPersona", nullable=false)
     */
    protected $planClienteAsesors;

    /**
     * @ORM\OneToMany(targetEntity="Usuarios", mappedBy="personales")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPersonal", nullable=false)
     */
    protected $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="Generos", inversedBy="personales")
     * @ORM\JoinColumn(name="idGenero", referencedColumnName="id", nullable=false)
     */
    protected $generos;

    /**
     * @ORM\ManyToOne(targetEntity="EstatusLaborales", inversedBy="personales")
     * @ORM\JoinColumn(name="idEstatusLaboral", referencedColumnName="id", nullable=false)
     */
    protected $estatusLaborales;

    public function __construct()
    {
        $this->personalEmpresas = new ArrayCollection();
        $this->personalGenerales = new ArrayCollection();
        $this->personalLaborales = new ArrayCollection();
        $this->planClienteAsesors = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Personales
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
     * Set the value of noi.
     *
     * @param string $noi
     * @return \CoreBundle\Entity\Personales
     */
    public function setNoi($noi)
    {
        $this->noi = $noi;

        return $this;
    }

    /**
     * Get the value of noi.
     *
     * @return string
     */
    public function getNoi()
    {
        return $this->noi;
    }

    /**
     * Set the value of curp.
     *
     * @param string $curp
     * @return \CoreBundle\Entity\Personales
     */
    public function setCurp($curp)
    {
        $this->curp = $curp;

        return $this;
    }

    /**
     * Get the value of curp.
     *
     * @return string
     */
    public function getCurp()
    {
        return $this->curp;
    }

    /**
     * Set the value of rfc.
     *
     * @param string $rfc
     * @return \CoreBundle\Entity\Personales
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
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\Personales
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
     * Set the value of apPaterno.
     *
     * @param string $apPaterno
     * @return \CoreBundle\Entity\Personales
     */
    public function setApPaterno($apPaterno)
    {
        $this->apPaterno = $apPaterno;

        return $this;
    }

    /**
     * Get the value of apPaterno.
     *
     * @return string
     */
    public function getApPaterno()
    {
        return $this->apPaterno;
    }

    /**
     * Set the value of apMaterno.
     *
     * @param string $apMaterno
     * @return \CoreBundle\Entity\Personales
     */
    public function setApMaterno($apMaterno)
    {
        $this->apMaterno = $apMaterno;

        return $this;
    }

    /**
     * Get the value of apMaterno.
     *
     * @return string
     */
    public function getApMaterno()
    {
        return $this->apMaterno;
    }

    /**
     * Set the value of edad.
     *
     * @param integer $edad
     * @return \CoreBundle\Entity\Personales
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get the value of edad.
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set the value of telefono.
     *
     * @param string $telefono
     * @return \CoreBundle\Entity\Personales
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
     * @return \CoreBundle\Entity\Personales
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
     * Set the value of fechaAlta.
     *
     * @param \DateTime $fechaAlta
     * @return \CoreBundle\Entity\Personales
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
     * Set the value of fechaIngreso.
     *
     * @param \DateTime $fechaIngreso
     * @return \CoreBundle\Entity\Personales
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get the value of fechaIngreso.
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set the value of fechaBaja.
     *
     * @param \DateTime $fechaBaja
     * @return \CoreBundle\Entity\Personales
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
     * Set the value of antiguedad.
     *
     * @param string $antiguedad
     * @return \CoreBundle\Entity\Personales
     */
    public function setAntiguedad($antiguedad)
    {
        $this->antiguedad = $antiguedad;

        return $this;
    }

    /**
     * Get the value of antiguedad.
     *
     * @return string
     */
    public function getAntiguedad()
    {
        return $this->antiguedad;
    }

    /**
     * Set the value of rutaFotografia.
     *
     * @param string $rutaFotografia
     * @return \CoreBundle\Entity\Personales
     */
    public function setRutaFotografia($rutaFotografia)
    {
        $this->rutaFotografia = $rutaFotografia;

        return $this;
    }

    /**
     * Get the value of rutaFotografia.
     *
     * @return string
     */
    public function getRutaFotografia()
    {
        return $this->rutaFotografia;
    }

    /**
     * Set the value of rutaFirma.
     *
     * @param string $rutaFirma
     * @return \CoreBundle\Entity\Personales
     */
    public function setRutaFirma($rutaFirma)
    {
        $this->rutaFirma = $rutaFirma;

        return $this;
    }

    /**
     * Get the value of rutaFirma.
     *
     * @return string
     */
    public function getRutaFirma()
    {
        return $this->rutaFirma;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Personales
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
     * Set the value of idGenero.
     *
     * @param integer $idGenero
     * @return \CoreBundle\Entity\Personales
     */
    public function setIdGenero($idGenero)
    {
        $this->idGenero = $idGenero;

        return $this;
    }

    /**
     * Get the value of idGenero.
     *
     * @return integer
     */
    public function getIdGenero()
    {
        return $this->idGenero;
    }

    /**
     * Set the value of idEstatusLaboral.
     *
     * @param integer $idEstatusLaboral
     * @return \CoreBundle\Entity\Personales
     */
    public function setIdEstatusLaboral($idEstatusLaboral)
    {
        $this->idEstatusLaboral = $idEstatusLaboral;

        return $this;
    }

    /**
     * Get the value of idEstatusLaboral.
     *
     * @return integer
     */
    public function getIdEstatusLaboral()
    {
        return $this->idEstatusLaboral;
    }

    /**
     * Add PersonalEmpresas entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalEmpresas $personalEmpresas
     * @return \CoreBundle\Entity\Personales
     */
    public function addPersonalEmpresas(PersonalEmpresas $personalEmpresas)
    {
        $this->personalEmpresas[] = $personalEmpresas;

        return $this;
    }

    /**
     * Remove PersonalEmpresas entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalEmpresas $personalEmpresas
     * @return \CoreBundle\Entity\Personales
     */
    public function removePersonalEmpresas(PersonalEmpresas $personalEmpresas)
    {
        $this->personalEmpresas->removeElement($personalEmpresas);

        return $this;
    }

    /**
     * Get PersonalEmpresas entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonalEmpresas()
    {
        return $this->personalEmpresas;
    }

    /**
     * Add PersonalGenerales entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalGenerales $personalGenerales
     * @return \CoreBundle\Entity\Personales
     */
    public function addPersonalGenerales(PersonalGenerales $personalGenerales)
    {
        $this->personalGenerales[] = $personalGenerales;

        return $this;
    }

    /**
     * Remove PersonalGenerales entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalGenerales $personalGenerales
     * @return \CoreBundle\Entity\Personales
     */
    public function removePersonalGenerales(PersonalGenerales $personalGenerales)
    {
        $this->personalGenerales->removeElement($personalGenerales);

        return $this;
    }

    /**
     * Get PersonalGenerales entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonalGenerales()
    {
        return $this->personalGenerales;
    }

    /**
     * Add PersonalLaborales entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalLaborales $personalLaborales
     * @return \CoreBundle\Entity\Personales
     */
    public function addPersonalLaborales(PersonalLaborales $personalLaborales)
    {
        $this->personalLaborales[] = $personalLaborales;

        return $this;
    }

    /**
     * Remove PersonalLaborales entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalLaborales $personalLaborales
     * @return \CoreBundle\Entity\Personales
     */
    public function removePersonalLaborales(PersonalLaborales $personalLaborales)
    {
        $this->personalLaborales->removeElement($personalLaborales);

        return $this;
    }

    /**
     * Get PersonalLaborales entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonalLaborales()
    {
        return $this->personalLaborales;
    }

    /**
     * Add PlanClienteAsesor entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanClienteAsesor $planClienteAsesor
     * @return \CoreBundle\Entity\Personales
     */
    public function addPlanClienteAsesor(PlanClienteAsesor $planClienteAsesor)
    {
        $this->planClienteAsesors[] = $planClienteAsesor;

        return $this;
    }

    /**
     * Remove PlanClienteAsesor entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanClienteAsesor $planClienteAsesor
     * @return \CoreBundle\Entity\Personales
     */
    public function removePlanClienteAsesor(PlanClienteAsesor $planClienteAsesor)
    {
        $this->planClienteAsesors->removeElement($planClienteAsesor);

        return $this;
    }

    /**
     * Get PlanClienteAsesor entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanClienteAsesors()
    {
        return $this->planClienteAsesors;
    }

    /**
     * Add Usuarios entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Usuarios $usuarios
     * @return \CoreBundle\Entity\Personales
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
     * @return \CoreBundle\Entity\Personales
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
     * Set Generos entity (many to one).
     *
     * @param \CoreBundle\Entity\Generos $generos
     * @return \CoreBundle\Entity\Personales
     */
    public function setGeneros(Generos $generos = null)
    {
        $this->generos = $generos;

        return $this;
    }

    /**
     * Get Generos entity (many to one).
     *
     * @return \CoreBundle\Entity\Generos
     */
    public function getGeneros()
    {
        return $this->generos;
    }

    /**
     * Set EstatusLaborales entity (many to one).
     *
     * @param \CoreBundle\Entity\EstatusLaborales $estatusLaborales
     * @return \CoreBundle\Entity\Personales
     */
    public function setEstatusLaborales(EstatusLaborales $estatusLaborales = null)
    {
        $this->estatusLaborales = $estatusLaborales;

        return $this;
    }

    /**
     * Get EstatusLaborales entity (many to one).
     *
     * @return \CoreBundle\Entity\EstatusLaborales
     */
    public function getEstatusLaborales()
    {
        return $this->estatusLaborales;
    }

    public function __sleep()
    {
        return array('id', 'noi', 'curp', 'rfc', 'nombre', 'apPaterno', 'apMaterno', 'edad', 'telefono', 'correo', 'fechaAlta', 'fechaIngreso', 'fechaBaja', 'antiguedad', 'rutaFotografia', 'rutaFirma', 'activo', 'idGenero', 'idEstatusLaboral');
    }
}