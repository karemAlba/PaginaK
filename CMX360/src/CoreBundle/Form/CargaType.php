<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CargaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('xml',FileType::class,array('required'=>true,'label'=>'Archivo XML','constraints'=>[
            new File([
                'maxSize' => '5M',
                'maxSizeMessage'=>'Archivo demasiado grande',
                'mimeTypes' => [
                    'application/xml'
                ],
                'mimeTypesMessage' => 'Formato no permitido.',
            ])
        ]))
        ->add('enviar',SubmitType::class,array('label'=>'Cargar'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_carga_type';
    }
}
