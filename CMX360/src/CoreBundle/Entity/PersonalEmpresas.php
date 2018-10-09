<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PersonalEmpresas
 *
 * @ORM\Entity()
 * @ORM\Table(name="personal_empresas", indexes={@ORM\Index(name="fk_personal_empresas_personales1_idx", columns={"idPersonal"}), @ORM\Index(name="fk_personal_empresas_cargos1_idx", columns={"idCargo"})})
 */
class PersonalEmpresas
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
     * @ORM\ManyToOne(targetEntity="Personales", inversedBy="personalEmpresas")
     * @ORM\JoinColumn(name="idPersonal", referencedColumnName="id", nullable=false)
     */
    protected $personales;

    /**
     * @ORM\ManyToOne(targetEntity="Cargos", inversedBy="personalEmpresas")
     * @ORM\JoinColumn(name="idCargo", referencedColumnName="id", nullable=false)
     */
    protected $cargos;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PersonalEmpresas
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
     * @return \CoreBundle\Entity\PersonalEmpresas
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
     * Set the value of idPersonal.
     *
     * @param integer $idPersonal
     * @return \CoreBundle\Entity\PersonalEmpresas
     */
    public function setIdPersonal($idPersonal)
    {
        $this->idPersonal = $idPersonal;

        return $this;
    }

    /**
     * Get the value of idPersonal.
     *
     * @return integer
     */
    public function getIdPersonal()
    {
        return $this->idPersonal;
    }

    /**
     * Set the value of idCargo.
     *
     * @param integer $idCargo
     * @return \CoreBundle\Entity\PersonalEmpresas
     */
    public function setIdCargo($idCargo)
    {
        $this->idCargo = $idCargo;

        return $this;
    }

    /**
     * Get the value of idCargo.
     *
     * @return integer
     */
    public function getIdCargo()
    {
        return $this->idCargo;
    }

    /**
     * Set Personales entity (many to one).
     *
     * @param \CoreBundle\Entity\Personales $personales
     * @return \CoreBundle\Entity\PersonalEmpresas
     */
    public function setPersonales(Personales $personales = null)
    {
        $this->personales = $personales;

        return $this;
    }

    /**
     * Get Personales entity (many to one).
     *
     * @return \CoreBundle\Entity\Personales
     */
    public function getPersonales()
    {
        return $this->personales;
    }

    /**
     * Set Cargos entity (many to one).
     *
     * @param \CoreBundle\Entity\Cargos $cargos
     * @return \CoreBundle\Entity\PersonalEmpresas
     */
    public function setCargos(Cargos $cargos = null)
    {
        $this->cargos = $cargos;

        return $this;
    }

    /**
     * Get Cargos entity (many to one).
     *
     * @return \CoreBundle\Entity\Cargos
     */
    public function getCargos()
    {
        return $this->cargos;
    }

    public function __sleep()
    {
        return array('id', 'activo', 'idPersonal', 'idCargo');
    }
}