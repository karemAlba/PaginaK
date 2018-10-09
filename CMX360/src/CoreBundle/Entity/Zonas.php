<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Zonas
 *
 * @ORM\Entity()
 * @ORM\Table(name="zonas", indexes={@ORM\Index(name="fk_zona_pais1_idx", columns={"idPais"})})
 */
class Zonas
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
    protected $zona;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="Estados", mappedBy="zonas")
     * @ORM\JoinColumn(name="id", referencedColumnName="idZona", nullable=false)
     */
    protected $estados;

    /**
     * @ORM\OneToMany(targetEntity="PlanProspeccion", mappedBy="zonas")
     * @ORM\JoinColumn(name="id", referencedColumnName="idZona", nullable=false)
     */
    protected $planProspeccions;

    /**
     * @ORM\ManyToOne(targetEntity="Paises", inversedBy="zonas")
     * @ORM\JoinColumn(name="idPais", referencedColumnName="id", nullable=false)
     */
    protected $paises;

    public function __construct()
    {
        $this->estados = new ArrayCollection();
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
     * @return \CoreBundle\Entity\Zonas
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
     * Set the value of zona.
     *
     * @param string $zona
     * @return \CoreBundle\Entity\Zonas
     */
    public function setZona($zona)
    {
        $this->zona = $zona;

        return $this;
    }

    /**
     * Get the value of zona.
     *
     * @return string
     */
    public function getZona()
    {
        return $this->zona;
    }

    /**
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\Zonas
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
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Zonas
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
     * Set the value of idPais.
     *
     * @param integer $idPais
     * @return \CoreBundle\Entity\Zonas
     */
    public function setIdPais($idPais)
    {
        $this->idPais = $idPais;

        return $this;
    }

    /**
     * Get the value of idPais.
     *
     * @return integer
     */
    public function getIdPais()
    {
        return $this->idPais;
    }

    /**
     * Add Estados entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Estados $estados
     * @return \CoreBundle\Entity\Zonas
     */
    public function addEstados(Estados $estados)
    {
        $this->estados[] = $estados;

        return $this;
    }

    /**
     * Remove Estados entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Estados $estados
     * @return \CoreBundle\Entity\Zonas
     */
    public function removeEstados(Estados $estados)
    {
        $this->estados->removeElement($estados);

        return $this;
    }

    /**
     * Get Estados entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstados()
    {
        return $this->estados;
    }

    /**
     * Add PlanProspeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\Zonas
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
     * @return \CoreBundle\Entity\Zonas
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
     * Set Paises entity (many to one).
     *
     * @param \CoreBundle\Entity\Paises $paises
     * @return \CoreBundle\Entity\Zonas
     */
    public function setPaises(Paises $paises = null)
    {
        $this->paises = $paises;

        return $this;
    }

    /**
     * Get Paises entity (many to one).
     *
     * @return \CoreBundle\Entity\Paises
     */
    public function getPaises()
    {
        return $this->paises;
    }

    public function __sleep()
    {
        return array('id', 'zona', 'nombre', 'activo', 'idPais');
    }
}