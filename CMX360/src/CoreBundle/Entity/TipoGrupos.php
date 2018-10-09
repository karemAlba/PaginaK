<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\TipoGrupos
 *
 * @ORM\Entity()
 * @ORM\Table(name="tipoGrupos")
 */
class TipoGrupos
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
     * @ORM\OneToMany(targetEntity="Grupos", mappedBy="tipoGrupos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idTipoGrupo", nullable=false)
     */
    protected $grupos;

    public function __construct()
    {
        $this->grupos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\TipoGrupos
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
     * @return \CoreBundle\Entity\TipoGrupos
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
     * @return \CoreBundle\Entity\TipoGrupos
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
     * Add Grupos entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Grupos $grupos
     * @return \CoreBundle\Entity\TipoGrupos
     */
    public function addGrupos(Grupos $grupos)
    {
        $this->grupos[] = $grupos;

        return $this;
    }

    /**
     * Remove Grupos entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Grupos $grupos
     * @return \CoreBundle\Entity\TipoGrupos
     */
    public function removeGrupos(Grupos $grupos)
    {
        $this->grupos->removeElement($grupos);

        return $this;
    }

    /**
     * Get Grupos entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}