<?php

namespace AppBundle\Controller;

use ConvertApi\ConvertApi;
use CoreBundle\Entity\ClienteResponsables;
use CoreBundle\Entity\ClientesProductos;
use CoreBundle\Entity\DomicilioClientes;
use CoreBundle\Entity\Prospeccion;
use CoreBundle\Entity\ProspeccionServicio;
use CoreBundle\Entity\ResponsableContactos;
use CoreBundle\Entity\TipoClientes;
use PhpOffice\PhpWord\TemplateProcessor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProspeccionController extends Controller
{
    /**
     * @Route("/prospeccion", name="prospeccion")
     */
    public function regProspeccionAction()
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),14);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $pca = $em->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('personales'=>$user->getPersonales()));
        $x = 0;
        $unicos = array();
        $pcaUnicos = array();
        foreach ($pca as $p):
            /*Planes Únicos*/
            array_push($unicos,$p->getPlanClientes()->getPlanProspeccion()->getId());
            array_push($pcaUnicos,$p->getId());
        endforeach;
        $unicos = array_unique($unicos);
        /*print_r($unicos);
        print_r($pcaUnicos);
        exit;*/

        $lista = array();

        foreach ($unicos as $u):
            $no = 0;
            $con = 0;
            $t = '';
            $n = '';
            foreach ($pcaUnicos as $pca):
                $pcaR = $em->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('id'=>$pca));
                $pros = $em->getRepository('CoreBundle:Prospeccion')->findOneBy(array('planClienteAsesor'=>$pcaR));
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

        /*print_r($lista);
        exit;*/

        return $this->render('@App/Default/prospeccion.html.twig', array(
            'pca'=>$pca,
            'unicos'=>$unicos,
            'lista'=>$lista
        ));
    }

    /**
     * @Route("/lista-clientes-prospectar/{id}", name="lista-clientes-prospectar")
     */
    public function listaClientesProspectarAction($id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),14);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $pca = $em->getRepository('CoreBundle:PlanClienteAsesor')->findBy(array('personales'=>$user->getPersonales()));

        return $this->render('@App/Default/prospeccionlista.html.twig',array(
            'pca'=>$pca,
            'id'=>$id
        ));
    }

    /**
     * @Route("/cliente-prospectar/{id}", name="cliente-prospectar")
     */
    public function clienteProspectarAction(Request $request,$id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),14);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();

        $cp = array();
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$id));
        $cRes = $em->getRepository('CoreBundle:ClienteResponsables')->findBy(array('clientes'=>$cliente));
        $cPro = $em->getRepository('CoreBundle:ClientesProductos')->findBy(array('clientes'=>$cliente,'activo'=>1));
        foreach ($cPro as $x):
            array_push($cp,$x->getProductos()->getId());
        endforeach;
        if(count($cPro)>0){
            $productos = $em->getRepository('CoreBundle:Productos')->findBy(array('marcas'=>$cPro[0]->getProductos()->getMarcas()));
        }else{
            $productos = null;
        }

        $tipoCliente = $em->getRepository('CoreBundle:TipoClientes')->findBy(array('activo'=>1));
        $tipoResponsable = $em->getRepository('CoreBundle:TipoResponsables')->findBy(array('activo'=>1));
        $estados = $em->getRepository('CoreBundle:Estados')->findBy(array('activo'=>1));
        $dom = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente,'isFiscal'=>0));
        $domF = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente,'isFiscal'=>1));
        $munFCli=null;
        $colFCli=null;
        if($domF){
            $munFCli = $em->getRepository('CoreBundle:Municipios')->findBy(array('estados'=>$domF->getMunicipios()->getEstados()));
            $colFCli = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios'=>$domF->getMunicipios()));
        }
        $munCli = $em->getRepository('CoreBundle:Municipios')->findBy(array('estados'=>$dom->getMunicipios()->getEstados()));
        $colCli = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios'=>$dom->getMunicipios()));
        $sectores = $em->getRepository('CoreBundle:Sectores')->findBy(array('activo'=>1));
        $segmentos = $em->getRepository('CoreBundle:Segmentos')->findBy(array('activo'=>1));
        $categorias = $em->getRepository('CoreBundle:Categorias')->findBy(array('activo'=>1));
        $marcas = $em->getRepository('CoreBundle:Marcas')->findBy(array('activo'=>1));
        $tipoG = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>1));
        $asoc = $em->getRepository('CoreBundle:Grupos')->findBy(array('tipoGrupos'=>$tipoG,'activo'=>1));
        $tipoG = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>2));
        $uni = $em->getRepository('CoreBundle:Grupos')->findBy(array('tipoGrupos'=>$tipoG,'activo'=>1));
        $qb = $em->createQueryBuilder();

        $gru = $qb->select('g')
            ->from('CoreBundle:Grupos','g')
            ->where('g.tipoGrupos = 3')
            ->orwhere('g.tipoGrupos = 4')
            ->andwhere('g.id != 2')
            ->orderby('g.nombre','ASC')
            ->getQuery()
            ->execute();
        $llamada = $em->getRepository('CoreBundle:EstatusSeguimientoProspeccion')->findBy(array('activo'=>1));
        $empresas = $em->getRepository('CoreBundle:Empresa')->findBy(array('activo'=>1));

        /*busqueda de cliente-plan-asesor*/
        $tId=null;
        $pc = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('clientes'=>$cliente));
        foreach ($pc as $t):
            $pca = $em->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('planClientes'=>$t,'personales'=>$user->getPersonales()));
            if($pca){
                $tId=$pca;
            }
        endforeach;
        $ps = $em->getRepository('CoreBundle:PlanServicio')->findBy(array('planProspeccion'=>$tId->getPlanClientes()->getPlanProspeccion()));
        $pro = $em->getRepository('CoreBundle:Prospeccion')->findOneBy(array('planClienteAsesor'=>$tId,'activo'=>1));
        $historial = $em->getRepository('CoreBundle:Prospeccion')->findBy(array('planClienteAsesor'=>$tId,'activo'=>0));
        $ps2 = $em->getRepository('CoreBundle:ProspeccionServicio')->findBy(array('prospeccion'=>$pro,'activo'=>1,'isAdicional'=>1));

        return $this->render('@App/Default/prospeccionnew.html.twig',array(
            'cliente'=>$cliente,
            'cRes'=>$cRes,
            'cProd'=>$cPro,
            'cp'=>$cp,
            'productos'=>$productos,
            'tipoCliente'=>$tipoCliente,
            'tipoResponsable'=>$tipoResponsable,
            'estados'=>$estados,
            'munCli'=>$munCli,
            'colCli'=>$colCli,
            'munFCli'=>$munFCli,
            'colFCli'=>$colFCli,
            'sectores'=>$sectores,
            'segmentos'=>$segmentos,
            'categorias'=>$categorias,
            'marcas'=>$marcas,
            'asociaciones'=>$asoc,
            'uniones'=>$uni,
            'grupos'=>$gru,
            'llamadas'=>$llamada,
            'empresas'=>$empresas,
            'planS'=>$ps,
            'pro'=>$pro,
            'ps2'=>$ps2,
            'historial'=>$historial
        ));
    }

    /**
     * @Route("/guardar-cliente-prospeccion/{enviar}", name="guardar-cliente-prospeccion")
     */
    public function guardarClienteAction(Request $request,$enviar){
        /*
        $em = $this->getDoctrine()->getManager();
        $nombreContacto = $request->request->get('nombreContacto');
        $responsable = $em->getRepository('CoreBundle:ResponsableContactos')->findOneBy(array('id'=>$nombreContacto));
        $cliRes = $em->getRepository('CoreBundle:ClienteResponsables')->findOneBy(array('responsableContactos'=>$responsable));

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        setlocale(LC_ALL,'es_MX');
        $today =  strftime('%e de %B de %Y');
        $section = $phpWord->addSection();
        $header = $section->addHeader();
        $header->addWatermark($this->getParameter('plan_directory').'/images/header.png', array(
            'width' => 610,
            'height' => 845,
            'marginTop' => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(-1)),
            'marginLeft' => round(\PhpOffice\PhpWord\Shared\Converter::cmToPixel(-1.9)),
            'posHorizontal' => 'absolute',
            'posVertical' => 'absolute'
        ));

        $phpWord->setDefaultFontName('Calibri');
        $phpWord->setDefaultFontSize(11);
        $phpWord->setDefaultParagraphStyle(
            array(
                'align'      => 'both',
                'spaceAfter' => 0,
                'space' => array('line' => 200)
            )
        );
        $section->addTextBreak();
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $paragraphStyleName = 'right';
        $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT,'spaceAfter' => 0));
        $myTextElement = $section->addText('Toluca, México a'.$today);
        $myTextElement->setFontStyle($fontStyle);
        $myTextElement->setParagraphStyle($paragraphStyleName);
        $section->addTextBreak(2);

        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(false);
        $myTextElement = $section->addText('En atención a:',$fontStyle,array('align'=>'left'));
        $section->addTextBreak();

        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $myTextElement = $section->addText(ucwords($responsable->getNombre().' '.$responsable->getApellidos()),$fontStyle,array('align'=>'left'));
        $myTextElement = $section->addText($responsable->getTipoResponsables()->getNombre(),$fontStyle,array('align'=>'left'));
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(false);
        $fontStyle->setColor('#002060');
        $myTextElement = $section->addText($cliRes->getClientes()->getRazonSocial(),$fontStyle,array('align'=>'left'));
        $section->addTextBreak();

        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setSize(10);
        $fontStyleLight = new \PhpOffice\PhpWord\Style\Font();
        $fontStyleLight->setBold(false);
        $fontStyleLight->setSize(10);
        $textrun = $section->addTextRun();
        $textrun->addText('CMX360 S.A. de C.V.',$fontStyle,array('align'=>'justify'));
        $textrun->addText(', su aliado de negocios presenta ante usted la Propuesta Económica en relación al cumplimiento de las regulaciones aplicables al sector hidrocarburos, a través de los siguientes servicios:',$fontStyleLight,array('align'=>'justify'));

        $section->addTextBreak(2);

        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setColor('#4472c4');
        $fontStyle->setItalic(true);
        $fontStyle->setSize(14);
        $myTextElement = $section->addTextBox(array('borderColor'=>'#4472c4','width'=>475,'height'=>40,'space'=>35));
        $myTextElement->addText('PROPUESTA ECONÓMICA',$fontStyle,array('align'=>'center'));
        $section->addTextBreak(2);

        $fileName = "Ejemplo-".date("Ymd-Hi").".docx";
        $phpWord->save($fileName);


        header("Content-Disposition: attachment; filename=".$fileName."; charset=iso-8859-1");
        echo file_get_contents($fileName);
        unlink($fileName);
        exit;*/

        /*print_r($request->request);
        exit;*/
        $em = $this->getDoctrine()->getManager();
        /*catch data*/
        $noCliente = $request->request->get('noCliente');
        $permisoCliente = $request->request->get('permisoCliente');
        $razonSocial = $request->request->get('razonSocial');
        $estacionServicio = $request->request->get('estacionServicio');
        $rfc = $request->request->get('rfc');
        $telefonoEmpresa = $request->request->get('telefonoEmpresa');
        $emailEmpresa = $request->request->get('emailEmpresa');
        $tipoC = $request->request->get('tipoCliente');
        $independiente = $request->request->get('independiente');
        $asociacion = $request->request->get('asociacion');
        $union = $request->request->get('union');
        $grupo = $request->request->get('grupo');
        $nombreContacto = $request->request->get('nombreContacto');
        $apellidoContacto = $request->request->get('apellidoContacto');
        $telefonoContacto = $request->request->get('telefonoContacto');
        $emailContacto = $request->request->get('emailContacto');
        $tipoContacto = $request->request->get('tipoContacto');
        $calleCliente = $request->request->get('calleCliente');
        $municipioCliente = $request->request->get('municipioCliente');
        $coloniaCliente = $request->request->get('coloniaCliente');
        $calleFiscalCliente = $request->request->get('calleFiscalCliente');
        $municipioFiscalCliente = $request->request->get('municipioFiscalCliente');
        $coloniaFiscalCliente = $request->request->get('coloniaFiscalCliente');
        $productosLista = $request->request->get('productos-lista');
        $productos = explode(".",$productosLista);
        $repro = $request->request->get('repro');
        $horaInicio = $request->request->get('horaInicio');
        $horaFin = $request->request->get('horaFin');
        $observaciones = $request->request->get('observaciones');
        $estatusLlamada = $request->request->get('estatusLlamada');
        $fechaRepro = $request->request->get('fechaRepro');
        $horaRepro = $request->request->get('horaRepro');
        $subservicioLista = $request->request->get('subservicio-lista');
        $subservicioListaNew = $request->request->get('subservicio-listanew');
        $user = $this->get('security.token_storage')->getToken()->getUser();

        /*check data*/
        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$noCliente));
        if($cliente->getNumeroPermiso()!=$permisoCliente){
            $cliente->setNumeroPermiso($permisoCliente);
        }
        if($cliente->getRazonSocial()!=$razonSocial){
            $cliente->setRazonSocial($razonSocial);
        }
        if($cliente->getEstacionServicio()!=$estacionServicio){
            $cliente->setEstacionServicio($estacionServicio);
        }
        if($cliente->getRfc()!=$rfc){
            $cliente->setRfc($rfc);
        }
        if($cliente->getTelefonoEmpresa()!=$telefonoEmpresa){
            $cliente->setTelefonoEmpresa($telefonoEmpresa);
        }
        if($cliente->getCorreoEmpresa()!=$emailEmpresa){
            $cliente->setCorreoEmpresa($emailEmpresa);
        }
        $tipoCliente = $em->getRepository('CoreBundle:TipoClientes')->findOneBy(array('id'=>$tipoC));
        if($cliente->getTipoClientes()!=$tipoCliente){
            $cliente->setTipoClientes($tipoCliente);
        }
        if($independiente==0){
            $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$grupo));
            $uni = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$union));
            $aso = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$asociacion));
            if($gru){
                $cliente->setGrupos($gru);
            }elseif ($uni){
                $cliente->setGrupos($uni);
            }elseif ($aso){
                $cliente->setGrupos($aso);
            }

        }else{
            $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>2));
            $cliente->setGrupos($gru);
        }
        $cliente->setFechaModificacion(new \DateTime('now'));
        $em->persist($cliente);
        $em->flush();

        $tipoResponsable = $em->getRepository('CoreBundle:TipoResponsables')->findOneBy(array('id'=>$tipoContacto));
        if(is_numeric($nombreContacto)){
            $responsable = $em->getRepository('CoreBundle:ResponsableContactos')->findOneBy(array('id'=>$nombreContacto));
            if($responsable->getTelefono()!=$telefonoContacto){
                $responsable->setTelefono($telefonoContacto);
            }
            if($responsable->getCorreo()!=$emailContacto){
                $responsable->setCorreo($emailContacto);
            }
            if($responsable->getTipoResponsables()!=$tipoResponsable){
                $responsable->setTipoResponsables($tipoResponsable);
            }
            $em->persist($responsable);
            $em->flush();
        }else{
            $responsable = new ResponsableContactos();
            $responsable->setNombre($nombreContacto);
            $responsable->setApellidos($apellidoContacto);
            $responsable->setTelefono($telefonoContacto);
            $responsable->setCorreo($emailContacto);
            $responsable->setActivo(1);
            $responsable->setTipoResponsables($tipoResponsable);
            $em->persist($responsable);
            $em->flush();
            $cliRes = new ClienteResponsables();
            $cliRes->setActivo(1);
            $cliRes->setClientes($cliente);
            $cliRes->setResponsableContactos($responsable);
            $em->persist($cliRes);
            $em->flush();
        }

        $dom = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente,'isFiscal'=>0,'activo'=>1));
        if($dom->getCalle()!=$calleCliente){
            $dom->setCalle($calleCliente);
        }
        $col = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('id'=>$coloniaCliente));
        if($dom->getColonias()!=$col){
            $dom->setColonias($col);
        }
        $mun = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$municipioCliente));
        if($dom->getMunicipios()!=$mun){
            $dom->setMunicipios($mun);
        }
        $em->persist($dom);
        $em->flush();

        if($calleFiscalCliente!=''){
            $domF = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente,'isFiscal'=>1));
            $mun = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$municipioFiscalCliente));
            $col = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('id'=>$coloniaFiscalCliente));
            if($domF){
                if($domF->getCalle()!=$calleFiscalCliente){
                    $domF->setCalle($calleFiscalCliente);
                }
                if($domF->getColonias()!=$col){
                    $domF->setColonias($col);
                }
                if($domF->getMunicipios()!=$mun){
                    $domF->setMunicipios($mun);
                }
                $domF->setActivo(1);
            }else{
                $domF = new DomicilioClientes();
                $domF->setClientes($cliente);
                $domF->setColonias($col);
                $domF->setMunicipios($mun);
                $domF->setIsFiscal(1);
                $domF->setActivo(1);
            }
            $em->persist($domF);
            $em->flush();
        }

        if(count($productos)>1){
            $delete = $em->getRepository('CoreBundle:ClientesProductos')->findBy(array('clientes'=>$cliente));
            foreach ($delete as $del):
                $em->remove($del);
                $em->flush();
            endforeach;
            foreach ($productos as $p):
                if($p!=''){
                    $pro = $em->getRepository('CoreBundle:Productos')->findOneBy(array('id'=>$p));
                    $cliProd = new ClientesProductos();
                    $cliProd->setActivo(1);
                    $cliProd->setClientes($cliente);
                    $cliProd->setProductos($pro);
                    $em->persist($cliProd);
                    $em->flush();
                }
            endforeach;
        }

        /*busqueda de cliente-plan-asesor*/
        $tId=null;
        $pc = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('clientes'=>$cliente));
        foreach ($pc as $t):
            $pca = $em->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('planClientes'=>$t,'personales'=>$user->getPersonales()));
            if($pca){
                $tId=$pca;
            }
        endforeach;

        if($repro=='on'){
            $costoTemporal = 0;
            $prospeccionH = new Prospeccion();
            $prospeccionH->setActivo(0);
            $prospeccionH->setFechaRegistro(new \DateTime('now'));
            $prospeccionH->setHoraInicio($horaInicio);
            $prospeccionH->setHoraFin($horaFin);
            $prospeccionH->setIsReprogramada(1);
            if($fechaRepro!=''){
                $prospeccionH->setFechaReprograma(new \DateTime($fechaRepro));
            }
            $prospeccionH->setHoraReprograma($horaRepro);
            $prospeccionH->setObservaciones($observaciones);
            $esta = $em->getRepository('CoreBundle:EstatusSeguimientoProspeccion')->findOneBy(array('id'=>$estatusLlamada));
            $prospeccionH->setEstatusSeguimientoProspeccion($esta);
            $prospeccionH->setResponsableContactos($responsable);
            $prospeccionH->setPlanClienteAsesor($tId);
            $em->persist($prospeccionH);
            $em->flush();
            if(count($subservicioLista)>0){
                foreach ($subservicioLista as $ss):
                    if($ss!=0){
                        $prosServ = new ProspeccionServicio();
                        $subservicio = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$ss));
                        $subservicioPrecio = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$subservicio,'activo'=>1));
                        $prosServ->setActivo(1);
                        $prosServ->setCosto($subservicioPrecio->getCosto());
                        $prosServ->setDescuento($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN());
                        $des = floatval($subservicioPrecio->getCosto()) * (intval($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN())/100);
                        $ct = floatval($subservicioPrecio->getCosto()) - $des;
                        $prosServ->setCostoTotal($ct);
                        $costoTemporal = $costoTemporal + $ct;
                        $prosServ->setIsAdicional(0);
                        $prosServ->setProspeccion($prospeccionH);
                        $prosServ->setSubservicio($subservicio);
                        $em->persist($prosServ);
                        $em->flush();
                    }
                endforeach;
            }
            if(count($subservicioListaNew)>0) {
                foreach ($subservicioListaNew as $ss):
                    if($ss!=0){
                        $prosServ = new ProspeccionServicio();
                        $subservicio = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$ss));
                        $subservicioPrecio = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$subservicio,'activo'=>1));
                        $prosServ->setActivo(1);
                        $prosServ->setCosto($subservicioPrecio->getCosto());
                        $prosServ->setDescuento($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN());
                        $des = floatval($subservicioPrecio->getCosto()) * (intval($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN())/100);
                        $ct = floatval($subservicioPrecio->getCosto()) - $des;
                        $prosServ->setCostoTotal($ct);
                        $costoTemporal = $costoTemporal + $ct;
                        $prosServ->setIsAdicional(1);
                        $prosServ->setProspeccion($prospeccionH);
                        $prosServ->setSubservicio($subservicio);
                        $em->persist($prosServ);
                        $em->flush();
                    }
                endforeach;
            }
            $prospeccionH->setCostoTotal($costoTemporal);
            $em->persist($prospeccionH);
            $em->flush();
        }
        $costoTotal = 0;
        $prospeccion = new Prospeccion();
        $prospeccion->setActivo(1);
        $prospeccion->setFechaRegistro(new \DateTime('now'));
        $prospeccion->setHoraInicio($horaInicio);
        $prospeccion->setHoraFin($horaFin);
        $prospeccion->setIsReprogramada(0);
        if($fechaRepro!=''){
            $prospeccion->setFechaReprograma(new \DateTime($fechaRepro));
        }
        $prospeccion->setHoraReprograma($horaRepro);
        $prospeccion->setObservaciones($observaciones);
        $esta = $em->getRepository('CoreBundle:EstatusSeguimientoProspeccion')->findOneBy(array('id'=>$estatusLlamada));
        $prospeccion->setEstatusSeguimientoProspeccion($esta);
        $prospeccion->setResponsableContactos($responsable);
        $prospeccion->setPlanClienteAsesor($tId);
        $em->persist($prospeccion);
        $em->flush();
        if(count($subservicioLista)>0){
            foreach ($subservicioLista as $ss):
                if($ss!=0){
                    $prosServ = new ProspeccionServicio();
                    $subservicio = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$ss));
                    $subservicioPrecio = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$subservicio,'activo'=>1));
                    $prosServ->setActivo(1);
                    $prosServ->setCosto($subservicioPrecio->getCosto());
                    $prosServ->setDescuento($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN());
                    $des = floatval($subservicioPrecio->getCosto()) * (intval($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN())/100);
                    $ct = floatval($subservicioPrecio->getCosto()) - $des;
                    $prosServ->setCostoTotal($ct);
                    $costoTotal = $costoTotal + $ct;
                    $prosServ->setIsAdicional(0);
                    $prosServ->setProspeccion($prospeccion);
                    $prosServ->setSubservicio($subservicio);
                    $em->persist($prosServ);
                    $em->flush();
                }
            endforeach;
        }
        if(count($subservicioListaNew)>0){
            foreach ($subservicioListaNew as $ss):
                if($ss!=0){
                    $prosServ = new ProspeccionServicio();
                    $subservicio = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$ss));
                    $subservicioPrecio = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$subservicio,'activo'=>1));
                    $prosServ->setActivo(1);
                    $prosServ->setCosto($subservicioPrecio->getCosto());
                    $prosServ->setDescuento($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN());
                    $des = floatval($subservicioPrecio->getCosto()) * (intval($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN())/100);
                    $ct = floatval($subservicioPrecio->getCosto()) - $des;
                    $prosServ->setCostoTotal($ct);
                    $costoTotal = $costoTotal + $ct;
                    $prosServ->setIsAdicional(1);
                    $prosServ->setProspeccion($prospeccion);
                    $prosServ->setSubservicio($subservicio);
                    $em->persist($prosServ);
                    $em->flush();
                }
            endforeach;
        }
        $prospeccion->setCostoTotal($costoTotal);
        if($repro=='on'){
            $prospeccion->setIdProspeccionPadre($prospeccionH->getId());
        }
        $em->persist($prospeccion);
        $em->flush();

        /*Guardar Docs (PDF y DOCX)*/
        setlocale(LC_ALL,'es_MX');
        $today =  strftime('%e de %B de %Y');
        $k = 0;
        $s = 0;
        $l = 0;
        $ps = $em->getRepository('CoreBundle:ProspeccionServicio')->findBy(array('prospeccion'=>$prospeccion,'activo'=>1));

        foreach ($ps as $x):
            if($x->getSubservicio()->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==1){
                $k = 1;
            }elseif ($x->getSubservicio()->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==2){
                $s = 1;
            }elseif ($x->getSubservicio()->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==3){
                $l = 1;
            }
        endforeach;

        if($k==1 && $s==1 && $l==1){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_TODO.docx');
        }elseif ($k==1 && $s==1 && $l==0){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_KREAT_SIGEM.docx');
        }elseif ($k==1 && $s==0 && $l==0){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_KREAT.docx');
        }elseif ($k==0 && $s==1 && $l==1){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_SIGEM_SOTEC.docx');
        }elseif ($k==0 && $s==1 && $l==0){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_SIGEM.docx');
        }elseif ($k==1 && $s==0 && $l==1){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_KREAT_SOTEC.docx');
        }elseif ($k==0 && $s==0 && $l==1){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_SOTEC.docx');
        }

        $templateWord->setValue('fecha', $today);
        $templateWord->setValue('cargo', $prospeccion->getResponsableContactos()->getTipoResponsables()->getNombre());
        $templateWord->setValue('nombreContacto', ucwords($prospeccion->getResponsableContactos()->getNombre().' '.$prospeccion->getResponsableContactos()->getApellidos()));
        $templateWord->setValue('razonSocial', $prospeccion->getPlanClienteAsesor()->getPlanClientes()->getClientes()->getRazonSocial());
        $i = count($ps);
        $templateWord->cloneRow('rowano', $i);
        $p = 1;
        foreach ($ps as $x):
            $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$x->getSubservicio(),'activo'=>1));
            $templateWord->setValue('valuenombre#'.$p, $x->getSubservicio()->getServicio()->getDepartamentoServicios()->getNombre());
            $templateWord->setValue('valueservicio#'.$p, $x->getSubservicio()->getServicio()->getNombre());
            $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
            $templateWord->setValue('valuepaquete#'.$p, '$'.number_format((float)$x->getCostoTotal(), 2, '.', ','));
            $templateWord->setValue('valueperiodo#'.$p, $x->getSubservicio()->getPeriodicidad()->getNombre());
            $templateWord->setValue('valueperiodoa#'.$p, $x->getSubservicio()->getPeriodoAplicacion()->getPeriodo());
            $templateWord->setValue('rowano#'.$p, $pre->getAnio());
            $p = $p + 1;
        endforeach;
        $condiciones = $em->getRepository('CoreBundle:PropuestasGeneral')->findBy(array('planProspeccion'=>$prospeccion->getPlanClienteAsesor()->getPlanClientes()->getPlanProspeccion()));
        $templateWord->cloneRow('rowcondicion', count($condiciones));
        $con = 1;
        foreach ($condiciones as $l):
            $templateWord->setValue('rowcondicion#'.$con, $l->getCondicionesComerciales()->getCondiciones());
            $con = $con +1;
        endforeach;

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $templateWord->setValue('nombreAsesor',$user->getPersonales()->getNombre()." ".$user->getPersonales()->getApPaterno());

        $fileName = "Prospección-".$prospeccion->getPlanClienteAsesor()->getPlanClientes()->getPlanProspeccion()->getId()."-".$prospeccion->getFechaRegistro()->format('Y-m-d').".docx";
        $templateWord->saveAs($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName);
        ConvertApi::setApiSecret('GdyObBEFqisBDhU5');
        $result = ConvertApi::convert('pdf', ['File' => $this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName]);
        $pdfName = str_replace("docx","pdf",$fileName);
        $result->getFile()->save($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.$pdfName);
        $prospeccion->setRutaPropuesta($pdfName);
        $em->persist($prospeccion);
        $em->flush();

        if($enviar==1){
            $message = \Swift_Message::newInstance()
                ->setSubject('Propuesta Económica CMX360')
                ->setFrom('services@cmx360.com.mx')
                ->setTo(array('aprogramacion2@kreatsolutions.com.mx',$responsable->getCorreo()))
                ->setBody(
                    $this->renderView('@App/mail/propuesta-email.html.twig',array(
                        'correo'=>$responsable->getCorreo(),
                        'nombre'=>$responsable->getNombre(),
                        'apellido'=>$responsable->getApellidos(),
                        'telefono'=>$responsable->getTelefono(),
                        'asesorNombre'=>$user->getPersonales()->getNombre(),
                        'asesorApellido'=>$user->getPersonales()->getApPaterno(),
                        'pdf'=>$pdfName
                    )),
                    'text/html'
                )
                ->attach(\Swift_Attachment::fromPath($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.$pdfName))
            ;

            $this->get('mailer')->send($message);
        }

        /*Guardar docs (PDF y DOCX)*/
        return $this->redirect($this->generateUrl('prospeccion'));
    }

    /**
     * @Route("/responsable-json", name="responsable-json")
     */
    public function jsonSAction(Request $request)
    {
        $id = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $ser = $em->getRepository('CoreBundle:ClienteResponsables')->findOneBy(array('id' => $id));
        $responsable = array(
            'telefono'=>$ser->getResponsableContactos()->getTelefono(),
            'email'=>$ser->getResponsableContactos()->getCorreo(),
            'tipo'=>$ser->getResponsableContactos()->getTipoResponsables()->getId()
        );

        return new Response(
            json_encode($responsable),
            200,
            array('Content-Type' => 'application/json')
        );
    }
    /**
     * @Route("/enviar-correo", name="enviar-correo")
     */
    public function enviarAction(){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $emailContacto = 'jprogramacion@kreatsolutions.com.mx';
        $nombreContacto = 'Lorem';
        $apellidoContacto = 'Ipsum';
        $telefonoContacto = '7222222222';

        $message = \Swift_Message::newInstance()
            ->setSubject('Propuesta Económica')
            ->setFrom('services@cmx360.com.mx')
            ->setTo(array('aprogramacion2@kreatsolutions.com.mx',$emailContacto))
            ->setBody(
                $this->renderView('@App/mail/propuesta-email.html.twig',array(
                    'correo'=>$emailContacto,
                    'nombre'=>$nombreContacto,
                    'apellido'=>$apellidoContacto,
                    'telefono'=>$telefonoContacto,
                    'asesorNombre'=>$user->getPersonales()->getNombre(),
                    'asesorApellido'=>$user->getPersonales()->getApPaterno(),
                    'pdf'=>'pruebas.pdf'
                )),
                'text/html'
            )
            ->attach(\Swift_Attachment::fromPath($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.'pruebas.pdf'))
        ;

        $this->get('mailer')->send($message);

        return $this->render('@App/layout.html.twig');
    }

    /**
     * @Route("/generarpdf-prospeccion", name="generarpdf-prospeccion")
     */
    public function generarPdfAction(Request $request){

        /*print_r($request->request);
        exit;*/
        $em = $this->getDoctrine()->getManager();
        /*catch data*/
        $noCliente = $request->request->get('noCliente');
        $razonSocial = $request->request->get('razonSocial');
        $nombreContacto = $request->request->get('nombreContacto');
        $apellidoContacto = $request->request->get('apellidoContacto');
        $telefonoContacto = $request->request->get('telefonoContacto');
        $emailContacto = $request->request->get('emailContacto');
        $tipoContacto = $request->request->get('tipoContacto');
        $subservicioLista = $request->request->get('subservicio-lista');
        $subservicioListaNew = $request->request->get('subservicio-listanew');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        /*catch data*/

        /*Guardar Docs (PDF y DOCX)*/
        setlocale(LC_ALL,'es_MX');
        $today =  strftime('%e de %B de %Y');
        $k = 0;
        $s = 0;
        $l = 0;

        $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$noCliente));
        $tId=null;
        $pc = $em->getRepository('CoreBundle:PlanClientes')->findBy(array('clientes'=>$cliente));
        foreach ($pc as $t):
            $pca = $em->getRepository('CoreBundle:PlanClienteAsesor')->findOneBy(array('planClientes'=>$t,'personales'=>$user->getPersonales()));
            if($pca){
                $tId=$pca;
            }
        endforeach;

        if(count($subservicioLista)>0){
            foreach ($subservicioLista as $x):
                if($x!=0){
                    $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                    if($sub->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==1){
                        $k = 1;
                    }elseif ($sub->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==2){
                        $s = 1;
                    }elseif ($sub->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==3){
                        $l = 1;
                    }
                }
            endforeach;
        }
        if(count($subservicioListaNew)>0){
            foreach ($subservicioListaNew as $x):
                if($x!=0){
                    $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                    if($sub->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==1){
                        $k = 1;
                    }elseif ($sub->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==2){
                        $s = 1;
                    }elseif ($sub->getServicio()->getDepartamentoServicios()->getEmpresa()->getId()==3){
                        $l = 1;
                    }
                }
            endforeach;
        }

        if($k==1 && $s==1 && $l==1){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_TODO.docx');
        }elseif ($k==1 && $s==1 && $l==0){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_KREAT_SIGEM.docx');
        }elseif ($k==1 && $s==0 && $l==0){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_KREAT.docx');
        }elseif ($k==0 && $s==1 && $l==1){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_SIGEM_SOTEC.docx');
        }elseif ($k==0 && $s==1 && $l==0){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_SIGEM.docx');
        }elseif ($k==1 && $s==0 && $l==1){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_KREAT_SOTEC.docx');
        }elseif ($k==0 && $s==0 && $l==1){
            $templateWord = new TemplateProcessor($this->getParameter('plan_directory'). DIRECTORY_SEPARATOR . 'templatesPE'. DIRECTORY_SEPARATOR.'PE_SOTEC.docx');
        }

        $templateWord->setValue('fecha', $today);
        $cargo = $em->getRepository('CoreBundle:TipoResponsables')->findOneBy(array('id'=>$tipoContacto));
        $templateWord->setValue('cargo', $cargo->getNombre());
        if(is_numeric($nombreContacto)){
            $responsable = $em->getRepository('CoreBundle:ResponsableContactos')->findOneBy(array('id'=>$nombreContacto));
            $templateWord->setValue('nombre', ucwords($responsable->getNombre().' '.$responsable->getApellidos()));
        }else{
            $templateWord->setValue('nombre', ucwords($nombreContacto.' '.$apellidoContacto));
        }
        $templateWord->setValue('razonSocial', $razonSocial);
        $i = count($subservicioLista) + count($subservicioListaNew);
        $templateWord->cloneRow('rowano', $i);
        $p = 1;

        $des = 1+($tId->getPlanClientes()->getPlanProspeccion()->getDescuentoN()/100);

        if(count($subservicioLista)>0){
            foreach ($subservicioLista as $x):
                $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub,'activo'=>1));
                $costo = $pre->getCosto() * $des;
                $templateWord->setValue('valuenombre#'.$p, $sub->getServicio()->getDepartamentoServicios()->getNombre());
                $templateWord->setValue('valueservicio#'.$p, $sub->getServicio()->getNombre());
                $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                $templateWord->setValue('valuepaquete#'.$p, '$'.number_format((float)$costo, 2, '.', ','));
                $templateWord->setValue('valueperiodo#'.$p, $sub->getPeriodicidad()->getNombre());
                $templateWord->setValue('valueperiodoa#'.$p, $sub->getPeriodoAplicacion()->getPeriodo());
                $templateWord->setValue('rowano#'.$p, $pre->getAnio());
                $p = $p + 1;
            endforeach;
        }
        if(count($subservicioListaNew)>0){
            foreach ($subservicioListaNew as $x):
                $sub = $em->getRepository('CoreBundle:Subservicio')->findOneBy(array('id'=>$x));
                $pre = $em->getRepository('CoreBundle:SubservicioPrecio')->findOneBy(array('subservicio'=>$sub,'activo'=>1));
                $costo = $pre->getCosto() * $des;
                $templateWord->setValue('valuenombre#'.$p, $sub->getServicio()->getDepartamentoServicios()->getNombre());
                $templateWord->setValue('valueservicio#'.$p, $sub->getServicio()->getNombre());
                $templateWord->setValue('valueunitario#'.$p, '$'.number_format((float)$pre->getCosto(), 2, '.', ','));
                $templateWord->setValue('valuepaquete#'.$p, '$'.number_format((float)$costo, 2, '.', ','));
                $templateWord->setValue('valueperiodo#'.$p, $sub->getPeriodicidad()->getNombre());
                $templateWord->setValue('valueperiodoa#'.$p, $sub->getPeriodoAplicacion()->getPeriodo());
                $templateWord->setValue('rowano#'.$p, $pre->getAnio());
                $p = $p + 1;
            endforeach;
        }

        $condiciones = $em->getRepository('CoreBundle:PropuestasGeneral')->findBy(array('planProspeccion'=>$tId->getPlanClientes()->getPlanProspeccion()));
        $templateWord->cloneRow('rowcondicion', count($condiciones));
        $con = 1;
        foreach ($condiciones as $l):
            $templateWord->setValue('rowcondicion#'.$con, $l->getCondicionesComerciales()->getCondiciones());
            $con = $con +1;
        endforeach;

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $templateWord->setValue('nombreAsesor',ucwords($user->getPersonales()->getNombre()." ".$user->getPersonales()->getApPaterno()));

        $fileName = "Prospección-Temporal-".date('Y-m-d').".docx";
        $templateWord->saveAs($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName);
        ConvertApi::setApiSecret('GdyObBEFqisBDhU5');
        $result = ConvertApi::convert('pdf', ['File' => $this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName]);
        $pdfName = str_replace("docx","pdf",$fileName);
        $result->getFile()->save($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.$pdfName);

        header("Content-Disposition: attachment; filename=".$pdfName."; charset=iso-8859-1");
        echo file_get_contents($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.$pdfName);
        unlink($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."pdf".DIRECTORY_SEPARATOR.$pdfName);
        unlink($this->getParameter('prospeccion_directory').DIRECTORY_SEPARATOR."docx".DIRECTORY_SEPARATOR.$fileName);
    }
}
