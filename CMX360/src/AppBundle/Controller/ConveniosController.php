<?php

namespace AppBundle\Controller;

use CoreBundle\Entity\Convenios;
use CoreBundle\Entity\ConvenioSubservicios;
use CoreBundle\Entity\Empresa;
use CoreBundle\Entity\Servicio;
use CoreBundle\Entity\Subservicio;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ConveniosController extends Controller
{
    /**
     * @Route("/registro-convenios", name="convenios.index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getRepository(Convenios::class);
        $convenios = $manager->findAll();
        return $this->render('@App/Default/convenios.index.html.twig', array(
            'convenios'=> $convenios
        ));

    }

    /**
     * @Route("/convenios/create", name="convenios.create")
     * @Method({"GET"})
     */
    public function createAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $subservicios = $manager->getRepository('CoreBundle:Subservicio')->findAll();
        $empresas = $manager->getRepository('CoreBundle:Empresa')->findAll();

        $convenio = new Convenios();
        $form = $this->createForm('CoreBundle\Form\ConveniosType',$convenio);
        return $this->render('@App/Default/convenios.create.html.twig',[
            'form'=>$form->createView(),
            'subservicios'=>$subservicios,
            'empresas'=>$empresas
        ]);
    }

    /**
     * @Route("/convenios/store", name="convenios.store")
     * @Method({"GET","POST"})
     */
    public function storeAction(Request $request)
    {
//                $this->printTest($request);
        $em = $this->getDoctrine()->getManager();
        //determino el costo minimo
        if($request->request->get('costo_autorizado') > $request->request->get('costo_propuesto')){
            $costo_minimo = $request->request->get('costo_propuesto');
        }else{
            $costo_minimo = $request->request->get('costo_autorizado');
        }
        //seteo el convenio
        $convenio = new Convenios();
        $convenio->setNombre($request->request->get('nombre'));
        $convenio->setCostoAutorizacion($costo_minimo);
        $convenio->setDescuentos($request->request->get('descuento'));
        $convenio->setActivo(1);
        $convenio->setFechaAlta(new \DateTime('now'));
        $convenio->setCondicionesComerciales($request->request->get('condiciones_comerciales'));
        //almaceno el convenio
        $em->persist($convenio);
        $em->flush();
        //recorrido de subservicios

        foreach ($request->request->get('subservicios') as $idsubservicio) {
            $subservicio_stored  = $em->getRepository(Subservicio::class)->findOneBy(['id'=>$idsubservicio]);
            //creamos la relacion
            $convenio_subservicio = new ConvenioSubservicios();
            $convenio_subservicio->setActivo(1);
            $convenio_subservicio->setConvenios($convenio);
            $convenio_subservicio->setSubservicio($subservicio_stored);
            $em->persist($convenio_subservicio);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('convenios.index'));

    }

    /**
     * @Route("/convenios/{id}/edit", name="convenios.edit")
     */
    public function editAction(Convenios $convenio)
    {
        $form = $this->createForm('CoreBundle\Form\ConveniosType',$convenio);
        return $this->render('AppBundle:Default:convenios.edit.html.twig', array(
           'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/convenios/{id}/update", name="convenios.update")
     * @Method({"PUT"})
     */
    public function updateAction()
    {

    }

    /**
     * @Route("/convenios/{id}/delete", name="convenios.delete")
     * @Method({"PUT"})
     */
    public function deleteAction()
    {

    }

    /**
     * @Route("/convenios/empresas",name="convenios.empresas")
     * @Method({"POST"})
     */
    public function getEmpresasAction()
    {
        $manager = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Empresa');
        $companies_collection  = $manager->findAll();
        $companies = array();
        foreach ($companies_collection as $company) {
            array_push($companies,['id'=>$company->getId(),'name'=>$company->getNombre()]);
        }
        return $this->json($companies);
    }

    /**
     * @Route("/convenios/empresas/departamentos/",name="convenios.departamentos")
     * @Method({"POST"})
     */
    public function getDepartmentsByIdEmpresaAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager()->getRepository('CoreBundle:DepartamentoServicios');
        $departamentos  = $manager->findBy(['empresa'=>$request->request->get('idempresa')]);
        $array_de_departamentos = array();
        foreach ($departamentos as $departamento) {
            array_push($array_de_departamentos,['id'=>$departamento->getId(),'name'=>$departamento->getNombre()]);
        }
        return $this->json($array_de_departamentos);
    }

    /**
     * @Route("/convenios/departamentos/servicios/", name="convenios.departamentos.servicios")
     * @Method({"POST"})
     */
    public function getDepartmentServicesByIdDepartmentAction(Request $request)
    {
        $idDepartment = $request->request->get('iddepartamento');
        $manager = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Servicio');
        $servicios  = $manager->findBy(array('departamentoServicios' => $idDepartment, 'activo' => 1));
        $array_de_servicios = array();
        foreach ($servicios as $servicio) {
            array_push($array_de_servicios,['id'=>$servicio->getId(),'name'=>$servicio->getNombre()]);
        }
        return $this->json($array_de_servicios);
    }

    /**
     * @Route("/convenios/departamentos/servicios/subservicios", name="convenios.departamentos.servicios.subservicios")
     * @Method({"POST"})
     */
    public function getSubserviceAction(Request $request)
    {
        $idservicio = $request->request->get('idservicio');
       $em = $this->getDoctrine()->getManager();
       $query = "SELECT ss.id, ss.nombre as name , ssp.costo 
            FROM subservicio as ss  
            INNER JOIN subservicioprecio as ssp on ss.id = ssp.idSubservicio 
            WHERE ss.activo = 1
            AND idServicio = '$idservicio'";
       $statement = $em->getConnection()->prepare($query);
       $statement ->execute();
       $result = $statement->fetchAll();
       return $this->json($result);

    }


    /**
     * @Route("/convenios/validar/nombre/", name="convenios.validar.nombre")
     * @Method({"GET","POST"})
     *
     */
    public function validateCompanyNameAction(Request $request)
    {
        $name = $request->request->get('name');
        $convenio = $this->getDoctrine()
            ->getManager()
            ->getRepository(Convenios::class)
            ->findOneBy(['nombre'=>$name]);
        if( $convenio == NULL ){
            return $this->json('false');
        }else{
            return $this->json('true');
        }
    }

    public function printTest($request)
    {
        print_r($request->request->all());
        die();
    }



}
