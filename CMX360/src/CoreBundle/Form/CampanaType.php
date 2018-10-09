<?php

namespace CoreBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampanaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = Request::createFromGlobals();
        $editar = $request->getRequestUri();
        $builder
        ->add('numero',TextType::class,array('disabled'=>true,'required'=>false))
            ->add('nombre',TextType::class,array('disabled'=>true,'required'=>false))
            ->add('asunto',TextType::class,array('disabled'=>true,'required'=>false))
            ->add('nombreremitente',TextType::class,array('disabled'=>true,'required'=>false))
            ->add('correoremitente',TextType::class,array('disabled'=>true,'required'=>false))
            ->add('fechaEnvio',DateType::class,array('disabled'=>true,'required'=>false,
                'widget' => 'single_text',
                'format' => 'EEEE yyyy-MM-dd',
            ))
            ->add('tipoCampana',EntityType::class, array(
                'class' => 'CoreBundle\Entity\TipoCampana',
                'attr'=>array('class'=>'form-control'),
                'query_builder' => function(EntityRepository $er ) {
                    return $er->createQueryBuilder('e')
                        ->where('e.activo = 1' )
                        ;
                }))
            ;
        if(false !== strpos($editar, 'editar')) {
            $builder->add('actualizar',SubmitType::class,array('label'=>'Actualizar'));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'CoreBundle\Entity\Campana'));
    }

    public function getBlockPrefix()
    {
        return 'campanaType';
    }
}
