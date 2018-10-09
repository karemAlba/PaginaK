<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProsController extends Controller
{

    /**
     * @Route("/consulta-prospeccion", name="consulta-previa-prospeccion")
     */
    public function checkProspeccionAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $asesor = $em->getRepository('CoreBundle:Perfiles')->findOneBy(array('id'=>6));
        $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$user,'perfiles'=>$asesor));
        if($pp){
            return $this->redirect($this->generateUrl('prospeccionConsulta',array('id'=>$user->getId())));
        }else{
            return $this->redirect($this->generateUrl('prosConsG'));
        }
    }

    /**
     * @Route("/prospeccion-consulta-asesores", name="prosConsG")
     */
    public function prosGAction(Request $request)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(), 15);
        if ($foo == 0) {
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $asesor = $query->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('activo'=>1));

        $clientes = array();
        $totales = array();
        $asesores = array();
        $listaasesores = array();
        $ids = array();
        $ventas = array();

        foreach ($asesor as $v):
            array_push($asesores,$v->getPersonales()->getId());
        endforeach;
        $asesores = array_unique($asesores);
        foreach ($asesores as $a):
            $as = $query->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$a));
            array_push($listaasesores,$as->getNombre().' '.$as->getApPaterno());
            array_push($ids,$as->getId());
            $pca = $query->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('activo'=>1,'personales'=>$as));
            $temp = floatval(0);
            $no = 0;
            foreach ($pca as $c):
                $pros = $query->getRepository('CoreBundle:Prospeccion')->findOneBy(array('planClienteAsesor'=>$c,'activo'=>1));
                if($pros){
                    if($pros->getEstatusSeguimientoProspeccion()->getId()==12){
                        $temp= $temp + floatval($pros->getCostoTotal());
                    }
                    $no = $no + 1;
                }
            endforeach;
            array_push($totales,$temp);
            array_push($clientes,count($pca));
            array_push($ventas,$no);
        endforeach;

        return $this->render('@App/Default/prospeccionconsultag.html.twig', array(
            'lista'=>$listaasesores,
            'ids'=>$ids,
            'totales'=>$totales,
            'clientes'=>$clientes,
            'ventas'=>$ventas
        ));
    }

    /**
     * @Route("/prospeccion-consulta/{id}", name="prospeccionConsulta")
     */
    public function prosAction(Request $request,$id)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),15);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $persona = $query->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$id,'activo'=>1));
        $plan = $query->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('personales'=>$persona));
        $x = 0;
        $unicos = array();
        $pcaUnicos = array();
        foreach ($plan as $p):
            /*Planes Únicos*/
            array_push($unicos,$p->getPlanClientes()->getPlanProspeccion()->getId());
            array_push($pcaUnicos,$p->getId());
        endforeach;
        $unicos = array_unique($unicos);
        $lista = array();

        foreach ($unicos as $u):
            $no = 0;
            $con = 0;
            $t = '';
            $n = '';
            foreach ($pcaUnicos as $pca):
                $pcaR = $query->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('id'=>$pca));
                $pros = $query->getRepository('CoreBundle:Prospeccion')->findOneBy(array('planClienteAsesor'=>$pcaR));
                if($pcaR->getPlanClientes()->getPlanProspeccion()->getId()==$u){
                    $no = $no +1;
                    $t = $pcaR->getPlanClientes()->getPlanProspeccion()->getIsIntegral();
                    $n = $pcaR->getPlanClientes()->getPlanProspeccion()->getNombre();
                    if($pros){
                        if($pros->getEstatusSeguimientoProspeccion()->getId()==1 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==5 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==11 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==12 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==13 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==15 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==16 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==17 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==19 ||
                            $pros->getEstatusSeguimientoProspeccion()->getId()==21){
                            $con=$con+1;
                        }
                    }
                }
            endforeach;
            array_push($lista,array('id'=>$u,'nombre'=>$n,'noClientes'=>$no,'contactado'=>$con,'tipo'=>$t));
        endforeach;

        return $this->render('@App/Default/prospeccionconsulta.html.twig', array(
            'plan'=>$plan,
            'unicos'=>$unicos,
            'lista'=>$lista,
        ));
    }

    /**
     * @Route("/consultas-de-prospecciones/{id}/", name="consulta-prospeccion")
     */
    public function consultaProspeccionAction(Request $request, $id)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),15);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $pc = array();
        $plan = $query->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=> $id));
        $persona = $query->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$user->getPersonales()->getId()));
        $cli = $query->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('personales'=>$persona));

        foreach ($cli as $c):
            if($c->getPlanClientes()->getPlanProspeccion()->getId()==$plan->getId()){
                array_push($pc,$c->getPlanClientes()->getId());
            }
        endforeach;

        /*print_r($pc);
        exit;*/

        return $this->render('@App/Default/vistaprospecciones.html.twig', array(
            'cli'=>$cli,
            'lista'=>$pc
        ));

    }

    /**
     * @Route("/consultas-de-prospecciones/{asesor}/{plan}", name="consulta-prospecciond")
     */
    public function consultaProspeccionDAction(Request $request, $asesor, $plan)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),15);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $pc = array();
        $plan = $query->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=> $plan));
        $persona = $query->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$asesor));
        $cli = $query->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('personales'=>$persona));

        foreach ($cli as $c):
            if($c->getPlanClientes()->getPlanProspeccion()->getId()==$plan->getId()){
                array_push($pc,$c->getPlanClientes()->getId());
            }
        endforeach;

        /*print_r($pc);
        exit;*/

        return $this->render('@App/Default/vistaprospecciones.html.twig', array(
            'cli'=>$cli,
            'lista'=>$pc
        ));

    }

    /**
     * @Route("/cliente-prospecciones/{id}/", name="cliente-prospeccion")
     */
    public function clienteProspeccionAction(Request $request, $id)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),15);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $cli =$query->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$id));
        /*temporales*/
        $pcaT=$query->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('personales'=>$user->getPersonales()));
        $idpca = 0;
        foreach ($pcaT as $x):
            if($x->getPlanClientes()->getClientes()->getId()==$id){
                $idpca=$x->getPlanClientes()->getId();
            }
        endforeach;
        /*temporales*/
        $pc = $query->getRepository('CoreBundle:PlanClientes')->findOneBy(array('id'=>$idpca));
        $pca=$query->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('planClientes'=>$pc,'personales'=>$user->getPersonales()));
        $pros = $query->getRepository('CoreBundle:Prospeccion')->findOneBy(array('planClienteAsesor'=>$pca,'activo'=>1));
        $prosH = $query->getRepository('CoreBundle:Prospeccion')->findBy(array('planClienteAsesor'=>$pca,'activo'=>0));
        $ps = $query->getRepository('CoreBundle:ProspeccionServicio')->findBy(array('prospeccion'=>$pros));
        $grupos = $query->getRepository('CoreBundle:grupos')->findBy(array('activo'=>1));

        $productos = $query->getRepository('CoreBundle:ClientesProductos')->findBy(array('id'=>$cli));

        $domicilio = $query->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cli,'isFiscal'=>0));
        $domiciliof = $query->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cli, 'isFiscal'=>1));

        return $this->render('@App/Default/clientesprospecciones.html.twig', array(
            'cli'=>$cli,
            'productos'=>$productos,
            'domicilio' =>$domicilio,
            'pros'=>$pros,
            'ps'=>$ps,
            'grupos'=>$grupos,
            'prosH'=>$prosH,
            'pc'=>$pc,
            'domiciliof'=>$domiciliof
        ));

    }

    /**
     * @Route("/cliente-prospecciones/{asesor}/{cliente}", name="cliente-prospecciond")
     */
    public function clienteProspeccionDAction(Request $request, $cliente, $asesor)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),15);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $query = $this->getDoctrine()->getManager();
        $cli =$query->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$cliente));
        /*temporales*/
        $persona = $query->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$asesor));
        $pcaT=$query->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('personales'=>$persona));
        $idpca = 0;
        foreach ($pcaT as $x):
            if($x->getPlanClientes()->getClientes()->getId()==$cliente){
                $idpca=$x->getPlanClientes()->getId();
            }
        endforeach;
        /*temporales*/
        $pc = $query->getRepository('CoreBundle:PlanClientes')->findOneBy(array('id'=>$idpca));
        $pca=$query->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('planClientes'=>$pc,'personales'=>$persona));
        $pros = $query->getRepository('CoreBundle:Prospeccion')->findOneBy(array('planClienteAsesor'=>$pca,'activo'=>1));
        $prosH = $query->getRepository('CoreBundle:Prospeccion')->findBy(array('planClienteAsesor'=>$pca,'activo'=>0));
        $ps = $query->getRepository('CoreBundle:ProspeccionServicio')->findBy(array('prospeccion'=>$pros));
        $grupos = $query->getRepository('CoreBundle:grupos')->findBy(array('activo'=>1));

        $productos = $query->getRepository('CoreBundle:ClientesProductos')->findBy(array('id'=>$cli));

        $domicilio = $query->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cli,'isFiscal'=>0));
        $domiciliof = $query->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cli, 'isFiscal'=>1));

        return $this->render('@App/Default/clientesprospecciones.html.twig', array(
            'cli'=>$cli,
            'productos'=>$productos,
            'domicilio' =>$domicilio,
            'pros'=>$pros,
            'ps'=>$ps,
            'grupos'=>$grupos,
            'prosH'=>$prosH,
            'pc'=>$pc,
            'domiciliof'=>$domiciliof
        ));

    }
}
