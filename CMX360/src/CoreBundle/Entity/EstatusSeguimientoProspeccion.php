<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\EstatusSeguimientoProspeccion
 *
 * @ORM\Entity()
 * @ORM\Table(name="estatusSeguimientoProspeccion", indexes={@ORM\Index(name="fk_estatusSeguimientoProspeccion_estatusVentas1_idx", columns={"idEstatusVentas"})})
 */
class EstatusSeguimientoProspeccion
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
     * @ORM\OneToMany(targetEntity="Prospeccion", mappedBy="estatusSeguimientoProspeccion")
     * @ORM\JoinColumn(name="id", referencedColumnName="idEstatusSeguimientoProspeccion", nullable=false)
     */
    protected $prospeccions;

    /**
     * @ORM\ManyToOne(targetEntity="EstatusVentas", inversedBy="estatusSeguimientoProspeccions")
     * @ORM\JoinColumn(name="idEstatusVentas", referencedColumnName="id", nullable=false)
     */
    protected $estatusVentas;

    public function __construct()
    {
        $this->prospeccions = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\EstatusSeguimientoProspeccion
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
     * @return \CoreBundle\Entity\EstatusSeguimientoProspeccion
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
     * @return \CoreBundle\Entity\EstatusSeguimientoProspeccion
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
     * Set the value of idEstatusVentas.
     *
     * @param integer $idEstatusVentas
     * @return \CoreBundle\Entity\EstatusSeguimientoProspeccion
     */
    public function setIdEstatusVentas($idEstatusVentas)
    {
        $this->idEstatusVentas = $idEstatusVentas;

        return $this;
    }

    /**
     * Get the value of idEstatusVentas.
     *
     * @return integer
     */
    public function getIdEstatusVentas()
    {
        return $this->idEstatusVentas;
    }

    /**
     * Add Prospeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Prospeccion $prospeccion
     * @return \CoreBundle\Entity\EstatusSeguimientoProspeccion
     */
    public function addProspeccion(Prospeccion $prospeccion)
    {
        $this->prospeccions[] = $prospeccion;

        return $this;
    }

    /**
     * Remove Prospeccion entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Prospeccion $prospeccion
     * @return \CoreBundle\Entity\EstatusSeguimientoProspeccion
     */
    public function removeProspeccion(Prospeccion $prospeccion)
    {
        $this->prospeccions->removeElement($prospeccion);

        return $this;
    }

    /**
     * Get Prospeccion entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProspeccions()
    {
        return $this->prospeccions;
    }

    /**
     * Set EstatusVentas entity (many to one).
     *
     * @param \CoreBundle\Entity\EstatusVentas $estatusVentas
     * @return \CoreBundle\Entity\EstatusSeguimientoProspeccion
     */
    public function setEstatusVentas(EstatusVentas $estatusVentas = null)
    {
        $this->estatusVentas = $estatusVentas;

        return $this;
    }

    /**
     * Get EstatusVentas entity (many to one).
     *
     * @return \CoreBundle\Entity\EstatusVentas
     */
    public function getEstatusVentas()
    {
        return $this->estatusVentas;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'idEstatusVentas');
    }
}