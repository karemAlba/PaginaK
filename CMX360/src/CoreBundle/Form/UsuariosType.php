<?php

namespace CoreBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = Request::createFromGlobals();
        $editar = $request->getRequestUri();
        if(false !== strpos($editar, 'editar-usuario')) {
            $builder->add('activo', CheckboxType::class, array(
                'label'    => 'Activar',
                'required' => false,))
                ->add('ingresar',SubmitType::class,array('label'=>'Actualizar'));

        }else{
            $builder->add('ingresar',SubmitType::class,array('label'=>'Ingresar'));
        }
        $builder->add('nombre',TextType::class,array('label'=>'Nombre','required'=>true))
            ->add('contrasena', TextType::class, array('label'=>'Contraseña', 'required'=>true))
            ->add('perfil',EntityType::class, array(
                'mapped'=>false,
                'class' => 'CoreBundle\Entity\Perfiles',
                'attr'=>array('class'=>'form-control'),
                'query_builder' => function(EntityRepository $er ) {
                    return $er->createQueryBuilder('p')
                        ->where('p.activo = 1' )
                        ;
                }))
            ->add('privilegios',EntityType::class, array(
                'mapped'=>false,
                'class' => 'CoreBundle\Entity\Privilegios',
                'attr'=>array('class'=>'form-control select2'),
                'query_builder' => function(EntityRepository $er ) {
                    return $er->createQueryBuilder('p')
                        ->where('p.activo = 1' )
                        ;
                }))
            ->add('lista',TextType::class,array(
                'mapped'=>false,
                'required'=>false,
                'attr'=>array('class'=>'hidden')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'CoreBundle\Entity\Usuarios'));
    }

    public function getBlockPrefix()
    {
        return 'usuariosType';
    }
}
