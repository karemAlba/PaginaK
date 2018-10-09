<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="dash")
     * @Method({"GET", "POST"})
     */

    public function dashAction(Request $request)
    {
        return $this->render('@App/Default/dashboard.html.twig');
    }

    /**
     * @Route("/Error-404", name="error")
     */

    public function ErrorAction(){
        return $this->render('@App/Default/error.html.twig');
    }

    public function permisos($id,$menu){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$id));
        $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$user));
        $permiso = array();
        foreach ($pp as $p):
            $priv = $em->getRepository('CoreBundle:Privilegios')->findOneBy(array('id'=>$p->getPrivilegios()->getId()));
            $perf = $em->getRepository('CoreBundle:Perfiles')->findOneBy(array('id'=>$p->getPerfiles()->getId()));
            $accesos = $em->getRepository('CoreBundle:Accesos')->findBy(array('privilegios'=>$priv,'perfiles'=>$perf));
            foreach ($accesos as $a):
                if(in_array($a->getMenus()->getId(),$permiso)){

                }else{
                    array_push($permiso,$a->getMenus()->getId());
                }
            endforeach;
        endforeach;
        if(!in_array($menu,$permiso)){
            return 0;
        }else{
            return 1;
        }
    }
}
