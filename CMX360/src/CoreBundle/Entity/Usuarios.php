<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * CoreBundle\Entity\Usuarios
 *
 * @ORM\Entity(repositoryClass="CoreBundle\Entity\UsuariosRepository")
 * @ORM\Table(name="usuarios", indexes={@ORM\Index(name="fk_usuarios_personales1_idx", columns={"idPersonal"})})
 */
class Usuarios implements UserInterface, \Serializable
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
     * @ORM\Column(type="blob", length=255, nullable=true)
     */
    protected $contrasena;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $activo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\OneToMany(targetEntity="PersonaPerfiles", mappedBy="usuarios")
     * @ORM\JoinColumn(name="id", referencedColumnName="idUsuario", nullable=false)
     */
    protected $personaPerfiles;

    /**
     * @ORM\ManyToOne(targetEntity="Personales", inversedBy="usuarios")
     * @ORM\JoinColumn(name="idPersonal", referencedColumnName="id")
     */
    protected $personales;

    /**
     * @ORM\ManyToOne(targetEntity="ClienteResponsables", inversedBy="usuarios")
     * @ORM\JoinColumn(name="idClienteResponsable", referencedColumnName="id")
     */
    protected $clienteResponsables;

    public function __construct()
    {
        $this->personaPerfiles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Usuarios
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
     * @return \CoreBundle\Entity\Usuarios
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
     * Set the value of contrasena.
     *
     * @param string $contrasena
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    /**
     * Get the value of contrasena.
     *
     * @return string
     */
    public function getContrasena()
    {
        if($this->contrasena != ''){
            rewind($this->contrasena);
            return stream_get_contents($this->contrasena);
        }
        return $this->contrasena;
    }

    /**
     * Set the value of activo.
     *
     * @param boolean $activo
     * @return \CoreBundle\Entity\Usuarios
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
     * @return \CoreBundle\Entity\Usuarios
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
     * Set the value of idPersonal.
     *
     * @param integer $idPersonal
     * @return \CoreBundle\Entity\Usuarios
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
     * Set the value of idClienteResponsable.
     *
     * @param integer $idClienteResponsable
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setIdClienteResponsable($idClienteResponsable)
    {
        $this->idClienteResponsable = $idClienteResponsable;

        return $this;
    }

    /**
     * Get the value of idClienteResponsable.
     *
     * @return integer
     */
    public function getIdClienteResponsable()
    {
        return $this->idClienteResponsable;
    }

    /**
     * Add PersonaPerfiles entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonaPerfiles $personaPerfiles
     * @return \CoreBundle\Entity\Usuarios
     */
    public function addPersonaPerfiles(PersonaPerfiles $personaPerfiles)
    {
        $this->personaPerfiles[] = $personaPerfiles;

        return $this;
    }

    /**
     * Remove PersonaPerfiles entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PersonaPerfiles $personaPerfiles
     * @return \CoreBundle\Entity\Usuarios
     */
    public function removePersonaPerfiles(PersonaPerfiles $personaPerfiles)
    {
        $this->personaPerfiles->removeElement($personaPerfiles);

        return $this;
    }

    /**
     * Get PersonaPerfiles entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonaPerfiles()
    {
        return $this->personaPerfiles;
    }

    /**
     * Set Personales entity (many to one).
     *
     * @param \CoreBundle\Entity\Personales $personales
     * @return \CoreBundle\Entity\Usuarios
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
     * Set ClienteResponsables entity (many to one).
     *
     * @param \CoreBundle\Entity\ClienteResponsables $clienteResponsables
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setClienteResponsables(ClienteResponsables $clienteResponsables = null)
    {
        $this->clienteResponsables = $clienteResponsables;

        return $this;
    }

    /**
     * Get ClienteResponsables entity (many to one).
     *
     * @return \CoreBundle\Entity\ClienteResponsables
     */
    public function getClienteResponsables()
    {
        return $this->clienteResponsables;
    }

    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->nombre,
            $this->contrasena,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nombre,
            $this->contrasena,
            ) = unserialize($serialized);
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->nombre;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'contrasena', 'activo', 'fechaAlta', 'idPersonal', 'idClienteResponsable');
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        if($this->contrasena != ''){
            return stream_get_contents($this->contrasena);
        }
        return $this->contrasena;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }
}