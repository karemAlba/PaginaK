<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Cargos
 *
 * @ORM\Entity()
 * @ORM\Table(name="cargos", indexes={@ORM\Index(name="fk_cargos_departamentos1_idx", columns={"idDepartamento"})})
 */
class Cargos
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
     * @ORM\OneToMany(targetEntity="PersonalEmpresas", mappedBy="cargos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idCargo", nullable=false)
     */
    protected $personalEmpresas;

    /**
     * @ORM\ManyToOne(targetEntity="Departamentos", inversedBy="cargos")
     * @ORM\JoinColumn(name="idDepartamento", referencedColumnName="id", nullable=false)
     */
    protected $departamentos;

    public function __construct()
    {
        $this->personalEmpresas = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Cargos
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
     * @return \CoreBundle\Entity\Cargos
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
     * @return \CoreBundle\Entity\Cargos
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
     * Set the value of idDepartamento.
     *
     * @param integer $idDepartamento
     * @return \CoreBundle\Entity\Cargos
     */
    public function setIdDepartamento($idDepartamento)
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    /**
     * Get the value of idDepartamento.
     *
     * @return integer
     */
    public function getIdDepartamento()
    {
        return $this->idDepartamento;
    }

    /**
     * Add PersonalEmpresas entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalEmpresas $personalEmpresas
     * @return \CoreBundle\Entity\Cargos
     */
    public function addPersonalEmpresas(PersonalEmpresas $personalEmpresas)
    {
        $this->personalEmpresas[] = $personalEmpresas;

        return $this;
    }

    /**
     * Remove PersonalEmpresas entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalEmpresas $personalEmpresas
     * @return \CoreBundle\Entity\Cargos
     */
    public function removePersonalEmpresas(PersonalEmpresas $personalEmpresas)
    {
        $this->personalEmpresas->removeElement($personalEmpresas);

        return $this;
    }

    /**
     * Get PersonalEmpresas entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonalEmpresas()
    {
        return $this->personalEmpresas;
    }

    /**
     * Set Departamentos entity (many to one).
     *
     * @param \CoreBundle\Entity\Departamentos $departamentos
     * @return \CoreBundle\Entity\Cargos
     */
    public function setDepartamentos(Departamentos $departamentos = null)
    {
        $this->departamentos = $departamentos;

        return $this;
    }

    /**
     * Get Departamentos entity (many to one).
     *
     * @return \CoreBundle\Entity\Departamentos
     */
    public function getDepartamentos()
    {
        return $this->departamentos;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'idDepartamento');
    }
}