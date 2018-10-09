<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\ConvenioGrupo
 *
 * @ORM\Entity()
 * @ORM\Table(name="convenio_grupo", indexes={@ORM\Index(name="fk_convenio_grupo_convenios1_idx", columns={"idConvenio"}), @ORM\Index(name="fk_convenio_grupo_grupos1_idx", columns={"idGrupo"})})
 */
class ConvenioGrupo
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
     * @ORM\ManyToOne(targetEntity="Convenios", inversedBy="convenioGrupos")
     * @ORM\JoinColumn(name="idConvenio", referencedColumnName="id", nullable=false)
     */
    protected $convenios;

    /**
     * @ORM\ManyToOne(targetEntity="Grupos", inversedBy="convenioGrupos")
     * @ORM\JoinColumn(name="idGrupo", referencedColumnName="id", nullable=false)
     */
    protected $grupos;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\ConvenioGrupo
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
     * @return \CoreBundle\Entity\ConvenioGrupo
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
     * @return \CoreBundle\Entity\ConvenioGrupo
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
     * Set the value of idGrupo.
     *
     * @param integer $idGrupo
     * @return \CoreBundle\Entity\ConvenioGrupo
     */
    public function setIdGrupo($idGrupo)
    {
        $this->idGrupo = $idGrupo;

        return $this;
    }

    /**
     * Get the value of idGrupo.
     *
     * @return integer
     */
    public function getIdGrupo()
    {
        return $this->idGrupo;
    }

    /**
     * Set Convenios entity (many to one).
     *
     * @param \CoreBundle\Entity\Convenios $convenios
     * @return \CoreBundle\Entity\ConvenioGrupo
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
     * Set Grupos entity (many to one).
     *
     * @param \CoreBundle\Entity\Grupos $grupos
     * @return \CoreBundle\Entity\ConvenioGrupo
     */
    public function setGrupos(Grupos $grupos = null)
    {
        $this->grupos = $grupos;

        return $this;
    }

    /**
     * Get Grupos entity (many to one).
     *
     * @return \CoreBundle\Entity\Grupos
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    public function __sleep()
    {
        return array('id', 'activo', 'idConvenio', 'idGrupo');
    }
}