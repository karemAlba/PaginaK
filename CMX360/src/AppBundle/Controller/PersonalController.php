<?php

namespace AppBundle\Controller;

use CoreBundle\Entity\PersonalEmpresas;
use CoreBundle\Entity\Personales;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonalController extends Controller
{
    /**
     * @Route("/registro-personal", name="regPersonal")
     * @Method({"GET","POST"})
     */
    public function regPersonalAction(Request $request){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),1);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $persona = new Personales();
        $form = $this->createForm('CoreBundle\Form\PersonalesType', $persona);
        $form->handleRequest($request);
        $saved = 0;

        $cargo = $query->getRepository('CoreBundle:Cargos')->findOneBy(array('activo'=>1,'id'=>$request->request->get('cargo',1)));
        $listaD = $query->getRepository('CoreBundle:Departamentos')->findBy(array('activo'=>1));
        $listaC = $query->getRepository('CoreBundle:Cargos')->findBy(array('activo'=>1,'departamentos'=>$cargo->getDepartamentos()));

        if ($form->isSubmitted() && $form->isValid()) {
            $rep = $this->getDoctrine()->getManager();
            $curp = $query->getRepository('CoreBundle:Personales')->findOneBy(array('curp'=>$persona->getCurp()));
            $rfc = $query->getRepository('CoreBundle:Personales')->findOneBy(array('rfc'=>$persona->getRfc()));
            $email = $query->getRepository('CoreBundle:Personales')->findOneBy(array('correo'=>$persona->getCorreo()));
            $noi = $query->getRepository('CoreBundle:Personales')->findOneBy(array('noi'=>$persona->getNoi()));

            if(count($curp) || count($rfc) || count($email) || count($noi)){
                if(count($curp)>0){
                    $form->get('curp')->addError(new FormError('CURP duplicada'));
                }
                if(count($rfc)>0){
                    $form->get('rfc')->addError(new FormError('RFC duplicado.'));
                }
                if(count($email)>0){
                    $form->get('correo')->addError(new FormError('Email duplicado.'));
                }
                if(count($noi)>0){
                    $form->get('noi')->addError(new FormError('NOI duplicado.'));
                }
                $lista = $query->getRepository('CoreBundle:Personales')->findAll();
                $per_emp = $query->getRepository('CoreBundle:PersonalEmpresas')->findAll();
                return $this->render('@App/Default/personalnew.html.twig',array(
                    'lista'=>$lista,
                    'match'=>$per_emp,
                    'persona' => $persona,
                    'listaD'=>$listaD,
                    'listaC'=>$listaC,
                    'departamento'=>$cargo->getDepartamentos()->getId(),
                    'cargo'=>$cargo->getId(),
                    'form' => $form->createView(),
                    'save'=> $saved
                ));
            }
            $persona->setActivo(1);
            $rep->persist($persona);
            $rep->flush();

            $pe = new PersonalEmpresas();
            $pe->setActivo(1);
            $pe->setCargos($cargo);
            $pe->setPersonales($persona);
            $rep->persist($pe);
            $rep->flush();
            $saved = 1;
        }

        $lista = $query->getRepository('CoreBundle:Personales')->findAll();
        $per_emp = $query->getRepository('CoreBundle:PersonalEmpresas')->findAll();

        return $this->render('@App/Default/personalnew.html.twig',array(
            'lista'=>$lista,
            'match'=>$per_emp,
            'persona' => $persona,
            'listaD'=>$listaD,
            'listaC'=>$listaC,
            'departamento'=>$cargo->getDepartamentos()->getId(),
            'cargo'=>$cargo->getId(),
            'form' => $form->createView(),
            'save' => $saved
        ));
    }

    /**
     * @Route("/{id}/editar-personal", name="editPersonal")
     * @Method({"GET", "POST"})
     */
    public function editPersonalAction(Request $request, Personales $personales,$id)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),1);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('CoreBundle\Form\PersonalesType', $personales);
        $tmp = $personales->getRutaFotografia();
        $editForm->handleRequest($request);
        $p = $em->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$id));
        $pe = $em->getRepository('CoreBundle:PersonalEmpresas')->findOneBy(array('personales'=>$p));
        $cargo = $em->getRepository('CoreBundle:Cargos')->findOneBy(array('activo'=>1,'id'=>$request->request->get('cargo',1)));
        $saved = 0;

        $listaD = $em->getRepository('CoreBundle:Departamentos')->findBy(array('activo'=>1));
        $listaC = $em->getRepository('CoreBundle:Cargos')->findBy(array('activo'=>1,'departamentos'=>$pe->getCargos()->getDepartamentos()));

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($personales->getRutaFotografia()){
                $file = $personales->getRutaFotografia();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('fotos_directory'),$fileName);
                $personales->setRutaFotografia($fileName);
            }else{
                $personales->setRutaFotografia($tmp);
            }
            $curp = $em->getRepository('CoreBundle:Personales')->findOneBy(array('curp'=>$personales->getCurp()));
            $rfc = $em->getRepository('CoreBundle:Personales')->findOneBy(array('rfc'=>$personales->getRfc()));
            $email = $em->getRepository('CoreBundle:Personales')->findOneBy(array('correo'=>$personales->getCorreo()));
            $noi = $em->getRepository('CoreBundle:Personales')->findOneBy(array('noi'=>$personales->getNoi()));
            if($curp->getId()!= $personales->getId()){
                if(count($curp)>0 || count($rfc) || count($email) || count($noi)){
                    if(count($curp)>0){
                        $editForm->get('curp')->addError(new FormError('CURP duplicada.'));
                    }
                    if(count($rfc)>0){
                        $editForm->get('rfc')->addError(new FormError('RFC duplicado.'));
                    }
                    if(count($email)>0){
                        $editForm->get('correo')->addError(new FormError('Email duplicado.'));
                    }
                    if(count($noi)>0){
                        $editForm->get('noi')->addError(new FormError('NOI duplicado.'));
                    }
                    return $this->render('@App/Default/personaledit.html.twig', array(
                        'personales' => $personales,
                        'listaD'=>$listaD,
                        'listaC'=>$listaC,
                        'departamento'=>$pe->getCargos()->getDepartamentos()->getId(),
                        'cargo'=>$pe->getCargos()->getId(),
                        'edit_form' => $editForm->createView(),
                        'save'=>$saved
                    ));
                }
            }

            $em->persist($personales);
            $em->flush();
            $pe->setCargos($cargo);
            $em->persist($pe);
            $em->flush();
            return $this->redirectToRoute('regPersonal');
        }

        return $this->render('@App/Default/personaledit.html.twig', array(
            'personales' => $personales,
            'listaD'=>$listaD,
            'listaC'=>$listaC,
            'departamento'=>$pe->getCargos()->getDepartamentos()->getId(),
            'cargo'=>$pe->getCargos()->getId(),
            'edit_form' => $editForm->createView(),
            'save'=>$saved
        ));
    }

    /**
     * @Route("/departamentos-json", name="departamentos-json")
     */
    public function jsonDAction(Request $request)
    {
        $id = $request->request->get('departamento');
        $em = $this->getDoctrine()->getManager();
        $departamento = $em->getRepository('CoreBundle:Departamentos')->findOneBy(array('id' => $id));
        $car = $em->getRepository('CoreBundle:Cargos')->findBy(array('departamentos' => $departamento, 'activo' => 1));
        $cars = array();
        foreach ($car as $c):
            array_push($cars, array('id' => $c->getId(), 'cargo' => $c->getNombre()));
        endforeach;

        return new Response(
            json_encode($cars),
            200,
            array('Content-Type' => 'application/json')
        );
    }
}
