<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\EstatusPropuesta
 *
 * @ORM\Entity()
 * @ORM\Table(name="estatusPropuesta")
 */
class EstatusPropuesta
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
     * @ORM\OneToMany(targetEntity="PropuestaIndependiente", mappedBy="estatusPropuesta")
     * @ORM\JoinColumn(name="id", referencedColumnName="idEstatusPropuesta", nullable=false)
     */
    protected $propuestaIndependientes;

    public function __construct()
    {
        $this->propuestaIndependientes = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\EstatusPropuesta
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
     * @return \CoreBundle\Entity\EstatusPropuesta
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
     * @return \CoreBundle\Entity\EstatusPropuesta
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
     * Add PropuestaIndependiente entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaIndependiente $propuestaIndependiente
     * @return \CoreBundle\Entity\EstatusPropuesta
     */
    public function addPropuestaIndependiente(PropuestaIndependiente $propuestaIndependiente)
    {
        $this->propuestaIndependientes[] = $propuestaIndependiente;

        return $this;
    }

    /**
     * Remove PropuestaIndependiente entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaIndependiente $propuestaIndependiente
     * @return \CoreBundle\Entity\EstatusPropuesta
     */
    public function removePropuestaIndependiente(PropuestaIndependiente $propuestaIndependiente)
    {
        $this->propuestaIndependientes->removeElement($propuestaIndependiente);

        return $this;
    }

    /**
     * Get PropuestaIndependiente entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropuestaIndependientes()
    {
        return $this->propuestaIndependientes;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}