<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Campana
 *
 * @ORM\Entity()
 * @ORM\Table(name="campana", indexes={@ORM\Index(name="fk_campana_tipocampana1_idx", columns={"idTipoCampana"})})
 */
class Campana
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nombreremitente;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $correoremitente;

    /**
     * @ORM\Column(type="blob", length=255, nullable=true)
     */
    protected $asunto;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaEnvio;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="CampanaCliente", mappedBy="campana")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCampana", nullable=false)
     */
    protected $campanaClientes;

    /**
     * @ORM\OneToMany(targetEntity="PlanProspeccion", mappedBy="campana")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCampana", nullable=false)
     */
    protected $planProspeccions;

    /**
     * @ORM\ManyToOne(targetEntity="TipoCampana", inversedBy="campanas")
     * @ORM\JoinColumn(name="idTipoCampana", referencedColumnName="id", nullable=true)
     */
    protected $tipoCampana;

    public function __construct()
    {
        $this->campanaClientes = new ArrayCollection();
        $this->planProspeccions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Campana
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
     * Set the value of numero.
     *
     * @param integer $numero
     * @return \CoreBundle\Entity\Campana
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of numero.
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\Campana
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
     * Set the value of nombreremitente.
     *
     * @param string $nombreremitente
     * @return \CoreBundle\Entity\Campana
     */
    public function setNombreremitente($nombreremitente)
    {
        $this->nombreremitente = $nombreremitente;

        return $this;
    }

    /**
     * Get the value of nombreremitente.
     *
     * @return string
     */
    public function getNombreremitente()
    {
        return $this->nombreremitente;
    }

    /**
     * Set the value of correoremitente.
     *
     * @param string $correoremitente
     * @return \CoreBundle\Entity\Campana
     */
    public function setCorreoremitente($correoremitente)
    {
        $this->correoremitente = $correoremitente;

        return $this;
    }

    /**
     * Get the value of correoremitente.
     *
     * @return string
     */
    public function getCorreoremitente()
    {
        return $this->correoremitente;
    }

    /**
     * Set the value of asunto.
     *
     * @param string $asunto
     * @return \CoreBundle\Entity\Campana
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get the value of asunto.
     *
     * @return string
     */
    public function getAsunto()
    {
        if($this->asunto != ''){
            return stream_get_contents($this->asunto);
        }
        return $this->asunto;
    }

    /**
     * Set the value of fechaEnvio.
     *
     * @param \DateTime $fechaEnvio
     * @return \CoreBundle\Entity\Campana
     */
    public function setFechaEnvio($fechaEnvio)
    {
        $this->fechaEnvio = $fechaEnvio;

        return $this;
    }

    /**
     * Get the value of fechaEnvio.
     *
     * @return \DateTime
     */
    public function getFechaEnvio()
    {
        return $this->fechaEnvio;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Campana
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
     * Set the value of idTipoCampana.
     *
     * @param integer $idTipoCampana
     * @return \CoreBundle\Entity\Campana
     */
    public function setIdTipoCampana($idTipoCampana)
    {
        $this->idTipoCampana = $idTipoCampana;

        return $this;
    }

    /**
     * Get the value of idTipoCampana.
     *
     * @return integer
     */
    public function getIdTipoCampana()
    {
        return $this->idTipoCampana;
    }

    /**
     * Add CampanaCliente entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\CampanaCliente $campanaCliente
     * @return \CoreBundle\Entity\Campana
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
     * @return \CoreBundle\Entity\Campana
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
     * Add PlanProspeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\Campana
     */
    public function addPlanProspeccion(PlanProspeccion $planProspeccion)
    {
        $this->planProspeccions[] = $planProspeccion;

        return $this;
    }

    /**
     * Remove PlanProspeccion entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\Campana
     */
    public function removePlanProspeccion(PlanProspeccion $planProspeccion)
    {
        $this->planProspeccions->removeElement($planProspeccion);

        return $this;
    }

    /**
     * Get PlanProspeccion entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanProspeccions()
    {
        return $this->planProspeccions;
    }

    /**
     * Set TipoCampana entity (many to one).
     *
     * @param \CoreBundle\Entity\TipoCampana $tipoCampana
     * @return \CoreBundle\Entity\Campana
     */
    public function setTipoCampana(TipoCampana $tipoCampana = null)
    {
        $this->tipoCampana = $tipoCampana;

        return $this;
    }

    /**
     * Get TipoCampana entity (many to one).
     *
     * @return \CoreBundle\Entity\TipoCampana
     */
    public function getTipoCampana()
    {
        return $this->tipoCampana;
    }

    public function __sleep()
    {
        return array('id', 'numero', 'nombre', 'nombreremitente', 'correoremitente', 'asunto', 'fechaEnvio', 'activo', 'idTipoCampana');
    }
}