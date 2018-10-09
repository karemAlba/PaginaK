<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function menuAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$user,'activo'=>1));
        $permiso = array();
        foreach ($pp as $p):
            $priv = $em->getRepository('CoreBundle:Privilegios')->findOneBy(array('id'=>$p->getPrivilegios()->getId(),'activo'=>1));
            $perf = $em->getRepository('CoreBundle:Perfiles')->findOneBy(array('id'=>$p->getPerfiles()->getId(),'activo'=>1));
            $accesos = $em->getRepository('CoreBundle:Accesos')->findBy(array('privilegios'=>$priv,'perfiles'=>$perf,'activo'=>1));
            foreach ($accesos as $a):
                if(in_array($a->getMenus()->getId(),$permiso)){

                }else{
                    array_push($permiso,$a->getMenus()->getId());
                }
            endforeach;
        endforeach;
        return $this->render('@App/partials/menu.html.twig',array(
            'permiso'=>$permiso
        ));
    }
}
