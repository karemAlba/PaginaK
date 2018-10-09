<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Grupos
 *
 * @ORM\Entity()
 * @ORM\Table(name="grupos", indexes={@ORM\Index(name="fk_grupos_tipoGrupos1_idx", columns={"idTipoGrupo"})})
 */
class Grupos
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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $idGrupoPadre;

    /**
     * @ORM\OneToMany(targetEntity="Clientes", mappedBy="grupos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idGrupo", nullable=false)
     */
    protected $clientes;

    /**
     * @ORM\OneToMany(targetEntity="ConvenioGrupo", mappedBy="grupos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idGrupo", nullable=false)
     */
    protected $convenioGrupos;

    /**
     * @ORM\OneToMany(targetEntity="PlanAsocUniGpo", mappedBy="grupos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idGrupo", nullable=false)
     */
    protected $planAsocUniGpos;

    /**
     * @ORM\OneToMany(targetEntity="PropuestaIndependiente", mappedBy="grupos")
     * @ORM\JoinColumn(name="id", referencedColumnName="idGrupo", nullable=false)
     */
    protected $propuestaIndependientes;

    /**
     * @ORM\ManyToOne(targetEntity="TipoGrupos", inversedBy="grupos")
     * @ORM\JoinColumn(name="idTipoGrupo", referencedColumnName="id", nullable=false)
     */
    protected $tipoGrupos;

    public function __construct()
    {
        $this->clientes = new ArrayCollection();
        $this->convenioGrupos = new ArrayCollection();
        $this->planAsocUniGpos = new ArrayCollection();
        $this->propuestaIndependientes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Grupos
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
     * @return \CoreBundle\Entity\Grupos
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
     * @return \CoreBundle\Entity\Grupos
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
     * Set the value of idGrupoPadre.
     *
     * @param integer $idGrupoPadre
     * @return \CoreBundle\Entity\Grupos
     */
    public function setIdGrupoPadre($idGrupoPadre)
    {
        $this->idGrupoPadre = $idGrupoPadre;

        return $this;
    }

    /**
     * Get the value of idGrupoPadre.
     *
     * @return integer
     */
    public function getIdGrupoPadre()
    {
        return $this->idGrupoPadre;
    }

    /**
     * Set the value of idTipoGrupo.
     *
     * @param integer $idTipoGrupo
     * @return \CoreBundle\Entity\Grupos
     */
    public function setIdTipoGrupo($idTipoGrupo)
    {
        $this->idTipoGrupo = $idTipoGrupo;

        return $this;
    }

    /**
     * Get the value of idTipoGrupo.
     *
     * @return integer
     */
    public function getIdTipoGrupo()
    {
        return $this->idTipoGrupo;
    }

    /**
     * Add Clientes entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Clientes $clientes
     * @return \CoreBundle\Entity\Grupos
     */
    public function addClientes(Clientes $clientes)
    {
        $this->clientes[] = $clientes;

        return $this;
    }

    /**
     * Remove Clientes entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Clientes $clientes
     * @return \CoreBundle\Entity\Grupos
     */
    public function removeClientes(Clientes $clientes)
    {
        $this->clientes->removeElement($clientes);

        return $this;
    }

    /**
     * Get Clientes entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClientes()
    {
        return $this->clientes;
    }

    /**
     * Add ConvenioGrupo entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ConvenioGrupo $convenioGrupo
     * @return \CoreBundle\Entity\Grupos
     */
    public function addConvenioGrupo(ConvenioGrupo $convenioGrupo)
    {
        $this->convenioGrupos[] = $convenioGrupo;

        return $this;
    }

    /**
     * Remove ConvenioGrupo entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ConvenioGrupo $convenioGrupo
     * @return \CoreBundle\Entity\Grupos
     */
    public function removeConvenioGrupo(ConvenioGrupo $convenioGrupo)
    {
        $this->convenioGrupos->removeElement($convenioGrupo);

        return $this;
    }

    /**
     * Get ConvenioGrupo entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConvenioGrupos()
    {
        return $this->convenioGrupos;
    }

    /**
     * Add PlanAsocUniGpo entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanAsocUniGpo $planAsocUniGpo
     * @return \CoreBundle\Entity\Grupos
     */
    public function addPlanAsocUniGpo(PlanAsocUniGpo $planAsocUniGpo)
    {
        $this->planAsocUniGpos[] = $planAsocUniGpo;

        return $this;
    }

    /**
     * Remove PlanAsocUniGpo entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PlanAsocUniGpo $planAsocUniGpo
     * @return \CoreBundle\Entity\Grupos
     */
    public function removePlanAsocUniGpo(PlanAsocUniGpo $planAsocUniGpo)
    {
        $this->planAsocUniGpos->removeElement($planAsocUniGpo);

        return $this;
    }

    /**
     * Get PlanAsocUniGpo entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanAsocUniGpos()
    {
        return $this->planAsocUniGpos;
    }

    /**
     * Add PropuestaIndependiente entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaIndependiente $propuestaIndependiente
     * @return \CoreBundle\Entity\Grupos
     */
    public function addPropuestaIndependiente(PropuestaIndependiente $propuestaIndependiente)
    {
        $this->propuestaIndependientes[] = $propuestaIndependiente;

        return $this;
    }

    /**
     * Remove PropuestaIndependiente entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\PropuestaIndependiente $propuestaIndependiente
     * @return \CoreBundle\Entity\Grupos
     */
    public function removePropuestaIndependiente(PropuestaIndependiente $propuestaIndependiente)
    {
        $this->propuestaIndependientes->removeElement($propuestaIndependiente);

        return $this;
    }

    /**
     * Get PropuestaIndependiente entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPropuestaIndependientes()
    {
        return $this->propuestaIndependientes;
    }

    /**
     * Set TipoGrupos entity (many to one).
     *
     * @param \CoreBundle\Entity\TipoGrupos $tipoGrupos
     * @return \CoreBundle\Entity\Grupos
     */
    public function setTipoGrupos(TipoGrupos $tipoGrupos = null)
    {
        $this->tipoGrupos = $tipoGrupos;

        return $this;
    }

    /**
     * Get TipoGrupos entity (many to one).
     *
     * @return \CoreBundle\Entity\TipoGrupos
     */
    public function getTipoGrupos()
    {
        return $this->tipoGrupos;
    }

    public function __sleep()
    {
        return array('id', 'nombre', 'activo', 'idGrupoPadre', 'idTipoGrupo');
    }
}