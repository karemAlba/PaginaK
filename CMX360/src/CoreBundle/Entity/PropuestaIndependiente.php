<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\PropuestaIndependiente
 *
 * @ORM\Entity()
 * @ORM\Table(name="propuestaIndependiente", indexes={@ORM\Index(name="fk_propuesta_estatusPropuesta1_idx", columns={"idEstatusPropuesta"}), @ORM\Index(name="fk_propuestaIndependiente_convenios1_idx", columns={"idConvenio"}), @ORM\Index(name="fk_propuestaIndependiente_grupos1_idx", columns={"idGrupo"}), @ORM\Index(name="fk_propuestaIndependiente_marcas1_idx", columns={"idMarca"})})
 */
class PropuestaIndependiente
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
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $costoTotal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $descuento;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isConvenio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $rutaPropuesta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idUsuarioGenera;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idUsuarioAutoriza;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idPropuestaPadre;

    /**
     * @ORM\OneToMany(targetEntity="PropuestaServicio", mappedBy="propuestaIndependiente")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPropuesta", nullable=false)
     */
    protected $propuestaServicios;

    /**
     * @ORM\ManyToOne(targetEntity="EstatusPropuesta", inversedBy="propuestaIndependientes")
     * @ORM\JoinColumn(name="idEstatusPropuesta", referencedColumnName="id", nullable=false)
     */
    protected $estatusPropuesta;

    /**
     * @ORM\ManyToOne(targetEntity="Convenios", inversedBy="propuestaIndependientes")
     * @ORM\JoinColumn(name="idConvenio", referencedColumnName="id")
     */
    protected $convenios;

    /**
     * @ORM\ManyToOne(targetEntity="Grupos", inversedBy="propuestaIndependientes")
     * @ORM\JoinColumn(name="idGrupo", referencedColumnName="id")
     */
    protected $grupos;

    /**
     * @ORM\ManyToOne(targetEntity="Marcas", inversedBy="propuestaIndependientes")
     * @ORM\JoinColumn(name="idMarca", referencedColumnName="id")
     */
    protected $marcas;

    public function __construct()
    {
        $this->propuestaServicios = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Set the value of costo.
     *
     * @param float $costo
     * @return \CoreBundle\Entity\PropuestaIndependiente
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get the value of costo.
     *
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set the value of costoTotal.
     *
     * @param float $costoTotal
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Set the value of descuento.
     *
     * @param string $descuento
     * @return \CoreBundle\Entity\PropuestaIndependiente
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get the value of descuento.
     *
     * @return string
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set the value of isConvenio.
     *
     * @param boolean $isConvenio
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Set the value of rutaPropuesta.
     *
     * @param string $rutaPropuesta
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Set the value of idUsuarioGenera.
     *
     * @param integer $idUsuarioGenera
     * @return \CoreBundle\Entity\PropuestaIndependiente
     */
    public function setIdUsuarioGenera($idUsuarioGenera)
    {
        $this->idUsuarioGenera = $idUsuarioGenera;

        return $this;
    }

    /**
     * Get the value of idUsuarioGenera.
     *
     * @return integer
     */
    public function getIdUsuarioGenera()
    {
        return $this->idUsuarioGenera;
    }

    /**
     * Set the value of idUsuarioAutoriza.
     *
     * @param integer $idUsuarioAutoriza
     * @return \CoreBundle\Entity\PropuestaIndependiente
     */
    public function setIdUsuarioAutoriza($idUsuarioAutoriza)
    {
        $this->idUsuarioAutoriza = $idUsuarioAutoriza;

        return $this;
    }

    /**
     * Get the value of idUsuarioAutoriza.
     *
     * @return integer
     */
    public function getIdUsuarioAutoriza()
    {
        return $this->idUsuarioAutoriza;
    }

    /**
     * Set the value of idPropuestaPadre.
     *
     * @param integer $idPropuestaPadre
     * @return \CoreBundle\Entity\PropuestaIndependiente
     */
    public function setIdPropuestaPadre($idPropuestaPadre)
    {
        $this->idPropuestaPadre = $idPropuestaPadre;

        return $this;
    }

    /**
     * Get the value of idPropuestaPadre.
     *
     * @return integer
     */
    public function getIdPropuestaPadre()
    {
        return $this->idPropuestaPadre;
    }

    /**
     * Set the value of idEstatusPropuesta.
     *
     * @param integer $idEstatusPropuesta
     * @return \CoreBundle\Entity\PropuestaIndependiente
     */
    public function setIdEstatusPropuesta($idEstatusPropuesta)
    {
        $this->idEstatusPropuesta = $idEstatusPropuesta;

        return $this;
    }

    /**
     * Get the value of idEstatusPropuesta.
     *
     * @return integer
     */
    public function getIdEstatusPropuesta()
    {
        return $this->idEstatusPropuesta;
    }

    /**
     * Set the value of idConvenio.
     *
     * @param integer $idConvenio
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Set the value of idGrupo.
     *
     * @param integer $idGrupo
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Set the value of idMarca.
     *
     * @param integer $idMarca
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Add PropuestaServicio entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaServicio $propuestaServicio
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Set EstatusPropuesta entity (many to one).
     *
     * @param \CoreBundle\Entity\EstatusPropuesta $estatusPropuesta
     * @return \CoreBundle\Entity\PropuestaIndependiente
     */
    public function setEstatusPropuesta(EstatusPropuesta $estatusPropuesta = null)
    {
        $this->estatusPropuesta = $estatusPropuesta;

        return $this;
    }

    /**
     * Get EstatusPropuesta entity (many to one).
     *
     * @return \CoreBundle\Entity\EstatusPropuesta
     */
    public function getEstatusPropuesta()
    {
        return $this->estatusPropuesta;
    }

    /**
     * Set Convenios entity (many to one).
     *
     * @param \CoreBundle\Entity\Convenios $convenios
     * @return \CoreBundle\Entity\PropuestaIndependiente
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

    /**
     * Set Grupos entity (many to one).
     *
     * @param \CoreBundle\Entity\Grupos $grupos
     * @return \CoreBundle\Entity\PropuestaIndependiente
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
     * Set Marcas entity (many to one).
     *
     * @param \CoreBundle\Entity\Marcas $marcas
     * @return \CoreBundle\Entity\PropuestaIndependiente
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

    public function __sleep()
    {
        return array('id', 'activo', 'fechaRegistro', 'costo', 'costoTotal', 'descuento', 'isConvenio', 'rutaPropuesta', 'idUsuarioGenera', 'idUsuarioAutoriza', 'idPropuestaPadre', 'idEstatusPropuesta', 'idConvenio', 'idGrupo', 'idMarca');
    }
}