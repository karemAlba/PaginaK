<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PersonalesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = Request::createFromGlobals();
        $editar = $request->getRequestUri();
        if(false !== strpos($editar, 'editar-personal')) {
            $builder->add('rutaFotografia',FileType::class,array('required' => false,
                'data_class'=>null,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'maxSizeMessage'=>'Archivo demasiado grande',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Revisa el archivo. Formato no permitido.',
                    ])]));
            $builder->add('registrar',SubmitType::class,array('label'=>'Actualizar'));
            $builder->add('activo');
        }else{
            $builder->add('registrar',SubmitType::class,array('label'=>'Registrar'));
        }
        $builder->add('nombre',TextType::class,array(
                'required' => false,
                'attr'=>array('autocomplete'=>'off'),
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ingresa Nombre',
                    )),
                    new Length(array('min' => 3,
                        'minMessage' => 'El nombre debe ser mayor a {{ limit }} letras',
                    )),
                ),
            ))
            ->add('apPaterno',TextType::class,array(
                'required'=>false,
                'attr'=>array('autocomplete'=>'off'),
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ingresa Apellido Paterno',
                    )),
                    new Length(array('min' => 3,
                        'minMessage' => 'El apellido paterno debe ser mayor a {{ limit }} letras',
                    )),
                ),
            ))
            ->add('apMaterno',TextType::class,array(
                'required'=>false,
                'attr'=>array('autocomplete'=>'off'),
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ingresa Apellido Materno',
                    )),
                    new Length(array('min' => 3,
                        'minMessage' => 'El apellido materno debe ser mayor a {{ limit }} letras',
                    )),
                ),
            ))
            ->add('telefono',TextType::class,array(
                'required'=>false,
                'attr'=>array('autocomplete'=>'off'),
                'constraints'=>array(
                    new NotBlank(array(
                        'message'=>'Ingresa Teléfono'
                    )),
                    new Length(array(
                        'minMessage'=>'El teléfono debe contener al menos {{ limit }} digitos',
                        'min'=>7,
                        'max'=>15,
                        'maxMessage'=>'El télefono no debe ser mayor a {{ limit }} digitos'
                    ))
                )
            ))
            ->add('noi',TextType::class,array(
                'required'=>false,
                'attr'=>array('autocomplete'=>'off'),
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ingresa NOI',
                    )),
                ),
            ))
            ->add('rfc',TextType::class,array(
                'required'=>false,
                'attr'=>array('autocomplete'=>'off'),
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ingresa RFC',
                    )),
                    new Length(array(
                        'min'=>13,
                        'max' => 13,
                        'exactMessage'=>'RFC debe ser de 13 caracteres'
                    )),
                ),
            ))
            ->add('curp',TextType::class,array(
                'required'=>false,
                'attr'=>array('autocomplete'=>'off'),
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Ingresa CURP',
                    )),
                    new Length(array(
                        'min'=>18,
                        'max' => 18,
                        'exactMessage'=>'CURP debe ser de 18 caracteres'
                    )),
                ),
            ))
            ->add('correo',EmailType::class,array(
                'required'=>false,
                'attr'=>array('autocomplete'=>'off'),
                'constraints'=>array(
                    new NotBlank(array(
                        'message'=> 'Ingresa el correo electrónico'
                    ))
                )
            ))
            ->add('edad',IntegerType::class,array('attr'=>array('min'=>0,'max'=>100,'step'=>1)
            ,'required'=>false,
                'constraints'=>array(
                    new NotBlank(array('message'=>'Ingresa la Edad'))
                )))
            ->add('generos')
            ->add('estatusLaborales')
            ->add('fechaIngreso',DateType::class,array(
                'widget'=>'single_text',
                'format'=>'yyyy-MM-dd',
                'required'=>false,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Selecciona Fecha',
                    ))
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'CoreBundle\Entity\Personales'));
    }

    public function getBlockPrefix()
    {
        return 'core_bundle_personales_type';
    }
}
