<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusquedaUsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre',TextType::class, array('label'=>'Buscar Nombre','required'=>false))
            ->add('perfil',TextType::class, array('label'=>'Buscar Perfil','required'=>false))
            ->add('privilegio',TextType::class, array('label'=>'Buscar Privilegio','required'=>false))
            ->add('usuario',TextType::class, array('label'=>'Buscar Usuario','required'=>false))
            ->add('buscar', SubmitType::class, array('label'=> 'Buscar'))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'busqueda_type';
    }
}
