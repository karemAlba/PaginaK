<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\EstatusVentas
 *
 * @ORM\Entity()
 * @ORM\Table(name="estatusVentas")
 */
class EstatusVentas
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
     * @ORM\OneToMany(targetEntity="EstatusSeguimientoProspeccion", mappedBy="estatusVentas")
     * @ORM\JoinColumn(name="id", referencedColumnName="idEstatusVentas", nullable=false)
     */
    protected $estatusSeguimientoProspeccions;

    public function __construct()
    {
        $this->estatusSeguimientoProspeccions = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\EstatusVentas
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
     * @return \CoreBundle\Entity\EstatusVentas
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
     * @return \CoreBundle\Entity\EstatusVentas
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
     * Add EstatusSeguimientoProspeccion entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\EstatusSeguimientoProspeccion $estatusSeguimientoProspeccion
     * @return \CoreBundle\Entity\EstatusVentas
     */
    public function addEstatusSeguimientoProspeccion(EstatusSeguimientoProspeccion $estatusSeguimientoProspeccion)
    {
        $this->estatusSeguimientoProspeccions[] = $estatusSeguimientoProspeccion;

        return $this;
    }

    /**
     * Remove EstatusSeguimientoProspeccion entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\EstatusSeguimientoProspeccion $estatusSeguimientoProspeccion
     * @return \CoreBundle\Entity\EstatusVentas
     */
    public function removeEstatusSeguimientoProspeccion(EstatusSeguimientoProspeccion $estatusSeguimientoProspeccion)
    {
        $this->estatusSeguimientoProspeccions->removeElement($estatusSeguimientoProspeccion);

        return $this;
    }

    /**
     * Get EstatusSeguimientoProspeccion entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstatusSeguimientoProspeccions()
    {
        return $this->estatusSeguimientoProspeccions;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo');
    }
}