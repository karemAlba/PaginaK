<?php

namespace AppBundle\Controller;

use CoreBundle\Entity\PlanProspeccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TemporalController extends Controller
{
    /**
     * @Route("/consulta-plan-prospeccion", name="consultaPlan")
     * @Method({"GET", "POST"})
     */

    public function consultaPlanAction(Request $request)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),11);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $plan =  $query->getRepository('CoreBundle:PlanServicio')->findBy(array('activo'=>1));

        $lista1 = array();
        $lista2 = array();
        $lista3 = array();
        $lista4 = array();
        $lista5 = array();
        $lista6 = array();

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==1){
                array_push($lista1,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==2 || $p->getPlanProspeccion()->getEstatusPlan()->getId()==3){
                array_push($lista2,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==4){
                array_push($lista3,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==7){
                array_push($lista4,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==6){
                array_push($lista5,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==5){
                array_push($lista6,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        $lista1 = array_unique($lista1);
        $lista2 = array_unique($lista2);
        $lista3 = array_unique($lista3);
        $lista4 = array_unique($lista4);
        $lista5 = array_unique($lista5);
        $lista6 = array_unique($lista6);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $privilegios = array();
        $pp = $query->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$user));

        foreach ($pp as $x):
            array_push($privilegios,$x->getPrivilegios()->getId());
        endforeach;

        return $this->render('@App/Default/planconsulta.html.twig',array(
            'privilegios' => $privilegios,
            'plan' => $plan,
            'lista1'=>$lista1,
            'lista2'=>$lista2,
            'lista3'=>$lista3,
            'lista4'=>$lista4,
            'lista5'=>$lista5,
            'lista6'=>$lista6,
        ));
    }

    /**
     * @Route("/consulta-plan-prospeccion/{id}", name="consulta-planprospeccion")
     */
    public function planProspeccionConsultaAction($id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),11);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=> $id));
        if($plan->getIsIntegral()== 1){
            $planS = $em->getRepository('CoreBundle:PlanServicio')->findBy(array('planProspeccion' => $plan));
        }else {
            $planS = $em->getRepository('CoreBundle:PlanServicio')->findOneBy(array('planProspeccion'=> $plan));
        }
        $familia = $em->getRepository('CoreBundle:PlanAsocUniGpo')->findBy(array('planProspeccion'=>$plan));
        $cli = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('planProspeccion'=>$plan));
        $grupos = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1));
        $prop = $em->getRepository('CoreBundle:PropuestasGeneral')->findOneBy(array('planProspeccion'=>$plan));

        return $this->render('@App/Default/planprospeccionconsulta.html.twig', array(
            'plan' => $plan,
            'grupos' => $grupos,
            'planS'=>$planS,
            'prop'=>$prop,
            'familia' => $familia,
            'cli' => $cli
        ));
    }

    /**
     * @Route("/autorizacion", name="autorizacion")
     * @Method({"GET", "POST"})
     */

    public function autorizacionAction(Request $request)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),12);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*Permisos*/

        $query = $this->getDoctrine()->getManager();
        $plan =  $query->getRepository('CoreBundle:PlanServicio')->findBy(array('activo'=>1));

        $lista1 = array();
        $lista2 = array();
        $lista3 = array();

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==2 || $p->getPlanProspeccion()->getEstatusPlan()->getId()==3){
                array_push($lista1,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==4){
                array_push($lista2,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==5){
                array_push($lista3,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        $lista1 = array_unique($lista1);
        $lista2 = array_unique($lista2);
        $lista3 = array_unique($lista3);

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $perfil = $query->getRepository('CoreBundle:Perfiles')->findOneBy(array('id'=>$user));
        $privilegio = $query->getRepository('CoreBundle:Privilegios')->findOneBy(array('id'=>$user));

        $form = $this->createForm('CoreBundle\Form\PlanProspeccionType');
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('consultaPlan' );
        }

        $pp = $query->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('activo'=>1));

        return $this->render('@App/Default/autorizacion.html.twig',array(
            'lista1'=>$lista1,
            'lista2'=>$lista2,
            'lista3'=>$lista3,
            'perfil' => $perfil,
            'privilegio' => $privilegio,
            'plan' => $plan,
            'pp'=>$pp,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/consulta-plan-autorizacion/{id}", name="consulta-autorizacion")
     * @Method({"GET", "POST"})
     */
    public function autorizacionConsultaAction(Request $request,$id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),12);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $plan = $query->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=> $id));
        $familia = $query->getRepository('CoreBundle:PlanAsocUniGpo')->findOneBy(array('planProspeccion'=>$plan));
        $cli = $query->getRepository('CoreBundle:PlanClientes')->findBy(array('planProspeccion'=>$plan));
        $domicilio = $query->getRepository('CoreBundle:DomicilioClientes')->findBy(array('isFiscal'=>0));
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $perfil = $query->getRepository('CoreBundle:PersonaPerfiles')->findOneBy(array('usuarios'=>$user));

        /*print_r($perfil->getPrivilegios()->getId());
        exit;*/

        $estados = array();

        foreach ($domicilio as $d):
            foreach ($cli as $c):
                if ($d->getClientes() == $c->getClientes()){
                    array_push($estados, $d->getMunicipios()->getEstados()->getNombre());
                }
            endforeach;
        endforeach;

        $estados = array_unique($estados);
//        $listaestados = $query->getRepository('CoreBundle:Estados')->findAll();



        if($plan->getIsIntegral()== 1){
            $planS = $query->getRepository('CoreBundle:PlanServicio')->findBy(array('planProspeccion' => $plan));
        }else {
            $planS = $query->getRepository('CoreBundle:PlanServicio')->findOneBy(array('planProspeccion'=> $plan));
        }

        return $this->render('@App/Default/autorizacionconsulta.html.twig',array(
            'perfil' => $perfil,
            'estados' => $estados,
//          'listaestados' => $listaestados,
            'plan' => $plan,
            'planS'=> $planS,
            'familia' => $familia,
            'cli' => $cli,
        ));
    }

    /**
     * @Route("/enviar-plan", name="enviarv")
     */
    public function enviarvAction(Request $request)
    {
        $id = $request->request->get('id');
        $es = $request->request->get('estatus');

        $em = $this->getDoctrine()->getManager();
        $observaciones = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id' => $id));
        $estatus = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id' => $es));

        $observaciones->setEstatusPlan($estatus);

        $em->persist($observaciones);
        $em->flush();

        return new Response(
            json_encode(1),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/modifica-plan", name="modifica")
     */
    public function modificaAction(Request $request)
    {
        $id = $request->request->get('id');
        $observacion = $request->request->get('observacion');
        $es = $request->request->get('estatus');

        $em = $this->getDoctrine()->getManager();
        $observaciones = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id' => $id));
        $estatus = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id' => $es));

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $perfiles = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$user));

        $ban = false;
        foreach ($perfiles as $perfil):
            if ($perfil->getPerfiles()->getId() == 3 && $ban==false){
                if($perfil->getPrivilegios()->getId() == 4){
                    $observaciones->setObservacionesDO($observacion);
                }elseif($perfil->getPrivilegios()->getId() == 3){
                    $observaciones->setObservacionesDG($observacion);
                }
                $observaciones->setEstatusPlan($estatus);
                $em->persist($observaciones);
                $em->flush();
                $ban = true;
            }
        endforeach;

        $observaciones->setEstatusPlan($estatus);
        $em->persist($observaciones);
        $em->flush();

        return new Response(
            json_encode(1),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/autoriza-plan", name="autorizap")
     */
    public function autorizaAction(Request $request)
    {
        $id = $request->request->get('id');
        $observacion = $request->request->get('observacion');
        $es = $request->request->get('estatus');

        $em = $this->getDoctrine()->getManager();
        $observaciones = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id' => $id));

        $estatus = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id' => $es));

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $perfiles = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$user));

        $ban = false;
        foreach ($perfiles as $perfil):
            if ($perfil->getPerfiles()->getId() == 3 && $ban==false){
                if($perfil->getPrivilegios()->getId() == 4){
                    $observaciones->setObservacionesDO($observacion);
                    $observaciones->setFechaAutorizacionDO(new \DateTime("now"));
                    $observaciones->setIdusuarioAutoriza($user->getId());
                }elseif($perfil->getPrivilegios()->getId() == 3){
                    $observaciones->setObservacionesDG($observacion);
                    $observaciones->setFechaAutorizacionDG(new \DateTime("now"));
                    $observaciones->setIdusuarioAutoriza($user->getId());
                }
                $observaciones->setEstatusPlan($estatus);
                $em->persist($observaciones);
                $em->flush();
                $ban = true;
            }
        endforeach;

        return new Response(
            json_encode(1),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/enviar-direccion", name="enviardg")
     */
    public function enviarDgAction(Request $request)
    {
        $id = $request->request->get('id');
        $ob = $request->request->get('observacion');

        $em = $this->getDoctrine()->getManager();
        $observaciones = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id' => $id));
        $estatus = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id' => 3));

        $observaciones->setObservacionesDO($ob);
        $observaciones->setEstatusPlan($estatus);

        $em->persist($observaciones);
        $em->flush();



        return new Response(
            json_encode(1),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/clientes-autorizacion/{id}", name="clientesa")
     */
    public function autorizacionClientesConsultaAction($id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),12);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=> $id));
        //$estados = $em->getRepository('CoreBundle:PlanProspeccion')->findBy(array())
        if($plan->getIsIntegral()== 1){
            $planS = $em->getRepository('CoreBundle:PlanServicio')->findBy(array('planProspeccion' => $plan));
        }else {
            $planS = $em->getRepository('CoreBundle:PlanServicio')->findOneBy(array('planProspeccion'=> $plan));
        }

        $familia = $em->getRepository('CoreBundle:PlanAsocUniGpo')->findBy(array('planProspeccion'=>$plan));
        $cli = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('planProspeccion'=>$plan));
        $grupos = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1));

        return $this->render('@App/Default/clientesautorizacion.html.twig', array(
            'plan' => $plan,
            'planS'=>$planS,
            'familia' => $familia,
            'cli' => $cli,
            'grupos' => $grupos
        ));
    }


    /**
     * @Route("/servicios-autorizacion/{id}", name="serviciosa")
     */
    public function serviciosAutorizacionConsultaAction($id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),12);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=> $id));

        if($plan->getIsIntegral()== 1){
            $planS = $em->getRepository('CoreBundle:PlanServicio')->findBy(array('planProspeccion' => $plan->getId()));
        }else {
            $planS = $em->getRepository('CoreBundle:PlanServicio')->findOneBy(array('planProspeccion'=> $plan));
        }
        $precios = array();

        foreach ($planS as $p) :
            $precio = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$p->getSubservicio()));
            array_push($precios, array('id'=>$p->getSubservicio()->getId(), 'costo'=>$precio->getCosto()));
        endforeach;

        return $this->render('@App/Default/serviciosautorizacion.html.twig', array(
            'planS'=>$planS,
            'plan'=>$plan,
            'precios'=> $precios
        ));
    }

}
