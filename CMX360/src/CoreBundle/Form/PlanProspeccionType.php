<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanProspeccionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = Request::createFromGlobals();
        $form = $request->getRequestUri();
        if(false !== strpos($form, 'consulta-plan')) {
            $builder->add('nombre',TextType::class,array('label'=>'Ingrese el nombre del plan','required'=>false, 'mapped'=> false))
                ->add('modificado',TextType::class,array('label'=>'Ingrese el nombre del plan','required'=>false, 'mapped'=>false));
            ;
        }else{
        }

        $builder->add('revision',TextType::class,array('label'=>'Ingrese el nombre del plan','required'=>false, 'mapped'=>false))
            ->add('autorizado',TextType::class,array('label'=>'Ingrese el nombre del plan','required'=>false, 'mapped'=>false))
        ;

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'plan_type';
    }
}
