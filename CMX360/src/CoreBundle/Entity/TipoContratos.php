<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\TipoContratos
 *
 * @ORM\Entity()
 * @ORM\Table(name="tipoContratos")
 */
class TipoContratos
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
     * @ORM\OneToMany(targetEntity="PersonalLaborales", mappedBy="tipoContratos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idTipoContrato", nullable=false)
     */
    protected $personalLaborales;

    public function __construct()
    {
        $this->personalLaborales = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\TipoContratos
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
     * @return \CoreBundle\Entity\TipoContratos
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
     * @return \CoreBundle\Entity\TipoContratos
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
     * Add PersonalLaborales entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalLaborales $personalLaborales
     * @return \CoreBundle\Entity\TipoContratos
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
     * @return \CoreBundle\Entity\TipoContratos
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

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}