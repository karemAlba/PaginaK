<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Sectores
 *
 * @ORM\Entity()
 * @ORM\Table(name="sectores")
 */
class Sectores
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
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $clave;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="Segmentos", mappedBy="sectores")
     * @ORM\JoinColumn(name="id", referencedColumnName="idSector", nullable=false)
     */
    protected $segmentos;

    public function __construct()
    {
        $this->segmentos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Sectores
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
     * @return \CoreBundle\Entity\Sectores
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
     * Set the value of clave.
     *
     * @param string $clave
     * @return \CoreBundle\Entity\Sectores
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get the value of clave.
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Sectores
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
     * Add Segmentos entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Segmentos $segmentos
     * @return \CoreBundle\Entity\Sectores
     */
    public function addSegmentos(Segmentos $segmentos)
    {
        $this->segmentos[] = $segmentos;

        return $this;
    }

    /**
     * Remove Segmentos entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Segmentos $segmentos
     * @return \CoreBundle\Entity\Sectores
     */
    public function removeSegmentos(Segmentos $segmentos)
    {
        $this->segmentos->removeElement($segmentos);

        return $this;
    }

    /**
     * Get Segmentos entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSegmentos()
    {
        return $this->segmentos;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'clave', 'activo');
    }
}