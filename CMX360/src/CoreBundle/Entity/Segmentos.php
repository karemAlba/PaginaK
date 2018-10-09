<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Segmentos
 *
 * @ORM\Entity()
 * @ORM\Table(name="segmentos", indexes={@ORM\Index(name="fk_segmentos_sectores1_idx", columns={"idSector"})})
 */
class Segmentos
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
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $clave;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="Categorias", mappedBy="segmentos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idSegmento", nullable=false)
     */
    protected $categorias;

    /**
     * @ORM\ManyToOne(targetEntity="Sectores", inversedBy="segmentos")
     * @ORM\JoinColumn(name="idSector", referencedColumnName="id", nullable=false)
     */
    protected $sectores;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Segmentos
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
     * @return \CoreBundle\Entity\Segmentos
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
     * Set the value of clave.
     *
     * @param string $clave
     * @return \CoreBundle\Entity\Segmentos
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get the value of clave.
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Segmentos
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
     * Set the value of idSector.
     *
     * @param integer $idSector
     * @return \CoreBundle\Entity\Segmentos
     */
    public function setIdSector($idSector)
    {
        $this->idSector = $idSector;

        return $this;
    }

    /**
     * Get the value of idSector.
     *
     * @return integer
     */
    public function getIdSector()
    {
        return $this->idSector;
    }

    /**
     * Add Categorias entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Categorias $categorias
     * @return \CoreBundle\Entity\Segmentos
     */
    public function addCategorias(Categorias $categorias)
    {
        $this->categorias[] = $categorias;

        return $this;
    }

    /**
     * Remove Categorias entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Categorias $categorias
     * @return \CoreBundle\Entity\Segmentos
     */
    public function removeCategorias(Categorias $categorias)
    {
        $this->categorias->removeElement($categorias);

        return $this;
    }

    /**
     * Get Categorias entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    /**
     * Set Sectores entity (many to one).
     *
     * @param \CoreBundle\Entity\Sectores $sectores
     * @return \CoreBundle\Entity\Segmentos
     */
    public function setSectores(Sectores $sectores = null)
    {
        $this->sectores = $sectores;

        return $this;
    }

    /**
     * Get Sectores entity (many to one).
     *
     * @return \CoreBundle\Entity\Sectores
     */
    public function getSectores()
    {
        return $this->sectores;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'clave', 'activo', 'idSector');
    }
}