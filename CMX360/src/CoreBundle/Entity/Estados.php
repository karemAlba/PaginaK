<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Estados
 *
 * @ORM\Entity()
 * @ORM\Table(name="estados", indexes={@ORM\Index(name="fk_estado_zona1_idx", columns={"idZona"})})
 */
class Estados
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
    protected $nombre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="Municipios", mappedBy="estados")
     * @ORM\JoinColumn(name="id", referencedColumnName="idEstado", nullable=false)
     */
    protected $municipios;

    /**
     * @ORM\OneToMany(targetEntity="PlanProspeccion", mappedBy="estados")
     * @ORM\JoinColumn(name="id", referencedColumnName="idEstado", nullable=false)
     */
    protected $planProspeccions;

    /**
     * @ORM\ManyToOne(targetEntity="Zonas", inversedBy="estados")
     * @ORM\JoinColumn(name="idZona", referencedColumnName="id", nullable=false)
     */
    protected $zonas;

    public function __construct()
    {
        $this->municipios = new ArrayCollection();
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
     * @return \CoreBundle\Entity\Estados
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
     * Set the value of nombre.
     *
     * @param string $nombre
     * @return \CoreBundle\Entity\Estados
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
     * @return \CoreBundle\Entity\Estados
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
     * Set the value of idZona.
     *
     * @param integer $idZona
     * @return \CoreBundle\Entity\Estados
     */
    public function setIdZona($idZona)
    {
        $this->idZona = $idZona;

        return $this;
    }

    /**
     * Get the value of idZona.
     *
     * @return integer
     */
    public function getIdZona()
    {
        return $this->idZona;
    }

    /**
     * Add Municipios entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Municipios $municipios
     * @return \CoreBundle\Entity\Estados
     */
    public function addMunicipios(Municipios $municipios)
    {
        $this->municipios[] = $municipios;

        return $this;
    }

    /**
     * Remove Municipios entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Municipios $municipios
     * @return \CoreBundle\Entity\Estados
     */
    public function removeMunicipios(Municipios $municipios)
    {
        $this->municipios->removeElement($municipios);

        return $this;
    }

    /**
     * Get Municipios entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMunicipios()
    {
        return $this->municipios;
    }

    /**
     * Add PlanProspeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\Estados
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
     * @return \CoreBundle\Entity\Estados
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
     * Set Zonas entity (many to one).
     *
     * @param \CoreBundle\Entity\Zonas $zonas
     * @return \CoreBundle\Entity\Estados
     */
    public function setZonas(Zonas $zonas = null)
    {
        $this->zonas = $zonas;

        return $this;
    }

    /**
     * Get Zonas entity (many to one).
     *
     * @return \CoreBundle\Entity\Zonas
     */
    public function getZonas()
    {
        return $this->zonas;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'idZona');
    }
}