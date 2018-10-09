<?php

namespace AppBundle\Controller;


use CoreBundle\Entity\Caidas;
use CoreBundle\Form\CsvType;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Reader_CSV;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction(){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if(is_object($user)){
            return $this->redirectToRoute('index');
        }else{
            return $this->redirectToRoute('login');
        }
    }


    /**
     * @Route("/index", name="index")
     */
    public function indexAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if(is_object($user)){
            return $this->render('@App/Default/index.html.twig');
        }else{
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @Route("/cargar-csv", name="csv")
     * @Method({"GET","POST"})
     */
    public function csvAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if(is_object($user)){
            $form = $this->createForm(CsvType::class,null,array(
                'method' => 'POST',
                'attr'=>array('id'=>'carga-form')
            ));

            $em = $this->getDoctrine()->getManager();

            $form->handleRequest($request);


            if ($form->isSubmitted()) {
                if($form->isValid()) {
                    $data = $form->getData();
                    $file = $data['csv'];
                    $tipo = $data['tipo'];
                    if($tipo == 1) {
                        if ($file->guessExtension() == 'csv' || $file->guessExtension() == 'txt') {
                            $caidas = $em->getRepository('CoreBundle:Caidas')->findBy(array('tipo'=>1));
                            foreach ($caidas as $c):
                                $em->remove($c);
                                $em->flush();
                            endforeach;

                            $connection = $this->getDoctrine()->getEntityManager()->getConnection();
                            $connection->exec("ALTER TABLE caidas AUTO_INCREMENT = 1;");
                            $objReader = PHPExcel_IOFactory::createReader('CSV');
                            $objReader->setInputEncoding('ISO-8859-1');
                            $objPHPExcel = $objReader->load($file);
                            $worksheet = $objPHPExcel->getActiveSheet();
                            foreach ($worksheet->getRowIterator() as $row) {
                                $cellIterator = $row->getCellIterator();
                                $caida = new Caidas();
                                $cellIterator->setIterateOnlyExistingCells(false);
                                foreach ($cellIterator as $cell) {
                                    if (!is_null($cell)) {
                                        //echo 'Cell: ' . $cell->getCoordinate() . ' - ' . $cell->getValue() . "\r\n";
                                        if (strpos($cell->getCoordinate(), 'A') !== false) {
                                            $caida->setIdc($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'B') !== false) {
                                            $caida->setNoEstacion($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'C') !== false) {
                                            $caida->setRazonSocial($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'D') !== false) {
                                            $caida->setDireccion($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'E') !== false) {
                                            $caida->setAlfanum($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'F') !== false) {
                                            $caida->setFechaPublicacion($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'G') !== false) {
                                            $caida->setFechaInicio($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'H') !== false) {
                                            $caida->setNombreReviso($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'I') !== false) {
                                            $caida->setPuestoReviso($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'J') !== false) {
                                            $caida->setQuienAprobo($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'K') !== false) {
                                            $caida->setPuestoAprobo($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'L') !== false) {
                                            $caida->setPermiso($cell->getValue());
                                        }
                                    }
                                }
                                $caida->setTipo(1);
                                $em->persist($caida);
                                $em->flush();
                            }
                            return $this->redirectToRoute('index');
                        }
                    }elseif ($tipo == 2){
                        if ($file->guessExtension() == 'csv' || $file->guessExtension() == 'txt') {
                            $caidas = $em->getRepository('CoreBundle:Caidas')->findBy(array('tipo'=>2));
                            foreach ($caidas as $c):
                                $em->remove($c);
                                $em->flush();
                            endforeach;

                            $connection = $this->getDoctrine()->getEntityManager()->getConnection();
                            $connection->exec("ALTER TABLE caidas AUTO_INCREMENT = 1;");
                            $objReader = PHPExcel_IOFactory::createReader('CSV');
                            $objReader->setInputEncoding('ISO-8859-1');
                            $objPHPExcel = $objReader->load($file);
                            $worksheet = $objPHPExcel->getActiveSheet();
                            foreach ($worksheet->getRowIterator() as $row) {
                                $cellIterator = $row->getCellIterator();
                                $caida = new Caidas();
                                $cellIterator->setIterateOnlyExistingCells(false);
                                foreach ($cellIterator as $cell) {
                                    if (!is_null($cell)) {
                                        //echo 'Cell: ' . $cell->getCoordinate() . ' - ' . $cell->getValue() . "\r\n";
                                        if (strpos($cell->getCoordinate(), 'A') !== false) {
                                            $caida->setIdc($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'B') !== false) {
                                            $caida->setNoEstacion($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'C') !== false) {
                                            $caida->setRazonSocial($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'D') !== false) {
                                            $caida->setDireccion($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'E') !== false) {
                                            $caida->setAlfanum($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'F') !== false) {
                                            $caida->setFechaPublicacion($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'G') !== false) {
                                            $caida->setFechaInicio($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'H') !== false) {
                                            $caida->setNombreReviso($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'I') !== false) {
                                            $caida->setPuestoReviso($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'J') !== false) {
                                            $caida->setQuienAprobo($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'K') !== false) {
                                            $caida->setPuestoAprobo($cell->getValue());
                                        }
                                        if (strpos($cell->getCoordinate(), 'L') !== false) {
                                            $caida->setPermiso($cell->getValue());
                                        }
                                    }
                                }
                                $caida->setTipo(2);
                                $em->persist($caida);
                                $em->flush();
                            }
                            return $this->redirectToRoute('index');
                        }
                    }
                }
            }
            return $this->render('@App/Default/csv.html.twig',array(
                'form'=>$form->createView(),

            ));
        }else{
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @Route("/centros-de-distribucion", name="centros")
     */
    public function centrosAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if(is_object($user)){
            $query = $this->getDoctrine()->getManager();
            $info =  $query->getRepository('CoreBundle:Caidas')->findBy(array('tipo'=>2));
            $doc = $query->getRepository('CoreBundle:Documentos')->findAll();
            return $this->render('@App/Default/centros.html.twig', array('info'=> $info, 'doc'=>$doc));
        }else{
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @Route("/estaciones-de-servicio", name="estaciones")
     */
    public function estacionesAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if(is_object($user)){
            $query = $this->getDoctrine()->getManager();
            $info =  $query->getRepository('CoreBundle:Caidas')->findBy(array('tipo'=>1));
            $doc = $query->getRepository('CoreBundle:Documentos')->findAll();
            return $this->render('@App/Default/estaciones.html.twig', array('info'=> $info, 'doc'=>$doc));
        }else{
            return $this->redirectToRoute('login');
        }
    }

    /**
     * @Route("/doc/{iddoc}/{idinfo}/" , name="doc")
     */
    public function documentosAction(Request $request, $iddoc, $idinfo)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if(is_object($user)){
            $query = $this->getDoctrine()->getManager();
            $documento = $query->getRepository('CoreBundle:Documentos')->findOneBy(array('id'=> $iddoc));
            $info =  $query->getRepository('CoreBundle:Caidas')->findOneBy(array('idc'=>$idinfo));

            if($info->getTipo() == 1) {
                $templateWord = new TemplateProcessor('S:\TI-ASEA\09-07-2018\ELEMENTOS COMPLETOS\ESTACIONES DE SERVICIO' . DIRECTORY_SEPARATOR . $documento->getUrl());
                if ($documento->getTipo() == 1) {
                    $templateWord->setValue('Value1', $info->getNoEstacion());
                    $templateWord->setValue('Value2', $info->getRazonSocial());
                    $templateWord->setValue('Value3', $info->getDireccion());
                    $templateWord->setValue('Value4', $info->getAlfanum());
                    $templateWord->setValue('Value5', $info->getFechaPublicacion());
                    $templateWord->setValue('Value6', $info->getFechaInicio());
                    $templateWord->setValue('Value7', $info->getNombreReviso());
                    $templateWord->setValue('Value8', $info->getPuestoReviso());
                    $templateWord->setValue('Value9', $info->getQuienAprobo());
                    $templateWord->setValue('Value10', $info->getPuestoAprobo());
                    $templateWord->setValue('Value11', $info->getPermiso());
                    $templateWord->saveAs($documento->getUrl());
                    header("Content-Disposition: attachment; filename=" . $documento->getUrl() . "; charset=iso-8859-1");
                    echo file_get_contents($documento->getUrl());
                    unlink($documento->getUrl());
                    exit;
                } elseif ($documento->getTipo() == 2) {
                    $objPHPExcel = new PHPExcel();
                    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                    $objPHPExcel = $objReader->load('S:\TI-ASEA\09-07-2018\ELEMENTOS COMPLETOS\ESTACIONES DE SERVICIO' . DIRECTORY_SEPARATOR . $documento->getUrl());
                    if ($documento->getId() == 24) {
                        $objPHPExcel->setActiveSheetIndex(0);

                        $objPHPExcel->getActiveSheet()->SetCellValue('C4', "Anexos,Formato " .$info->getPermiso() . "-F-005");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C5', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral7, Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C6', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral 3, Vineta 2,Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C7', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral 3, Vineta 2,Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C8', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral 3, Vineta 3,Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C9', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral 3, Vineta 4,Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C13', "Procedimiento " .$info->getPermiso() . "-P-004");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C14', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 4, Pág 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C15', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 6, Pág 9.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C16', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.2, Pág 9.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C17', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 10, Pág 10.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C19', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 4, Viñeta 6, Pág 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C20', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.1.4, Viñeta 2, Pág 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C21', "Procedimiento " .$info->getPermiso() . "-P-004");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C22', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.1.1, Pág 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C23', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.1, Pág 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C24', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.2.1, Pág 9.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C25', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 6, Pág 9.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C26', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 10, Pág 10.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C28', "Anexos, Formato ".$info->getPermiso() . "-F-006");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C30', "Anexos, Formato ".$info->getPermiso() . "-F-006");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C34', "Procedimiento ".$info->getPermiso() . "-P-005 \n Numerales 2 y 12, Pág. 5 y 6");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C35', "Procedimiento ".$info->getPermiso() . "-P-005 \n Numerales 5 y 9, Pág. 5");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C37', "Anexos, Formato ".$info->getPermiso() . "-F-007");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C42', "Procedimiento ".$info->getPermiso() . "-P-006, \n Numeral 6.3, Viñetas, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C43', "Procedimiento ".$info->getPermiso() . "-P-006, \n Numeral 2, Viñetas, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C45', "Anexos, Formato " .$info->getPermiso() . "-F-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C50', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 5, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C51', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 1, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C52', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 3, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C53', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 5, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C54', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 6, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C55', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 7, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C57', "Anexos, Formato ".$info->getPermiso() . "-F-011");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C62', "Procedimiento ".$info->getPermiso() . "-P-008, \n Numeral 7, 10, Pág. 5,7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C63', "Procedimiento ".$info->getPermiso() . "-P-008, \n Numeral 8, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C64', "Procedimiento ".$info->getPermiso() . "-P-008, \n Numeral 12, Viñeta 2, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C66', "Anexos, Formato ".$info->getPermiso() . "-F-014.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C67', "Anexos, Formato " .$info->getPermiso() . "-F-016");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C71', "Anexos, Formato " .$info->getPermiso() . "-F-017");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C76', "Procedimiento " .$info->getPermiso() . "-P-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C77', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 1, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C78', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 2, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C79', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 3, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C80', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 4, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C81', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 5, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C82', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 6, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C83', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 7, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C84', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 8, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C85', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 9, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C86', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 10,Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C87', "Procedimiento " .$info->getPermiso() . "-P-010");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C89', "Anexos, Formato " .$info->getPermiso() . "-F-019");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C93', "Procedimiento " .$info->getPermiso() . "-P-002, \n Numeral 8, Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C94', "Procedimiento " .$info->getPermiso() . "-P-002, \n Numeral 8, Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C96', "Anexos, Formato ".$info->getPermiso() . "-F-001 y " . $info->getPermiso() . "-F-002");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C101',"Procedimiento ".$info->getPermiso() . "-P-011, \n Numeral 3, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C103', "Anexos, Formato ". $info->getPermiso() . "-F-022");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C108', "Procedimiento " .$info->getPermiso() . "-P-012, \n Numeral 5, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C109', "Procedimiento " .$info->getPermiso() . "-P-012, \n Numeral 7, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C110', "Procedimiento " .$info->getPermiso() . "-P-012, \n Numeral 13, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C112', "Anexos, Formato " .$info->getPermiso() . "-F-023\n" . $info->getPermiso() . "-F-024");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C134', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 5, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C135', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 4, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C137', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 1,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C138', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 2,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C139', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 3,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C140', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 4,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C141', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 5,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C142', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 6,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C143', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 20, Viñeta 2,  Pág. 10.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C145', "Anexos, Formato " .$info->getPermiso() . "-F-025");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C150', "Anexos, Formato " .$info->getPermiso() . "-F-029");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C151', "Procedimiento ".$info->getPermiso() . "-P-014, \n Numeral 4, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C152', "Procedimiento ".$info->getPermiso() . "-P-014, \n Numeral 4, Apartado V, Viñeta 1, Pág.\n 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C154', "Anexos, Formato " .$info->getPermiso() . "-F-029");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C155', "Anexos, Formato " .$info->getPermiso() . "-F-030");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C160', "Procedimiento " .$info->getPermiso() . "-P-015, \n Numeral 1, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C161', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C162', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 1, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C163', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C164', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 3, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C165', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 4, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C166', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 5, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C167', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñetas 6,7 y 8, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C168', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 9 y 10, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C170', "Anexos, Formato " .$info->getPermiso() . "-F-033");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C171', "Plan " .$info->getPermiso() . "-PL-001 y Anexos, \n Formatos " . $info->getPermiso() . "-F-034");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C176', "Procedimiento " .$info->getPermiso() . "-P-017, \n Numeral 2, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C178', "Procedimiento " .$info->getPermiso() . "-P-017, \n Numeral 2, Viñeta 5, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C179', "Procedimiento " .$info->getPermiso() . "-P-018, \n Numeral 14, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C181', "Anexos, Formato " .$info->getPermiso() . "-F-035");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C188', "Procedimiento " .$info->getPermiso() . "-P-019, \n Numerales 1,5 y 22. Pág. 6, 13.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C189', "Procedimiento " .$info->getPermiso() . "-P-019, \n Numerales 19 y 23. Pág. 12, 13.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C191', "Anexos, Formato " .$info->getPermiso() . "-F-038");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C192', "Anexos, Formato " .$info->getPermiso() . "-F-040");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C197', "Procedimiento " .$info->getPermiso() . "-P-020, \n Numerales 1, 12 y 13, Pág. 7 y 8");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C199', "Anexos, Formato " .$info->getPermiso() . "-F-044; \n " . $info->getPermiso() . "-F-045 y" . $info->getPermiso() . "-F-046");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C204', "Procedimiento " .$info->getPermiso() . "-P-021");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C206', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 1, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C207', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 2, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C208', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 3, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C209', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 4, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C210', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 5, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C211', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 6, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C212', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 7, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C213', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 8, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C214', "Procedimiento " .$info->getPermiso() . "-P-021");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C215', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 13, Viñeta 1, Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C216', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 13, Viñeta 2, Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C217', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 13, Viñeta 3, Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C218', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 13, Viñeta 4, Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C223', "Procedimiento " .$info->getPermiso() . "-P-022, \n Numerales 4 y 8, Pág. 7 y 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C224', "Procedimiento " .$info->getPermiso() . "-P-022, \n Numerales 9, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C226', "Anexos, Formato " .$info->getPermiso() . "-F-051");
                    } elseif ($documento->getId() == 25) {
                        $objPHPExcel->setActiveSheetIndex(0);

                        $objPHPExcel->getActiveSheet()->SetCellValue('F4', $info->getPermiso() . "-F-005");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F9', $info->getPermiso() . "-P-021");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F11', $info->getPermiso() . "-F-006");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F13', $info->getPermiso() . "-P-004");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F15', $info->getPermiso() . "-F-006");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F17', $info->getPermiso() . "-F-007");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F19', $info->getPermiso() . "-F-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F21', $info->getPermiso() . "-F-010");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F23', $info->getPermiso() . "-F-011");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F25', $info->getPermiso() . "-F-012");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F27', $info->getPermiso() . "-F-013\n" . $info->getPermiso() . "-F-014");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F29', $info->getPermiso() . "-F-016");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F31', $info->getPermiso() . "-P-008");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F37', $info->getPermiso() . "-F-0018");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F39', $info->getPermiso() . "-P-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F61', $info->getPermiso() . "-F-020");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F63', $info->getPermiso() . "-F-002\n" . $info->getPermiso() . "-F-003");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F65', $info->getPermiso() . "-F-004");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F67', $info->getPermiso() . "-F-022");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F71', $info->getPermiso() . "-F-023\n" . $info->getPermiso() . "-F-024");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F73', $info->getPermiso() . "-P-012");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F87', $info->getPermiso() . "-F-018");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F89', $info->getPermiso() . "-F-026");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F91', $info->getPermiso() . "-F-027");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F93', $info->getPermiso() . "-P-013");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F95', $info->getPermiso() . "-F-025");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F97', $info->getPermiso() . "-F-029");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F99', $info->getPermiso() . "-F-030");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F101', $info->getPermiso() . "-F-031");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F103', $info->getPermiso() . "-F-033");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F105', $info->getPermiso() . "-PL-001");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F107', $info->getPermiso() . "-F-034");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F109', $info->getPermiso() . "-P-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F111', $info->getPermiso() . "-F-035");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F113', $info->getPermiso() . "-F-038");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F115', $info->getPermiso() . "-F-040");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F117', $info->getPermiso() . "-F-044\n" . $info->getPermiso() . "-F-045\n" . $info->getPermiso() . "-F-046");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F119', $info->getPermiso() . "-F-047");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F121', $info->getPermiso() . "-F-051");
                    }
                    //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="' . $documento->getUrl() . '"');
                    header('Cache-Control: max-age=0');
                    header('Cache-Control: max-age=1');
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    $objWriter->save('php://output');
                    exit;
                }
            }elseif ($info->getTipo() == 2){
                $templateWord = new TemplateProcessor('S:\TI-ASEA\09-07-2018\ELEMENTOS COMPLETOS\CENTROS DE DISTRIBUCION' . DIRECTORY_SEPARATOR . $documento->getUrl());
                if ($documento->getTipo() == 1) {
                    $templateWord->setValue('Value1', $info->getNoEstacion());
                    $templateWord->setValue('Value2', $info->getRazonSocial());
                    $templateWord->setValue('Value3', $info->getDireccion());
                    $templateWord->setValue('Value4', $info->getAlfanum());
                    $templateWord->setValue('Value5', $info->getFechaPublicacion());
                    $templateWord->setValue('Value6', $info->getFechaInicio());
                    $templateWord->setValue('Value7', $info->getNombreReviso());
                    $templateWord->setValue('Value8', $info->getPuestoReviso());
                    $templateWord->setValue('Value9', $info->getQuienAprobo());
                    $templateWord->setValue('Value10', $info->getPuestoAprobo());
                    $templateWord->setValue('Value11', $info->getPermiso());
                    $templateWord->saveAs($documento->getUrl());
                    header("Content-Disposition: attachment; filename=" . $documento->getUrl() . "; charset=iso-8859-1");
                    echo file_get_contents($documento->getUrl());
                    unlink($documento->getUrl());
                    exit;
                } elseif ($documento->getTipo() == 2) {
                    $objPHPExcel = new PHPExcel();
                    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                    $objPHPExcel = $objReader->load('S:\TI-ASEA\09-07-2018\ELEMENTOS COMPLETOS\CENTROS DE DISTRIBUCION' . DIRECTORY_SEPARATOR . $documento->getUrl());
                    if ($documento->getId() == 24) {
                        $objPHPExcel->setActiveSheetIndex(0);

                        $objPHPExcel->getActiveSheet()->SetCellValue('C4', "Anexos,Formato " .$info->getPermiso() . "-F-005");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C5', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral7, Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C6', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral 3, Vineta 2,Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C7', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral 3, Vineta 2,Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C8', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral 3, Vineta 3,Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C9', "Procedimiento " .$info->getPermiso() . "-P-003 \n Numeral 3, Vineta 4,Pág 4.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C13', "Procedimiento " .$info->getPermiso() . "-P-004");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C14', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 4, Pág 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C15', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 6, Pág 9.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C16', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.2, Pág 9.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C17', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 10, Pág 10.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C19', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 4, Viñeta 6, Pág 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C20', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.1.4, Viñeta 2, Pág 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C21', "Procedimiento " .$info->getPermiso() . "-P-004");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C22', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.1.1, Pág 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C23', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.1, Pág 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C24', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 5.2.1, Pág 9.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C25', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 6, Pág 9.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C26', "Procedimiento " .$info->getPermiso() . "-P-004 \n Numeral 10, Pág 10.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C28', "Anexos, Formato ".$info->getPermiso() . "-F-006");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C30', "Anexos, Formato ".$info->getPermiso() . "-F-006");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C34', "Procedimiento ".$info->getPermiso() . "-P-005 \n Numerales 2 y 12, Pág. 5 y 6");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C35', "Procedimiento ".$info->getPermiso() . "-P-005 \n Numerales 5 y 9, Pág. 5");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C37', "Anexos, Formato ".$info->getPermiso() . "-F-007");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C42', "Procedimiento ".$info->getPermiso() . "-P-006, \n Numeral 6.3, Viñetas, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C43', "Procedimiento ".$info->getPermiso() . "-P-006, \n Numeral 2, Viñetas, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C45', "Anexos, Formato " .$info->getPermiso() . "-F-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C50', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 5, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C51', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 1, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C52', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 3, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C53', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 5, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C54', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 6, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C55', "Procedimiento ".$info->getPermiso() . "-P-007, \n Numeral 7, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C57', "Anexos, Formato ".$info->getPermiso() . "-F-011");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C62', "Procedimiento ".$info->getPermiso() . "-P-008, \n Numeral 7, 10, Pág. 5,7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C63', "Procedimiento ".$info->getPermiso() . "-P-008, \n Numeral 8, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C64', "Procedimiento ".$info->getPermiso() . "-P-008, \n Numeral 12, Viñeta 2, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C66', "Anexos, Formato ".$info->getPermiso() . "-F-014.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C67', "Anexos, Formato " .$info->getPermiso() . "-F-016");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C71', "Anexos, Formato " .$info->getPermiso() . "-F-017");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C76', "Procedimiento " .$info->getPermiso() . "-P-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C77', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 1, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C78', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 2, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C79', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 3, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C80', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 4, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C81', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 5, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C82', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 6, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C83', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 7, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C84', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 8, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C85', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 2, Viñeta 9, Pág.5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C86', "Procedimiento " .$info->getPermiso() . "-P-009, \n Numeral 10,Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C87', "Procedimiento " .$info->getPermiso() . "-P-010");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C89', "Anexos, Formato " .$info->getPermiso() . "-F-019");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C93', "Procedimiento " .$info->getPermiso() . "-P-002, \n Numeral 8, Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C94', "Procedimiento " .$info->getPermiso() . "-P-002, \n Numeral 8, Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C96', "Anexos, Formato ".$info->getPermiso() . "-F-001 y " . $info->getPermiso() . "-F-002");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C101',"Procedimiento ".$info->getPermiso() . "-P-011, \n Numeral 3, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C103', "Anexos, Formato ". $info->getPermiso() . "-F-022");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C108', "Procedimiento " .$info->getPermiso() . "-P-012, \n Numeral 5, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C109', "Procedimiento " .$info->getPermiso() . "-P-012, \n Numeral 7, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C110', "Procedimiento " .$info->getPermiso() . "-P-012, \n Numeral 13, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C112', "Anexos, Formato " .$info->getPermiso() . "-F-023\n" . $info->getPermiso() . "-F-024");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C134', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 5, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C135', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 4, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C137', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 1,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C138', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 2,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C139', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 3,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C140', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 4,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C141', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 5,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C142', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 1, Viñeta 6,  Pág. 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C143', "Procedimiento " .$info->getPermiso() . "-P-013, \n Numeral 20, Viñeta 2,  Pág. 10.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C145', "Anexos, Formato " .$info->getPermiso() . "-F-025");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C150', "Anexos, Formato " .$info->getPermiso() . "-F-029");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C151', "Procedimiento ".$info->getPermiso() . "-P-014, \n Numeral 4, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C152', "Procedimiento ".$info->getPermiso() . "-P-014, \n Numeral 4, Apartado V, Viñeta 1, Pág.\n 7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C154', "Anexos, Formato " .$info->getPermiso() . "-F-029");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C155', "Anexos, Formato " .$info->getPermiso() . "-F-030");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C160', "Procedimiento " .$info->getPermiso() . "-P-015, \n Numeral 1, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C161', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C162', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 1, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C163', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 2, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C164', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 3, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C165', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 4, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C166', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 5, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C167', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñetas 6,7 y 8, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C168', "Procedimiento " .$info->getPermiso() . "-P-016, \n Numeral 2, Viñeta 9 y 10, Pág. 5.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C170', "Anexos, Formato " .$info->getPermiso() . "-F-033");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C171', "Plan " .$info->getPermiso() . "-PL-001 y Anexos, \n Formatos " . $info->getPermiso() . "-F-034");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C176', "Procedimiento " .$info->getPermiso() . "-P-017, \n Numeral 2, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C178', "Procedimiento " .$info->getPermiso() . "-P-017, \n Numeral 2, Viñeta 5, Pág. 6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C178', "Procedimiento " .$info->getPermiso() . "-P-018, \n Numeral 14, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C181', "Anexos, Formato " .$info->getPermiso() . "-F-035");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C188', "Procedimiento " .$info->getPermiso() . "-P-019, \n Numerales 1,5 y 22. Pág. 6, 13.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C189', "Procedimiento " .$info->getPermiso() . "-P-019, \n Numerales 19 y 23. Pág. 12, 13.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C191', "Anexos, Formato " .$info->getPermiso() . "-F-038");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C192', "Anexos, Formato " .$info->getPermiso() . "-F-040");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C197', "Procedimiento " .$info->getPermiso() . "-P-020, \n Numerales 1, 12 y 13, Pág. 7 y 8");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C199', "Anexos, Formato " .$info->getPermiso() . "-F-044; \n " . $info->getPermiso() . "-F-045 y" . $info->getPermiso() . "-F-046");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C204', "Procedimiento " .$info->getPermiso() . "-P-021");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C206', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 1, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C207', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 2, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C208', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 3, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C209', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 4, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C210', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 5, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C211', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 6, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C212', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 7, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C213', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 7, Viñeta 8, Pág.6.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C214', "Procedimiento " .$info->getPermiso() . "-P-021");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C215', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 13, Viñeta 1, Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C216', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 13, Viñeta 2, Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C217', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 13, Viñeta 3, Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C218', "Procedimiento " .$info->getPermiso() . "-P-021, \n Numeral 13, Viñeta 4, Pág.7.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C223', "Procedimiento " .$info->getPermiso() . "-P-022, \n Numerales 4 y 8, Pág. 7 y 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C224', "Procedimiento " .$info->getPermiso() . "-P-022, \n Numerales 9, Pág. 8.");
                        $objPHPExcel->getActiveSheet()->SetCellValue('C226', "Anexos, Formato " .$info->getPermiso() . "-F-051");
                    } elseif ($documento->getId() == 25) {
                        $objPHPExcel->setActiveSheetIndex(0);

                        $objPHPExcel->getActiveSheet()->SetCellValue('F4', $info->getPermiso() . "-P-021");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F6', $info->getPermiso() . "-F-006");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F8', $info->getPermiso() . "-P-004");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F10', $info->getPermiso() . "-F-006");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F12', $info->getPermiso() . "-F-007");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F14', $info->getPermiso() . "-F-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F16', $info->getPermiso() . "-F-010");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F18', $info->getPermiso() . "-F-011");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F20', $info->getPermiso() . "-F-012");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F22', $info->getPermiso() . "-F-013");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F23', $info->getPermiso() . "-F-014");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F24', $info->getPermiso() . "-F-016");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F26', $info->getPermiso() . "-P-008");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F32', $info->getPermiso() . "-F-0018");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F34', $info->getPermiso() . "-P-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F44', $info->getPermiso() . "-P-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F56', $info->getPermiso() . "-F-020");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F58', $info->getPermiso() . "-F-002");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F59', $info->getPermiso() . "-F-003");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F60', $info->getPermiso() . "-F-004");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F62', $info->getPermiso() . "-F-022");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F64', $info->getPermiso() . "-F-023");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F65', $info->getPermiso() . "-F-024");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F66', $info->getPermiso() . "-P-012");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F80', $info->getPermiso() . "-F-018");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F82', $info->getPermiso() . "-F-026");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F84', $info->getPermiso() . "-F-027");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F90', $info->getPermiso() . "-F-029");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F92', $info->getPermiso() . "-F-030");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F94', $info->getPermiso() . "-F-031");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F96', $info->getPermiso() . "-F-033");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F98', $info->getPermiso() . "-PL-001");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F100', $info->getPermiso() . "-F-034");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F102', $info->getPermiso() . "-P-009");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F104', $info->getPermiso() . "-F-035");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F106', $info->getPermiso() . "-F-038");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F108', $info->getPermiso() . "-F-040");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F110', $info->getPermiso() . "-F-044");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F111', $info->getPermiso() . "-F-045");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F112', $info->getPermiso() . "-F-046");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F113', $info->getPermiso() . "-F-047");
                        $objPHPExcel->getActiveSheet()->SetCellValue('F115', $info->getPermiso() . "-F-051");
                    }
                    //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment;filename="' . $documento->getUrl() . '"');
                    header('Cache-Control: max-age=0');
                    header('Cache-Control: max-age=1');
                    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                    header('Pragma: public'); // HTTP/1.0
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    $objWriter->save('php://output');
                    exit;
                }
            }
        }else{
            return $this->redirectToRoute('login');
        }
    }
}
