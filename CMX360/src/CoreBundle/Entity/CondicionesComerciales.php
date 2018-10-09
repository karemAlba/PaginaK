<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\CondicionesComerciales
 *
 * @ORM\Entity()
 * @ORM\Table(name="condicionesComerciales")
 */
class CondicionesComerciales
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    protected $condiciones;

    /**
     * @ORM\OneToMany(targetEntity="PropuestasGeneral", mappedBy="condicionesComerciales")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCondicionesComerciales", nullable=false)
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
     * @return \CoreBundle\Entity\CondicionesComerciales
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
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\CondicionesComerciales
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
     * Set the value of condiciones.
     *
     * @param string $condiciones
     * @return \CoreBundle\Entity\CondicionesComerciales
     */
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;

        return $this;
    }

    /**
     * Get the value of condiciones.
     *
     * @return string
     */
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Add PropuestasGeneral entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestasGeneral $propuestasGeneral
     * @return \CoreBundle\Entity\CondicionesComerciales
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
     * @return \CoreBundle\Entity\CondicionesComerciales
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
        return array('id', 'activo', 'condiciones');
    }
}