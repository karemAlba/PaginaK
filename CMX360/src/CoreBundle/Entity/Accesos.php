<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\Accesos
 *
 * @ORM\Entity()
 * @ORM\Table(name="accesos", indexes={@ORM\Index(name="fk_accesos_perfiles1_idx", columns={"idPerfil"}), @ORM\Index(name="fk_accesos_privilegios1_idx", columns={"idPrivilegio"}), @ORM\Index(name="fk_accesos_menus1_idx", columns={"idMenu"})})
 */
class Accesos
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
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\ManyToOne(targetEntity="Perfiles", inversedBy="accesos")
     * @ORM\JoinColumn(name="idPerfil", referencedColumnName="id", nullable=false)
     */
    protected $perfiles;

    /**
     * @ORM\ManyToOne(targetEntity="Privilegios", inversedBy="accesos")
     * @ORM\JoinColumn(name="idPrivilegio", referencedColumnName="id", nullable=false)
     */
    protected $privilegios;

    /**
     * @ORM\ManyToOne(targetEntity="Menus", inversedBy="accesos")
     * @ORM\JoinColumn(name="idMenu", referencedColumnName="id", nullable=false)
     */
    protected $menus;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Accesos
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
     * @return \CoreBundle\Entity\Accesos
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
     * Set the value of fechaAlta.
     *
     * @param \DateTime $fechaAlta
     * @return \CoreBundle\Entity\Accesos
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get the value of fechaAlta.
     *
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set the value of idPerfil.
     *
     * @param integer $idPerfil
     * @return \CoreBundle\Entity\Accesos
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;

        return $this;
    }

    /**
     * Get the value of idPerfil.
     *
     * @return integer
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set the value of idPrivilegio.
     *
     * @param integer $idPrivilegio
     * @return \CoreBundle\Entity\Accesos
     */
    public function setIdPrivilegio($idPrivilegio)
    {
        $this->idPrivilegio = $idPrivilegio;

        return $this;
    }

    /**
     * Get the value of idPrivilegio.
     *
     * @return integer
     */
    public function getIdPrivilegio()
    {
        return $this->idPrivilegio;
    }

    /**
     * Set the value of idMenu.
     *
     * @param integer $idMenu
     * @return \CoreBundle\Entity\Accesos
     */
    public function setIdMenu($idMenu)
    {
        $this->idMenu = $idMenu;

        return $this;
    }

    /**
     * Get the value of idMenu.
     *
     * @return integer
     */
    public function getIdMenu()
    {
        return $this->idMenu;
    }

    /**
     * Set Perfiles entity (many to one).
     *
     * @param \CoreBundle\Entity\Perfiles $perfiles
     * @return \CoreBundle\Entity\Accesos
     */
    public function setPerfiles(Perfiles $perfiles = null)
    {
        $this->perfiles = $perfiles;

        return $this;
    }

    /**
     * Get Perfiles entity (many to one).
     *
     * @return \CoreBundle\Entity\Perfiles
     */
    public function getPerfiles()
    {
        return $this->perfiles;
    }

    /**
     * Set Privilegios entity (many to one).
     *
     * @param \CoreBundle\Entity\Privilegios $privilegios
     * @return \CoreBundle\Entity\Accesos
     */
    public function setPrivilegios(Privilegios $privilegios = null)
    {
        $this->privilegios = $privilegios;

        return $this;
    }

    /**
     * Get Privilegios entity (many to one).
     *
     * @return \CoreBundle\Entity\Privilegios
     */
    public function getPrivilegios()
    {
        return $this->privilegios;
    }

    /**
     * Set Menus entity (many to one).
     *
     * @param \CoreBundle\Entity\Menus $menus
     * @return \CoreBundle\Entity\Accesos
     */
    public function setMenus(Menus $menus = null)
    {
        $this->menus = $menus;

        return $this;
    }

    /**
     * Get Menus entity (many to one).
     *
     * @return \CoreBundle\Entity\Menus
     */
    public function getMenus()
    {
        return $this->menus;
    }

    public function __sleep()
    {
        return array('id', 'activo', 'fechaAlta', 'idPerfil', 'idPrivilegio', 'idMenu');
    }
}