<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * CoreBundle\Entity\Usuarios
 *
 * @ORM\Entity(repositoryClass="CoreBundle\Entity\UsuariosRepository")
 * @ORM\Table(name="usuarios")
 */
class Usuarios implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idu;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $usuario;

    /**
     * @ORM\Column(name="`password`", type="string", length=50, nullable=true)
     */
    protected $password;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $rol;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $salt;

    /**
     * @Gedmo\Timestampable(on="create", field="creado")
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;

    public function __construct()
    {
    }

    /**
     * Set the value of idu.
     *
     * @param integer $idu
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setIdu($idu)
    {
        $this->idu = $idu;

        return $this;
    }

    /**
     * Get the value of idu.
     *
     * @return integer
     */
    public function getIdu()
    {
        return $this->idu;
    }

    /**
     * Set the value of usuario.
     *
     * @param string $usuario
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of usuario.
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of password.
     *
     * @param string $password
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of rol.
     *
     * @param integer $rol
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get the value of rol.
     *
     * @return integer
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of salt.
     *
     * @param string $salt
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get the value of salt.
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the value of created_at.
     *
     * @param \DateTime $created_at
     * @return \CoreBundle\Entity\Usuarios
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of created_at.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
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
            $this->idu,
            $this->usuario,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->idu,
            $this->usuario,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->usuario;
    }

    public function __sleep()
    {
        return array('idu', 'usuario', 'password', 'rol', 'salt', 'created_at');
    }
}