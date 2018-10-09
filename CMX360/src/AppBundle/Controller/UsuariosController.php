<?php

namespace AppBundle\Controller;

use CoreBundle\Entity\PersonaPerfiles;
use CoreBundle\Entity\Usuarios;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UsuariosController extends Controller
{
    /**
     * @Route("/registro-usuarios", name="regUsuarios")
     * @Method({"GET", "POST"})
     */
    public function regUsuariosAction(Request $request){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),16);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuarios();
        $form = $this->createForm('CoreBundle\Form\UsuariosType', $usuario);
        $saved = 0;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $i = $request->get('usuariosType')['lista'];
            if(isset($i)){
                $privilegios = explode(".",$i);
                array_pop($privilegios);
            }
            $per = $em->getRepository('CoreBundle:Personales')->findOneBy(array('activo'=>1,'id'=>$request->request->get('usuario')));
            $usuario->setPersonales($per);
            $usuario->setActivo(1);
            $usuario->setFechaAlta(new \DateTime("now"));
            $em->persist($usuario);
            $em->flush();
            if(count($privilegios)>0){
                $perfil = $em->getRepository('CoreBundle:Perfiles')->findOneBy(array('id'=>$request->get('usuariosType')['perfil']));
                foreach ($privilegios as $p):
                    $pri = $em->getRepository('CoreBundle:Privilegios')->findOneBy(array('id'=>$p));
                    $pperf = new PersonaPerfiles();
                    $pperf->setActivo(1);
                    $pperf->setUsuarios($usuario);
                    $pperf->setFechaAlta(new \DateTime("now"));
                    $pperf->setPerfiles($perfil);
                    $pperf->setPrivilegios($pri);
                    $em->persist($pperf);
                    $em->flush();
                endforeach;
                $saved = 1;
            }
        }

        $lista = array();
        $personal = $em->getRepository('CoreBundle:PersonalEmpresas')->findBy(array('activo'=>'1'));
        foreach ($personal as $p):
            if($p->getCargos()->getNombre()=='Asesor'){

            }else{
                array_push($lista,array('id'=>$p->getPersonales()->getId(),'nombre'=>$p->getPersonales()->getNombre(),'ap'=>$p->getPersonales()->getApPaterno(),'am'=>$p->getPersonales()->getApMaterno(),'completo'=>$p->getPersonales()->getNombre().' '.$p->getPersonales()->getApPaterno().' '.$p->getPersonales()->getApMaterno()));
            }
        endforeach;

        $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('activo'=>1));
        $check = array();
        foreach ($pp as $u):
            array_push($check,$u->getUsuarios()->getPersonales()->getId());
        endforeach;
        $usuarios = $em->getRepository('CoreBundle:Usuarios')->findAll();

        return $this->render('@App/Default/usuariosnew.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
            'save' => $saved,
            'lista'=>$lista,
            'pp'=>$pp,
            'usuarios'=>$usuarios,
            'check' => $check,
        ));
    }

    /**
     * @Route("/{id}/editar-usuario", name="editUsuario")
     * @Method({"GET","POST"})
     */
    public function editUsuarioAction(Request $request, Usuarios $usuarios, $id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),16);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('CoreBundle\Form\UsuariosType', $usuarios);
        $editForm->handleRequest($request);

        $usu = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$id));
        $datosP = $em->getRepository('CoreBundle:Privilegios')->findBy(array('activo'=>1));
        $pri = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$usu));
        $sel = array();
        foreach ($pri as $temp):
            array_push($sel, $temp->getPrivilegios()->getId());
        endforeach;

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($usuarios);
            $em->flush();
            $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$usuarios));
            foreach ($pp as $d):
                $em->remove($d);
                $em->flush();
            endforeach;
            $i = $request->get('usuariosType')['lista'];
            if(isset($i)){
                $privilegios = explode(".",$i);
                array_pop($privilegios);
            }
            $perfil = $em->getRepository('CoreBundle:Perfiles')->findOneBy(array('id'=>$request->get('usuariosType')['perfil']));
            foreach ($privilegios as $p):
                $pri = $em->getRepository('CoreBundle:Privilegios')->findOneBy(array('id'=>$p));
                $pperf = new PersonaPerfiles();
                $pperf->setActivo(1);
                $pperf->setUsuarios($usuarios);
                $pperf->setFechaAlta(new \DateTime("now"));
                $pperf->setPerfiles($perfil);
                $pperf->setPrivilegios($pri);
                $em->persist($pperf);
                $em->flush();
            endforeach;

            if($user->getId()==$usuarios->getId()){
                $this->get('security.token_storage')->setToken(null);
                $request->getSession()->invalidate();
                return $this->redirectToRoute('login');
            }else{
                return $this->redirectToRoute('regUsuarios');
            }
        }

        return $this->render('@App/Default/usuariosedit.html.twig',array(
            'edit_form' => $editForm->createView(),
            'usuario'=>$usu,
            'privilegios'=>$datosP,
            'sel'=>$sel,
            'perfil'=>$pri
        ));
    }

    /**
     * @Route("consulta-usuarios", name="consulta-usuarios")
     */
    public function consultaUsuariosAction(Request $request){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),17);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findAll();
        $form = $this->createForm('CoreBundle\Form\BusquedaUsuariosType');
        $form->handleRequest($request);
        $buscar1 = array();
        $buscar2 = array();
        $buscar3 = array();
        $buscar4 = array();
        $final = array();

        $listabuscar = $em->getRepository('CoreBundle:Usuarios')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if($data['nombre']!= ''){
                $nombre = $data['nombre'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('p')
                    ->from('CoreBundle:Personales','p')
                    ->where('p.nombre LIKE :nombre')
                    ->setParameter('nombre', '%'.$nombre.'%')
                    ->getQuery()
                    ->execute();

                foreach ($results as $r):
                    $us = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('personales'=>$r));
                    if(count($us)>0){
                        $check = array_keys(array_column($buscar1, 'id'), $us->getId());
                        if(count($check)>0){

                        }else{
                            array_push($buscar1,$us->getId());
                        }
                    }
                endforeach;
            }else{
                foreach ($listabuscar as $z) {
                    array_push($buscar1,$z->getId());
                }
            }
            if($data['perfil']!= ''){
                $nombre = $data['perfil'];
                $perfil = $em->getRepository('CoreBundle:Perfiles')->findOneBy(array('nombre'=>$nombre));

                $results = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('perfiles'=>$perfil));

                foreach ($results as $r):
                    $check = array_keys(array_column($buscar2, 'id'), $r->getUsuarios()->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar2,$r->getUsuarios()->getId());
                    }
                endforeach;
            }else{
                foreach ($listabuscar as $z) {
                    array_push($buscar2,$z->getId());
                }
            }
            if($data['privilegio']!= ''){
                $nombre = $data['privilegio'];
                $privilegio = $em->getRepository('CoreBundle:Privilegios')->findOneBy(array('nombre'=>$nombre));

                $results = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('privilegios'=>$privilegio));

                foreach ($results as $r):
                    $check = array_keys(array_column($buscar3, 'id'), $r->getUsuarios()->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar3,$r->getUsuarios()->getId());
                    }
                endforeach;
            }else{
                foreach ($listabuscar as $z) {
                    array_push($buscar3,$z->getId());
                }
            }
            if($data['usuario']!= ''){
                $nombre = $data['usuario'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('u')
                    ->from('CoreBundle:Usuarios','u')
                    ->where('u.nombre LIKE :nombre')
                    ->setParameter('nombre', '%'.$nombre.'%')
                    ->getQuery()
                    ->execute();

                foreach ($results as $r):
                    $us = $em->getRepository('CoreBundle:PersonaPerfiles')->findOneBy(array('usuarios'=>$r));
                    if(count($us)>0){
                        $check = array_keys(array_column($buscar4, 'id'), $us->getId());
                        if(count($check)>0){

                        }else{
                            array_push($buscar4,$us->getId());
                        }
                    }
                endforeach;
            }else{
                foreach ($listabuscar as $z) {
                    array_push($buscar4,$z->getId());
                }
            }
            $final = array_intersect($buscar1,$buscar2,$buscar3);
            $final = array_unique($final);
        }
        $full = $em->getRepository('CoreBundle:PersonaPerfiles')->findAll();

        return $this->render('@App/Default/usuariosconsulta.html.twig',array(
            'form' => $form->createView(),
            'final'=>$final,
            'full'=>$full
        ));
    }

    /**
     * @Route("/usuarios/{id}", name="consulta-usuario")
     */
    public function consultaUsuarioAction($id){
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$id));
        $persona = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$usuario));
        return $this->render('@App/Default/usuarioconsulta.html.twig',array(
            'usuario'=>$usuario,
            'persona'=>$persona
        ));
    }
}