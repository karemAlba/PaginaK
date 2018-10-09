<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\ConvenioSubservicios
 *
 * @ORM\Entity()
 * @ORM\Table(name="convenio_subservicios", indexes={@ORM\Index(name="fk_convenio_subservicios_convenios1_idx", columns={"idConvenio"}), @ORM\Index(name="fk_convenio_subservicios_subservicio1_idx", columns={"idSubservicio"})})
 */
class ConvenioSubservicios
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
     * @ORM\ManyToOne(targetEntity="Convenios", inversedBy="convenioSubservicios")
     * @ORM\JoinColumn(name="idConvenio", referencedColumnName="id", nullable=false)
     */
    protected $convenios;

    /**
     * @ORM\ManyToOne(targetEntity="Subservicio", inversedBy="convenioSubservicios")
     * @ORM\JoinColumn(name="idSubservicio", referencedColumnName="id", nullable=false)
     */
    protected $subservicio;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\ConvenioSubservicios
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
     * @return \CoreBundle\Entity\ConvenioSubservicios
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
     * Set the value of idConvenio.
     *
     * @param integer $idConvenio
     * @return \CoreBundle\Entity\ConvenioSubservicios
     */
    public function setIdConvenio($idConvenio)
    {
        $this->idConvenio = $idConvenio;

        return $this;
    }

    /**
     * Get the value of idConvenio.
     *
     * @return integer
     */
    public function getIdConvenio()
    {
        return $this->idConvenio;
    }

    /**
     * Set the value of idSubservicio.
     *
     * @param integer $idSubservicio
     * @return \CoreBundle\Entity\ConvenioSubservicios
     */
    public function setIdSubservicio($idSubservicio)
    {
        $this->idSubservicio = $idSubservicio;

        return $this;
    }

    /**
     * Get the value of idSubservicio.
     *
     * @return integer
     */
    public function getIdSubservicio()
    {
        return $this->idSubservicio;
    }

    /**
     * Set Convenios entity (many to one).
     *
     * @param \CoreBundle\Entity\Convenios $convenios
     * @return \CoreBundle\Entity\ConvenioSubservicios
     */
    public function setConvenios(Convenios $convenios = null)
    {
        $this->convenios = $convenios;

        return $this;
    }

    /**
     * Get Convenios entity (many to one).
     *
     * @return \CoreBundle\Entity\Convenios
     */
    public function getConvenios()
    {
        return $this->convenios;
    }

    /**
     * Set Subservicio entity (many to one).
     *
     * @param \CoreBundle\Entity\Subservicio $subservicio
     * @return \CoreBundle\Entity\ConvenioSubservicios
     */
    public function setSubservicio(Subservicio $subservicio = null)
    {
        $this->subservicio = $subservicio;

        return $this;
    }

    /**
     * Get Subservicio entity (many to one).
     *
     * @return \CoreBundle\Entity\Subservicio
     */
    public function getSubservicio()
    {
        return $this->subservicio;
    }

    public function __sleep()
    {
        return array('id', 'activo', 'idConvenio', 'idSubservicio');
    }
}