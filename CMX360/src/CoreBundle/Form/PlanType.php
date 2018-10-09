<?php

namespace CoreBundle\Form;

use CoreBundle\Entity\Zonas;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = Request::createFromGlobals();
        $editar = $request->getRequestUri();
        switch ($options['flow_step']) {
            case 1:
                $builder
                    ->add('checkConvenio',ChoiceType::class,array(
                        'label'=>'Aplicar Convenio',
                        'mapped'=>false,
                        'expanded'=>true,
                        'multiple'=>false,
                        'choices'=>array('Sí' => true, 'No' => false),
                    ))
                    ->add('convenios',EntityType::class,array(
                        'label'=>'Convenio',
                        'class'=>'CoreBundle\Entity\Convenios',
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('c')
                                ->where('c.activo = 1' )
                                ->orderBy('c.nombre', 'ASC');
                        }
                    ))
                    ->add('nombre',TextType::class,array('label'=>'Nombre de Plan de Prospección','required'=>true,'attr'=>array('autocomplete'=>'off')))
                    ->add('tipoClientes',EntityType::class,array(
                        'label'=>'Tipo de Cliente',
                        'class'=>'CoreBundle\Entity\TipoClientes',
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('t')
                                ->where('t.activo = 1' )
                                ->orderBy('t.nombre', 'ASC');
                        }
                    ))
                    ->add('zonas',ChoiceType::class,array(
                        'label'=>'Zona',
                        'multiple'=>false,
                        'expanded'=>false,
                        'mapped'=>false
                    ))
                    ->add('estados',ChoiceType::class,array(
                        'label'=>'Estado',
                        'multiple'=>false,
                        'expanded'=>false,
                        'mapped'=>false
                    ))
                    ->add('municipios',ChoiceType::class,array(
                        'label'=>'Municipio',
                        'multiple'=>false,
                        'mapped'=>false,
                        'expanded'=>false
                    ))
                    ->add('codigoPostal',TextType::class,array(
                        'label'=>'Código Postal',
                        'required'=>false,
                        'attr'=>array('autocomplete'=>'off')
                    ))
                    ->add('marcas', EntityType::class,array(
                        'label'=>'Marca',
                        'class'=>'CoreBundle\Entity\Marcas',
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('m')
                                ->where('m.activo = 1' )
                                ->orderBy('m.nombre', 'ASC');
                        }
                    ))
                    ->add('asociacion', ChoiceType::class,array(
                        'label'=>'Asociación',
                        'mapped'=>false,
                        'expanded'=>false,
                        'multiple'=>false
                    ))
                    ->add('union', ChoiceType::class,array(
                        'label'=>'Unión',
                        'mapped'=>false,
                        'expanded'=>false,
                        'multiple'=>false
                    ))
                    ->add('grupo', ChoiceType::class,array(
                        'label'=>'Grupo',
                        'mapped'=>false,
                        'expanded'=>false,
                        'multiple'=>false
                    ))
                    ->add('estatusSeguimiento', EntityType::class,array(
                        'label'=>'Estatus',
                        'class'=>'CoreBundle\Entity\EstatusSeguimiento',
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('e')
                                ->where('e.activo = 1' );
                        }
                    ))
                    ;

                if(false !== strpos($editar, 'editar')) {
                    $builder->add('campana', EntityType::class,array(
                        'label'=>'Campaña',
                        'class'=>'CoreBundle\Entity\Campana',
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('c')
                                ->where('c.activo = 1' )
                                ->orderBy('c.fechaEnvio', 'ASC');
                        }
                    ));
                }
                $builder->get('zonas')->resetViewTransformers();
                $builder->get('estados')->resetViewTransformers();
                $builder->get('municipios')->resetViewTransformers();
                $builder->get('asociacion')->resetViewTransformers();
                $builder->get('union')->resetViewTransformers();
                $builder->get('grupo')->resetViewTransformers();
                break;
            case 2:
                $builder
                    ->add('checkDescuento',ChoiceType::class,array(
                        'label'=>'Descuento para Negociación',
                        'mapped'=>false,
                        'expanded'=>true,
                        'multiple'=>false,
                        'required'=>false,
                        'placeholder'=>false,
                        'choices'=>array('Sí' => true, 'No' => false)
                    ))
                    ->add('descuentoN',IntegerType::class,array(
                        'label'=>'Ingrese el % de Descuento',
                        'attr'=>array('autocomplete'=>'off','min'=>'0','max'=>'10','step'=>'1','value'=>'0')
                    ))
                    ->add('tipoServicio',ChoiceType::class,array(
                        'label'=>'Tipo de Servicio',
                        'mapped'=>false,
                        'expanded'=>false,
                        'multiple'=>false,
                        'choices'=>array('INDIVIDUAL' => 0, 'INTEGRAL' => 1),
                    ))
                    ->add('condicionesComerciales',TextareaType::class,array(
                        'label'=>'Condiciones Comerciales',
                        'required'=>false,
                        'attr'=>array('rows'=>'5')
                    ))
                    ->add('costodeProspeccion',TextType::class,array(
                        'label'=>'Costo de Prospección',
                        'mapped'=>false,
                        'required'=>false,
                        'attr'=>array('autocomplete'=>'off','readonly'=>'readonly')
                    ))
                    ->add('empresa', EntityType::class,array(
                        'label'=>'Empresa',
                        'mapped'=>false,
                        'class'=>'CoreBundle\Entity\Empresa',
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('e')
                                ->where('e.activo = 1' );
                        }
                    ))
                    ->add('departamento', ChoiceType::class,array(
                        'label'=>'Departamento',
                        'mapped'=>false
                    ))
                    ->add('servicio', ChoiceType::class,array(
                        'label'=>'Servicio',
                        'mapped'=>false
                    ))
                    ->add('subservicio', ChoiceType::class,array(
                        'label'=>'Subservicio',
                        'mapped'=>false
                    ))
                    ->add('costoServicio', TextType::class,array(
                        'label'=>'Costo',
                        'mapped'=>false,
                        'required'=>false,
                        'attr'=>array('readonly'=>'readonly')
                    ))
                    ->add('costoTotal',TextType::class,array(
                        'label'=>'Costo Total',
                        'mapped'=>false,
                        'required'=>false,
                        'attr'=>array('autocomplete'=>'off','step'=>'0.01','readonly'=>'readonly')
                    ))
                    ->add('costoTotalCN',TextType::class,array(
                        'label'=>'Costo por Convenio',
                        'mapped'=>false,
                        'required'=>false,
                        'attr'=>array('autocomplete'=>'off','step'=>'0.01','readonly'=>'readonly')
                    ))
                    ->add('costoTotalDesc',TextType::class,array(
                        'label'=>'Costo Total con Descuento',
                        'mapped'=>false,
                        'required'=>false,
                        'attr'=>array('autocomplete'=>'off','step'=>'0.01','readonly'=>'readonly')
                    ))
                    ->add('costoTotalPropuesto',TextType::class,array(
                        'label'=>'Costo Total Propuesto',
                        'mapped'=>false,
                        'required'=>false,
                        'attr'=>array('autocomplete'=>'off','step'=>'0.01')
                    ))
                    ->add('fechaInicio',DateType::class,array(
                        'label'=>'Fecha inicio',
                        'widget' => 'single_text',
                        'required'=>false,
                        'format' => 'yyyy-MM-dd',
                    ))
                    ->add('fechaFin',DateType::class,array(
                        'label'=>'Fecha fin',
                        'required'=>false,
                        'widget' => 'single_text',
                        'format' => 'yyyy-MM-dd',
                    ))
                    ->add('tiempo',TextType::class,array(
                        'label'=>'Tiempo de Prospección',
                        'mapped'=>false,
                        'required'=>false,
                        'attr'=>array('autocomplete'=>'off','readonly'=>'readonly')
                    ))
                    ->add('numeroAsesores',IntegerType::class,array(
                        'label'=>'Asesores Designados',
                        'mapped'=>false,
                        'attr'=>array('autocomplete'=>'off','min'=>'0','value'=>'0')
                    ))
                    ;
                if(false !== strpos($editar, 'editar')) {
                    $builder->add('rutaFlyer',FileType::class,array('required' => false,
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
                }
                $builder->get('tipoServicio')->resetViewTransformers();
                $builder->get('departamento')->resetViewTransformers();
                $builder->get('servicio')->resetViewTransformers();
                $builder->get('subservicio')->resetViewTransformers();
                break;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'CoreBundle\Entity\PlanProspeccion'));
    }

    public function getBlockPrefix()
    {
        return 'planType';
    }
}
