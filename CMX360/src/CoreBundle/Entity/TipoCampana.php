<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\TipoCampana
 *
 * @ORM\Entity()
 * @ORM\Table(name="tipoCampana")
 */
class TipoCampana
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
     * @ORM\OneToMany(targetEntity="Campana", mappedBy="tipoCampana")
     * @ORM\JoinColumn(name="id", referencedColumnName="idTipoCampana", nullable=false)
     */
    protected $campanas;

    public function __construct()
    {
        $this->campanas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\TipoCampana
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
     * @return \CoreBundle\Entity\TipoCampana
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
     * @return \CoreBundle\Entity\TipoCampana
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
     * Add Campana entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Campana $campana
     * @return \CoreBundle\Entity\TipoCampana
     */
    public function addCampana(Campana $campana)
    {
        $this->campanas[] = $campana;

        return $this;
    }

    /**
     * Remove Campana entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Campana $campana
     * @return \CoreBundle\Entity\TipoCampana
     */
    public function removeCampana(Campana $campana)
    {
        $this->campanas->removeElement($campana);

        return $this;
    }

    /**
     * Get Campana entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampanas()
    {
        return $this->campanas;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}