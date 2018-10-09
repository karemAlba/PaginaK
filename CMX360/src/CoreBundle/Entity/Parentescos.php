<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Parentescos
 *
 * @ORM\Entity()
 * @ORM\Table(name="parentescos")
 */
class Parentescos
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
    protected $relacion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="PersonalGenerales", mappedBy="parentescos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idParentesco", nullable=false)
     */
    protected $personalGenerales;

    public function __construct()
    {
        $this->personalGenerales = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Parentescos
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
     * Set the value of relacion.
     *
     * @param string $relacion
     * @return \CoreBundle\Entity\Parentescos
     */
    public function setRelacion($relacion)
    {
        $this->relacion = $relacion;

        return $this;
    }

    /**
     * Get the value of relacion.
     *
     * @return string
     */
    public function getRelacion()
    {
        return $this->relacion;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Parentescos
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
     * Add PersonalGenerales entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalGenerales $personalGenerales
     * @return \CoreBundle\Entity\Parentescos
     */
    public function addPersonalGenerales(PersonalGenerales $personalGenerales)
    {
        $this->personalGenerales[] = $personalGenerales;

        return $this;
    }

    /**
     * Remove PersonalGenerales entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalGenerales $personalGenerales
     * @return \CoreBundle\Entity\Parentescos
     */
    public function removePersonalGenerales(PersonalGenerales $personalGenerales)
    {
        $this->personalGenerales->removeElement($personalGenerales);

        return $this;
    }

    /**
     * Get PersonalGenerales entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonalGenerales()
    {
        return $this->personalGenerales;
    }

    public function __sleep()
    {
        return array('id', 'relacion', 'activo');
    }
}