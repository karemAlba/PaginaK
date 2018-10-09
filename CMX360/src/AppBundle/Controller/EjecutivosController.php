<?php

namespace AppBundle\Controller;

use CoreBundle\Entity\EjecutivoCentroservicios;
use CoreBundle\Entity\PersonaPerfiles;
use CoreBundle\Entity\Usuarios;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EjecutivosController extends Controller
{
    /**
     * @Route("/registro-asesores", name="regEjecutivos")
     * @Method({"GET", "POST"})
     */

    public function regEjecutivoAction(Request $request)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),6);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $query = $this->getDoctrine()->getManager();
        $usuario = new Usuarios();
        $form = $this->createForm('CoreBundle\Form\EjecutivosType', $usuario);
        $cargos = $query->getRepository('CoreBundle:Cargos')->findBy(array('activo'=>1,'nombre'=>'asesor'));
        $eje = array();
        $check = array();
        $usuarios = $query->getRepository('CoreBundle:Usuarios')->findAll();

        foreach ($cargos as $x):
            $empresas = $query->getRepository('CoreBundle:PersonalEmpresas')->findBy(array('activo'=>1, 'cargos'=>$x));
            foreach ($usuarios as $u):
                array_push($check,$u->getPersonales()->getId());
            endforeach;
            if(count($usuarios)>0){
                    if (count($empresas)>0){
                        foreach ($empresas as $e):
                            if(in_array($e->getPersonales()->getId(),$check)) {

                            }else{
                                if($e->getPersonales()->getActivo()==1){
                                    array_push($eje,array('id'=>$e->getPersonales()->getId(),'nombre'=>$e->getPersonales()->getNombre(),'apellido'=>$e->getPersonales()->getApPaterno(),'nombrec'=>$e->getPersonales()->getNombre()." ".$e->getPersonales()->getApPaterno()." ".$e->getPersonales()->getApMaterno()));
                                }
                            }
                        endforeach;
                    }
            }else{
                foreach ($empresas as $u):
                    if($u->getPersonales()->getActivo()==1){
                        array_push($eje,array('id'=>$u->getPersonales()->getId(),'nombre'=>$u->getPersonales()->getNombre(),'apellido'=>$u->getPersonales()->getApPaterno(),'nombrec'=>$u->getPersonales()->getNombre()." ".$u->getPersonales()->getApPaterno()." ".$u->getPersonales()->getApMaterno()));
                    }
                endforeach;
            }
        endforeach;

        $form->handleRequest($request);
        $saved = 0;
        if ($form->isSubmitted() && $form->isValid()) {
            $rev = $query->getRepository('CoreBundle:Usuarios')->findOneBy(array('nombre'=>$usuario->getNombre()));
            if(!$rev){
                //$pe = new Usuarios();
                //$pe->setActivo(1);
                $rep = $this->getDoctrine()->getManager();
                $per = $query->getRepository('CoreBundle:Personales')->findOneBy(array('activo'=>1,'id'=>$request->request->get('ejecutivo')));
                $usuario->setPersonales($per);
                $usuario->setActivo(1);
                $rep->persist($usuario);
                $rep->flush();
                $pe = new PersonaPerfiles();
                $pe->setActivo(1);
                $pe->setFechaAlta(new \DateTime("now"));
                $pe->setUsuarios($usuario);
                $pf = $query->getRepository('CoreBundle:Perfiles')->findOneBy(array('nombre'=>'asesor'));
                $pv = $query->getRepository('CoreBundle:Privilegios')->findOneBy(array('nombre'=>'relaciones comerciales'));
                $pe->setPerfiles($pf);
                $pe->setPrivilegios($pv);
                $rep->persist($pe);
                $rep->flush();
                if(count($x)>0){
                    $saved = 1;
                    $cargos = $query->getRepository('CoreBundle:Cargos')->findBy(array('activo'=>1,'nombre'=>'asesor'));
                    $eje = array();
                    $check = array();
                    $usuarios = $query->getRepository('CoreBundle:Usuarios')->findBy(array('activo'=>1));
                    foreach ($cargos as $x):
                        $empresas = $query->getRepository('CoreBundle:PersonalEmpresas')->findBy(array('activo'=>1, 'cargos'=>$x));
                        foreach ($usuarios as $u):
                            array_push($check,$u->getPersonales()->getId());
                        endforeach;

                        if(count($usuarios)>0){
                            if (count($empresas)>0){
                                foreach ($empresas as $e):
                                    if(in_array($e->getPersonales()->getId(),$check)) {

                                    }else{
                                        array_push($eje,array('id'=>$e->getPersonales()->getId(),'nombre'=>$e->getPersonales()->getNombre(),'apellido'=>$e->getPersonales()->getApPaterno(),'nombrec'=>$e->getPersonales()->getNombre()." ".$e->getPersonales()->getApPaterno()." ".$e->getPersonales()->getApMaterno()));
                                    }
                                endforeach;
                            }
                        }else{
                            foreach ($empresas as $u):
                                array_push($eje,array('id'=>$u->getPersonales()->getId(),'nombre'=>$u->getPersonales()->getNombre(),'apellido'=>$u->getPersonales()->getApPaterno(),'nombrec'=>$u->getPersonales()->getNombre()." ".$u->getPersonales()->getApPaterno()." ".$u->getPersonales()->getApMaterno()));
                            endforeach;
                        }
                    endforeach;
                }else{

                    $usu = $query->getRepository('CoreBundle:Usuarios')->findAll();

                    return $this->render('@App/Default/ejecutivos.html.twig',array(
                        'id'=>$request->request->get('ejecutivo'),
                        'usu'=>$usu,
                        'ejecutivos'=>$eje,
                        'usuario' => $usuario,
                        'form' => $form->createView(),
                        'save' => $saved
                    ));
                }
            }else{
                $saved=1;
            }
        }

        $pp = $query->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('activo'=>1));
        $usu = $query->getRepository('CoreBundle:Usuarios')->findAll();
        $white = array();
        foreach ($pp as $u):
            if($u->getPerfiles()->getNombre()=='Asesor'){
                array_push($white,$u->getUsuarios()->getId());
            }
        endforeach;

        return $this->render('@App/Default/ejecutivos.html.twig',array(
            'usu'=>$usu,
            'white'=>$white,
            'ejecutivos'=>$eje,
            'usuario' => $usuario,
            'form' => $form->createView(),
            'save' => $saved
        ));
    }

    /**
     * @Route("/{id}/editar-asesor", name="editEjecutivo")
     * @Method({"GET", "POST"})
     */
    public function editEjecutivoAction(Request $request, Usuarios $ejecutivos, $id)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),6);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('CoreBundle\Form\EjecutivosType', $ejecutivos);
        $editForm->handleRequest($request);

        $usu = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$id));
        $ejec = $em->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$usu->getPersonales()->getId()));
        $ecs = array();

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ejecutivos);
            $em->flush();
            $id = $usu->getId();
            $ins = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$id));
            return $this->redirectToRoute('regEjecutivos');

        }


        return $this->render('@App/Default/ejecutivosedit.html.twig', array(
            'ejec' => $ejec,
            'usuario' => $ecs,
            'ejecutivos' => $ejecutivos,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * @Route("/genPassword",name="genPassword")
     */
    public function genAction(){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return new Response(
            json_encode(substr(str_shuffle($chars),0,9)),
            200,
            array('Content-Type' => 'application/json')
        );
    }
}
