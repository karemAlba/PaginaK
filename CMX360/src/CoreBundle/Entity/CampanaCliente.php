<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\CampanaCliente
 *
 * @ORM\Entity()
 * @ORM\Table(name="campana_cliente", indexes={@ORM\Index(name="fk_campana_cliente_responsableContactos1_idx", columns={"idResponsableContacto"}), @ORM\Index(name="fk_campana_cliente_campana1_idx", columns={"idCampana"})})
 */
class CampanaCliente
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
    protected $nombredestinatario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $correodestinatario;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $existe;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\ManyToOne(targetEntity="ResponsableContactos", inversedBy="campanaClientes")
     * @ORM\JoinColumn(name="idResponsableContacto", referencedColumnName="id", nullable=true)
     */
    protected $responsableContactos;

    /**
     * @ORM\ManyToOne(targetEntity="Campana", inversedBy="campanaClientes")
     * @ORM\JoinColumn(name="idCampana", referencedColumnName="id", nullable=false)
     */
    protected $campana;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\CampanaCliente
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
     * Set the value of nombredestinatario.
     *
     * @param string $nombredestinatario
     * @return \CoreBundle\Entity\CampanaCliente
     */
    public function setNombredestinatario($nombredestinatario)
    {
        $this->nombredestinatario = $nombredestinatario;

        return $this;
    }

    /**
     * Get the value of nombredestinatario.
     *
     * @return string
     */
    public function getNombredestinatario()
    {
        return $this->nombredestinatario;
    }

    /**
     * Set the value of correodestinatario.
     *
     * @param string $correodestinatario
     * @return \CoreBundle\Entity\CampanaCliente
     */
    public function setCorreodestinatario($correodestinatario)
    {
        $this->correodestinatario = $correodestinatario;

        return $this;
    }

    /**
     * Get the value of correodestinatario.
     *
     * @return string
     */
    public function getCorreodestinatario()
    {
        return $this->correodestinatario;
    }

    /**
     * Set the value of existe.
     *
     * @param boolean $existe
     * @return \CoreBundle\Entity\CampanaCliente
     */
    public function setExiste($existe)
    {
        $this->existe = $existe;

        return $this;
    }

    /**
     * Get the value of existe.
     *
     * @return boolean
     */
    public function getExiste()
    {
        return $this->existe;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\CampanaCliente
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
     * Set the value of idResponsableContacto.
     *
     * @param integer $idResponsableContacto
     * @return \CoreBundle\Entity\CampanaCliente
     */
    public function setIdResponsableContacto($idResponsableContacto)
    {
        $this->idResponsableContacto = $idResponsableContacto;

        return $this;
    }

    /**
     * Get the value of idResponsableContacto.
     *
     * @return integer
     */
    public function getIdResponsableContacto()
    {
        return $this->idResponsableContacto;
    }

    /**
     * Set the value of idCampana.
     *
     * @param integer $idCampana
     * @return \CoreBundle\Entity\CampanaCliente
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
     * Set ResponsableContactos entity (many to one).
     *
     * @param \CoreBundle\Entity\ResponsableContactos $responsableContactos
     * @return \CoreBundle\Entity\CampanaCliente
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

    /**
     * Set Campana entity (many to one).
     *
     * @param \CoreBundle\Entity\Campana $campana
     * @return \CoreBundle\Entity\CampanaCliente
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

    public function __sleep()
    {
        return array('id', 'nombredestinatario', 'correodestinatario', 'existe', 'activo', 'idResponsableContacto', 'idCampana');
    }
}