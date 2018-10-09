<?php

namespace AppBundle\Controller;

use AppBundle\Form\contactoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('@App/Default/index.html.twig');
    }

    /**
     * @Route("/conocenos", name="about")
     */
    public function aboutAction()
    {
        return $this->render('@App/Default/about.html.twig');
    }

    /**
     * @Route("/servicios", name="services")
     */
    public function servicesAction()
    {
        return $this->render('@App/Default/services.html.twig');
    }

    /**
     * @Route("/areas-de-influencia", name="areas")
     */
    public function areasAction(){
        return $this->render('@App/Default/areas.html.twig');
    }

    /**
     * @Route("/contacto", name="contact")
     */
    public function contactAction(Request $request){
        $form = $this->createForm(contactoType::class,null,array(
            'method' => 'POST',
            'attr'=>array('id'=>'contact-form')
        ));
        $enviado=0;
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $data = $form->getData();
                $message = \Swift_Message::newInstance()
                    ->setSubject('KreatSolutions - Contacto')
                    ->setFrom($data['email'])

                    ->setTo(array('aprogramacion@kreatsolutions.net'))
                    ->setBody(
                        $this->renderView('@App/Frontend/contact.html.twig',array('contacto'=>$data,)),
                        'text/html'
                    )
                ;
                /*$contacto = new Contactos();
                $contacto->setNombre($data['nombre']);
                $contacto->setApellidos($data['apellidos']);
                $contacto->setEmail($data['email']);
                $contacto->setTelefono($data['telefono']);
                $contacto->setMensaje($data['mensaje']);
                $contacto->setTipo(1);
                $em->persist();
                $em->flush();*/
                $this->get('mailer')->send($message);
                $enviado=1;
            }else{
                $enviado=0;
            }
        }else{
            $enviado=0;
        }
        return $this->render('@App/Default/contact.html.twig', array(
            'form' => $form->createView(),
            'enviado' => $enviado,
        ));
    }


    /**
     * @Route("/medio-ambiente", name="medio-ambiente")
     */
    public function ambienteAction()
    {
        return $this->render('@App/Default/service-ma.html.twig');
    }

    /**
     * @Route("/CRE", name="cre")
     */
    public function creAction()
    {
        return $this->render('@App/Default/service-cre.html.twig');
    }

    /**
     * @Route("/Juridico", name="juridico")
     */
    public function juridicoAction()
    {
        return $this->render('@App/Default/service-juridico.html.twig');
    }

    /**
     * @Route("/ASEA", name="asea")
     */
    public function aseaAction()
    {
        return $this->render('@App/Default/service-asea.html.twig');
    }

    /**
     * @Route("/STPS", name="stps")
     */
    public function stpsAction()
    {
        return $this->render('@App/Default/service-stps.html.twig');
    }

    /**
     * @Route("/diseno-y-construccion", name="diseno")
     */
    public function disenoAction(){
        return $this->render('@App/Default/service-diseno.html.twig');
    }

    /**
     * @Route("/bolsa-de-trabajo", name="bolsa")
     */
    public function bolsaAction(){
        return $this->render('@App/Default/bolsa.html.twig');
    }

}
