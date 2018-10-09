<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class contactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class,array('label'=>'Ingrese su nombre','required'=>true))
            ->add('email',EmailType::class,array('label'=>'Ingrese su E-mail','required'=>true))
            ->add('telefono',TelType::class,array('label'=>'Ingrese su télefono','required'=>true))
            ->add('mensaje',TextareaType::class,array('label'=>'Ingrese su télefono','required'=>true))
            ->add('area', ChoiceType::class, array(
                'choices' => array(
                    'Operátiva' => 'operativa',
                    'Administrativa' => 'administrativa',

                )))
            ->add('enviar', SubmitType::class, array('label'=> 'Enviar'));

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'contact';
    }
}
