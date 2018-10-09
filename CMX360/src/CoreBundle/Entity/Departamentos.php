<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Departamentos
 *
 * @ORM\Entity()
 * @ORM\Table(name="departamentos")
 */
class Departamentos
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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idDepartamentoPadre;

    /**
     * @ORM\OneToMany(targetEntity="Cargos", mappedBy="departamentos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idDepartamento", nullable=false)
     */
    protected $cargos;

    public function __construct()
    {
        $this->cargos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Departamentos
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
     * @return \CoreBundle\Entity\Departamentos
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
     * @return \CoreBundle\Entity\Departamentos
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
     * Set the value of idDepartamentoPadre.
     *
     * @param integer $idDepartamentoPadre
     * @return \CoreBundle\Entity\Departamentos
     */
    public function setIdDepartamentoPadre($idDepartamentoPadre)
    {
        $this->idDepartamentoPadre = $idDepartamentoPadre;

        return $this;
    }

    /**
     * Get the value of idDepartamentoPadre.
     *
     * @return integer
     */
    public function getIdDepartamentoPadre()
    {
        return $this->idDepartamentoPadre;
    }

    /**
     * Add Cargos entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Cargos $cargos
     * @return \CoreBundle\Entity\Departamentos
     */
    public function addCargos(Cargos $cargos)
    {
        $this->cargos[] = $cargos;

        return $this;
    }

    /**
     * Remove Cargos entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Cargos $cargos
     * @return \CoreBundle\Entity\Departamentos
     */
    public function removeCargos(Cargos $cargos)
    {
        $this->cargos->removeElement($cargos);

        return $this;
    }

    /**
     * Get Cargos entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCargos()
    {
        return $this->cargos;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'idDepartamentoPadre');
    }
}