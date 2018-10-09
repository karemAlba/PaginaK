<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
class CsvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('csv',FileType::class,array('required'=>true,'constraints'=>[
            new File([
                'maxSize' => '5M',
                'maxSizeMessage'=>'Archivo demasiado grande',
                /*'mimeTypes' => [
                    'application/vnd.ms-excel',
                    'application/csv',
                    'application/x-csv',
                    'text/csv',
                    'text/comma-separated-values',
                    'text/x-comma-separated-values',
                    'text/tab-separated-values'
                ],
                'mimeTypesMessage' => 'Formato no permitido.',*/
            ])
        ]))
            ->add('tipo', ChoiceType::class, array(
                'multiple'=> false,
                'expanded' => false,
                'choices'=> array(
                    'Estaciones de servicio'=>'1',
                    'Centros de distribución'=>'2')
            ))
                ->add('enviar',SubmitType::class,array('label'=>'Cargar'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'csv_type';
    }
}
