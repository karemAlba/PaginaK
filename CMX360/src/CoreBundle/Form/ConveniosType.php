<?php

namespace CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConveniosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre',TextType::class,[
            'required'=>true,
            'attr' => [
                'class'=> 'form-control',
            ]
        ]);
        $builder->add('costoAutorizacion',IntegerType::class,[
            'attr' => [
                'min'=>0,
                'class'=> 'form-control',
            ]
        ]);
        $builder->add('descuentos',IntegerType::class,[
            'attr'=>[
                'min'=>0,
                'max'=>10,
                'class'=>'form-control',
                'placeholder'=>'Min: 0,    Max:10',
                'value'=>0
            ],

        ]);
        $builder->add('condicionesComerciales',TextType::class,[
            'required'=>false,
            'attr'=>[
                'class'=>'form-control'
            ],
        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\Convenios'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }


}
