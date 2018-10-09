<?php

namespace AppBundle\Controller;

use CoreBundle\Entity\Clientes;
use CoreBundle\Entity\ClientesProductos;
use CoreBundle\Entity\DomicilioClientes;
use CoreBundle\Entity\Grupos;
use CoreBundle\Form\CargaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SimpleXMLElement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientesController extends Controller
{
    /**
     * @Route("/registro-clientes", name="regClientes")
     * @Method({"GET","POST"})
     */
    public function regClientesAction(Request $request){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),3);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('CoreBundle:Clientes')->findAll();

        $formData = new Clientes();

        $flow = $this->get('cmx360.form.flow.clienteReg');
        $flow->bind($formData);

        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);
            if($flow->getCurrentStepNumber()==2){
                $data =  $flow->getRequest()->request;
                $t = array();
                array_push($t,array('estado'=>$data->all()['clientesType']['estado']));
                array_push($t,array('municipio'=>$data->all()['clientesType']['municipio']));
                array_push($t,array('colonia'=>$data->all()['clientesType']['colonia']));
                array_push($t,array('calle'=>$data->all()['clientesType']['calle']));
                if(isset($data->all()['clientesType']['igual'])){
                    array_push($t,array('igual'=>$data->all()['clientesType']['igual']));
                }
                if(isset($data->all()['clientesType']['estadoFiscal'])){
                    array_push($t,array('estadoFiscal'=>$data->all()['clientesType']['estadoFiscal']));
                }
                if(isset($data->all()['clientesType']['municipioFiscal'])){
                    array_push($t,array('municipioFiscal'=>$data->all()['clientesType']['municipioFiscal']));
                }
                if(isset($data->all()['clientesType']['coloniaFiscal'])){
                    array_push($t,array('coloniaFiscal'=>$data->all()['clientesType']['coloniaFiscal']));
                }
                if(isset($data->all()['clientesType']['calleFiscal'])){
                    array_push($t,array('calleFiscal'=>$data->all()['clientesType']['calleFiscal']));
                }
                $this->get('session')->set('datos2', $t);
            }
            if($flow->getCurrentStepNumber()==3){
                $data =  $flow->getRequest()->request;
                $t = array();
                array_push($t,array('sector'=>$data->all()['clientesType']['sector']));
                array_push($t,array('segmento'=>$data->all()['clientesType']['segmento']));
                array_push($t,array('categoria'=>$data->all()['clientesType']['categoria']));
                if(isset($data->all()['clientesType']['marca'])){
                    array_push($t,array('marca'=>$data->all()['clientesType']['marca']));
                }else{
                }
                array_push($t,array('nuevamarca'=>$data->all()['clientesType']['nuevamarca']));
                array_push($t,array('independiente'=>$data->all()['clientesType']['independiente']));
                array_push($t,array('lista'=>$data->all()['clientesType']['lista']));
                if($data->all()['clientesType']['independiente']==0){
                    if(isset($data->all()['clientesType']['asociacion'])){
                        array_push($t,array('asociacion'=>$data->all()['clientesType']['asociacion']));
                        array_push($t,array('nuevaasociacion'=>$data->all()['clientesType']['nuevaasociacion']));
                    }
                    if(isset($data->all()['clientesType']['macrogrupo'])){
                        array_push($t,array('macrogrupo'=>$data->all()['clientesType']['macrogrupo']));
                        array_push($t,array('nuevomacrogrupo'=>$data->all()['clientesType']['nuevomacrogrupo']));
                    }
                    if(isset($data->all()['clientesType']['grupo'])){
                        array_push($t,array('grupo'=>$data->all()['clientesType']['grupo']));
                        array_push($t,array('nuevogrupo'=>$data->all()['clientesType']['nuevogrupo']));
                    }
                }
                $this->get('session')->set('datos3', $t);
                /*$datos = $this->get('session')->get('datos3');
                print_r($datos);
                exit;*/
            }
            if ($flow->nextStep()) {
                $form = $flow->createForm();
            } else {
                $sessionVal2 = $this->get('session')->get('datos2');
                foreach ($sessionVal2 as $i):
                    if(isset($i['colonia'])){
                        $colonia = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('id'=>$i['colonia']));
                    }
                    if(isset($i['municipio'])){
                        $municipio = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$i['municipio']));
                    }
                    if(isset($i['estado'])){
                        $estado = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id'=>$i['estado']));
                    }
                    if(isset($i['coloniaFiscal'])){
                        $coloniaF = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('id'=>$i['coloniaFiscal']));
                    }
                    if(isset($i['municipioFiscal'])){
                        $municipioF = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$i['municipioFiscal']));
                    }
                    if(isset($i['estadoFiscal'])){
                        $estadoF = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id'=>$i['estadoFiscal']));
                    }
                    if(isset($i['igual'])){
                        $igual = $i['igual'];
                    }
                    if(isset($i['calle'])){
                        $calle = $i['calle'];
                    }
                    if(isset($i['calleFiscal'])){
                        $calleF = $i['calleFiscal'];
                    }
                endforeach;
                $sessionVal3 = $this->get('session')->get('datos3');
                foreach ($sessionVal3 as $i):
                    if(isset($i['sector'])){
                        $sector = $em->getRepository('CoreBundle:Sectores')->findOneBy(array('id'=>$i['sector']));
                    }
                    if(isset($i['segmento'])){
                        $segmento = $em->getRepository('CoreBundle:Segmentos')->findOneBy(array('id'=>$i['segmento']));
                    }
                    if(isset($i['categoria'])){
                        $categoria = $em->getRepository('CoreBundle:Categorias')->findOneBy(array('id'=>$i['categoria']));
                    }
                    if(isset($i['marca'])){
                        $marca = $em->getRepository('CoreBundle:Marcas')->findOneBy(array('id'=>$i['marca']));
                    }
                    if(isset($i['lista'])){
                        $productos = explode(".",$i['lista']);
                        array_pop($productos);
                    }
                    if(isset($i['nuevamarca'])){
                        $nuevamarca = $i['nuevamarca'];
                    }
                    if(isset($i['independiente'])){
                        $ind = $i['independiente'];
                    }
                    if(isset($i['asociacion'])){
                        $asociacion = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$i['asociacion']));
                    }
                    if(isset($i['macrogrupo'])){
                        $macrogrupo = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$i['macrogrupo']));
                    }
                    if(isset($i['grupo'])){
                        $grupo = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$i['grupo']));
                    }
                    if(isset($i['nuevaasociacion'])){
                        $nuevaasociacion = $i['nuevaasociacion'];
                    }
                    if(isset($i['nuevomacrogrupo'])){
                        $nuevomacrogrupo = $i['nuevomacrogrupo'];
                    }
                    if(isset($i['nuevogrupo'])){
                        $nuevogrupo = $i['nuevogrupo'];
                    }
                endforeach;

                $formData->setActivo(1);
                $formData->setFechaAlta(new \DateTime("now"));
                $formData->setCategorias($categoria);
                if($ind==0){
                    if(isset($asociacion) && count($asociacion)>0){
                        if(isset($macrogrupo) && count($macrogrupo)>0){
                            if(isset($grupo) && count($grupo)>0){
                                $formData->setGrupos($grupo);
                            }elseif(isset($nuevogrupo) && $nuevogrupo!=null){
                                $newgru = new Grupos();
                                $newgru->setActivo(1);
                                $newgru->setIdGrupoPadre($macrogrupo->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>3));
                                $newgru->setTipoGrupos($ti);
                                $newgru->setNombre($nuevogrupo);
                                $em->persist($newgru);
                                $em->flush();
                                $formData->setGrupos($newgru);
                            }else{
                                $formData->setGrupos($macrogrupo);
                            }
                        }elseif (isset($nuevomacrogrupo) && $nuevomacrogrupo!=null){
                            $newuni = new Grupos();
                            $newuni->setActivo(1);
                            $newuni->setIdGrupoPadre($asociacion->getId());
                            $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>2));
                            $newuni->setTipoGrupos($ti);
                            $newuni->setNombre($nuevomacrogrupo);
                            $em->persist($newuni);
                            $em->flush();
                            if(isset($nuevogrupo) && $nuevogrupo!=null){
                                $newgru = new Grupos();
                                $newgru->setActivo(1);
                                $newgru->setIdGrupoPadre($newuni->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>3));
                                $newgru->setTipoGrupos($ti);
                                $newgru->setNombre($nuevogrupo);
                                $em->persist($newgru);
                                $em->flush();
                                $formData->setGrupos($newgru);
                            }else{
                                $formData->setGrupos($newuni);
                            }
                        }else{
                            if(isset($grupo) && count($grupo)>0){
                                $formData->setGrupos($grupo);
                            }else{
                                $formData->setGrupos($asociacion);
                            }
                        }
                    }elseif (isset($nuevaasociacion) && $nuevaasociacion!=null){
                        if(isset($nuevomacrogrupo) && $nuevomacrogrupo!=null){
                            if(isset($nuevogrupo) && $nuevogrupo!=null){
                                $newaso = new Grupos();
                                $newaso->setActivo(1);
                                $newaso->setIdGrupoPadre(0);
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>1));
                                $newaso->setTipoGrupos($ti);
                                $newaso->setNombre($nuevaasociacion);
                                $em->persist($newaso);
                                $em->flush();
                                $newuni = new Grupos();
                                $newuni->setActivo(1);
                                $newuni->setIdGrupoPadre($newaso->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>2));
                                $newuni->setTipoGrupos($ti);
                                $newuni->setNombre($nuevomacrogrupo);
                                $em->persist($newuni);
                                $em->flush();
                                $newgru = new Grupos();
                                $newgru->setActivo(1);
                                $newgru->setIdGrupoPadre($newuni->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>3));
                                $newgru->setTipoGrupos($ti);
                                $newgru->setNombre($nuevogrupo);
                                $em->persist($newgru);
                                $em->flush();
                                $formData->setGrupos($newgru);
                            }else{
                                $newaso = new Grupos();
                                $newaso->setActivo(1);
                                $newaso->setIdGrupoPadre(0);
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>1));
                                $newaso->setTipoGrupos($ti);
                                $newaso->setNombre($nuevaasociacion);
                                $em->persist($newaso);
                                $em->flush();
                                $newuni = new Grupos();
                                $newuni->setActivo(1);
                                $newuni->setIdGrupoPadre($newaso->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>2));
                                $newuni->setTipoGrupos($ti);
                                $newuni->setNombre($nuevomacrogrupo);
                                $em->persist($newuni);
                                $em->flush();
                                $formData->setGrupos($newuni);
                            }
                        }else{
                            $newaso = new Grupos();
                            $newaso->setActivo(1);
                            $newaso->setIdGrupoPadre(0);
                            $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>1));
                            $newaso->setTipoGrupos($ti);
                            $newaso->setNombre($nuevaasociacion);
                            $em->persist($newaso);
                            $em->flush();
                            $formData->setGrupos($newaso);
                        }
                    }else{
                        if(isset($macrogrupo) && count($macrogrupo)>0){
                            if(isset($grupo) && count($grupo)>0){
                                $formData->setGrupos($grupo);
                            }elseif (isset($nuevogrupo) && $nuevogrupo!=null){
                                $newgru = new Grupos();
                                $newgru->setActivo(1);
                                $newgru->setIdGrupoPadre($macrogrupo->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>3));
                                $newgru->setTipoGrupos($ti);
                                $newgru->setNombre($nuevogrupo);
                                $em->persist($newgru);
                                $em->flush();
                                $formData->setGrupos($newgru);
                            }else{
                                $formData->setGrupos($macrogrupo);
                            }
                        }else{
                            if(isset($grupo) && count($grupo)>0){
                                $formData->setGrupos($grupo);
                            }
                        }
                    }
                }elseif ($ind==1){
                    $grupo = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>2));
                    $formData->setGrupos($grupo);
                }
                $em->persist($formData);
                $em->flush();
                $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array(),array('id'=>'DESC'),1);
                $folio = $sector->getClave().$segmento->getClave().$categoria->getClave()."-".str_pad($cliente->getId(), 5, '0', STR_PAD_LEFT)."-".date("Y");
                $cliente->setFolioGenerico($folio);
                $domicilio = new DomicilioClientes();
                $domicilio->setClientes($cliente);
                $domicilio->setColonias($colonia);
                $domicilio->setMunicipios($municipio);
                $domicilio->setIsFiscal(0);
                $domicilio->setActivo(1);
                $domicilio->setCalle($calle);
                $em->persist($domicilio);
                $em->flush();
                if(isset($igual) && $igual==1){
                    $domicilio = new DomicilioClientes();
                    $domicilio->setClientes($cliente);
                    $domicilio->setColonias($colonia);
                    $domicilio->setMunicipios($municipio);
                    $domicilio->setIsFiscal(1);
                    $domicilio->setActivo(1);
                    $domicilio->setCalle($calle);
                    $em->persist($domicilio);
                    $em->flush();
                }
                if(count($productos)>0){
                    foreach ($productos as $p):
                        $cp = new ClientesProductos();
                        $prod = $em->getRepository('CoreBundle:Productos')->findOneBy(array('id'=>$p));
                        $cp->setActivo(1);
                        $cp->setProductos($prod);
                        $cp->setClientes($cliente);
                        $em->persist($cp);
                        $em->flush();
                    endforeach;
                }
                if(!isset($igual)){
                    if($coloniaF || $municipioF){
                        $domicilio = new DomicilioClientes();
                        $domicilio->setClientes($cliente);
                        $domicilio->setColonias($coloniaF);
                        $domicilio->setMunicipios($municipioF);
                        $domicilio->setIsFiscal(1);
                        $domicilio->setActivo(1);
                        $domicilio->setCalle($calleF);
                        $em->persist($domicilio);
                        $em->flush();
                    }
                }
                $em->persist($formData);
                $em->flush();
                $flow->reset();

                return $this->redirect($this->generateUrl('regClientes'));
            }
        }

        $lista = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('isFiscal'=>0));
        $marcas = $em->getRepository('CoreBundle:Marcas')->findBy(array('activo'=>1));
        $aso = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('activo'=>1,'id'=>1));
        $asociaciones = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1,'tipoGrupos'=>$aso));
        $macro = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('activo'=>1,'id'=>2));
        $macros = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1,'tipoGrupos'=>$macro));
        $grupo = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('activo'=>1,'id'=>3));
        $grupos = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1,'tipoGrupos'=>$grupo));
        $gruposAll = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1));
        $pro = $em->getRepository('CoreBundle:ClientesProductos')->findBy(array('activo'=>1));

        return $this->render('@App/Default/clientesnew.html.twig', array(
            'form' => $form->createView(),
            'clientes' => $clientes,
            'flow' => $flow,
            'lista' => $lista,
            'marcas'=>$marcas,
            'asociaciones'=>$asociaciones,
            'macros'=>$macros,
            'grupos'=>$grupos,
            'gruposall'=>$gruposAll,
            'productos'=>$pro
        ));
    }

    /**
     * @Route("/carga-masiva-clientes", name="cargaMasiva")
     * @Method({"GET","POST"})
     */
    public function cargaXmlAction(Request $request){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),4);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $form = $this->createForm(CargaType::class,null,array(
            'method' => 'POST',
            'attr'=>array('id'=>'carga-form')
        ));
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $data = $form->getData();
                $file = $data['xml'];
                //https://publicacionexterna.azurewebsites.net/publicaciones/places
                $places = new SimpleXMLElement(file_get_contents($file));
                ini_set('max_execution_time', 1200);
                $no = 0;
                $noM = 0;
                $noA = 0;
                for ($x = 0; $x < count($places); $x++) {
                    $checkP = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('numeroPermiso' => $places->place[$x]->cre_id));
                    if (!$checkP) {
                        $categorias = $em->getRepository('CoreBundle:Categorias')->findOneBy(array('activo' => 1, 'id' => 9));
                        $tipo = $em->getRepository('CoreBundle:TipoClientes')->findOneBy(array('activo' => 1, 'id' => 2));
                        $maps = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $places->place[$x]->location->y . ',' . $places->place[$x]->location->x . '&key=AIzaSyAkBFwLSt_5jLy8CtRYtN5m5ZC6NvIdc3c', true);
                        $json = json_decode($maps, true);
                        $coloniaMaps = '';
                        $localidadMaps = '';
                        $municipioMaps = '';
                        $codigoPostalMaps = '';
                        $estadoMaps = '';

                        foreach ($json['results'] as $cliente):
                            foreach ($cliente['address_components'] as $address):
                                if ($address['types'][0] == 'political') {
                                    $coloniaMaps = $address['long_name'];
                                }
                                if ($address['types'][0] == 'locality') {
                                    $localidadMaps = $address['long_name'];
                                }
                                if ($address['types'][0] == 'administrative_area_level_2') {
                                    $municipioMaps = $address['long_name'];
                                    if (strpos($municipioMaps, ' Municipality') !== false) {
                                        $municipioMaps = str_replace(' Municipality', '', $municipioMaps);
                                    }
                                }
                                if ($address['types'][0] == 'administrative_area_level_1') {
                                    $estadoMaps = $address['long_name'];
                                }
                                if ($address['types'][0] == 'postal_code') {
                                    $codigoPostalMaps = $address['long_name'];
                                }
                            endforeach;
                            break;
                        endforeach;
                        /*print_r($localidadMaps);
                        exit;*/

                        $estado = $em->getRepository('CoreBundle:Estados')->findOneBy(array('nombre' => $estadoMaps));
                        $municipio = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('nombre' => $municipioMaps, 'estados' => $estado));

                        if (!$municipio) {
                            $lista = $em->getRepository('CoreBundle:Municipios')->findBy(array('estados' => $estado));
                            foreach ($lista as $m):
                                if($municipioMaps==''){
                                    $pos = strpos($localidadMaps, $m->getNombre());
                                    $pos1 = strpos($m->getNombre(),$localidadMaps);
                                    if ($pos !== false || $pos1 !==false) {
                                        $municipio = $m;
                                        break;
                                    }
                                }else{
                                    $pos = strpos($municipioMaps, $m->getNombre());
                                    $pos1 = strpos($m->getNombre(),$municipioMaps);
                                    if ($pos !== false || $pos1 !==false) {
                                        $municipio = $m;
                                        break;
                                    }
                                }
                            endforeach;
                        }

                        if(!$municipio){
                            $noM++;
                        }else{
                            $coloniaC = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('nombre'=>$coloniaMaps,'municipios'=>$municipio));
                            if(!$coloniaC){
                                $colonias = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios'=>$municipio));
                                if($coloniaMaps!=null){
                                    foreach ($colonias as $c):
                                        $pos = strpos($coloniaMaps, $c->getNombre());
                                        $pos1 = strpos($c->getNombre(),$coloniaMaps);
                                        if ($pos !== false || $pos1 !==false) {
                                            $coloniaC = $c;
                                            break;
                                        }
                                    endforeach;
                                }
                            }
                            if(!$coloniaC){
                                $coloniaC = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('codigoPostal'=>$codigoPostalMaps,'municipios'=>$municipio));
                            }
                            $gru = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>1));
                            if($coloniaC){
                                $cliente = new Clientes();
                                $cliente->setActivo(1);
                                $cliente->setNumeroPermiso($places->place[$x]->cre_id);
                                $cliente->setRazonSocial($places->place[$x]->name);
                                $cliente->setCoordenadaX($places->place[$x]->location->y);
                                $cliente->setCoordenadaY($places->place[$x]->location->x);
                                $cliente->setFechaAlta(new \DateTime("now"));
                                $cliente->setCategorias($categorias);
                                $cliente->setTipoClientes($tipo);
                                $cliente->setGrupos($gru);
                                $em->persist($cliente);
                                $em->flush();
                                $domicilio = new DomicilioClientes();
                                $domicilio->setClientes($cliente);
                                $domicilio->setIsFiscal(0);
                                $domicilio->setCalle($places->place[$x]->location->address_street);
                                $domicilio->setColonias($coloniaC);
                                $domicilio->setActivo(1);
                                $domicilio->setMunicipios($municipio);
                                $em->persist($domicilio);
                                $em->flush();
                                $cliente->setFolioGenerico($categorias->getSegmentos()->getSectores()->getClave().$categorias->getSegmentos()->getClave().$categorias->getClave()."-".str_pad($cliente->getId(), 5, '0', STR_PAD_LEFT)."-".date("Y"));
                                $em->persist($cliente);
                                $em->flush();
                                $noA++;
                            }else{
                                $cliente = new Clientes();
                                $cliente->setActivo(1);
                                $cliente->setNumeroPermiso($places->place[$x]->cre_id);
                                $cliente->setRazonSocial($places->place[$x]->name);
                                $cliente->setCoordenadaX($places->place[$x]->location->y);
                                $cliente->setCoordenadaY($places->place[$x]->location->x);
                                $cliente->setFechaAlta(new \DateTime("now"));
                                $cliente->setCategorias($categorias);
                                $cliente->setTipoClientes($tipo);
                                $cliente->setGrupos($gru);
                                $em->persist($cliente);
                                $em->flush();
                                $domicilio = new DomicilioClientes();
                                $domicilio->setClientes($cliente);
                                $domicilio->setIsFiscal(0);
                                $domicilio->setActivo(1);
                                $domicilio->setCalle($places->place[$x]->location->address_street);
                                $domicilio->setMunicipios($municipio);
                                $em->persist($domicilio);
                                $em->flush();
                                $cliente->setFolioGenerico($categorias->getSegmentos()->getSectores()->getClave().$categorias->getSegmentos()->getClave().$categorias->getClave()."-".str_pad($cliente->getId(), 5, '0', STR_PAD_LEFT)."-".date("Y"));
                                $em->persist($cliente);
                                $em->flush();
                                $noA++;
                            }

                        }
                    }else{
                        $no++;
                    }
                }
                return $this->redirectToRoute('regClientes');
            }
        }
        $sectores = $em->getRepository('CoreBundle:Sectores')->findBy(array('activo'=>1));
        return $this->render('@App/Default/clientesmasivo.html.twig',array(
            'form'=>$form->createView(),
            'sectores'=>$sectores
        ));
    }

    /**
     * @Route("/lista-de-clientes", name="lista-clientes")
     */
    public function listaAction(Request $request){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),5);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('CoreBundle:Clientes')->findAll();
        $form = $this->createForm('CoreBundle\Form\BusquedaClientesType');
        $form->handleRequest($request);
        $buscar1 = array();
        $buscar2 = array();
        $buscar3 = array();
        $buscar4 = array();
        $buscar5 = array();
        $buscar6 = array();
        $buscar7 = array();
        $buscar8 = array();
        $buscar9 = array();
        $buscar10 = array();
        $final = array();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $listabuscar = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('isFiscal'=>0));
            $listabuscar2 = $em->getRepository('CoreBundle:ClientesProductos')->findAll();

            if($data['numeroPermiso']!= ''){
                $numero = $data['numeroPermiso'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Clientes','c')
                    ->where('c.numeroPermiso LIKE :numero')
                    ->setParameter('numero', '%'.$numero.'%')
                    ->getQuery()
                    ->execute();

                foreach ($results as $r):
                    $check = array_keys(array_column($buscar1, 'id'), $r->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar1,$r->getId());
                    }
                endforeach;
            }else{
                foreach ($listabuscar as $z) {
                    array_push($buscar1,$z->getClientes()->getId());
                }
            }

            if($data['estacionServicio']!= ''){
                $estacion = $data['estacionServicio'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Clientes','c')
                    ->where('c.estacionServicio LIKE :estacion')
                    ->setParameter('estacion', '%'.$estacion.'%')
                    ->getQuery()
                    ->execute();

                foreach ($results as $r):
                    $check = array_keys(array_column($buscar2, 'id'), $r->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar2,$r->getId());
                    }
                endforeach;
            }else{
                foreach ($listabuscar as $z) {
                    array_push($buscar2,$z->getClientes()->getId());
                }
            }

            if($data['razonSocial']!= ''){
                $razon = $data['razonSocial'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Clientes','c')
                    ->where('c.razonSocial LIKE :razon')
                    ->setParameter('razon', '%'.$razon.'%')
                    ->getQuery()
                    ->execute();

                foreach ($results as $r):
                    $check = array_keys(array_column($buscar3, 'id'), $r->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar3,$r->getId());
                    }
                endforeach;
            }else{
                foreach ($listabuscar as $z) {
                    array_push($buscar3,$z->getClientes()->getId());
                }
            }

            if(isset($data['marcas'])){
                $idmarcas = $data['marcas']->getId();
                foreach ($listabuscar2 as $z) {
                    if($z->getProductos()->getMarcas() != null && $z->getProductos()->getMarcas()->getId()==$idmarcas){
                        $check = array_keys(array_column($buscar4, 'id'), $z->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar4,$z->getClientes()->getId());
                        }
                    }
                }
            }else{
                foreach ($listabuscar as $z) {
                    array_push($buscar4,$z->getClientes()->getId());
                }
            }

            if(isset($data['asociacion'])){
                $idasociacion = $data['asociacion']->getId();
                foreach ($listabuscar as $y) {
                    if($y->getClientes()->getGrupos() != null && $y->getClientes()->getGrupos()->getId()==$idasociacion){
                        $check = array_keys(array_column($buscar5, 'id'), $y->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar5,$y->getClientes()->getId());
                        }
                    }
                    if($y->getClientes()->getGrupos() != null && $y->getClientes()->getGrupos()->getIdGrupoPadre()==$idasociacion){
                        $check = array_keys(array_column($buscar5, 'id'), $y->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar5,$y->getClientes()->getId());
                        }
                    }
                    $padre = null;
                    if($y->getClientes()->getGrupos() != null){
                        $padre = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$y->getClientes()->getGrupos()->getIdGrupoPadre()));
                    }
                    if($y->getClientes()->getGrupos() != null && count($padre)>0 && $padre->getIdGrupoPadre()==$idasociacion){
                        $check = array_keys(array_column($buscar5, 'id'), $y->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar5,$y->getClientes()->getId());
                        }
                    }
                }
            }else{
                foreach ($listabuscar as $y) {
                    array_push($buscar5,$y->getClientes()->getId());
                }
            }

            if(isset($data['macrogrupos'])){
                $idmacrogrupos = $data['macrogrupos']->getId();
                foreach ($listabuscar as $y) {
                    if($y->getClientes()->getGrupos() != null && $y->getClientes()->getGrupos()->getId()==$idmacrogrupos){
                        $check = array_keys(array_column($buscar6, 'id'), $y->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar6,$y->getClientes()->getId());
                        }
                    }
                    if($y->getClientes()->getGrupos() != null && $y->getClientes()->getGrupos()->getIdGrupoPadre()==$idmacrogrupos){
                        $check = array_keys(array_column($buscar6, 'id'), $y->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar6,$y->getClientes()->getId());
                        }
                    }
                }
            }else{
                foreach ($listabuscar as $y) {
                    array_push($buscar6,$y->getClientes()->getId());
                }
            }

            if(isset($data['grupo'])){
                $idgrupos = $data['grupo']->getId();
                foreach ($listabuscar as $y) {
                    if($y->getClientes()->getGrupos() != null && $y->getClientes()->getGrupos()->getId()==$idgrupos){
                        $check = array_keys(array_column($buscar7, 'id'), $y->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar7,$y->getClientes()->getId());
                        }
                    }
                }
            }else{
                foreach ($listabuscar as $y) {
                    array_push($buscar7,$y->getClientes()->getId());
                }
            }


            if(isset($data['categorias'])){
                $idcategorias = $data['categorias']->getId();
                foreach ($listabuscar as $y) {
                    if($y->getClientes()->getCategorias()->getId()==$idcategorias){
                        $check = array_keys(array_column($buscar8, 'id'), $y->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar8,$y->getClientes()->getId());
                        }
                    }
                }
            }else{
                foreach ($listabuscar as $y) {
                    array_push($buscar8,$y->getClientes()->getId());
                }
            }

            if(isset($data['estado'])){
                $idestado = $data['estado']->getId();
                foreach ($listabuscar as $x) {
                    if($x->getMunicipios()->getEstados()->getId()==$idestado){
                        $check = array_keys(array_column($buscar9, 'id'), $x->getClientes()->getId());

                        if(count($check)>0){

                        }else{
                            array_push($buscar9,$x->getClientes()->getId());
                        }
                    }
                }
            }else{
                foreach ($listabuscar as $x) {
                    array_push($buscar9,$x->getClientes()->getId());
                }
            }
            if(isset($data['tipoCliente'])){
                $idtipocliente = $data['tipoCliente']->getId();
                foreach ($listabuscar as $x) {
                    if($x->getClientes()->getTipoClientes()->getId()==$idtipocliente){
                        $check = array_keys(array_column($buscar10, 'id'), $x->getClientes()->getId());
                        if(count($check)>0){

                        }else{
                            array_push($buscar10,$x->getClientes()->getId());
                        }
                    }
                }
            }else{
                foreach ($listabuscar as $x) {
                    array_push($buscar10,$x->getClientes()->getId());
                }
            }

            $final = array_intersect($buscar1,$buscar2,$buscar3,$buscar4,$buscar5,$buscar6,$buscar7,$buscar8,$buscar9,$buscar10);
            $final = array_unique($final);
            /*$final = array_intersect($buscar4,$buscar5,$buscar9,$buscar10);
            print_r($final);
            exit;*/

            /*foreach ($final as $f):
                print_r($f."<br>");
            endforeach;
            exit;*/
            $form = $this->createForm('CoreBundle\Form\BusquedaClientesType');
        }

        $em = $this->getDoctrine()->getManager();
        $clientep = $em->getRepository('CoreBundle:ClientesProductos')->findAll();
        $lista = $em->getRepository('CoreBundle:DomicilioClientes')->findBy(array('isFiscal'=>0));
        $grupo = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1));

        return $this->render('@App/Default/clientes.html.twig', array(
            'form' => $form->createView(),
            'clientes' => $clientes,
            'clientep' => $clientep,
            'lista' => $lista,
            'final'=>$final,
            'grupos'=>$grupo
        ));
    }

    /**
     * @Route("/cliente/{id}/editar", name="editar-cliente")
     * @Method({"GET","POST"})
     */
    public function editarClienteAction(Request $request, $id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),3);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/

        $em = $this->getDoctrine()->getManager();
        $cli = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$id));
        $flow = $this->get('cmx360.form.flow.clienteReg');
        $flow->bind($cli);
        $form = $flow->createForm();

        if($flow->isValid($form)){
            $flow->saveCurrentStepData($form);
            if($flow->getCurrentStepNumber()==2){
                $data =  $flow->getRequest()->request;
                $t = array();
                array_push($t,array('estado'=>$data->all()['clientesType']['estado']));
                array_push($t,array('municipio'=>$data->all()['clientesType']['municipio']));
                array_push($t,array('colonia'=>$data->all()['clientesType']['colonia']));
                array_push($t,array('calle'=>$data->all()['clientesType']['calle']));
                if(isset($data->all()['clientesType']['igual'])){
                    array_push($t,array('igual'=>$data->all()['clientesType']['igual']));
                }
                array_push($t,array('estadoFiscal'=>$data->all()['clientesType']['estadoFiscal']));
                array_push($t,array('municipioFiscal'=>$data->all()['clientesType']['municipioFiscal']));
                array_push($t,array('coloniaFiscal'=>$data->all()['clientesType']['coloniaFiscal']));
                array_push($t,array('calleFiscal'=>$data->all()['clientesType']['calleFiscal']));
                $this->get('session')->set('datos2', $t);
            }
            if($flow->getCurrentStepNumber()==3){
                $data =  $flow->getRequest()->request;
                $t = array();
                array_push($t,array('sector'=>$data->all()['clientesType']['sector']));
                array_push($t,array('segmento'=>$data->all()['clientesType']['segmento']));
                array_push($t,array('categoria'=>$data->all()['clientesType']['categoria']));
                array_push($t,array('marca'=>$data->all()['clientesType']['marca']));
                array_push($t,array('nuevamarca'=>$data->all()['clientesType']['nuevamarca']));
                array_push($t,array('independiente'=>$data->all()['clientesType']['independiente']));
                array_push($t,array('lista'=>$data->all()['clientesType']['lista']));
                if($data->all()['clientesType']['independiente']==0){
                    if(isset($data->all()['clientesType']['asociacion'])){
                        array_push($t,array('asociacion'=>$data->all()['clientesType']['asociacion']));
                        array_push($t,array('nuevaasociacion'=>$data->all()['clientesType']['nuevaasociacion']));
                    }
                    if(isset($data->all()['clientesType']['macrogrupo'])){
                        array_push($t,array('macrogrupo'=>$data->all()['clientesType']['macrogrupo']));
                        array_push($t,array('nuevomacrogrupo'=>$data->all()['clientesType']['nuevomacrogrupo']));
                    }
                    if(isset($data->all()['clientesType']['grupo'])){
                        array_push($t,array('grupo'=>$data->all()['clientesType']['grupo']));
                        array_push($t,array('nuevogrupo'=>$data->all()['clientesType']['nuevogrupo']));
                    }
                }
                $this->get('session')->set('datos3', $t);
            }
            if ($flow->nextStep()) {
                $form = $flow->createForm();
            } else {
                $sessionVal2 = $this->get('session')->get('datos2');
                foreach ($sessionVal2 as $i):
                    if(isset($i['colonia'])){
                        $colonia = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('id'=>$i['colonia']));
                    }
                    if(isset($i['municipio'])){
                        $municipio = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$i['municipio']));
                    }
                    if(isset($i['estado'])){
                        $estado = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id'=>$i['estado']));
                    }
                    if(isset($i['coloniaFiscal'])){
                        $coloniaF = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('id'=>$i['coloniaFiscal']));
                    }
                    if(isset($i['municipioFiscal'])){
                        $municipioF = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id'=>$i['municipioFiscal']));
                    }
                    if(isset($i['estadoFiscal'])){
                        $estadoF = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id'=>$i['estadoFiscal']));
                    }
                    if(isset($i['igual'])){
                        $igual = $i['igual'];
                    }
                    if(isset($i['calle'])){
                        $calle = $i['calle'];
                    }
                    if(isset($i['calleFiscal'])){
                        $calleF = $i['calleFiscal'];
                    }
                endforeach;
                $sessionVal3 = $this->get('session')->get('datos3');
                foreach ($sessionVal3 as $i):
                    if(isset($i['sector'])){
                        $sector = $em->getRepository('CoreBundle:Sectores')->findOneBy(array('id'=>$i['sector']));
                    }
                    if(isset($i['segmento'])){
                        $segmento = $em->getRepository('CoreBundle:Segmentos')->findOneBy(array('id'=>$i['segmento']));
                    }
                    if(isset($i['categoria'])){
                        $categoria = $em->getRepository('CoreBundle:Categorias')->findOneBy(array('id'=>$i['categoria']));
                    }
                    if(isset($i['marca'])){
                        $marca = $em->getRepository('CoreBundle:Marcas')->findOneBy(array('id'=>$i['marca']));
                    }
                    if(isset($i['lista'])){
                        $productos = explode(".",$i['lista']);
                        array_pop($productos);
                    }
                    if(isset($i['nuevamarca'])){
                        $nuevamarca = $i['nuevamarca'];
                    }
                    if(isset($i['independiente'])){
                        $ind = $i['independiente'];
                    }
                    if(isset($i['asociacion'])){
                        $asociacion = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$i['asociacion']));
                    }
                    if(isset($i['macrogrupo'])){
                        $macrogrupo = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$i['macrogrupo']));
                    }
                    if(isset($i['grupo'])){
                        $grupo = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$i['grupo']));
                    }
                    if(isset($i['nuevaasociacion'])){
                        $nuevaasociacion = $i['nuevaasociacion'];
                    }
                    if(isset($i['nuevomacrogrupo'])){
                        $nuevomacrogrupo = $i['nuevomacrogrupo'];
                    }
                    if(isset($i['nuevogrupo'])){
                        $nuevogrupo = $i['nuevogrupo'];
                    }
                endforeach;

                $cli->setFechaModificacion(new \DateTime("now"));
                $cli->setCategorias($categoria);
                if($ind==0){
                    if(isset($asociacion) && count($asociacion)>0){
                        if(isset($macrogrupo) && count($macrogrupo)>0){
                            if(isset($grupo) && count($grupo)>0){
                                $cli->setGrupos($grupo);
                            }elseif(isset($nuevogrupo) && $nuevogrupo!=null){
                                $newgru = new Grupos();
                                $newgru->setActivo(1);
                                $newgru->setIdGrupoPadre($macrogrupo->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>3));
                                $newgru->setTipoGrupos($ti);
                                $newgru->setNombre($nuevogrupo);
                                $em->persist($newgru);
                                $em->flush();
                                $cli->setGrupos($newgru);
                            }else{
                                $cli->setGrupos($macrogrupo);
                            }
                        }elseif (isset($nuevomacrogrupo) && $nuevomacrogrupo!=null){
                            $newuni = new Grupos();
                            $newuni->setActivo(1);
                            $newuni->setIdGrupoPadre($asociacion->getId());
                            $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>2));
                            $newuni->setTipoGrupos($ti);
                            $newuni->setNombre($nuevomacrogrupo);
                            $em->persist($newuni);
                            $em->flush();
                            if(isset($nuevogrupo) && $nuevogrupo!=null){
                                $newgru = new Grupos();
                                $newgru->setActivo(1);
                                $newgru->setIdGrupoPadre($newuni->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>3));
                                $newgru->setTipoGrupos($ti);
                                $newgru->setNombre($nuevogrupo);
                                $em->persist($newgru);
                                $em->flush();
                                $cli->setGrupos($newgru);
                            }else{
                                $cli->setGrupos($newuni);
                            }
                        }else{
                            if(isset($grupo) && count($grupo)>0){
                                $cli->setGrupos($grupo);
                            }else{
                                $cli->setGrupos($asociacion);
                            }
                        }
                    }elseif (isset($nuevaasociacion) && $nuevaasociacion!=null){
                        if(isset($nuevomacrogrupo) && $nuevomacrogrupo!=null){
                            if(isset($nuevogrupo) && $nuevogrupo!=null){
                                $newaso = new Grupos();
                                $newaso->setActivo(1);
                                $newaso->setIdGrupoPadre(0);
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>1));
                                $newaso->setTipoGrupos($ti);
                                $newaso->setNombre($nuevaasociacion);
                                $em->persist($newaso);
                                $em->flush();
                                $newuni = new Grupos();
                                $newuni->setActivo(1);
                                $newuni->setIdGrupoPadre($newaso->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>2));
                                $newuni->setTipoGrupos($ti);
                                $newuni->setNombre($nuevomacrogrupo);
                                $em->persist($newuni);
                                $em->flush();
                                $newgru = new Grupos();
                                $newgru->setActivo(1);
                                $newgru->setIdGrupoPadre($newuni->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>3));
                                $newgru->setTipoGrupos($ti);
                                $newgru->setNombre($nuevogrupo);
                                $em->persist($newgru);
                                $em->flush();
                                $cli->setGrupos($newgru);
                            }else{
                                $newaso = new Grupos();
                                $newaso->setActivo(1);
                                $newaso->setIdGrupoPadre(0);
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>1));
                                $newaso->setTipoGrupos($ti);
                                $newaso->setNombre($nuevaasociacion);
                                $em->persist($newaso);
                                $em->flush();
                                $newuni = new Grupos();
                                $newuni->setActivo(1);
                                $newuni->setIdGrupoPadre($newaso->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>2));
                                $newuni->setTipoGrupos($ti);
                                $newuni->setNombre($nuevomacrogrupo);
                                $em->persist($newuni);
                                $em->flush();
                                $cli->setGrupos($newuni);
                            }
                        }else{
                            $newaso = new Grupos();
                            $newaso->setActivo(1);
                            $newaso->setIdGrupoPadre(0);
                            $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>1));
                            $newaso->setTipoGrupos($ti);
                            $newaso->setNombre($nuevaasociacion);
                            $em->persist($newaso);
                            $em->flush();
                            $cli->setGrupos($newaso);
                        }
                    }else{
                        if(isset($macrogrupo) && count($macrogrupo)>0){
                            if(isset($grupo) && count($grupo)>0){
                                $cli->setGrupos($grupo);
                            }elseif (isset($nuevogrupo) && $nuevogrupo!=null){
                                $newgru = new Grupos();
                                $newgru->setActivo(1);
                                $newgru->setIdGrupoPadre($macrogrupo->getId());
                                $ti = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('id'=>3));
                                $newgru->setTipoGrupos($ti);
                                $newgru->setNombre($nuevogrupo);
                                $em->persist($newgru);
                                $em->flush();
                                $cli->setGrupos($newgru);
                            }else{
                                $cli->setGrupos($macrogrupo);
                            }
                        }else{
                            if(isset($grupo) && count($grupo)>0){
                                $cli->setGrupos($grupo);
                            }
                        }
                    }
                }elseif ($ind==1){
                    $grupo = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>2));
                    $cli->setGrupos($grupo);
                }
                $em->persist($cli);
                $em->flush();
                $cliente = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=>$id));
                $folio = $sector->getClave().$segmento->getClave().$categoria->getClave()."-".str_pad($cliente->getId(), 5, '0', STR_PAD_LEFT)."-".date("Y");
                $cliente->setFolioGenerico($folio);
                $domicilio = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente,'isFiscal'=>0));
                $domicilio->setColonias($colonia);
                $domicilio->setMunicipios($municipio);
                $domicilio->setIsFiscal(0);
                $domicilio->setActivo(1);
                $domicilio->setCalle($calle);
                $em->persist($domicilio);
                $em->flush();
                if(isset($igual) && $igual==1){
                    $domicilio = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente,'isFiscal'=>1));
                    if(count($domicilio)>0){

                    }else{
                        $domicilio = new DomicilioClientes();
                        $domicilio->setIsFiscal(1);
                        $domicilio->setClientes($cliente);
                    }
                    $domicilio->setColonias($colonia);
                    $domicilio->setMunicipios($municipio);
                    $domicilio->setActivo(1);
                    $domicilio->setCalle($calle);
                    $em->persist($domicilio);
                    $em->flush();
                }
                if(count($productos)>0){
                    $lp = $em->getRepository('CoreBundle:ClientesProductos')->findBy(array('clientes'=>$cliente));
                    foreach ($lp as $d):
                        $em->remove($d);
                        $em->flush();
                    endforeach;
                    foreach ($productos as $p):
                        $cp = new ClientesProductos();
                        $prod = $em->getRepository('CoreBundle:Productos')->findOneBy(array('id'=>$p));
                        $cp->setActivo(1);
                        $cp->setProductos($prod);
                        $cp->setClientes($cliente);
                        $em->persist($cp);
                        $em->flush();
                    endforeach;
                }
                if(!isset($igual)){
                    if($coloniaF || $municipioF){
                        $domicilio = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente,'isFiscal'=>1));
                        if(count($domicilio)>0){

                        }else{
                            $domicilio = new DomicilioClientes();
                            $domicilio->setIsFiscal(1);
                            $domicilio->setActivo(1);
                            $domicilio->setClientes($cliente);
                        }
                        $domicilio->setColonias($coloniaF);
                        $domicilio->setMunicipios($municipioF);
                        $domicilio->setCalle($calleF);
                        $em->persist($domicilio);
                        $em->flush();
                    }
                }
                $em->persist($cliente);
                $em->flush();
                $flow->reset();

                return $this->redirect($this->generateUrl('regClientes'));
            }
        }

        $datos = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cli,'isFiscal'=>0));
        $datosF = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cli,'isFiscal'=>1));
        $datosP = $em->getRepository('CoreBundle:ClientesProductos')->findBy(array('clientes'=>$cli,'activo'=>1));
        $cprod = array();
        foreach ($datosP as $temp):
            array_push($cprod, $temp->getProductos()->getId());
        endforeach;
        $marcas = $em->getRepository('CoreBundle:Marcas')->findBy(array('activo'=>1));
        $segmentos = $em->getRepository('CoreBundle:Segmentos')->findBy(array('activo'=>1,'sectores'=>$datos->getClientes()->getCategorias()->getSegmentos()->getSectores()));
        $categorias = $em->getRepository('CoreBundle:Categorias')->findBy(array('activo'=>1,'segmentos'=>$datos->getClientes()->getCategorias()->getSegmentos()));
        $productos = null;
        if($datosP){
            $productos = $em->getRepository('CoreBundle:Productos')->findBy(array('activo'=>1,'marcas'=>$datosP[0]->getProductos()->getMarcas()));
        }
        $aso = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('activo'=>1,'id'=>1));
        $asociaciones = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1,'tipoGrupos'=>$aso));
        $macro = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('activo'=>1,'id'=>2));
        $macros = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1,'tipoGrupos'=>$macro));
        $grupo = $em->getRepository('CoreBundle:TipoGrupos')->findOneBy(array('activo'=>1,'id'=>3));
        $grupos = $em->getRepository('CoreBundle:Grupos')->findBy(array('activo'=>1,'tipoGrupos'=>$grupo));

        $municipios = $em->getRepository('CoreBundle:Municipios')->findBy(array('estados'=>$datos->getMunicipios()->getEstados()),array('nombre'=>'ASC'));
        $colonias = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios'=>$datos->getMunicipios()),array('nombre'=>'ASC'));
        if($datosF){
            $municipiosF = $em->getRepository('CoreBundle:Municipios')->findBy(array('estados'=>$datosF->getMunicipios()->getEstados()),array('nombre'=>'ASC'));
            $coloniasF = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios'=>$datosF->getMunicipios()),array('nombre'=>'ASC'));
        }else{
            $municipiosF = null;
            $coloniasF = null;
        }
        $asoc = 0;
        if($datos->getClientes()->getGrupos()!=null && $datos->getClientes()->getGrupos()->getTipoGrupos()->getId()==3){
            $tmp = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('activo'=>1,'id'=>$datos->getClientes()->getGrupos()->getIdGrupoPadre()));
            $asoc = $tmp->getIdGrupoPadre();
        }

        return $this->render('@App/Default/clientesedit.html.twig',array(
            'form' => $form->createView(),
            'cliente' => $cli,
            'flow' => $flow,
            'datos' => $datos,
            'datosF' => $datosF,
            'datosP'=>$datosP,
            'marcas'=>$marcas,
            'segmentos'=>$segmentos,
            'categorias'=>$categorias,
            'productos'=>$productos,
            'clientep'=>$cprod,
            'asociaciones'=>$asociaciones,
            'macros'=>$macros,
            'grupos'=>$grupos,
            'asoc'=>$asoc,
            'municipiocliente'=>$municipios,
            'coloniascliente'=>$colonias,
            'municipioclienteF'=>$municipiosF,
            'coloniasclienteF'=>$coloniasF
        ));
    }

    /**
     * @Route("/clientes/{id}", name="consulta-cliente")
     */
    public function consultaClienteAction($id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),5);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $cliente =$em->getRepository('CoreBundle:Clientes')->findOneBy(array('id'=> $id));
        if(!$cliente){
            return $this->redirectToRoute('lista-clientes');
        }
        $domicilio = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente,'isFiscal'=> 0));
        $domiciliof = $em->getRepository('CoreBundle:DomicilioClientes')->findOneBy(array('clientes'=>$cliente, 'isFiscal'=>1));
        $productos = $em->getRepository('CoreBundle:ClientesProductos')->findBy(array('clientes'=>$cliente));


        return $this->render('@App/Default/clienteconsulta.html.twig', array(
            'domicilio' => $domicilio,
            'domiciliof' => $domiciliof,
            'productos' => $productos
        ));

    }

    /**
     * @Route("/municipios-json", name="municipios-json")
     */
    public function jsonMAction(Request $request)
    {
        $id = $request->request->get('estado');
        $em = $this->getDoctrine()->getManager();
        $estado = $em->getRepository('CoreBundle:Estados')->findOneBy(array('id' => $id));
        $mun = $em->getRepository('CoreBundle:Municipios')->findBy(array('estados' => $estado, 'activo' => 1),array('nombre'=>'ASC'));
        $muns = array();
        foreach ($mun as $m):
            array_push($muns, array('id' => $m->getId(), 'municipio' => $m->getNombre()));
        endforeach;

        return new Response(
            json_encode($muns),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/colonias-json", name="colonias-json")
     */
    public function jsonCAction(Request $request)
    {
        $id = $request->request->get('municipio');
        $em = $this->getDoctrine()->getManager();
        $municipio = $em->getRepository('CoreBundle:Municipios')->findOneBy(array('id' => $id));
        $col = $em->getRepository('CoreBundle:Colonias')->findBy(array('municipios' => $municipio, 'activo' => 1),array('nombre'=>'ASC'));
        $cols = array();
        foreach ($col as $c):
            array_push($cols, array('id' => $c->getId(), 'colonia' => $c->getNombre(),'codigo'=>$c->getCodigoPostal()));
        endforeach;

        return new Response(
            json_encode($cols),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/producto-json", name="producto-json")
     */
    public function jsonPAction(Request $request){
        $id = $request->request->get('marca');
        $em = $this->getDoctrine()->getManager();
        $marca = $em->getRepository('CoreBundle:Marcas')->findOneBy(array('id'=>$id));
        $prod = $em->getRepository('CoreBundle:Productos')->findBy(array('marcas'=>$marca,'activo'=>1));
        $prods = array();
        foreach ($prod as $p):
            array_push($prods, array('id'=>$p->getId(),'producto'=>$p->getNombre()));
        endforeach;

        return new Response(
            json_encode($prods),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/sector-json", name="sector-json")
     */
    public function jsonSAction(Request $request){
        $id = $request->request->get('sector');
        $em = $this->getDoctrine()->getManager();
        $sector = $em->getRepository('CoreBundle:Sectores')->findOneBy(array('id'=>$id));
        $seg = $em->getRepository('CoreBundle:Segmentos')->findBy(array('sectores'=>$sector,'activo'=>1));
        $segs = array();
        foreach ($seg as $s):
            array_push($segs, array('id'=>$s->getId(),'seg'=>$s->getNombre()));
        endforeach;

        return new Response(
            json_encode($segs),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/segmento-json", name="segmento-json")
     */
    public function jsonSeAction(Request $request){
        $id = $request->request->get('segmento');
        $em = $this->getDoctrine()->getManager();
        $segmento = $em->getRepository('CoreBundle:Segmentos')->findOneBy(array('id'=>$id));
        $cat = $em->getRepository('CoreBundle:Categorias')->findBy(array('segmentos'=>$segmento,'activo'=>1));
        $cats = array();
        foreach ($cat as $c):
            array_push($cats, array('id'=>$c->getId(),'cat'=>$c->getNombre()));
        endforeach;

        return new Response(
            json_encode($cats),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/estado-codigo", name="estado-codigo")
     */
    public function estadoCodigoAction(Request $request)
    {
        $codigo = $request->request->get('codigo');
        $em = $this->getDoctrine()->getManager();
        $colonia = $em->getRepository('CoreBundle:Colonias')->findOneBy(array('codigoPostal' => $codigo));
        $select = array();
        $estado = $colonia->getMunicipios()->getEstados()->getId();
        $select['estado']=$estado;
        $municipio = $colonia->getMunicipios()->getId();
        $select['municipio']=$municipio;
        return new Response(
            json_encode($select),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/permiso", name="permiso")
     */
    public function permisoAction(Request $request){
        $permiso = $request->request->get('permiso');
        $em = $this->getDoctrine()->getManager();
        $existe = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('numeroPermiso' => $permiso));
        if(count($existe)>0){
            $check = 1;
        }else{
            $check =0;
        }
        return new Response(
            json_encode($check),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/permiso-editar", name="permiso-editar")
     */
    public function permisoEditarAction(Request $request){
        $permiso = $request->request->get('permiso');
        $folio = $request->request->get('folio');
        $em = $this->getDoctrine()->getManager();
        $existe = $em->getRepository('CoreBundle:Clientes')->findOneBy(array('numeroPermiso' => $permiso));
        if(count($existe)>0){
            if($existe->getFolioGenerico()==$folio){
                $check = 0;
            }else{
                $check = 1;
            }
        }else{
            $check =0;
        }
        return new Response(
            json_encode($check),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/asociacion-json", name="asociacion-json")
     */
    public function jsonAsoAction(Request $request){
        $id = $request->request->get('asociacion');
        $em = $this->getDoctrine()->getManager();
        $asociacion = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$id));
        $uni = $em->getRepository('CoreBundle:Grupos')->findBy(array('idGrupoPadre'=>$asociacion->getId(),'activo'=>1));
        $unis = array();
        foreach ($uni as $u):
            array_push($unis, array('id'=>$u->getId(),'union'=>$u->getNombre(),'padre'=>$u->getIdGrupoPadre()));
        endforeach;

        return new Response(
            json_encode($unis),
            200,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/union-json", name="union-json")
     */
    public function jsonUniAction(Request $request){
        $id = $request->request->get('union');
        $em = $this->getDoctrine()->getManager();
        $union = $em->getRepository('CoreBundle:Grupos')->findOneBy(array('id'=>$id));
        $gru = $em->getRepository('CoreBundle:Grupos')->findBy(array('idGrupoPadre'=>$union->getId(),'activo'=>1));
        $grus = array();
        foreach ($gru as $g):
            array_push($grus, array('id'=>$g->getId(),'grupo'=>$g->getNombre(),'padre'=>$g->getIdGrupoPadre()));
        endforeach;

        return new Response(
            json_encode($grus),
            200,
            array('Content-Type' => 'application/json')
        );
    }
}
