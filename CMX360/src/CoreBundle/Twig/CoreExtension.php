<?php

namespace CoreBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;

class CoreExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'core_extension';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('integral', array($this, 'integralFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('tipoperfil', array($this, 'tipoPerfilFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('estadoporid', array($this, 'estadoporIdFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('estado', array($this, 'estadoFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('municipio', array($this, 'municipioFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('colonia', array($this, 'coloniaFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('codigoPostal', array($this, 'codigoPostalFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('calle', array($this, 'calleFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('estadoFiscal', array($this, 'estadoFiscalFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('municipioFiscal', array($this, 'municipioFiscalFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('coloniaFiscal', array($this, 'coloniaFiscalFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('codigoPostalFiscal', array($this, 'codigoPostalFiscalFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('calleFiscal', array($this, 'calleFiscalFilter'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('estatusSeguimiento', array($this, 'estatusSeguimientoFilter'), array('is_safe' => array('html'))),
        );
    }

    protected $doctrine;
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function integralFilter($value){
        $result='';
        if($value==1){
            $result='Integral';
        }elseif($value==0){
            $result='Individual';
        }
        return $result;
    }

    public function tipoPerfilFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $usuario = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$value));
        $perfil = $em->getRepository('CoreBundle:PersonaPerfiles')->findOneBy(array('usuarios'=>$usuario));
        $result = $perfil->getPerfiles()->getId();
        return $result;
    }

    public function estadoporIdFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $estado = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>0,'clientes'=>$cliente));
        $result = $estado->getMunicipios()->getEstados()->getNombre();
        return $result;
    }

    /*Domicilio Físico*/
    public function estadoFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $estado = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>0,'clientes'=>$cliente));
        $result = $estado->getMunicipios()->getEstados()->getId();
        return $result;
    }

    public function municipioFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $municipio = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>0,'clientes'=>$cliente));
        $result = $municipio->getMunicipios()->getId();
        return $result;
    }

    public function coloniaFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $colonia = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>0,'clientes'=>$cliente));
        if($colonia->getColonias()!=null){
            $result = $colonia->getColonias()->getId();
        }else{
            $result = 0;
        }
        return $result;
    }

    public function codigoPostalFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $codigo = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>0,'clientes'=>$cliente));
        if($codigo->getColonias()!=null){
            $result = $codigo->getColonias()->getCodigoPostal();
        }else{
            $result = 0;
        }
        return $result;
    }

    public function calleFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $calle = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>0,'clientes'=>$cliente));
        $result = $calle->getCalle();
        return $result;
    }

    /*Domicilio Fiscal*/
    public function estadoFiscalFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $estado = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>1,'clientes'=>$cliente));
        if($estado){
            $result = $estado->getMunicipios()->getEstados()->getId();
        }else{
            $result = 0;
        }
        return $result;
    }

    public function municipioFiscalFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $municipio = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>1,'clientes'=>$cliente));
        if($municipio){
            $result = $municipio->getMunicipios()->getId();
        }else{
            $result=0;
        }
        return $result;
    }

    public function coloniaFiscalFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $colonia = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>1,'clientes'=>$cliente));
        if($colonia){
            $result = $colonia->getColonias()->getId();
        }else{
            $result=0;
        }
        return $result;
    }

    public function codigoPostalFiscalFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $codigo = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>1,'clientes'=>$cliente));
        if($codigo){
            $result = $codigo->getColonias()->getCodigoPostal();
        }
        return $result;
    }

    public function calleFiscalFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$value));
        $calle = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>1,'clientes'=>$cliente));
        if($calle){
            $result = $calle->getCalle();
        }
        return $result;
    }

    public function estatusSeguimientoFilter($value){
        $result='';
        $em = $this->doctrine->getManager();
        $pca = $em->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('id'=>$value));
        $pros = $em->getRepository('CoreBundle:Prospeccion')->findOneBy(array('planClienteAsesor'=>$pca));
        if($pros!=null){
            $result = $pros->getEstatusSeguimientoProspeccion()->getNombre();
        }else{
            $result='-----';
        }
        return $result;
    }
}
