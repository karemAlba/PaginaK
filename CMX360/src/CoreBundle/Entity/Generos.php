<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Generos
 *
 * @ORM\Entity()
 * @ORM\Table(name="generos")
 */
class Generos
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
     * @ORM\OneToMany(targetEntity="Personales", mappedBy="generos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idGenero", nullable=false)
     */
    protected $personales;

    public function __construct()
    {
        $this->personales = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Generos
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
     * @return \CoreBundle\Entity\Generos
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
     * Add Personales entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Personales $personales
     * @return \CoreBundle\Entity\Generos
     */
    public function addPersonales(Personales $personales)
    {
        $this->personales[] = $personales;

        return $this;
    }

    /**
     * Remove Personales entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Personales $personales
     * @return \CoreBundle\Entity\Generos
     */
    public function removePersonales(Personales $personales)
    {
        $this->personales->removeElement($personales);

        return $this;
    }

    /**
     * Get Personales entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonales()
    {
        return $this->personales;
    }

    public function __sleep()
    {
        return array('id', 'nombre');
    }
}