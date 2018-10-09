<?php

namespace AppBundle\Controller;

use CoreBundle\Entity\Campana;
use CoreBundle\Entity\CampanaCliente;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

class CampanasController extends Controller
{
    /**
     * @Route("/registro-campanas", name="regCampanas")
     * @Method({"GET", "POST"})
     */
    public function campanaAction(Request $request)
    {
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),8);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $campanas = $em->getRepository('CoreBundle:Campana')->findBy(array('activo'=>1));
        return $this->render('@App/Default/campanas.html.twig', array(
            'campanas'=>$campanas
        ));
    }

    /**
     * @Route("/consulta-campanas", name="lista-campanas")
     * @Method({"GET","POST"})
     */
    public function listaCampanasAction(Request $request){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),9);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $campana = $em->getRepository('CoreBundle:Campana')->findBy(array('activo'=>1));
        $form = $this->createForm('CoreBundle\Form\BusquedaCampanaType');
        $form->handleRequest($request);
        $buscar1 = array();
        $buscar2 = array();
        $buscar3 = array();
        $buscar4 = array();
        $buscar5 = array();
        $buscar6 = array();
        $buscar7 = array();
        $buscar8 = array();
        $final = array();
        $lista = $em->getRepository('CoreBundle:Campana')->findBy(array('activo'=>1),array('numero'=>'ASC'));

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if($data['numero']!= ''){
                $numero = $data['numero'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Campana','c')
                    ->where('c.numero LIKE :numero')
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
                foreach ($lista as $z) {
                    array_push($buscar1,$z->getId());
                }
            }
            if($data['nombre']!= ''){
                $nombre = $data['nombre'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Campana','c')
                    ->where('c.nombre LIKE :nombre')
                    ->setParameter('nombre', '%'.$nombre.'%')
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
                foreach ($lista as $z) {
                    array_push($buscar2,$z->getId());
                }
            }
            if($data['asunto']!= ''){
                $asunto = $data['asunto'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Campana','c')
                    ->where('c.asunto LIKE :asunto')
                    ->setParameter('asunto', '%'.$asunto.'%')
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
                foreach ($lista as $z) {
                    array_push($buscar3,$z->getId());
                }
            }
            if($data['nombreRemitente']!= ''){
                $nombreRemitente = $data['nombreRemitente'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Campana','c')
                    ->where('c.nombreremitente LIKE :nombre')
                    ->setParameter('nombre', '%'.$nombreRemitente.'%')
                    ->getQuery()
                    ->execute();

                foreach ($results as $r):
                    $check = array_keys(array_column($buscar4, 'id'), $r->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar4,$r->getId());
                    }
                endforeach;
            }else{
                foreach ($lista as $z) {
                    array_push($buscar4,$z->getId());
                }
            }
            if($data['correoRemitente']!= ''){
                $correoRemitente = $data['correoRemitente'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Campana','c')
                    ->where('c.correoremitente LIKE :correo')
                    ->setParameter('correo', '%'.$correoRemitente.'%')
                    ->getQuery()
                    ->execute();

                foreach ($results as $r):
                    $check = array_keys(array_column($buscar5, 'id'), $r->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar5,$r->getId());
                    }
                endforeach;
            }else{
                foreach ($lista as $z) {
                    array_push($buscar5,$z->getId());
                }
            }
            if($data['correoDestinatario']!= ''){
                $correoDestinatario = $data['correoDestinatario'];
                $cc = $em->getRepository('CoreBundle:CampanaCliente')->findBy(array('correodestinatario'=>$correoDestinatario,'activo'=>1));
                foreach ($cc as $r):
                    $check = array_keys(array_column($buscar8, 'id'), $r->getCampana()->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar8,$r->getCampana()->getId());
                    }
                endforeach;
            }else{
                foreach ($lista as $z) {
                    array_push($buscar8,$z->getId());
                }
            }
            if($data['fechaEnvio']!= ''){
                $fecha = $data['fechaEnvio'];
                $qb = $em->createQueryBuilder();

                $results = $qb->select('c')
                    ->from('CoreBundle:Campana','c')
                    ->where('c.fechaEnvio = :fecha')
                    ->setParameter('fecha', $fecha->format('Y-m-d'))
                    ->getQuery()
                    ->execute();

                foreach ($results as $r):
                    $check = array_keys(array_column($buscar6, 'id'), $r->getId());
                    if(count($check)>0){

                    }else{
                        array_push($buscar6,$r->getId());
                    }
                endforeach;
            }else{
                foreach ($lista as $z) {
                    array_push($buscar6,$z->getId());
                }
            }
            if(isset($data['tipo'])){
                $idtipo = $data['tipo']->getId();
                foreach ($lista as $x) {
                    if($x->getTipoCampana()==$idtipo){
                        $check = array_keys(array_column($buscar7, 'id'), $x->getId());
                        if(count($check)>0){

                        }else{
                            array_push($buscar7,$x->getId());
                        }
                    }
                }
            }else{
                foreach ($lista as $x) {
                    array_push($buscar7,$x->getId());
                }
            }
            $final = array_intersect($buscar1,$buscar2,$buscar3,$buscar4,$buscar5,$buscar6,$buscar7,$buscar8);
            $final = array_unique($final);
        }
        return $this->render('@App/Default/campanasconsulta.html.twig', array(
            'form' => $form->createView(),
            'lista'=>$lista,
            'final'=>$final
        ));
    }

    /**
     * @Route("/campana/{id}/editar", name="editar-campana")
     */
    public function editarCampanaAction(Request $request,Campana $campana, $id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),8);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('CoreBundle\Form\CampanaType', $campana);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($campana);
            $em->flush();
            return $this->redirectToRoute('regCampanas');
        }

        $correos = $em->getRepository('CoreBundle:CampanaCliente')->findBy(array('campana'=>$campana,'activo'=>1));

        return $this->render('@App/Default/campanasedit.html.twig',array(
            'edit_form' => $editForm->createView(),
            'campana' => $campana,
            'correos'=>$correos
        ));
    }

    /**
     * @Route("/campanas/{id}", name="consulta-campana")
     * @Method({"GET","POST"})
     */
    public function consultaCampanaAction(Request $request,$id){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),9);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $em = $this->getDoctrine()->getManager();
        $campana = $em->getRepository('CoreBundle:Campana')->findOneBy(array('id'=>$id));
        $correos = $em->getRepository('CoreBundle:CampanaCliente')->findBy(array('campana'=>$campana));
        return $this->render('@App/Default/campanaconsulta.html.twig',array(
            'campana'=>$campana,
            'correos'=>$correos
        ));
    }

    /**
     * @Route("/extraccion", name="extraccion")
     * @Method({"GET","POST"})
     */
    public function extraccionAction(Request $request){
        /*PERMISOS*/
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $permiso = $this->get('permiso');
        $foo = $permiso->permisos($user->getId(),8);
        if($foo==0){
            return $this->redirect($this->generateUrl('dash'));
        }
        /*PERMISOS*/
        $sendinCampaign = $this->get('sendinblue_api.email_campaigns_endpoint');
        $sendinContact = $this->get('sendinblue_api.contacts_endpoint');
        ini_set('max_execution_time', 6000);
        $em = $this->getDoctrine()->getManager();
        foreach ($sendinCampaign->getEmailCampaigns()->getCampaigns() as $campaign):
            $check = $em->getRepository('CoreBundle:Campana')->findOneBy(array('numero'=>$campaign['id']));
            if(!$check){
                $campana = new Campana();
                $campana->setNumero($campaign['id']);
                $campana->setNombre($campaign['name']);
                $campana->setNombreremitente($campaign['sender']->name);
                $campana->setCorreoremitente($campaign['sender']->email);
                $campana->setAsunto($campaign['subject']);
                $pd = new DateTime($campaign['createdAt']);
                $campana->setFechaEnvio($pd);
                $campana->setActivo(1);
                $em->persist($campana);
                $em->flush();
                foreach ($campaign['recipients']->lists as $list):
                    foreach ($sendinContact->getContactsFromList($list,null,500)->getContacts() as $contact):
                        $checkEmail = $em->getRepository('CoreBundle:CampanaCliente')->findOneBy(array('correodestinatario'=>$contact['email'],'campana'=>$campana));
                        if(!$checkEmail){
                            $cliente = new CampanaCliente();
                            $cliente->setActivo(1);
                            $cliente->setExiste(0);
                            $cliente->setCampana($campana);
                            $cliente->setCorreodestinatario($contact['email']);
                            $em->persist($cliente);
                            $em->flush();
                        }
                    endforeach;
                endforeach;
            }
        endforeach;
        return $this->redirectToRoute('regCampanas');
    }
}
