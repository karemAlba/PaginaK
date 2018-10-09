<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PersonaPerfiles
 *
 * @ORM\Entity()
 * @ORM\Table(name="persona_perfiles", indexes={@ORM\Index(name="fk_persona_perfiles_perfil1_idx", columns={"idPerfil"}), @ORM\Index(name="fk_persona_perfiles_privilegio1_idx", columns={"idPrivilegio"}), @ORM\Index(name="fk_persona_perfiles_usuarios1_idx", columns={"idUsuario"})})
 */
class PersonaPerfiles
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
     * @ORM\ManyToOne(targetEntity="Perfiles", inversedBy="personaPerfiles")
     * @ORM\JoinColumn(name="idPerfil", referencedColumnName="id", nullable=false)
     */
    protected $perfiles;

    /**
     * @ORM\ManyToOne(targetEntity="Privilegios", inversedBy="personaPerfiles")
     * @ORM\JoinColumn(name="idPrivilegio", referencedColumnName="id", nullable=false)
     */
    protected $privilegios;

    /**
     * @ORM\ManyToOne(targetEntity="Usuarios", inversedBy="personaPerfiles")
     * @ORM\JoinColumn(name="idUsuario", referencedColumnName="id", nullable=false)
     */
    protected $usuarios;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\PersonaPerfiles
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
     * @return \CoreBundle\Entity\PersonaPerfiles
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
     * @return \CoreBundle\Entity\PersonaPerfiles
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
     * @return \CoreBundle\Entity\PersonaPerfiles
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
     * @return \CoreBundle\Entity\PersonaPerfiles
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
     * Set the value of idUsuario.
     *
     * @param integer $idUsuario
     * @return \CoreBundle\Entity\PersonaPerfiles
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of idUsuario.
     *
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set Perfiles entity (many to one).
     *
     * @param \CoreBundle\Entity\Perfiles $perfiles
     * @return \CoreBundle\Entity\PersonaPerfiles
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
     * @return \CoreBundle\Entity\PersonaPerfiles
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
     * Set Usuarios entity (many to one).
     *
     * @param \CoreBundle\Entity\Usuarios $usuarios
     * @return \CoreBundle\Entity\PersonaPerfiles
     */
    public function setUsuarios(Usuarios $usuarios = null)
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    /**
     * Get Usuarios entity (many to one).
     *
     * @return \CoreBundle\Entity\Usuarios
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    public function __sleep()
    {
        return array('id', 'activo', 'fechaAlta', 'idPerfil', 'idPrivilegio', 'idUsuario');
    }
}