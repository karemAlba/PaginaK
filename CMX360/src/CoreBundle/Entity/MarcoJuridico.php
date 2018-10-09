<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\MarcoJuridico
 *
 * @ORM\Entity()
 * @ORM\Table(name="marcoJuridico")
 */
class MarcoJuridico
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
     * @ORM\OneToMany(targetEntity="PropuestasGeneral", mappedBy="marcoJuridico")
     * @ORM\JoinColumn(name="id", referencedColumnName="idMarcoJuridico", nullable=false)
     */
    protected $propuestasGenerals;

    public function __construct()
    {
        $this->propuestasGenerals = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\MarcoJuridico
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
     * @return \CoreBundle\Entity\MarcoJuridico
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
     * @return \CoreBundle\Entity\MarcoJuridico
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
     * Add PropuestasGeneral entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestasGeneral $propuestasGeneral
     * @return \CoreBundle\Entity\MarcoJuridico
     */
    public function addPropuestasGeneral(PropuestasGeneral $propuestasGeneral)
    {
        $this->propuestasGenerals[] = $propuestasGeneral;

        return $this;
    }

    /**
     * Remove PropuestasGeneral entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestasGeneral $propuestasGeneral
     * @return \CoreBundle\Entity\MarcoJuridico
     */
    public function removePropuestasGeneral(PropuestasGeneral $propuestasGeneral)
    {
        $this->propuestasGenerals->removeElement($propuestasGeneral);

        return $this;
    }

    /**
     * Get PropuestasGeneral entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropuestasGenerals()
    {
        return $this->propuestasGenerals;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}