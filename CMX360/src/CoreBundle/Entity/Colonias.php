<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Colonias
 *
 * @ORM\Entity()
 * @ORM\Table(name="colonias", indexes={@ORM\Index(name="fk_colonia_municipio1_idx", columns={"idMunicipio"})})
 */
class Colonias
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $codigoPostal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\OneToMany(targetEntity="DomicilioClientes", mappedBy="colonias")
     * @ORM\JoinColumn(name="id", referencedColumnName="idColonia", nullable=false)
     */
    protected $domicilioClientes;

    /**
     * @ORM\OneToMany(targetEntity="PersonalGenerales", mappedBy="colonias")
     * @ORM\JoinColumn(name="id", referencedColumnName="idColonia", nullable=false)
     */
    protected $personalGenerales;

    /**
     * @ORM\ManyToOne(targetEntity="Municipios", inversedBy="colonias")
     * @ORM\JoinColumn(name="idMunicipio", referencedColumnName="id", nullable=false)
     */
    protected $municipios;

    public function __construct()
    {
        $this->domicilioClientes = new ArrayCollection();
        $this->personalGenerales = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Colonias
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
     * @return \CoreBundle\Entity\Colonias
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
     * Set the value of codigoPostal.
     *
     * @param string $codigoPostal
     * @return \CoreBundle\Entity\Colonias
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get the value of codigoPostal.
     *
     * @return string
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Colonias
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
     * Set the value of idMunicipio.
     *
     * @param integer $idMunicipio
     * @return \CoreBundle\Entity\Colonias
     */
    public function setIdMunicipio($idMunicipio)
    {
        $this->idMunicipio = $idMunicipio;

        return $this;
    }

    /**
     * Get the value of idMunicipio.
     *
     * @return integer
     */
    public function getIdMunicipio()
    {
        return $this->idMunicipio;
    }

    /**
     * Add DomicilioClientes entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\DomicilioClientes $domicilioClientes
     * @return \CoreBundle\Entity\Colonias
     */
    public function addDomicilioClientes(DomicilioClientes $domicilioClientes)
    {
        $this->domicilioClientes[] = $domicilioClientes;

        return $this;
    }

    /**
     * Remove DomicilioClientes entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\DomicilioClientes $domicilioClientes
     * @return \CoreBundle\Entity\Colonias
     */
    public function removeDomicilioClientes(DomicilioClientes $domicilioClientes)
    {
        $this->domicilioClientes->removeElement($domicilioClientes);

        return $this;
    }

    /**
     * Get DomicilioClientes entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomicilioClientes()
    {
        return $this->domicilioClientes;
    }

    /**
     * Add PersonalGenerales entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalGenerales $personalGenerales
     * @return \CoreBundle\Entity\Colonias
     */
    public function addPersonalGenerales(PersonalGenerales $personalGenerales)
    {
        $this->personalGenerales[] = $personalGenerales;

        return $this;
    }

    /**
     * Remove PersonalGenerales entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonalGenerales $personalGenerales
     * @return \CoreBundle\Entity\Colonias
     */
    public function removePersonalGenerales(PersonalGenerales $personalGenerales)
    {
        $this->personalGenerales->removeElement($personalGenerales);

        return $this;
    }

    /**
     * Get PersonalGenerales entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonalGenerales()
    {
        return $this->personalGenerales;
    }

    /**
     * Set Municipios entity (many to one).
     *
     * @param \CoreBundle\Entity\Municipios $municipios
     * @return \CoreBundle\Entity\Colonias
     */
    public function setMunicipios(Municipios $municipios = null)
    {
        $this->municipios = $municipios;

        return $this;
    }

    /**
     * Get Municipios entity (many to one).
     *
     * @return \CoreBundle\Entity\Municipios
     */
    public function getMunicipios()
    {
        return $this->municipios;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'codigoPostal', 'activo', 'idMunicipio');
    }
}