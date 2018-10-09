<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\Caidas
 *
 * @ORM\Entity()
 * @ORM\Table(name="caidas")
 */
class Caidas
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idc;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $no_estacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $razon_social;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $direccion;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $alfanum;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $fecha_publicacion;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $fecha_inicio;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $nombre_reviso;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $puesto_reviso;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $quien_aprobo;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $puesto_aprobo;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $permiso;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $tipo;

    public function __construct()
    {
    }

    /**
     * Set the value of idc.
     *
     * @param integer $idc
     * @return \CoreBundle\Entity\Caidas
     */
    public function setIdc($idc)
    {
        $this->idc = $idc;

        return $this;
    }

    /**
     * Get the value of idc.
     *
     * @return integer
     */
    public function getIdc()
    {
        return $this->idc;
    }

    /**
     * Set the value of no_estacion.
     *
     * @param string $no_estacion
     * @return \CoreBundle\Entity\Caidas
     */
    public function setNoEstacion($no_estacion)
    {
        $this->no_estacion = $no_estacion;

        return $this;
    }

    /**
     * Get the value of no_estacion.
     *
     * @return string
     */
    public function getNoEstacion()
    {
        return $this->no_estacion;
    }

    /**
     * Set the value of razon_social.
     *
     * @param string $razon_social
     * @return \CoreBundle\Entity\Caidas
     */
    public function setRazonSocial($razon_social)
    {
        $this->razon_social = $razon_social;

        return $this;
    }

    /**
     * Get the value of razon_social.
     *
     * @return string
     */
    public function getRazonSocial()
    {
        return $this->razon_social;
    }

    /**
     * Set the value of direccion.
     *
     * @param string $direccion
     * @return \CoreBundle\Entity\Caidas
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of direccion.
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of alfanum.
     *
     * @param string $alfanum
     * @return \CoreBundle\Entity\Caidas
     */
    public function setAlfanum($alfanum)
    {
        $this->alfanum = $alfanum;

        return $this;
    }

    /**
     * Get the value of alfanum.
     *
     * @return string
     */
    public function getAlfanum()
    {
        return $this->alfanum;
    }

    /**
     * Set the value of fecha_publicacion.
     *
     * @param string $fecha_publicacion
     * @return \CoreBundle\Entity\Caidas
     */
    public function setFechaPublicacion($fecha_publicacion)
    {
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }

    /**
     * Get the value of fecha_publicacion.
     *
     * @return string
     */
    public function getFechaPublicacion()
    {
        return $this->fecha_publicacion;
    }

    /**
     * Set the value of fecha_inicio.
     *
     * @param string $fecha_inicio
     * @return \CoreBundle\Entity\Caidas
     */
    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    /**
     * Get the value of fecha_inicio.
     *
     * @return string
     */
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Set the value of nombre_reviso.
     *
     * @param string $nombre_reviso
     * @return \CoreBundle\Entity\Caidas
     */
    public function setNombreReviso($nombre_reviso)
    {
        $this->nombre_reviso = $nombre_reviso;

        return $this;
    }

    /**
     * Get the value of nombre_reviso.
     *
     * @return string
     */
    public function getNombreReviso()
    {
        return $this->nombre_reviso;
    }

    /**
     * Set the value of puesto_reviso.
     *
     * @param string $puesto_reviso
     * @return \CoreBundle\Entity\Caidas
     */
    public function setPuestoReviso($puesto_reviso)
    {
        $this->puesto_reviso = $puesto_reviso;

        return $this;
    }

    /**
     * Get the value of puesto_reviso.
     *
     * @return string
     */
    public function getPuestoReviso()
    {
        return $this->puesto_reviso;
    }

    /**
     * Set the value of quien_aprobo.
     *
     * @param string $quien_aprobo
     * @return \CoreBundle\Entity\Caidas
     */
    public function setQuienAprobo($quien_aprobo)
    {
        $this->quien_aprobo = $quien_aprobo;

        return $this;
    }

    /**
     * Get the value of quien_aprobo.
     *
     * @return string
     */
    public function getQuienAprobo()
    {
        return $this->quien_aprobo;
    }

    /**
     * Set the value of puesto_aprobo.
     *
     * @param string $puesto_aprobo
     * @return \CoreBundle\Entity\Caidas
     */
    public function setPuestoAprobo($puesto_aprobo)
    {
        $this->puesto_aprobo = $puesto_aprobo;

        return $this;
    }

    /**
     * Get the value of puesto_aprobo.
     *
     * @return string
     */
    public function getPuestoAprobo()
    {
        return $this->puesto_aprobo;
    }

    /**
     * Set the value of permiso.
     *
     * @param string $permiso
     * @return \CoreBundle\Entity\Caidas
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;

        return $this;
    }

    /**
     * Get the value of permiso.
     *
     * @return string
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Set the value of tipo.
     *
     * @param integer $tipo
     * @return \CoreBundle\Entity\Caidas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of tipo.
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    public function __sleep()
    {
        return array('idc', 'no_estacion', 'razon_social', 'direccion', 'alfanum', 'fecha_publicacion', 'fecha_inicio', 'nombre_reviso', 'puesto_reviso', 'quien_aprobo', 'puesto_aprobo', 'permiso', 'tipo');
    }
}