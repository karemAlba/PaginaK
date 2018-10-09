<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Paises
 *
 * @ORM\Entity()
 * @ORM\Table(name="paises")
 */
class Paises
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
     * @ORM\OneToMany(targetEntity="Zonas", mappedBy="paises")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPais", nullable=false)
     */
    protected $zonas;

    public function __construct()
    {
        $this->zonas = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Paises
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
     * @return \CoreBundle\Entity\Paises
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
     * @return \CoreBundle\Entity\Paises
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
     * Add Zonas entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Zonas $zonas
     * @return \CoreBundle\Entity\Paises
     */
    public function addZonas(Zonas $zonas)
    {
        $this->zonas[] = $zonas;

        return $this;
    }

    /**
     * Remove Zonas entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Zonas $zonas
     * @return \CoreBundle\Entity\Paises
     */
    public function removeZonas(Zonas $zonas)
    {
        $this->zonas->removeElement($zonas);

        return $this;
    }

    /**
     * Get Zonas entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZonas()
    {
        return $this->zonas;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}