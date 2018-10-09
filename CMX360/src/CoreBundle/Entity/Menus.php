<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Menus
 *
 * @ORM\Entity()
 * @ORM\Table(name="menus")
 */
class Menus
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
    protected $seccion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $apartado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $ruta;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="Accesos", mappedBy="menus")
     * @ORM\JoinColumn(name="id", referencedColumnName="idMenu", nullable=false)
     */
    protected $accesos;

    public function __construct()
    {
        $this->accesos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Menus
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
     * Set the value of seccion.
     *
     * @param string $seccion
     * @return \CoreBundle\Entity\Menus
     */
    public function setSeccion($seccion)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get the value of seccion.
     *
     * @return string
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Set the value of apartado.
     *
     * @param string $apartado
     * @return \CoreBundle\Entity\Menus
     */
    public function setApartado($apartado)
    {
        $this->apartado = $apartado;

        return $this;
    }

    /**
     * Get the value of apartado.
     *
     * @return string
     */
    public function getApartado()
    {
        return $this->apartado;
    }

    /**
     * Set the value of ruta.
     *
     * @param string $ruta
     * @return \CoreBundle\Entity\Menus
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get the value of ruta.
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Menus
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
     * Add Accesos entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Accesos $accesos
     * @return \CoreBundle\Entity\Menus
     */
    public function addAccesos(Accesos $accesos)
    {
        $this->accesos[] = $accesos;

        return $this;
    }

    /**
     * Remove Accesos entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Accesos $accesos
     * @return \CoreBundle\Entity\Menus
     */
    public function removeAccesos(Accesos $accesos)
    {
        $this->accesos->removeElement($accesos);

        return $this;
    }

    /**
     * Get Accesos entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccesos()
    {
        return $this->accesos;
    }

    public function __sleep()
    {
        return array('id', 'seccion', 'apartado', 'ruta', 'activo');
    }
}