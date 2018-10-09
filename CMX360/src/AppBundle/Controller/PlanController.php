<?php

namespace AppBundle\Controller;

use CoreBundle\Entity\PlanAsocUniGpo;
use CoreBundle\Entity\PlanClienteAsesor;
use CoreBundle\Entity\PlanClientes;
use CoreBundle\Entity\PlanProspeccion;
use CoreBundle\Entity\PlanServicio;
use CoreBundle\Entity\PropuestasGeneral;
use CoreBundle\Form\PlanType;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\ZipArchive;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PhpOffice\PhpWord\TemplateProcessor;
use \ConvertApi\ConvertApi;

class PlanController extends Controller
{
    /**
     * @Route("/registro-plan-de-prospeccion", name="regPlan")
     */
    public function regPlanAction(Request $request)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),10);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $pais = $em->getRepository('CoreBundle:Paises')->findOneBy(array('nombre'=>'México'));
        $zonas = $em->getRepository('CoreBundle:Zonas')->findBy(array('paises'=>$pais));
        $estados = $em->getRepository('CoreBundle:Estados')->findBy(array('activo'=>1));
        $aso = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>1,'activo'=>'1'));
        $asociaciones = $em->getRepository('CoreBundle:Grupos')->findBy(array('tipoGrupos'=>$aso,'activo'=>'1'));
        $uni = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('activo'=>1,'id'=>2));
        $uniones = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1,'tipoGrupos'=>$uni));
        $grupo = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('activo'=>1,'id'=>3));
        $grupos = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1,'tipoGrupos'=>$grupo));
        $formData = new PlanProspeccion();
        $flow = $this->get('cmx360.form.flow.planReg');
        $flow->bind($formData);
        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);
            if($flow->getCurrentStepNumber()==1){
                $data =  $flow->getRequest()->request;
                $t = array();
                $t['hasConvenio'] = $data->all()['planType']['checkConvenio'];
                if(isset($data->all()['planType']['convenios'])){
                    $t['convenio'] = $data->all()['planType']['convenios'];
                }else{
                    $t['convenio']=0;
                }
                $t['nombre']=$data->all()['planType']['nombre'];
                if(isset($data->all()['planType']['campana'])){
                    $t['campana']=$data->all()['planType']['campana'];
                }else{
                    $t['campana']=0;
                }
                if(isset($data->all()['planType']['tipoClientes'])){
                    $t['tipo-cliente']=$data->all()['planType']['tipoClientes'];
                }else{
                    $t['tipo-cliente']=0;
                }
                if(isset($data->all()['planType']['zonas'])){
                    $t['zona']=$data->all()['planType']['zonas'];
                }else{
                    $t['zona']=0;
                }
                if(isset($data->all()['planType']['estados'])){
                    $t['estado']=$data->all()['planType']['estados'];
                }else{
                    $t['estado']=0;
                }
                if(isset($data->all()['planType']['municipios'])){
                    $t['municipio']=$data->all()['planType']['municipios'];
                }else{
                    $t['municipio']=0;
                }
                if(isset($data->all()['planType']['marcas'])){
                    $t['marca']=$data->all()['planType']['marcas'];
                }else{
                    $t['marca']=0;
                }
                if(isset($data->all()['planType']['asociacion'])){
                    $t['asociacion']=$data->all()['planType']['asociacion'];
                }else{
                    $t['asociacion']=0;
                }
                if(isset($data->all()['planType']['union'])){
                    $t['union']=$data->all()['planType']['union'];
                }else{
                    $t['union']=0;
                }
                if(isset($data->all()['planType']['grupo'])){
                    $t['grupo']=$data->all()['planType']['grupo'];
                }else{
                    $t['grupo']=0;
                }
                if(isset($data->all()['planType']['estatusSeguimiento'])){
                    $t['estatusSeguimiento']=$data->all()['planType']['estatusSeguimiento'];
                }else{
                    $t['estatusSeguimiento']=0;
                }
                if($data->all()['planType']['codigoPostal']!=''){
                    $t['codigoPostal']=$data->all()['planType']['codigoPostal'];
                }else{
                    $t['codigoPostal']=0;
                }
                $t['lista-clientes']=$data->all()['lista-sel'];
                $this->get('session')->set('datos', $t);
                /*$datos = $this->get('session')->get('datos');
                print_r($datos);
                exit;*/
            }elseif($flow->getCurrentStepNumber()==2){
                $data =  $flow->getRequest()->request;
                $t = $this->get('session')->get('datos');
                if(isset($data->all()['planType']['checkDescuento'])){
                    $t['isNegociable']=$data->all()['planType']['checkDescuento'];
                }else{
                    $t['isNegociable']=0;
                }
                $t['descuentoN']=$data->all()['planType']['descuentoN'];
                $t['costoTotalDesc']=$data->all()['planType']['costoTotalDesc'];
                if(isset($data->all()['planType']['tipoServicio'])){
                    $t['tipoServicio']=$data->all()['planType']['tipoServicio'];
                }else{
                    $t['tipoServicio']=0;
                }
                if(isset($data->all()['planType']['empresa'])){
                    $t['empresa']=$data->all()['planType']['empresa'];
                }else{
                    $t['empresa']=0;
                }
                if(isset($data->all()['planType']['departamento'])){
                    $t['departamento']=$data->all()['planType']['departamento'];
                }else{
                    $t['departamento']=0;
                }
                if(isset($data->all()['planType']['servicio'])){
                    $t['servicio']=$data->all()['planType']['servicio'];
                }else{
                    $t['servicio']=0;
                }
                if(isset($data->all()['planType']['subservicio'])){
                    $t['subservicio']=$data->all()['planType']['subservicio'];
                }else{
                    $t['subservicio']=0;
                }
                $t['condicionesComerciales']=$data->all()['planType']['condicionesComerciales'];
                $t['costodeProspeccion']=$data->all()['planType']['costodeProspeccion'];
                $t['costoTotalPropuesto']=$data->all()['planType']['costoTotalPropuesto'];
                $t['costoTotalDesc']=$data->all()['planType']['costoTotalDesc'];
                $t['costoTotal']=$data->all()['planType']['costoTotal'];
                $t['costoTotalCN']=$data->all()['planType']['costoTotalCN'];
                $t['tiempo']=$data->all()['planType']['tiempo'];
                $t['fechaInicio']=$data->all()['planType']['fechaInicio'];
                $t['fechaFin']=$data->all()['planType']['fechaFin'];
                $t['numeroAsesores']=$data->all()['planType']['numeroAsesores'];
                if(isset($data->all()['subservicios-lista'])){
                    $t['subservicio-lista']=$data->all()['subservicios-lista'];
                }else{
                    $t['subservicio-lista']=0;
                }
                if(isset($data->all()['add-subservicio'])){
                    $t['add-subservicio']=$data->all()['add-subservicio'];
                }else{
                    $t['add-subservicio']=0;
                }
                if(isset($data->all()['add-descuento']) && $data->all()['planType']['checkDescuento']==1){
                    $t['add-descuento']=$data->all()['add-descuento'];
                }else{
                    $t['add-descuento']=0;
                }
                if($formData->getRutaFlyer()){
                    $file = $formData->getRutaFlyer();
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($this->getParameter('flyers_directory').'/temp/',$fileName);
                    $t['rutaFlyer']=$fileName;
                }
                $this->get('session')->set('datos', $t);
                /*$datos = $this->get('session')->get('datos');
                print_r($datos);
                exit;*/
            }
            if ($flow->nextStep()) {
                $form = $flow->createForm();
            }else {
                $datos = $this->get('session')->get('datos');
                $em = $this->getDoctrine()->getManager();
                /*print_r($datos);
                exit;*/
                $plan = new PlanProspeccion();
                if(isset($datos['hasConvenio'])){
                    $plan->setIsConvenio($datos['hasConvenio']);
                }
                if(isset($datos['isNegociable'])){
                    $plan->setIsNegociable($datos['isNegociable']);
                }
                if(isset($datos['descuentoN'])){
                    $plan->setDescuentoN($datos['descuentoN']);
                    $descuento = $datos['descuentoN'];
                }
                if(isset($datos['costoTotalDesc'])){
                    $costoDesc = $datos['costoTotalDesc'];
                }
                if(isset($datos['convenio'])){
                    if($datos['convenio']!=0){
                        $convenio = $em->getRepository('CoreBundle:Convenios')->findOneBy(array('id'=>$datos['convenio'],'activo'=>1));
                        $plan->setConvenios($convenio);
                    }
                }
                if(isset($datos['nombre'])){
                    $plan->setNombre($datos['nombre']);
                }
                if(isset($datos['campana'])){
                    $campana = $em->getRepository('CoreBundle:Campana')->findOneBy(array('id'=>$datos['campana']));
                    $plan->setCampana($campana);
                }
                if(isset($datos['tipo-cliente'])){
                    $tipoC = $em->getRepository('CoreBundle:TipoClientes')->findOneBy(array('id'=>$datos['tipo-cliente']));
                    $plan->setTipoClientes($tipoC);
                }
                if(isset($datos['zona'])){
                    if($datos['zona']!=0){
                        $zona = $em->getRepository('CoreBundle:Zonas')->findOneBy(array('id'=>$datos['zona']));
                        $plan->setZonas($zona);
                    }
                }
                if(isset($datos['estado'])){
                    if($datos['estado']!=0){
                        $estado = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id'=>$datos['estado']));
                        $plan->setEstados($estado);
                    }
                }
                if(isset($datos['municipio'])){
                    if($datos['municipio']!=0){
                        $municipio = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$datos['municipio']));
                        $plan->setMunicipios($municipio);
                    }
                }
                if(isset($datos['marca'])){
                    $marca = $em->getRepository('CoreBundle:Marcas')->findOneBy(array('id'=>$datos['marca']));
                    $plan->setMarcas($marca);
                }
                if(isset($datos['estatusSeguimiento'])){
                    $status = $em->getRepository('CoreBundle:EstatusSeguimiento')->findOneBy(array('id'=>$datos['estatusSeguimiento']));
                    $plan->setEstatusSeguimiento($status);
                }
                if(isset($datos['codigoPostal'])){
                    $plan->setCodigoPostal($datos['codigoPostal']);
                }
                if(isset($datos['tipoServicio'])){
                    $plan->setIsIntegral($datos['tipoServicio']);
                }
                if(isset($datos['condicionesComerciales'])){
                    $plan->setCondicionesComerciales($datos['condicionesComerciales']);
                }
                if(isset($datos['costodeProspeccion'])){
                    $plan->setCostodeProspeccion(floatval($datos['costodeProspeccion']));
                }
                if(isset($datos['costoTotalPropuesto'])){
                    $plan->setCostoTotalPropuesto(floatval($datos['costoTotalPropuesto']));
                }
                if(isset($datos['costoTotal'])){
                    $plan->setCostoTotal(floatval($datos['costoTotal']));
                }
                if(isset($datos['costoTotalCN'])){
                    $plan->setCostoTotalCN(floatval($datos['costoTotalCN']));
                }
                if(isset($datos['fechaInicio'])){
                    $plan->setFechaInicio(new \DateTime($datos['fechaInicio']));
                }
                if(isset($datos['fechaFin'])){
                    $plan->setFechaFin(new \DateTime($datos['fechaFin']));
                }
                if(isset($datos['numeroAsesores'])){
                    $plan->setNumeroAsesores($datos['numeroAsesores']);
                }
                if(isset($datos['rutaFlyer'])){
                    $plan->setRutaFlyer($datos['rutaFlyer']);
                    rename($this->getParameter('flyers_directory').'/temp/'.$datos['rutaFlyer'],$this->getParameter('flyers_directory').'/'.$datos['rutaFlyer']);
                }
                $user = $this->get('security.token_storage')->getToken()->getUser();
                $plan->setIdusuarioGenera($user->getId());
                $plan->setActivo(1);
                $plan->setFechaAlta(new \DateTime("now"));
                $plan->setFechaEnvioRevisionDO(new \DateTime("now"));
                $statusplan = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id'=>2));
                $plan->setEstatusPlan($statusplan);
                /*$em->persist($plan);
                $em->flush();*/
                try{
                    $em->persist($plan);
                    $em->flush();
                }catch (\Exception $e){
                    $ban=0;
                }
                $bang = 0;
                $banu = 0;
                $bana = 0;
                if(isset($datos['grupo'])){
                    $bang = $datos['grupo'];
                }
                if(isset($datos['union'])){
                    $banu = $datos['union'];
                }
                if(isset($datos['asociacion'])){
                    $bana = $datos['asociacion'];
                }
                if(isset($datos['lista-clientes'])){
                    $num=0;
                    $list = explode('+',$datos['lista-clientes']);
                    foreach ($list as $l):
                        if($l!=''){
                            $planClientes = new PlanClientes();
                            $cli = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$l));
                            $planClientes->setPlanProspeccion($plan);
                            $planClientes->setClientes($cli);
                            $planClientes->setFechaAlta(new \DateTime("now"));
                            $planClientes->setActivo(1);
                            $em->persist($planClientes);
                            $em->flush();
                            $num=$num+1;
                            if($cli->getGrupos()!=null){
                                if($bana==0 && $bang==0 && $banu==0){
                                    $check = $em->getRepository('CoreBundle:PlanAsocUniGpo')->findBy(array('planProspeccion'=>$plan,'grupos'=>$cli->getGrupos()));
                                    if(count($check)>0){

                                    }else{
                                        $planG = new PlanAsocUniGpo();
                                        $planG->setPlanProspeccion($plan);
                                        $planG->setActivo(1);
                                        $planG->setGrupos($cli->getGrupos());
                                        $em->persist($planG);
                                        $em->flush();
                                    }
                                }
                            }else{
                                $g = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>1));
                                if($bana==0 && $bang==0 && $banu==0){
                                    $check = $em->getRepository('CoreBundle:PlanAsocUniGpo')->findBy(array('planProspeccion'=>$plan,'grupos'=>$g));
                                    if(count($check)>0){

                                    }else{
                                        $planG = new PlanAsocUniGpo();
                                        $planG->setPlanProspeccion($plan);
                                        $planG->setActivo(1);
                                        $planG->setGrupos($g);
                                        $em->persist($planG);
                                        $em->flush();
                                    }
                                }
                            }
                        }
                    endforeach;
                    $plan->setCantidadClientes($num);
                    $em->persist($plan);
                    $em->flush();
                }
                if(isset($datos['subservicio'])){
                    if($datos['subservicio']==0){

                    }else{
                        $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$datos['subservicio']));
                        $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                        $planServicio = new PlanServicio();
                        $planServicio->setSubservicio($sub);
                        $planServicio->setPlanProspeccion($plan);
                        $planServicio->setDescuento($descuento);
                        $planServicio->setActivo(1);
                        $planServicio->setFechaAlta(new \DateTime("now"));
                        $planServicio->setCosto($pre->getCosto());
                        $em->persist($planServicio);
                        $em->flush();
                        $plan->setCantidadServicio(1);
                        $em->persist($plan);
                        $em->flush();
                    }
                }
                if(isset($datos['subservicio-lista'])){
                    if($datos['subservicio-lista']==0){

                    }else{
                        $numS = 0;
                        foreach ($datos['subservicio-lista'] as $x):
                            $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                            $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                            $planServicio = new PlanServicio();
                            $planServicio->setSubservicio($sub);
                            $planServicio->setPlanProspeccion($plan);
                            $planServicio->setCosto(floatval($pre->getCosto()));
                            $planServicio->setDescuento($descuento);
                            $planServicio->setActivo(1);
                            $planServicio->setFechaAlta(new \DateTime("now"));
                            $em->persist($planServicio);
                            $em->flush();
                            $numS= $numS+1;
                        endforeach;
                        $plan->setCantidadServicio($numS);
                        $em->persist($plan);
                        $em->flush();
                    }
                }
                if(isset($datos['add-subservicio'])){
                    $addSub = $datos['add-subservicio'];
                }
                if(isset($datos['add-descuento'])){
                    $addDes = $datos['add-descuento'];
                }
                if($addSub==0 && $addDes==0){

                }elseif ($addDes==0 && $addSub!=0){
                    $numS = 0;
                    foreach ($addSub as $x):
                        $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                        $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                        $planServicio = new PlanServicio();
                        $planServicio->setSubservicio($sub);
                        $planServicio->setPlanProspeccion($plan);
                        $planServicio->setCosto(floatval($pre->getCosto()));
                        $planServicio->setDescuento($addDes);
                        $planServicio->setActivo(1);
                        $planServicio->setFechaAlta(new \DateTime("now"));
                        $em->persist($planServicio);
                        $em->flush();
                        $numS= $numS+1;
                    endforeach;
                    $plan->setCantidadServicio($numS);
                    $em->persist($plan);
                    $em->flush();
                }else{
                    $numS = 0;
                    foreach ($addSub as $key=>$x):
                        $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                        $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                        $desc = $pre->getCosto()*(1-($addDes[$key]/100));
                        $planServicio = new PlanServicio();
                        $planServicio->setSubservicio($sub);
                        $planServicio->setPlanProspeccion($plan);
                        $planServicio->setCosto(floatval($desc));
                        $planServicio->setDescuento($addDes[$key]);
                        $planServicio->setActivo(1);
                        $planServicio->setFechaAlta(new \DateTime("now"));
                        $em->persist($planServicio);
                        $em->flush();
                        $numS= $numS+1;
                    endforeach;
                    $plan->setCantidadServicio($numS);
                    $em->persist($plan);
                    $em->flush();
                }
                if($bang!=0 && $banu!=0 && $bana!=0){
                    $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$bang));
                }elseif($bang==0 && $banu!=0 && $bana!=0){
                    $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$banu));
                }elseif($bang==0 && $banu==0 && $bana!=0){
                    $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$bana));
                }elseif ($bana==0 && $bang!=0 && $banu!=0){
                    $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$banu));
                }
                if($bang==0 && $banu==0 && $bana==0){
                    //no seleccionó grupo, unión o asociación
                }else{
                    $planGpo = new PlanAsocUniGpo();
                    $planGpo->setPlanProspeccion($plan);
                    $planGpo->setGrupos($gru);
                    $planGpo->setActivo(1);
                    $em->persist($planGpo);
                    $em->flush();
                }
                if(isset($datos['condicionesPropuesta'])){
                    $al = $em->getRepository('CoreBundle:Alcances')->findOneBy(array('id'=>1));
                    $ruta = $em->getRepository('CoreBundle:RutaImagenes')->findOneBy(array('id'=>1));
                    $marco = $em->getRepository('CoreBundle:MarcoJuridico')->findOneBy(array('id'=>1));
                    foreach ($datos['condicionesPropuesta'] as $id):
                        $prop = new PropuestasGeneral();
                        $prop->setActivo(1);
                        $prop->setFechaAsignacion(new \DateTime("now"));
                        $prop->setPlanProspeccion($plan);
                        $prop->setAlcances($al);
                        $prop->setRutaImagenes($ruta);
                        $prop->setMarcoJuridico($marco);
                        $c = $em->getRepository('CoreBundle:CondicionesComerciales')->findOneBy(array('id'=>$id));
                        $prop->setCondicionesComerciales($c);
                        $em->persist($prop);
                        $em->flush();
                    endforeach;
                }

                /*Guardar Docs (PDF y DOCX)*/
                setlocale(LC_ALL,'es_MX');
                $today =  strftime('%e de %B de %Y');
                $templateWord = new TemplateProcessor($this->getParameter('propuestas_directory'). DIRECTORY_SEPARATOR . 'templateTabla.docx');
                $templateWord->setValue('fecha', $today);

                if($datos['tipoServicio']==1){
                    if($datos['add-subservicio']==0){
                        $i = count($datos['subservicio-lista']);
                        $templateWord->cloneRow('rowano', $i);
                        foreach ($datos['subservicio-lista'] as $key=>$x):
                            $p = $key + 1;
                            $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                            $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                            $templateWord->setValue('valuenombre#'.$p, $sub->getServicio()->getDepartamentoServicios());
                            $templateWord->setValue('valueservicio#'.$p, $sub->getServicio()->getNombre());
                            $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                            if($datos['isNegociable']==0){
                                $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                            }else{
                                $c = $pre->getCosto();
                                $d = $datos['add-descuento'][$key]/100;
                                $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$c*(1-$d), 2, '.', ','));
                            }
                            $templateWord->setValue('valueperiodo#'.$p, $sub->getPeriodicidad()->getNombre());
                            $templateWord->setValue('valueperiodoa#'.$p, $sub->getPeriodoAplicacion()->getPeriodo());
                            $templateWord->setValue('rowano#'.$p, $pre->getAnio());
                        endforeach;
                    }else{
                        $i = count($datos['add-subservicio']);
                        $templateWord->cloneRow('rowano', $i);
                        foreach ($datos['add-subservicio'] as $key=>$x):
                            $p = $key + 1;
                            $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                            $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                            $templateWord->setValue('valuenombre#'.$p, $sub->getServicio()->getDepartamentoServicios());
                            $templateWord->setValue('valueservicio#'.$p, $sub->getServicio()->getNombre());
                            $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                            if($datos['isNegociable']==0){
                                $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                            }else{
                                $c = $pre->getCosto();
                                $d = $datos['add-descuento'][$key]/100;
                                $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$c*(1-$d), 2, '.', ','));
                            }
                            $templateWord->setValue('valueperiodo#'.$p, $sub->getPeriodicidad()->getNombre());
                            $templateWord->setValue('valueperiodoa#'.$p, $sub->getPeriodoAplicacion()->getPeriodo());
                            $templateWord->setValue('rowano#'.$p, $pre->getAnio());
                        endforeach;
                    }
                }else{
                    $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$datos['subservicio']));
                    $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub,'activo'=>1));
                    $templateWord->setValue('valuenombre', $sub->getServicio()->getDepartamentoServicios());
                    $templateWord->setValue('valueservicio', $sub->getServicio()->getNombre());
                    $templateWord->setValue('valueunitario', '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    if($datos['isNegociable']==0){
                        $templateWord->setValue('valuepaquete','$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    }else{
                        $c = $pre->getCosto();
                        $d = $datos['descuentoN']/100;
                        $templateWord->setValue('valuepaquete','$'.number_format((float)$c*(1-$d), 2, '.', ','));
                    }
                    $templateWord->setValue('valueperiodo', $sub->getPeriodicidad()->getNombre());
                    $templateWord->setValue('valueperiodoa', $sub->getPeriodoAplicacion()->getPeriodo());
                    $templateWord->setValue('rowano', $pre->getAnio());
                }


                $templateWord->cloneRow('rowcondicion', count($datos['condicionesPropuesta']));
                $con = 0;
                foreach ($datos['condicionesPropuesta'] as $l):
                    $con = $con +1;
                    $c = $em->getRepository('CoreBundle:CondicionesComerciales')->findOneBy(array('id'=>$l));
                    $templateWord->setValue('rowcondicion#'.$con, $c->getCondiciones());
                endforeach;

                $user = $this->get('security.token_storage')->getToken()->getUser();

                $templateWord->setValue('nombreAsesor',$user->getPersonales()->getNombre()." ".$user->getPersonales()->getApPaterno());

                $fileName = "Propuesta-".$prop->getPlanProspeccion()->getId()."-".$prop->getFechaAsignacion()->format('Y-m-d').".docx";

                $templateWord->saveAs($this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName);

                ConvertApi::setApiSecret('GdyObBEFqisBDhU5');
                $result = ConvertApi::convert('pdf', ['File' => $this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName]);
                $pdfName = str_replace("docx","pdf",$fileName);
                $result->getFile()->save($this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.$pdfName);
                /*Guardar docs (PDF y DOCX)*/

                return $this->redirectToRoute('regPlan');
            }
        }

        $datos = $this->get('session')->get('datos');

        /*Actualización*/

        $plan =  $em->getRepository('CoreBundle:PlanServicio')->findBy(array('activo'=>1));

        $lista1 = array();
        $lista2 = array();

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==1){
                array_push($lista1,$p->getPlanProspeccion()->getId());
            }
        endforeach;

        foreach ($plan as $p):
            if($p->getPlanProspeccion()->getEstatusPlan()->getId()==7){
                array_push($lista2,$p->getPlanProspeccion()->getId());
            }
        endforeach;


        $lista1 = array_unique($lista1);
        $lista2 = array_unique($lista2);

        return $this->render('@App/Default/plannew.html.twig',array(
            'form' => $form->createView(),
            'plan' => $plan,
            'lista1' => $lista1,
            'lista2'=> $lista2,
            'flow' => $flow,
            'zonas'=>$zonas,
            'estados'=>$estados,
            'asociaciones'=>$asociaciones,
            'uniones'=>$uniones,
            'grupos'=>$grupos,
            'datos'=>$datos,
        ));
    }

    /**
     * @Route("/{id}/actualizar-plan-prospeccion", name="editar-plan")
     */

    public function editarPlanAction(Request $request,PlanType $planType, $id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),10);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('CoreBundle\Form\PlanType', $planType);
        $editForm->handleRequest($request);

        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=>$id));

        return $this->render('@App/Default/planedit.html.twig', array(
            'plan' => $plan,
            'planP' => $planType,
            'edit_form' => $editForm->createView()
        ));

    }

    /**
     * @Route("/asignacion-plan", name="asignacion-plan")
     */
    public function asignaPlanAction(){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),13);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $listay = array();
        $listap = array();
        $lista1 = array();
        $sta = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id'=>4));
        $plan =  $em->getRepository('CoreBundle:PlanProspeccion')->findBy(array('activo'=>1,'estatusPlan'=>$sta));

        foreach ($plan as $p):
            $usu = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$p->getIdusuarioAutoriza()));
            $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$usu));
            foreach ($pp as $f):
                array_push($listap,array('id'=>$p->getId(),'perfil'=>$f->getPerfiles()->getNombre(),'privilegio'=>$f->getPrivilegios()->getNombre()));
            endforeach;
        endforeach;

        /*print_r($listap);
        exit;*/

        $sta = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id'=>6));
        $plan2 =  $em->getRepository('CoreBundle:PlanProspeccion')->findBy(array('activo'=>1,'estatusPlan'=>$sta));

        foreach ($plan2 as $p):
            $usu = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$p->getIdusuarioAutoriza()));
            $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$usu));
            foreach ($pp as $f):
                array_push($listay,array('id'=>$p->getId(),'perfil'=>$f->getPerfiles()->getNombre(),'privilegio'=>$f->getPrivilegios()->getNombre()));
            endforeach;
        endforeach;

        $sta = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id'=>5));
        $plan3 =  $em->getRepository('CoreBundle:PlanProspeccion')->findBy(array('activo'=>1,'estatusPlan'=>$sta));

        foreach ($plan3 as $p):
            $usu = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('id'=>$p->getIdusuarioAutoriza()));
            $pp = $em->getRepository('CoreBundle:PersonaPerfiles')->findBy(array('usuarios'=>$usu));
            foreach ($pp as $f):
                array_push($lista1,array('id'=>$p->getId(),'perfil'=>$f->getPerfiles()->getNombre(),'privilegio'=>$f->getPrivilegios()->getNombre()));
            endforeach;
        endforeach;

        return $this->render('@App/Default/planasignacionnew.html.twig',array(
            'plan' => $plan,
            'plan2' => $plan2,
            'plan3' => $plan3,
            'listap'=>$listap,
            'listay'=>$listay,
            'lista1'=>$lista1,
        ));
    }

    /**
     * @Route("/actualizar-asignacion-plan/{id}", name="actualizar-asignacion-plan")
     */
    public function actualizarAsignacionPlanAction($id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),13);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=>$id));
        $ps = $em->getRepository('CoreBundle:PlanServicio')->findBy(array('planProspeccion'=>$plan));
        $pc = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('planProspeccion'=>$plan));
        /*foreach ($ps as $s):
            print_r($s->getSubservicio()->getServicio()->getDepartamentoServicios()->getEmpresa()->getNombre());
        endforeach;
        exit;*/
        $cargo = $em->getRepository('CoreBundle:Cargos')->findOneBy(array('id'=>6));
        $pe = $em->getRepository('CoreBundle:PersonalEmpresas')->findBy(array('cargos'=>$cargo));
        $usu = $em->getRepository('CoreBundle:Usuarios')->findBy(array('activo'=>1));
        $lista = array();
        foreach ($usu as $u):
            foreach ($pe as $p):
                if($p->getPersonales()->getId() == $u->getPersonales()->getId()){
                    array_push($lista,array('id'=>$p->getPersonales()->getId(),'nombre'=>$p->getPersonales()->getNombre(),'apellido'=>$p->getPersonales()->getApPaterno()));
                }
            endforeach;
        endforeach;

        $contar = array();
        foreach ($pc as $i):
            $pca = $em->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('planClientes'=>$i,'activo'=>1));
            array_push($contar,$pca->getPersonales()->getId());
        endforeach;
        $vals = array_count_values($contar);

        return $this->render('@App/Default/planasignacionactualizacion.html.twig',array(
            'plan'=>$plan,
            'ps'=>$ps,
            'lista'=>$lista,
            'pc'=>$pc,
            'contar'=>$vals
        ));
    }

    /**
     * @Route("/asignar-plan/{id}", name="asignar-plan")
     */
    public function asignarPlanAction($id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),13);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=>$id));
        $ps = $em->getRepository('CoreBundle:PlanServicio')->findBy(array('planProspeccion'=>$plan));
        $pc = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('planProspeccion'=>$plan));
        /*foreach ($ps as $s):
            print_r($s->getSubservicio()->getServicio()->getDepartamentoServicios()->getEmpresa()->getNombre());
        endforeach;
        exit;*/
        $cargo = $em->getRepository('CoreBundle:Cargos')->findOneBy(array('id'=>6));
        $pe = $em->getRepository('CoreBundle:PersonalEmpresas')->findBy(array('cargos'=>$cargo));
        $usu = $em->getRepository('CoreBundle:Usuarios')->findBy(array('activo'=>1));
        $lista = array();
        foreach ($usu as $u):
            foreach ($pe as $p):
                if($p->getPersonales()->getId() == $u->getPersonales()->getId()){
                    array_push($lista,array('id'=>$p->getPersonales()->getId(),'nombre'=>$p->getPersonales()->getNombre(),'apellido'=>$p->getPersonales()->getApPaterno()));
                }
            endforeach;
        endforeach;

        return $this->render('@App/Default/planasignacion.html.twig',array(
            'plan'=>$plan,
            'ps'=>$ps,
            'lista'=>$lista,
            'pc'=>$pc
        ));
    }

    /**
     * @Route("/asignar-clientes", name="asignar-clientes")
     */
    public function asignarClientesAction(Request $request){
        $planId = $request->request->get('plan');
        $noC = $request->request->get('clientes');
        $lim = $request->request->get('limite');
        $lista = array();
        $em = $this->getDoctrine()->getManager();
        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=>$planId));
        $pcli = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('planProspeccion'=>$plan));
        $i=1;
        foreach ($pcli as $c):
            if($i>$noC && $i<=($noC+$lim)){
                $dom = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>0,'clientes'=>$c));
                $mar = $em->getRepository('CoreBundle:ClientesProductos')->findOneBy(array('clientes'=>$c));
                $grupo = '';
                $union = '';
                $asociacion = '';
                if($c->getClientes()->getGrupos()->getTipoGrupos()->getId()==3 || $c->getClientes()->getGrupos()->getTipoGrupos()->getId()==2 || $c->getClientes()->getGrupos()->getTipoGrupos()->getId()==1 || $c->getClientes()->getGrupos()->getTipoGrupos()->getId()==4){
                    /*grupo*/
                    if($c->getClientes()->getGrupos()->getTipoGrupos()->getId()==3){
                        $grupo = $c->getClientes()->getGrupos()->getNombre();
                        if($c->getClientes()->getGrupos()->getIdGrupoPadre()!=0){
                            $t1 = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$c->getClientes()->getGrupos()->getIdGrupoPadre()));
                            $union = $t1->getNombre();
                            if($t1->getIdGrupoPadre()!=0){
                                $t2 = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$t1->getIdGrupoPadre()));
                                $asociacion = $t2->getNombre();
                            }else{
                                $asociacion='-----';
                            }
                        }else{
                            $union = '-----';
                            $asociacion = '-----';
                        }
                    }/*union*/elseif ($c->getClientes()->getGrupos()->getTipoGrupos()->getId()==2){
                        $union = $c->getClientes()->getGrupos()->getNombre();
                        if($c->getClientes()->getGrupos()->getIdGrupoPadre()!=0){
                            $t1 = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$c->getClientes()->getGrupos()->getIdGrupoPadre()));
                            $asociacion = $t1->getNombre();
                        }else{
                            $asociacion = '-----';
                        }
                    }/*asociacion*/elseif ($c->getClientes()->getGrupos()->getTipoGrupos()->getId()==1){
                        $asociacion = $c->getClientes()->getGrupos()->getNombre();
                    }/*independiente*/elseif ($c->getClientes()->getGrupos()->getTipoGrupos()->getId()==4){
                        $grupo = $c->getClientes()->getGrupos()->getNombre();
                        $union = '-----';
                        $asociacion = '-----';
                    }
                }/*sin identificar*/elseif ($c->getClientes()->getGrupos()->getTipoGrupos()->getId()==5){
                    $grupo = $c->getClientes()->getGrupos()->getTipoGrupos()->getNombre();
                    $union = $c->getClientes()->getGrupos()->getTipoGrupos()->getNombre();
                    $asociacion = $c->getClientes()->getGrupos()->getTipoGrupos()->getNombre();
                }
                if($mar){
                    array_push($lista, array(
                        'estado'=>$dom->getMunicipios()->getEstados()->getNombre(),
                        'permiso'=>$dom->getClientes()->getNumeroPermiso(),
                        'marca'=>$mar->getProductos()->getMarcas()->getNombre(),
                        'asociacion'=>$asociacion,
                        'union'=>$union,
                        'grupo'=>$grupo
                    ));
                }else{
                    array_push($lista, array(
                        'estado'=>$dom->getMunicipios()->getEstados()->getNombre(),
                        'permiso'=>$dom->getClientes()->getNumeroPermiso(),
                        'marca'=>'-----',
                        'asociacion'=>$asociacion,
                        'union'=>$union,
                        'grupo'=>$grupo
                    ));
                }
            }
            $i=$i+1;
        endforeach;

        return new Response(
            json_encode($lista),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("guardar-asignacion", name="guardar-asignacion")
     */
    public function guardarAsignacionAction(Request $request){
        $n = $request->request->get('numero');
        $a = $request->request->get('asesor');
        $p = $request->request->get('plan');
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=>$p));
        $pcli = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('planProspeccion'=>$plan));
        $x = 0;
        $y = 0;
        $i=$n[$x];
        $j=$a[$y];
        /*print_r($n);
        print_r($a);
        exit;*/
        foreach ($pcli as $pc):
            $p = $em->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$j));
            $pca = new PlanClienteAsesor();
            $pca->setIdUsuarioAsigna($user->getId());
            $pca->setActivo(1);
            $pca->setFechaAsignacion(new \DateTime("now"));
            $pca->setPersonales($p);
            $pca->setPlanClientes($pc);
            $em->persist($pca);
            $em->flush();
            if($i!=0) {
                $i = $i - 1;
            }
            if ($i==0){
                $x=$x+1;
                $y=$y+1;
                if(isset($n[$x])){
                    $i=$n[$x];
                }
                if(isset($a[$y])){
                    $j=$a[$y];
                }
            }
        endforeach;

        $esta = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id'=>6));
        $plan->setEstatusPlan($esta);
        $em->persist($plan);
        $em->flush();

        return $this->redirect($this->generateUrl('asignacion-plan'));
    }

    /**
     * @Route("guardar-actualizacion-asignacion", name="guardar-actualizacion-asignacion")
     */
    public function guardarActualizacionAsignacionAction(Request $request){
        $n = $request->request->get('numero');
        $a = $request->request->get('asesor');
        $p = $request->request->get('plan');
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $plan = $em->getRepository('CoreBundle:PlanProspeccion')->findOneBy(array('id'=>$p));
        $pcli = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('planProspeccion'=>$plan));

        foreach ($pcli as $temp):
            $del = $em->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('planClientes'=>$temp));
            $del->setActivo(0);
            $em->persist($del);
            $em->flush();
        endforeach;
        $x = 0;
        $y = 0;
        $i=$n[$x];
        $j=$a[$y];
        /*print_r($n);
        print_r($a);
        exit;*/
        foreach ($pcli as $pc):
            $p = $em->getRepository('CoreBundle:Personales')->findOneBy(array('id'=>$j));
            $pca = new PlanClienteAsesor();
            $pca->setIdUsuarioAsigna($user->getId());
            $pca->setActivo(1);
            $pca->setFechaAsignacion(new \DateTime("now"));
            $pca->setPersonales($p);
            $pca->setPlanClientes($pc);
            $em->persist($pca);
            $em->flush();
            if($i!=0) {
                $i = $i - 1;
            }
            if ($i==0){
                $x=$x+1;
                $y=$y+1;
                if(isset($n[$x])){
                    $i=$n[$x];
                }
                if(isset($a[$y])){
                    $j=$a[$y];
                }
            }
        endforeach;

        $esta = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id'=>6));
        $plan->setEstatusPlan($esta);
        $em->persist($plan);
        $em->flush();

        return $this->redirect($this->generateUrl('asignacion-plan'));
    }

    /**
     * @Route("/estados-json", name="estados-json")
     */
    public function jsonEAction(Request $request)
    {
        $id = $request->request->get('zona');
        $em = $this->getDoctrine()->getManager();
        $zona = $em->getRepository('CoreBundle:Zonas')->findOneBy(array('id' => $id));
        $est = $em->getRepository('CoreBundle:Estados')->findBy(array('zonas' => $zona, 'activo' => 1),array('nombre'=>'ASC'));
        $esta = array();
        foreach ($est as $e):
            array_push($esta, array('id' => $e->getId(), 'estado' => $e->getNombre()));
        endforeach;

        return new Response(
            json_encode($esta),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/checkcodigo-json", name="checkcodigo-json")
     */
    public function jsonccbmAction(Request $request)
    {
        $check = 0;
        $codigo = $request->request->get('codigo');
        $mun = $request->request->get('municipio');
        $est = $request->request->get('estado');
        $zon = $request->request->get('zona');
        $em = $this->getDoctrine()->getManager();
        if($mun!=null){
            $muni = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id' => $mun,'activo'=>1));
            $col = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios'=>$muni,'activo'=>1));
            foreach ($col as $c):
                if($c->getCodigoPostal()==$codigo){
                    $check = 1;
                    break;
                }
            endforeach;
        }elseif ($est!=null){
            $esta = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id' => $est,'activo'=>1));
            $muni = $em->getRepository('CoreBundle:Municipios')->findBy(array('activo'=>1,'estados'=>$esta));
            foreach ($muni as $m):
                $col = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios'=>$m,'activo'=>1));
                foreach ($col as $c):
                    if($c->getCodigoPostal()==$codigo){
                        $check = 1;
                        break;
                    }
                endforeach;
            endforeach;
        }elseif ($zon!=null){
            $zona = $em->getRepository('CoreBundle:Zonas')->findOneBy(array('id' => $zon,'activo'=>1));
            $esta = $em->getRepository('CoreBundle:Estados')->findBy(array('zonas' => $zona,'activo'=>1));
            foreach ($esta as $e):
                $muni = $em->getRepository('CoreBundle:Municipios')->findBy(array('activo'=>1,'estados'=>$e));
                foreach ($muni as $m):
                    $col = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios'=>$m,'activo'=>1));
                    foreach ($col as $c):
                        if($c->getCodigoPostal()==$codigo){
                            $check = 1;
                            break;
                        }
                    endforeach;
                endforeach;
            endforeach;
        }

        return new Response(
            json_encode($check),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/buscar-json", name="buscar-json")
     */
    public function jsonBAction(Request $request)
    {
        $tipoC = $request->request->get('tipo');
        $zona = $request->request->get('zona');
        $esta = $request->request->get('estado');
        $mun = $request->request->get('municipio');
        $cod = $request->request->get('codigoPostal');
        $mar = $request->request->get('marca');
        $aso = $request->request->get('asociacion');
        $uni = $request->request->get('union');
        $gru = $request->request->get('grupo');
        $lista = array();
        $lista1 = array();
        $lista2 = array();
        $lista3 = array();
        $lista4 = array();
        $lista5 = array();
        $lista6 = array();
        $lista7 = array();
        $lista8 = array();
        $lista9 = array();
        $em = $this->getDoctrine()->getManager();
        if($tipoC==''){
            $clientes1 = $em->getRepository('CoreBundle:Clientes')->findBy(array('activo'=>1));
        }else{
            $tipo = $em->getRepository('CoreBundle:TipoClientes')->findOneBy(array('id'=>$tipoC,'activo'=>1));
            $clientes1 = $em->getRepository('CoreBundle:Clientes')->findBy(array('tipoClientes'=>$tipo,'activo'=>1));
        }
        if($zona==''){
            $clientes2 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }else{
            $zona = $em->getRepository('CoreBundle:Zonas')->findOneBy(array('id'=>$zona,'activo'=>1));
            $clientes2 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }
        if($esta==''){
            $clientes3 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }else{
            $estado = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id'=>$esta,'activo'=>1));
            $clientes3 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }
        if($mun==''){
            $clientes4 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }else{
            $municipio = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$mun,'activo'=>1));
            $clientes4 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0,'municipios'=>$municipio));
        }
        $clientes5 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        if($mar==''){
            $clientes6 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }else{
            $marca = $em->getRepository('CoreBundle:Marcas')->findOneBy(array('id'=>$mar,'activo'=>1));
            $clientes6 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }
        if($aso==0){
            $clientes7 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }else{
            $asociacion = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$aso,'activo'=>1));
            $clientes7 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }
        if($uni==0){
            $clientes8 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }else{
            $union = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$uni,'activo'=>1));
            $clientes8 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }
        if($gru==0){
            $clientes9 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }else{
            $grupo = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$gru,'activo'=>1));
            $clientes9 = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('activo'=>1,'isFiscal'=>0));
        }

        foreach ($clientes1 as $r):
            $check = array_keys(array_column($lista1, 'id'), $r->getId());
            if(count($check)>0){

            }else{
                array_push($lista1,$r->getId());
            }
        endforeach;
        foreach ($clientes2 as $r):
            if($zona==null || $zona==''){
                $check = array_keys(array_column($lista2, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista2,$r->getClientes()->getId());
                }
            }elseif($r->getMunicipios()->getEstados()->getZonas()->getId()==$zona->getId()){
                $check = array_keys(array_column($lista2, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista2,$r->getClientes()->getId());
                }
            }
        endforeach;
        foreach ($clientes3 as $r):
            if($esta==''){
                $check = array_keys(array_column($lista3, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista3,$r->getClientes()->getId());
                }
            }elseif($r->getMunicipios()->getEstados()->getId()==$estado->getId()){
                $check = array_keys(array_column($lista3, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista3,$r->getClientes()->getId());
                }
            }
        endforeach;
        foreach ($clientes4 as $r):
            $check = array_keys(array_column($lista4, 'id'), $r->getClientes()->getId());
            if(count($check)>0){

            }else{
                array_push($lista4,$r->getClientes()->getId());
            }
        endforeach;
        foreach ($clientes5 as $r):
            if($cod==''){
                $check = array_keys(array_column($lista5, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista5,$r->getClientes()->getId());
                }
            }elseif($r->getColonias()->getCodigoPostal()==$cod){
                $check = array_keys(array_column($lista5, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista5,$r->getClientes()->getId());
                }
            }
        endforeach;
        foreach ($clientes6 as $r):
            if($mar==''){
                $check = array_keys(array_column($lista6, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista6,$r->getClientes()->getId());
                }
            }else{
                $productos = $em->getRepository('CoreBundle:ClientesProductos')->findOneBy(array('clientes'=>$r,'activo'=>1));
                if(count($productos)>0 && $productos->getProductos()->getMarcas()->getId()==$marca->getId()){
                    $check = array_keys(array_column($lista6, 'id'), $r->getClientes()->getId());
                    if(count($check)>0){

                    }else{
                        array_push($lista6,$r->getClientes()->getId());
                    }
                }
            }
        endforeach;
        foreach ($clientes7 as $r):
            if($aso==''){
                $check = array_keys(array_column($lista7, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista7,$r->getClientes()->getId());
                }
            }else{
                if($r->getClientes()->getGrupos()!=null){
                    if($r->getClientes()->getGrupos()->getTipoGrupos()->getId()==3){
                        $grand = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$r->getClientes()->getGrupos()->getIdGrupoPadre()));
                    }
                    if($asociacion==$r->getClientes()->getGrupos() || $r->getClientes()->getGrupos()->getIdGrupoPadre()==$asociacion->getId() || (isset($grand) && $asociacion->getId()==$grand->getIdGrupoPadre())){
                        $check = array_keys(array_column($lista7, 'id'), $r->getClientes()->getId());
                        if(count($check)>0){

                        }else{
                            array_push($lista7,$r->getClientes()->getId());
                        }
                    }
                }
            }
        endforeach;
        foreach ($clientes8 as $r):
            if($uni==''){
                $check = array_keys(array_column($lista8, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista8,$r->getClientes()->getId());
                }
            }else{
                if($r->getClientes()->getGrupos()!=null && isset($union)){
                    if($union==$r->getClientes()->getGrupos() || $union->getId()==$r->getClientes()->getGrupos()->getIdGrupoPadre()){
                        $check = array_keys(array_column($lista8, 'id'), $r->getClientes()->getId());
                        if(count($check)>0){

                        }else{
                            array_push($lista8,$r->getClientes()->getId());
                        }
                    }
                }
            }
        endforeach;
        foreach ($clientes9 as $r):
            if($gru==''){
                $check = array_keys(array_column($lista9, 'id'), $r->getClientes()->getId());
                if(count($check)>0){

                }else{
                    array_push($lista9,$r->getClientes()->getId());
                }
            }else{
                if($r->getClientes()->getGrupos()!=null && isset($grupo) && $grupo==$r->getClientes()->getGrupos() ){
                    $check = array_keys(array_column($lista9, 'id'), $r->getClientes()->getId());
                    if(count($check)>0){

                    }else{
                        array_push($lista9,$r->getClientes()->getId());
                    }
                }
            }
        endforeach;

        $final = array_intersect($lista1,$lista2,$lista3,$lista4,$lista5,$lista6,$lista7,$lista8,$lista9);
        $final = array_unique($final);

        foreach ($final as $f):
            $c = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$f,'activo'=>1));
            $marca = $em->getRepository('CoreBundle:ClientesProductos')->findOneBy(array('clientes'=>$c));
            $m=null;
            if($marca!=null){
                $m = $marca->getProductos()->getMarcas()->getNombre();
            }else{
                $m = '-----';
            }
            $a=null;
            $u=null;
            $g=null;
            if($c->getGrupos()!=null){
                if($c->getGrupos()->getTipoGrupos()->getId()==1){
                    $a = $c->getGrupos()->getNombre();
                    $u = '-----';
                    $g = '-----';
                }elseif ($c->getGrupos()->getTipoGrupos()->getId()==2){
                    $u = $c->getGrupos()->getNombre();
                    if($c->getGrupos()->getIdGrupoPadre()==0){
                        $a = '-----';
                    }else{
                        $tmp = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$c->getGrupos()->getIdGrupoPadre()));
                        $a = $tmp->getNombre();
                    }
                    $g = '-----';
                }elseif ($c->getGrupos()->getTipoGrupos()->getId()==3){
                    $g = $c->getGrupos()->getNombre();
                    if($c->getGrupos()->getIdGrupoPadre()==0){
                        $u = '-----';
                    }else{
                        $tmp = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$c->getGrupos()->getIdGrupoPadre()));
                        $u = $tmp->getNombre();
                        if($tmp->getIdGrupoPadre()==0){
                            $a = '-----';
                        }else{
                            $tmp = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$tmp->getIdGrupoPadre()));
                            $a = $tmp->getNombre();
                        }

                    }
                }elseif ($c->getGrupos()->getTipoGrupos()->getId()==4){
                    $a = 'Es independiente';
                    $u = 'Es independiente';
                    $g = 'Es independiente';
                }elseif ($c->getGrupos()->getTipoGrupos()->getId()==5){
                    $a = 'Sin Identificar';
                    $u = 'Sin Identificar';
                    $g = 'Sin Identificar';
                }

            }else{
                $a = '-----';
                $u = '-----';
                $g = '-----';
            }
            $domicilio = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('isFiscal'=>0,'clientes'=>$c,'activo'=>1));
            array_push($lista, array(
                'id' => $c->getId(),
                'permiso' => $c->getNumeroPermiso(),
                'razon'=>$c->getRazonSocial(),
                'marca'=>$m,
                'asociacion'=>$a,
                'union'=>$u,
                'grupo'=>$g,
                'estado'=>$domicilio->getMunicipios()->getEstados()->getNombre()
                ));
        endforeach;
        return new Response(
            json_encode($lista),
            200,
            array('Content-Type' => 'application/json')
        );
    }
    /**
     * @Route("/empresa-json", name="empresa-json")
     */
    public function jsonDAction(Request $request)
    {
        $id = $request->request->get('empresa');
        $em = $this->getDoctrine()->getManager();
        $empresa = $em->getRepository('CoreBundle:Empresa')->findOneBy(array('id' => $id));
        $dep = $em->getRepository('CoreBundle:DepartamentoServicios')->findBy(array('empresa' => $empresa));
        $deps = array();
        foreach ($dep as $d):
            array_push($deps, array('id' => $d->getId(), 'departamento' => $d->getNombre()));
        endforeach;

        return new Response(
            json_encode($deps),
            200,
            array('Content-Type' => 'application/json')
        );
    }
    /**
     * @Route("/departamento-json", name="departamento-json")
     */
    public function jsonDepAction(Request $request)
    {
        $id = $request->request->get('departamento');
        $em = $this->getDoctrine()->getManager();
        $dep = $em->getRepository('CoreBundle:DepartamentoServicios')->findOneBy(array('id' => $id));
        $ser = $em->getRepository('CoreBundle:Servicio')->findBy(array('departamentoServicios' => $dep, 'activo' => 1));
        $servs = array();
        foreach ($ser as $s):
            array_push($servs, array('id' => $s->getId(), 'servicio' => $s->getNombre()));
        endforeach;

        return new Response(
            json_encode($servs),
            200,
            array('Content-Type' => 'application/json')
        );
    }
    /**
     * @Route("/servicio-json", name="servicio-json")
     */
    public function jsonSAction(Request $request)
    {
        $id = $request->request->get('servicio');
        $em = $this->getDoctrine()->getManager();
        $ser = $em->getRepository('CoreBundle:Servicio')->findOneBy(array('id' => $id));
        $sub = $em->getRepository('CoreBundle:Subservicio')->findBy(array('servicio' => $ser, 'activo' => 1));
        $subs = array();
        foreach ($sub as $s):
            $costo = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$s,'activo'=>1));
            array_push($subs, array('id' => $s->getId(), 'subservicio' => $s->getNombre(),'costo'=>$costo->getCosto()));
        endforeach;

        return new Response(
            json_encode($subs),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/costoCN-json", name="costoCN-json")
     */
    public function jsonCostoCNAction(Request $request)
    {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $con = $em->getRepository('CoreBundle:Convenios')->findOneBy(array('id'=>$id,'activo'=>1));
        $csub = $em->getRepository('CoreBundle:ConvenioSubservicios')->findOneBy(array('convenios'=>$con,'activo'=>1));
        $integral = 0;
        if($con->getIsIntegral()){
            $integral=1;
        }
        $convenio = array(
            'costo'=>$con->getCostoAutorizacion(),
            'condiciones'=>$con->getCondicionesComerciales(),
            'integral'=>$integral,
            'subservicio'=>$csub->getId(),
            'servicio'=>$csub->getSubservicio()->getServicio()->getId(),
            'departamento'=>$csub->getSubservicio()->getServicio()->getDepartamentoServicios()->getId(),
            'empresa'=>$csub->getSubservicio()->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()
        );

        return new Response(
            json_encode($convenio),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/subservicios-json", name="subservicios-json")
     */
    public function jsonSubserviciosAction(Request $request){
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $con = $em->getRepository('CoreBundle:Convenios')->findOneBy(array('id' => $id,'activo'=>1));
        $cs = $em->getRepository('CoreBundle:ConvenioSubservicios')->findBy(array('convenios'=>$con,'activo'=>1));
        $arrays = array();
        foreach ($cs as $i):
            $precio = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$i->getSubservicio()));
            array_push($arrays, array(
                'id'=>$i->getSubservicio()->getId(),
                'empresa'=>$i->getSubservicio()->getServicio()->getDepartamentoServicios()->getEmpresa()->getId(),
                'nombreempresa'=>$i->getSubservicio()->getServicio()->getDepartamentoServicios()->getEmpresa()->getNombre(),
                'departamento'=>$i->getSubservicio()->getServicio()->getDepartamentoServicios()->getId(),
                'nombredepartamento'=>$i->getSubservicio()->getServicio()->getDepartamentoServicios()->getNombre(),
                'servicio'=>$i->getSubservicio()->getServicio()->getId(),
                'nombreservicio'=>$i->getSubservicio()->getServicio()->getNombre(),
                'subservicio'=>$i->getSubservicio()->getId(),
                'nombresubservicio'=>$i->getSubservicio()->getNombre(),
                'precio'=>$precio->getCosto()
            ));
        endforeach;

        return new Response(
            json_encode($arrays),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/convenios-json", name="convenios-json")
     */
    public function jsonConveniosAction(Request $request)
    {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $con = $em->getRepository('CoreBundle:Convenios')->findOneBy(array('id' => $id,'activo'=>1));
        $cg = $em->getRepository('CoreBundle:ConvenioGrupo')->findOneBy(array('convenios'=>$con));
        $grand = 0;
        if($cg->getGrupos()->getTipoGrupos()->getId()==3){
            if($cg->getGrupos()->getIdGrupoPadre()==2 || $cg->getGrupos()->getIdGrupoPadre()==1){
                $grand = '';
            }else{
                $gr = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$cg->getGrupos()->getIdGrupoPadre()));
                $grand = $gr->getIdGrupoPadre();
            }
            $convenio = array('grupo'=>$cg->getGrupos()->getId(),'union'=>$cg->getGrupos()->getIdGrupoPadre(),'asociacion'=>$grand);
        }elseif ($cg->getGrupos()->getTipoGrupos()->getId()==2){
            $convenio = array('grupo'=>0,'union'=>$cg->getGrupos()->getId(),'asociacion'=>$cg->getGrupos()->getIdGrupoPadre());
        }elseif ($cg->getGrupos()->getTipoGrupos()->getId()==1){
            $convenio = array('grupo'=>0,'union'=>0,'asociacion'=>$cg->getGrupos()->getId());
        }elseif ($cg->getGrupos()->getTipoGrupos()->getId()==4){
            $convenio = array('grupo'=>0,'union'=>0,'asociacion'=>0);
        }

        return new Response(
            json_encode($convenio),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/listaconvenios-json", name="listaconvenios-json")
     */
    public function jsonConveniosListaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $con = $em->getRepository('CoreBundle:Convenios')->findBy(array('activo'=>1));
        $convenios = array();

        foreach ($con as $c):
            array_push($convenios,array('id'=>$c->getId(),'nombre'=>$c->getNombre()));
        endforeach;

        return new Response(
            json_encode($convenios),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("guardar-plan", name="guardar-plan")
     */
    public function guardarPlanAction(){
        $datos = $this->get('session')->get('datos');
        $ban=1;
        $em = $this->getDoctrine()->getManager();
        /*print_r($datos);
        exit;*/
        $plan = new PlanProspeccion();
        if(isset($datos['hasConvenio'])){
            $plan->setIsConvenio($datos['hasConvenio']);
        }
        if(isset($datos['isNegociable'])){
            $plan->setIsNegociable($datos['isNegociable']);
        }
        if(isset($datos['descuentoN'])){
            $plan->setDescuentoN($datos['descuentoN']);
            $descuento = $datos['descuentoN'];
        }
        if(isset($datos['costoTotalDesc'])){
            $costoDesc = $datos['costoTotalDesc'];
        }
        if(isset($datos['convenio'])){
            if($datos['convenio']!=0){
                $convenio = $em->getRepository('CoreBundle:Convenios')->findOneBy(array('id'=>$datos['convenio'],'activo'=>1));
                $plan->setConvenios($convenio);
            }
        }
        if(isset($datos['nombre'])){
            $plan->setNombre($datos['nombre']);
        }
        if(isset($datos['campana'])){
            $campana = $em->getRepository('CoreBundle:Campana')->findOneBy(array('id'=>$datos['campana']));
            $plan->setCampana($campana);
        }
        if(isset($datos['tipo-cliente'])){
            $tipoC = $em->getRepository('CoreBundle:TipoClientes')->findOneBy(array('id'=>$datos['tipo-cliente']));
            $plan->setTipoClientes($tipoC);
        }
        if(isset($datos['zona'])){
            if($datos['zona']!=0){
                $zona = $em->getRepository('CoreBundle:Zonas')->findOneBy(array('id'=>$datos['zona']));
                $plan->setZonas($zona);
            }
        }
        if(isset($datos['estado'])){
            if($datos['estado']!=0){
                $estado = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id'=>$datos['estado']));
                $plan->setEstados($estado);
            }
        }
        if(isset($datos['municipio'])){
            if($datos['municipio']!=0){
                $municipio = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$datos['municipio']));
                $plan->setMunicipios($municipio);
            }
        }
        if(isset($datos['marca'])){
            $marca = $em->getRepository('CoreBundle:Marcas')->findOneBy(array('id'=>$datos['marca']));
            $plan->setMarcas($marca);
        }
        if(isset($datos['estatusSeguimiento'])){
            $status = $em->getRepository('CoreBundle:EstatusSeguimiento')->findOneBy(array('id'=>$datos['estatusSeguimiento']));
            $plan->setEstatusSeguimiento($status);
        }
        if(isset($datos['codigoPostal'])){
            $plan->setCodigoPostal($datos['codigoPostal']);
        }
        if(isset($datos['tipoServicio'])){
            $plan->setIsIntegral($datos['tipoServicio']);
        }
        if(isset($datos['condicionesComerciales'])){
            $plan->setCondicionesComerciales($datos['condicionesComerciales']);
        }
        if(isset($datos['costodeProspeccion'])){
            $plan->setCostodeProspeccion(floatval($datos['costodeProspeccion']));
        }
        if(isset($datos['costoTotalPropuesto'])){
            $plan->setCostoTotalPropuesto(floatval($datos['costoTotalPropuesto']));
        }
        if(isset($datos['costoTotal'])){
            $plan->setCostoTotal(floatval($datos['costoTotal']));
        }
        if(isset($datos['costoTotalCN'])){
            $plan->setCostoTotalCN(floatval($datos['costoTotalCN']));
        }
        if(isset($datos['fechaInicio'])){
            $plan->setFechaInicio(new \DateTime($datos['fechaInicio']));
        }
        if(isset($datos['fechaFin'])){
            $plan->setFechaFin(new \DateTime($datos['fechaFin']));
        }
        if(isset($datos['numeroAsesores'])){
            $plan->setNumeroAsesores($datos['numeroAsesores']);
        }
        if(isset($datos['rutaFlyer'])){
            $plan->setRutaFlyer($datos['rutaFlyer']);
            rename($this->getParameter('flyers_directory').'/temp/'.$datos['rutaFlyer'],$this->getParameter('flyers_directory').'/'.$datos['rutaFlyer']);
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $plan->setIdusuarioGenera($user->getId());
        $plan->setActivo(1);
        $plan->setFechaAlta(new \DateTime("now"));
        $plan->setFechaEnvioRevisionDO(new \DateTime("now"));
        $statusplan = $em->getRepository('CoreBundle:EstatusPlan')->findOneBy(array('id'=>1));
        $plan->setEstatusPlan($statusplan);
        /*$em->persist($plan);
        $em->flush();*/
        try{
            $em->persist($plan);
            $em->flush();
        }catch (\Exception $e){
            $ban=0;
        }
        $bang = 0;
        $banu = 0;
        $bana = 0;
        if(isset($datos['grupo'])){
            $bang = $datos['grupo'];
        }
        if(isset($datos['union'])){
            $banu = $datos['union'];
        }
        if(isset($datos['asociacion'])){
            $bana = $datos['asociacion'];
        }
        if(isset($datos['lista-clientes'])){
            $num=0;
            $list = explode('+',$datos['lista-clientes']);
            foreach ($list as $l):
                if($l!=''){
                    $planClientes = new PlanClientes();
                    $cli = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$l));
                    $planClientes->setPlanProspeccion($plan);
                    $planClientes->setClientes($cli);
                    $planClientes->setFechaAlta(new \DateTime("now"));
                    $planClientes->setActivo(1);
                    $em->persist($planClientes);
                    $em->flush();
                    $num=$num+1;
                    if($cli->getGrupos()!=null){
                        if($bana==0 && $bang==0 && $banu==0){
                            $check = $em->getRepository('CoreBundle:PlanAsocUniGpo')->findBy(array('planProspeccion'=>$plan,'grupos'=>$cli->getGrupos()));
                            if(count($check)>0){

                            }else{
                                $planG = new PlanAsocUniGpo();
                                $planG->setPlanProspeccion($plan);
                                $planG->setActivo(1);
                                $planG->setGrupos($cli->getGrupos());
                                $em->persist($planG);
                                $em->flush();
                            }
                        }
                    }else{
                        $g = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>1));
                        if($bana==0 && $bang==0 && $banu==0){
                            $check = $em->getRepository('CoreBundle:PlanAsocUniGpo')->findBy(array('planProspeccion'=>$plan,'grupos'=>$g));
                            if(count($check)>0){

                            }else{
                                $planG = new PlanAsocUniGpo();
                                $planG->setPlanProspeccion($plan);
                                $planG->setActivo(1);
                                $planG->setGrupos($g);
                                $em->persist($planG);
                                $em->flush();
                            }
                        }
                    }
                }
            endforeach;
            $plan->setCantidadClientes($num);
            $em->persist($plan);
            $em->flush();
        }
        if(isset($datos['subservicio'])){
            if($datos['subservicio']==0){

            }else{
                $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$datos['subservicio']));
                $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                $planServicio = new PlanServicio();
                $planServicio->setSubservicio($sub);
                $planServicio->setPlanProspeccion($plan);
                $planServicio->setDescuento($descuento);
                $planServicio->setActivo(1);
                $planServicio->setFechaAlta(new \DateTime("now"));
                $planServicio->setCosto($pre->getCosto());
                $em->persist($planServicio);
                $em->flush();
                $plan->setCantidadServicio(1);
                $em->persist($plan);
                $em->flush();
            }
        }
        if(isset($datos['subservicio-lista'])){
            if($datos['subservicio-lista']==0){

            }else{
                $numS = 0;
                foreach ($datos['subservicio-lista'] as $x):
                    $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                    $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                    $planServicio = new PlanServicio();
                    $planServicio->setSubservicio($sub);
                    $planServicio->setPlanProspeccion($plan);
                    $planServicio->setCosto(floatval($pre->getCosto()));
                    $planServicio->setDescuento($descuento);
                    $planServicio->setActivo(1);
                    $planServicio->setFechaAlta(new \DateTime("now"));
                    $em->persist($planServicio);
                    $em->flush();
                    $numS= $numS+1;
                endforeach;
                $plan->setCantidadServicio($numS);
                $em->persist($plan);
                $em->flush();
            }
        }
        if(isset($datos['add-subservicio'])){
            $addSub = $datos['add-subservicio'];
        }
        if(isset($datos['add-descuento'])){
            $addDes = $datos['add-descuento'];
        }
        if($addSub==0 && $addDes==0){

        }elseif ($addDes==0 && $addSub!=0){
            $numS = 0;
            foreach ($addSub as $x):
                $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                $planServicio = new PlanServicio();
                $planServicio->setSubservicio($sub);
                $planServicio->setPlanProspeccion($plan);
                $planServicio->setCosto(floatval($pre->getCosto()));
                $planServicio->setDescuento($addDes);
                $planServicio->setActivo(1);
                $planServicio->setFechaAlta(new \DateTime("now"));
                $em->persist($planServicio);
                $em->flush();
                $numS= $numS+1;
            endforeach;
            $plan->setCantidadServicio($numS);
            $em->persist($plan);
            $em->flush();
        }else{
            $numS = 0;
            foreach ($addSub as $key=>$x):
                $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                $desc = $pre->getCosto()*(1-($addDes[$key]/100));
                $planServicio = new PlanServicio();
                $planServicio->setSubservicio($sub);
                $planServicio->setPlanProspeccion($plan);
                $planServicio->setCosto(floatval($desc));
                $planServicio->setDescuento($addDes[$key]);
                $planServicio->setActivo(1);
                $planServicio->setFechaAlta(new \DateTime("now"));
                $em->persist($planServicio);
                $em->flush();
                $numS= $numS+1;
            endforeach;
            $plan->setCantidadServicio($numS);
            $em->persist($plan);
            $em->flush();
        }
        if($bang!=0 && $banu!=0 && $bana!=0){
            $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$bang));
        }elseif($bang==0 && $banu!=0 && $bana!=0){
            $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$banu));
        }elseif($bang==0 && $banu==0 && $bana!=0){
            $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$bana));
        }elseif ($bana==0 && $bang!=0 && $banu!=0){
            $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$banu));
        }
        if($bang==0 && $banu==0 && $bana==0){
            //no seleccionó grupo, unión o asociación
        }else{
            $planGpo = new PlanAsocUniGpo();
            $planGpo->setPlanProspeccion($plan);
            $planGpo->setGrupos($gru);
            $planGpo->setActivo(1);
            $em->persist($planGpo);
            $em->flush();
        }
        if(isset($datos['condicionesPropuesta'])){
            $al = $em->getRepository('CoreBundle:Alcances')->findOneBy(array('id'=>1));
            $ruta = $em->getRepository('CoreBundle:RutaImagenes')->findOneBy(array('id'=>1));
            $marco = $em->getRepository('CoreBundle:MarcoJuridico')->findOneBy(array('id'=>1));
            foreach ($datos['condicionesPropuesta'] as $id):
                $prop = new PropuestasGeneral();
                $prop->setActivo(1);
                $prop->setFechaAsignacion(new \DateTime("now"));
                $prop->setPlanProspeccion($plan);
                $prop->setAlcances($al);
                $prop->setRutaImagenes($ruta);
                $prop->setMarcoJuridico($marco);
                $c = $em->getRepository('CoreBundle:CondicionesComerciales')->findOneBy(array('id'=>$id));
                $prop->setCondicionesComerciales($c);
                $em->persist($prop);
                $em->flush();
            endforeach;
        }

        /*Guardar Docs (PDF y DOCX)*/
        setlocale(LC_ALL,'es_MX');
        $today =  strftime('%e de %B de %Y');
        $templateWord = new TemplateProcessor($this->getParameter('propuestas_directory'). DIRECTORY_SEPARATOR . 'templateTabla.docx');
        $templateWord->setValue('fecha', $today);

        if($datos['tipoServicio']==1){
            if($datos['add-subservicio']==0){
                $i = count($datos['subservicio-lista']);
                $templateWord->cloneRow('rowano', $i);
                foreach ($datos['subservicio-lista'] as $key=>$x):
                    $p = $key + 1;
                    $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                    $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                    $templateWord->setValue('valuenombre#'.$p, $sub->getServicio()->getDepartamentoServicios());
                    $templateWord->setValue('valueservicio#'.$p, $sub->getServicio()->getNombre());
                    $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    if($datos['isNegociable']==0){
                        $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    }else{
                        $c = $pre->getCosto();
                        $d = $datos['add-descuento'][$key]/100;
                        $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$c*(1-$d), 2, '.', ','));
                    }
                    $templateWord->setValue('valueperiodo#'.$p, $sub->getPeriodicidad()->getNombre());
                    $templateWord->setValue('valueperiodoa#'.$p, $sub->getPeriodoAplicacion()->getPeriodo());
                    $templateWord->setValue('rowano#'.$p, $pre->getAnio());
                endforeach;
            }else{
                $i = count($datos['add-subservicio']);
                $templateWord->cloneRow('rowano', $i);
                foreach ($datos['add-subservicio'] as $key=>$x):
                    $p = $key + 1;
                    $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                    $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                    $templateWord->setValue('valuenombre#'.$p, $sub->getServicio()->getDepartamentoServicios());
                    $templateWord->setValue('valueservicio#'.$p, $sub->getServicio()->getNombre());
                    $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    if($datos['isNegociable']==0){
                        $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    }else{
                        $c = $pre->getCosto();
                        $d = $datos['add-descuento'][$key]/100;
                        $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$c*(1-$d), 2, '.', ','));
                    }
                    $templateWord->setValue('valueperiodo#'.$p, $sub->getPeriodicidad()->getNombre());
                    $templateWord->setValue('valueperiodoa#'.$p, $sub->getPeriodoAplicacion()->getPeriodo());
                    $templateWord->setValue('rowano#'.$p, $pre->getAnio());
                endforeach;
            }
        }else{
            $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$datos['subservicio']));
            $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
            $templateWord->setValue('valuenombre', $sub->getServicio()->getDepartamentoServicios());
            $templateWord->setValue('valueservicio', $sub->getServicio()->getNombre());
            $templateWord->setValue('valueunitario', '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
            if($datos['isNegociable']==0){
                $templateWord->setValue('valuepaquete','$'.number_format((float)$pre->getCosto(), 2, '.', ','));
            }else{
                $c = $pre->getCosto();
                $d = $datos['descuentoN']/100;
                $templateWord->setValue('valuepaquete','$'.number_format((float)$c*(1-$d), 2, '.', ','));
            }
            $templateWord->setValue('valueperiodo', $sub->getPeriodicidad()->getNombre());
            $templateWord->setValue('valueperiodoa', $sub->getPeriodoAplicacion()->getPeriodo());
            $templateWord->setValue('rowano', $pre->getAnio());
        }


        $templateWord->cloneRow('rowcondicion', count($datos['condicionesPropuesta']));
        $con = 0;
        foreach ($datos['condicionesPropuesta'] as $l):
            $con = $con +1;
            $c = $em->getRepository('CoreBundle:CondicionesComerciales')->findOneBy(array('id'=>$l));
            $templateWord->setValue('rowcondicion#'.$con, $c->getCondiciones());
        endforeach;

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $templateWord->setValue('nombreAsesor',$user->getPersonales()->getNombre()." ".$user->getPersonales()->getApPaterno());

        $fileName = "Propuesta-".$prop->getPlanProspeccion()->getId()."-".$prop->getFechaAsignacion()->format('Y-m-d').".docx";

        $templateWord->saveAs($this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName);

        ConvertApi::setApiSecret('GdyObBEFqisBDhU5');
        $result = ConvertApi::convert('pdf', ['File' => $this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName]);
        $pdfName = str_replace("docx","pdf",$fileName);
        $result->getFile()->save($this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.$pdfName);
        /*Guardar docs (PDF y DOCX)*/

        return new Response(
            json_encode($ban),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("previsualizar-propuesta", name="preview-propuesta")
     */
    public function propuestaAction(){
        /*$datos = $this->get('session')->get('datos');
        print_r($datos);
        exit;*/
        $em = $this->getDoctrine()->getManager();
        /*$user = $this->get('security.token_storage')->getToken()->getUser();

        $fqnameofjpeg = "/uploads/personales/fotos/".$user->getPersonales()->getRutaFotografia();

        echo "<img src='".$fqnameofjpeg."'>";
        exit;*/
        $con = $em->getRepository('CoreBundle:CondicionesComerciales')->findBy(array('activo'=>1));
        return $this->render('@App/Default/planpreview.html.twig', array('condiciones'=>$con));
    }

    /**
     * @Route("guardar-propuesta", name="guardar-propuesta")
     */
    public function guardarPropuestaAction(Request $request){
        $condiciones = $request->request->get('lista');
        $t = $this->get('session')->get('datos');
        $list = explode('k',$condiciones);
        $con = array();
        foreach ($list as $l):
            if($l!=''){
                array_push($con,$l);
            }
        endforeach;
        $t['condicionesPropuesta'] = $con;

        $this->get('session')->set('datos', $t);

        return new Response(
            json_encode(1),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/generar-propuesta", name="generar-propuesta")
     */
    public function generarPropuestaAction(Request $request){
        $condiciones = $request->request->get('lista-sel');
        $em = $this->getDoctrine()->getManager();
        $datos = $this->get('session')->get('datos');
        /*print_r($datos);
        exit;*/
        $tipo = null;
        $addSub = null;
        $addDes = null;
        $isNeg = null;
        $des = null;
        $subs = null;

        /*Generar Word*/
        setlocale(LC_ALL,'es_MX');
        $today =  strftime('%e de %B de %Y');
        $templateWord = new TemplateProcessor($this->getParameter('propuestas_directory'). DIRECTORY_SEPARATOR . 'templateTabla.docx');
        $templateWord->setValue('fecha', $today);

        /*Recolectar Datos*/
        if(isset($datos['add-subservicio'])){
            $addSub = $datos['add-subservicio'];
        }
        if(isset($datos['tipoServicio'])){
            $tipo = $datos['tipoServicio'];
        }
        if(isset($datos['add-descuento'])){
            $addDes = $datos['add-descuento'];
        }
        if(isset($datos['isNegociable'])){
            $isNeg = $datos['isNegociable'];
        }
        if(isset($datos['descuentoN'])){
            $des = $datos['descuentoN'];
        }
        if(isset($datos['subservicio'])){
            $subs = $datos['subservicio'];
        }
        /*Consultar en DB*/
        if($tipo==1){
            if($addSub==0){
                $i = count($datos['subservicio-lista']);
                $templateWord->cloneRow('rowano', $i);
                foreach ($datos['subservicio-lista'] as $key=>$x):
                    $p = $key + 1;
                    $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                    $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                    $templateWord->setValue('valuenombre#'.$p, $sub->getServicio()->getDepartamentoServicios());
                    $templateWord->setValue('valueservicio#'.$p, $sub->getServicio()->getNombre());
                    $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    if($isNeg==0){
                        $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    }else{
                        $c = $pre->getCosto();
                        $d = $addDes[$key]/100;
                        $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$c*(1-$d), 2, '.', ','));
                    }
                    $templateWord->setValue('valueperiodo#'.$p, $sub->getPeriodicidad()->getNombre());
                    $templateWord->setValue('valueperiodoa#'.$p, $sub->getPeriodoAplicacion()->getPeriodo());
                    $templateWord->setValue('rowano#'.$p, $pre->getAnio());
                endforeach;
            }else{
                $i = count($addSub);
                $templateWord->cloneRow('rowano', $i);
                foreach ($addSub as $key=>$x):
                    $p = $key + 1;
                    $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                    $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
                    $templateWord->setValue('valuenombre#'.$p, $sub->getServicio()->getDepartamentoServicios());
                    $templateWord->setValue('valueservicio#'.$p, $sub->getServicio()->getNombre());
                    $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    if($isNeg==0){
                        $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                    }else{
                        $c = $pre->getCosto();
                        $d = $addDes[$key]/100;
                        $templateWord->setValue('valuepaquete#'.$p,'$'.number_format((float)$c*(1-$d), 2, '.', ','));
                    }
                    $templateWord->setValue('valueperiodo#'.$p, $sub->getPeriodicidad()->getNombre());
                    $templateWord->setValue('valueperiodoa#'.$p, $sub->getPeriodoAplicacion()->getPeriodo());
                    $templateWord->setValue('rowano#'.$p, $pre->getAnio());
                endforeach;
            }
        }else{
            $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$subs));
            $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub));
            $templateWord->setValue('valuenombre', $sub->getServicio()->getDepartamentoServicios());
            $templateWord->setValue('valueservicio', $sub->getServicio()->getNombre());
            $templateWord->setValue('valueunitario', '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
            if($isNeg==0){
                $templateWord->setValue('valuepaquete','$'.number_format((float)$pre->getCosto(), 2, '.', ','));
            }else{
                $c = $pre->getCosto();
                $d = $des/100;
                $templateWord->setValue('valuepaquete','$'.number_format((float)$c*(1-$d), 2, '.', ','));
            }
            $templateWord->setValue('valueperiodo', $sub->getPeriodicidad()->getNombre());
            $templateWord->setValue('valueperiodoa', $sub->getPeriodoAplicacion()->getPeriodo());
            $templateWord->setValue('rowano', $pre->getAnio());
        }

        $list = explode('k',$condiciones);
        $con = 0;
        foreach ($list as $l):
            if($l!=''){
                $con = $con +1;
            }
        endforeach;
        $templateWord->cloneRow('rowcondicion', $con);
        $con = 0;
        foreach ($list as $l):
            if($l!=''){
                $con = $con +1;
                $c = $em->getRepository('CoreBundle:CondicionesComerciales')->findOneBy(array('id'=>$l));
                $templateWord->setValue('rowcondicion#'.$con, $c->getCondiciones());
            }
        endforeach;

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $templateWord->setValue('nombreAsesor',$user->getPersonales()->getNombre()." ".$user->getPersonales()->getApPaterno());

        $fileName = "Propuesta-".date("Ymd-Hi").".docx";
        //$fileName = "Propuesta.docx";
        $templateWord->saveAs($fileName);

        //Convertir docx en pdf
        /*ConvertApi::setApiSecret('GdyObBEFqisBDhU5');
        $result = ConvertApi::convert('pdf', ['File' => $fileName]);

        $pdfName = str_replace("docx","pdf",$fileName);

        $result->getFile()->save($this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR.$pdfName);*/

        //guardar con json para mostrar en la misma ventana
        /*
        $templateWord->saveAs($this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR.$fileName);
        $rutas = array('ruta'=>$this->getParameter('propuestas_directory').DIRECTORY_SEPARATOR."generados".DIRECTORY_SEPARATOR.$fileName);

        return new Response(
            json_encode($rutas),
            200,
            array('Content-Type' => 'application/json')
        );*/

        header("Content-Disposition: attachment; filename=".$fileName."; charset=iso-8859-1");
        echo file_get_contents($fileName);
        unlink($fileName);
        exit;
    }
}