<?php

namespace CoreBundle\Form;


use CoreBundle\Entity\Personales;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EjecutivosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = Request::createFromGlobals();
        $editar = $request->getRequestUri();
        if(false !== strpos($editar, 'editar-asesor')) {
            $builder->add('activo', CheckboxType::class, array(
                                'label'    => 'Activar',
                                'required' => false,))
                ->add('ingresar',SubmitType::class,array('label'=>'Actualizar'));

        }else{
            $builder->add('ingresar',SubmitType::class,array('label'=>'Ingresar'));
        }
        $builder->add('nombre',TextType::class,array('label'=>'Nombre','required'=>true))
                ->add('contrasena', TextType::class, array('label'=>'Contraseña', 'required'=>true))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'CoreBundle\Entity\Usuarios'));
    }

    public function getBlockPrefix()
    {
        return 'core_bundle_ejecutivos_type';
    }
}
