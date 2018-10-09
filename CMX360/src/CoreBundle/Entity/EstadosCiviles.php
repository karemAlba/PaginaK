<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\EstadosCiviles
 *
 * @ORM\Entity()
 * @ORM\Table(name="estadosCiviles")
 */
class EstadosCiviles
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
    protected $estado;

    /**
     * @ORM\OneToMany(targetEntity="PersonalGenerales", mappedBy="estadosCiviles")
     * @ORM\JoinColumn(name="id", referencedColumnName="idEstadoCivil", nullable=false)
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
     * @return \CoreBundle\Entity\EstadosCiviles
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
     * Set the value of estado.
     *
     * @param string $estado
     * @return \CoreBundle\Entity\EstadosCiviles
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of estado.
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add PersonalGenerales entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalGenerales $personalGenerales
     * @return \CoreBundle\Entity\EstadosCiviles
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
     * @return \CoreBundle\Entity\EstadosCiviles
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
        return array('id', 'estado');
    }
}