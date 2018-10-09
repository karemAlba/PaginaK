<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\PlanAsocUniGpo
 *
 * @ORM\Entity()
 * @ORM\Table(name="planAsocUniGpo", indexes={@ORM\Index(name="fk_planAsocUniGpo_planProspeccion1_idx", columns={"idPlanProspeccion"}), @ORM\Index(name="fk_planAsocUniGpo_grupos1_idx", columns={"idGrupo"})})
 */
class PlanAsocUniGpo
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
     * @ORM\ManyToOne(targetEntity="PlanProspeccion", inversedBy="planAsocUniGpos")
     * @ORM\JoinColumn(name="idPlanProspeccion", referencedColumnName="id", nullable=false)
     */
    protected $planProspeccion;

    /**
     * @ORM\ManyToOne(targetEntity="Grupos", inversedBy="planAsocUniGpos")
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
     * @return \CoreBundle\Entity\PlanAsocUniGpo
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
     * @return \CoreBundle\Entity\PlanAsocUniGpo
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
     * Set the value of idPlanProspeccion.
     *
     * @param integer $idPlanProspeccion
     * @return \CoreBundle\Entity\PlanAsocUniGpo
     */
    public function setIdPlanProspeccion($idPlanProspeccion)
    {
        $this->idPlanProspeccion = $idPlanProspeccion;

        return $this;
    }

    /**
     * Get the value of idPlanProspeccion.
     *
     * @return integer
     */
    public function getIdPlanProspeccion()
    {
        return $this->idPlanProspeccion;
    }

    /**
     * Set the value of idGrupo.
     *
     * @param integer $idGrupo
     * @return \CoreBundle\Entity\PlanAsocUniGpo
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
     * Set PlanProspeccion entity (many to one).
     *
     * @param \CoreBundle\Entity\PlanProspeccion $planProspeccion
     * @return \CoreBundle\Entity\PlanAsocUniGpo
     */
    public function setPlanProspeccion(PlanProspeccion $planProspeccion = null)
    {
        $this->planProspeccion = $planProspeccion;

        return $this;
    }

    /**
     * Get PlanProspeccion entity (many to one).
     *
     * @return \CoreBundle\Entity\PlanProspeccion
     */
    public function getPlanProspeccion()
    {
        return $this->planProspeccion;
    }

    /**
     * Set Grupos entity (many to one).
     *
     * @param \CoreBundle\Entity\Grupos $grupos
     * @return \CoreBundle\Entity\PlanAsocUniGpo
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
        return array('id', 'activo', 'idPlanProspeccion', 'idGrupo');
    }
}