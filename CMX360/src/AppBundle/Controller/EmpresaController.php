<?php

namespace AppBundle\Controller;


use CoreBundle\Entity\Departamentos;
use CoreBundle\Entity\DepartamentoServicios;
use CoreBundle\Entity\Empresa;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmpresaController extends Controller
{
    /**
     * @Route("/empresas", name="empresas.index")
     */
    public function indexAction()
    {
        $db = $this->getDoctrine()->getManager();
        $empresas =  $db->getRepository('CoreBundle:Empresa')->findAll();
        return $this->render('@App/Default/empresas.index.html.twig', array(
            'empresas'=> $empresas
        ));
    }

    /**
     * @Route("/empresas/create", name="empresas.create")
     * @Method({"GET","POST"})
     */
    public function createAction(Request $request)
    {
        $db = $this->getDoctrine()->getManager();
        $empresa = new Empresa();
        $form = $this->createForm('CoreBundle\Form\EmpresaType', $empresa);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $db->persist($empresa);
            $db->flush();
            return $this->redirect($this->generateUrl('empresas.index'));
        }
        return $this->render('@App/Default/empresas.create.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/empresas/{id}/edit", name="empresas.edit")
     * @Method({"GET","POST"})
     */
    public function editAction(Request $request, $id)
    {
        $db = $this->getDoctrine()->getManager();
        $empresa = $db->getRepository('CoreBundle:Empresa')->findOneBy(['id'=>$id]);
        $form = $this->createForm('CoreBundle\Form\EmpresaType',$empresa);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $db->persist($empresa);
            $db->flush();
            return $this->redirect($this->generateUrl('empresas.index'));
        }
        return $this->render('@App/Default/empresas.edit.html.twig',[
            'form'=>$form->createView(),
            'empresa'=> $empresa
        ]);
    }


}
