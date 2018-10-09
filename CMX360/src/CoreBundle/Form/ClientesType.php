<?php

namespace CoreBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($options['flow_step']) {
            case 1:
                $request = Request::createFromGlobals();
                $editar = $request->getRequestUri();
                $builder
                    ->add('numeroPermiso',TextType::class,array('label'=>'Número de permiso','required'=>false))
                    ->add('rfc',TextType::class,array('label'=>'RFC','required'=>false))
                    ->add('estacionServicio',TextType::class,array('label'=>'Estación de servicio','required'=>false))
                    ->add('telefonoEmpresa',TextType::class,array('label'=>'Telefono de empresa','required'=>false))
                    ->add('correoEmpresa',TextType::class,array('label'=>'Correo Electrónico de la empresa','required'=>false))
                    ->add('razonSocial',TextType::class,array('label'=>'Razón social','required'=>false));
                if(false !== strpos($editar, 'editar')) {
                    $builder->add('activo', CheckboxType::class, array(
                        'label'    => 'Activar',
                        'required' => false))
                        ->add('folioGenerico', TextType::class, array(
                            'label'    => 'Folio Genérico',
                            'disabled'=>true,
                            'required' => false));
                }
                break;
            case 2:
                $builder
                    ->add('calle',TextType::class,array('mapped'=>false,'required'=>false))
                    ->add( 'estado', EntityType::class, array(
                        'class' => 'CoreBundle\Entity\Estados',
                        'attr'=>array('class'=>'form-control'),
                        'mapped' => false,
                        'empty_data'=>false,
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('e')
                                ->where('e.activo = 1' )
                                ->orderBy('e.nombre', 'ASC');
                        }))
                    ->add('municipio',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                        ))
                    ->add('colonia',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                    ))
                    ->add('codigoPostal',TextType::class, array(
                        'label'=>'Código Postal',
                        'attr'=>array('class'=>'form-control'),
                        'required'=>false,
                        'mapped'=>false))
                    ->add('coordenadaX',TextType::class,array('label'=>'Coordenada X','required'=>false))
                    ->add('coordenadaY',TextType::class,array('label'=>'Coordenada Y','required'=>false))
                    //fiscal
                    ->add('igual', CheckboxType::class, array(
                        'mapped'=>false,
                        'label'    => 'Utiliza domicilio Físico',
                        'required' => false))
                    ->add('calleFiscal',TextType::class,array('mapped'=>false,'required'=>false))
                    ->add( 'estadoFiscal', EntityType::class, array(
                        'class' => 'CoreBundle\Entity\Estados',
                        'attr'=>array('class'=>'form-control'),
                        'mapped' => false,
                        'empty_data'=>false,
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('e')
                                ->where('e.activo = 1' )
                                ->orderBy('e.nombre', 'ASC');
                        }))
                    ->add('municipioFiscal',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'choices'=>array('Selecciona un Municipio' => null),
                        'data'=>null
                    ))
                    ->add('coloniaFiscal',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'choices'=>array('Selecciona una Colonia' => null),
                        'data'=>null
                    ))
                    ->add('codigoPostalFiscal',TextType::class, array(
                        'label'=>'Código Postal',
                        'required'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'mapped'=>false))
                    ;
                $builder->get('estadoFiscal')->resetViewTransformers();
                $builder->get('estado')->resetViewTransformers();
                $builder->get('municipio')->resetViewTransformers();
                $builder->get('colonia')->resetViewTransformers();
                $builder->get('municipioFiscal')->resetViewTransformers();
                $builder->get('coloniaFiscal')->resetViewTransformers();
                break;
            case 3:
                $builder
                    ->add('tipoClientes',EntityType::class,array(
                        'class'=>'CoreBundle\Entity\TipoClientes',
                        'attr'=>array('class'=>'form-control'),
                        'required'=>true,
                        'data'=>null,
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('t')
                                ->where('t.activo = 1' )
                                ->orderBy('t.id', 'DESC');
                            }))
                    ->add( 'sector', EntityType::class, array(
                        'class' => 'CoreBundle\Entity\Sectores',
                        'attr'=>array('class'=>'form-control'),
                        'mapped' => false,
                        'query_builder' => function(EntityRepository $er ) {
                            return $er->createQueryBuilder('s')
                                ->where('s.activo = 1' )
                                ->orderBy('s.nombre', 'ASC');
                        }))
                    ->add('segmento',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                    ))
                    ->add('categoria',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                    ))
                    ->add('marca',ChoiceType::class, array(
                        'mapped'=>false,
                        'choices'=>array('Selecciona una Marca' => null),
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                    ))
                    ->add('nuevamarca',TextType::class, array(
                        'mapped'=>false,
                        'required'=>false,
                        'label'=>'Nueva Marca',
                        'attr'=>array('class'=>'form-control')))
                    ->add('productos',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                    ))
                    ->add('lista',TextType::class,array(
                        'mapped'=>false,
                        'required'=>false,
                        'attr'=>array('class'=>'hidden')
                    ))
                    ->add('independiente',ChoiceType::class,array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'choices'=>array('Si'=>1,'No'=>0),
                        'expanded'=>true,
                        'multiple'=>false
                    ))
                    ->add('asociacion',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                    ))
                    ->add('nuevaasociacion',TextType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'label'=>'Nueva Asociación',
                        'required'=>false,
                        'data'=>null
                    ))
                    ->add('macrogrupo',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                    ))
                    ->add('nuevomacrogrupo',TextType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'label'=>'Nueva Unión',
                        'required'=>false,
                        'data'=>null
                    ))
                    ->add('grupo',ChoiceType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'data'=>null
                    ))
                    ->add('nuevogrupo',TextType::class, array(
                        'mapped'=>false,
                        'attr'=>array('class'=>'form-control'),
                        'label'=>'Nuevo Grupo',
                        'required'=>false,
                        'data'=>null
                    ))
                    ;
                $builder->get('segmento')->resetViewTransformers();
                $builder->get('categoria')->resetViewTransformers();
                $builder->get('marca')->resetViewTransformers();
                $builder->get('asociacion')->resetViewTransformers();
                $builder->get('macrogrupo')->resetViewTransformers();
                $builder->get('grupo')->resetViewTransformers();
                $builder->get('productos')->resetViewTransformers();
                break;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'CoreBundle\Entity\Clientes'));
    }


    public function getBlockPrefix()
    {
        return 'clientesType';
    }
}
