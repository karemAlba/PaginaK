<?php

namespace CoreBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusquedaCampanaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero',TextType::class,array('label'=>'Número de campaña','required'=>false))
            ->add('nombre',TextType::class,array('label'=>'Nombre de campaña','required'=>false))
            ->add('asunto',TextType::class,array('label'=>'Asunto de la campaña','required'=>false))
            ->add('nombreRemitente',TextType::class,array('label'=>'Remitente de campaña','required'=>false))
            ->add('correoRemitente',TextType::class,array('label'=>'Correo del remitente','required'=>false))
            ->add('fechaEnvio', DateType::class, array(
                'required'=>false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('correoDestinatario',TextType::class,array('required'=>false))
            ->add( 'tipo', EntityType::class, array(
                'class' => 'CoreBundle\Entity\TipoCampana',
                'attr'=>array('class'=>'form-control'),
                'query_builder' => function(EntityRepository $er ) {
                    return $er->createQueryBuilder('e')
                        ->where('e.activo = 1' )
                        //->orderBy('e.nombre', 'ASC')
                        ;
                }))

            ->add('buscar', SubmitType::class, array('label'=> 'Buscar'))



            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'campanaType';
    }
}
