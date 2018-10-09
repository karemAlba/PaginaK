<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Privilegios
 *
 * @ORM\Entity()
 * @ORM\Table(name="privilegios")
 */
class Privilegios
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
     * @ORM\OneToMany(targetEntity="Accesos", mappedBy="privilegios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPrivilegio", nullable=false)
     */
    protected $accesos;

    /**
     * @ORM\OneToMany(targetEntity="PersonaPerfiles", mappedBy="privilegios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idPrivilegio", nullable=false)
     */
    protected $personaPerfiles;

    public function __construct()
    {
        $this->accesos = new ArrayCollection();
        $this->personaPerfiles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Privilegios
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
     * @return \CoreBundle\Entity\Privilegios
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
     * @return \CoreBundle\Entity\Privilegios
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
     * @return \CoreBundle\Entity\Privilegios
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
     * @return \CoreBundle\Entity\Privilegios
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

    /**
     * Add PersonaPerfiles entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonaPerfiles $personaPerfiles
     * @return \CoreBundle\Entity\Privilegios
     */
    public function addPersonaPerfiles(PersonaPerfiles $personaPerfiles)
    {
        $this->personaPerfiles[] = $personaPerfiles;

        return $this;
    }

    /**
     * Remove PersonaPerfiles entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonaPerfiles $personaPerfiles
     * @return \CoreBundle\Entity\Privilegios
     */
    public function removePersonaPerfiles(PersonaPerfiles $personaPerfiles)
    {
        $this->personaPerfiles->removeElement($personaPerfiles);

        return $this;
    }

    /**
     * Get PersonaPerfiles entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonaPerfiles()
    {
        return $this->personaPerfiles;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}