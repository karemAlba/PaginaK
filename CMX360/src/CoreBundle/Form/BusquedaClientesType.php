<?php

namespace CoreBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusquedaClientesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroPermiso',TextType::class,array('label'=>'Número de permiso','required'=>false))
            ->add('estacionServicio',TextType::class,array('label'=>'Estación de servicio','required'=>false))
            ->add('razonSocial',TextType::class,array('label'=>'Razón social','required'=>false))
            ->add('marcas', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Marcas',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('m')
                        ->where('m.activo = 1');
                }
            ))
            ->add('grupo', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Grupos',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('g')
                        ->where('g.activo = 1')
                        ->andWhere('g.tipoGrupos = 3');
                }
            ))
            ->add('tipoCliente', EntityType::class, array(
                'class'=>'CoreBundle\Entity\TipoClientes',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('t')
                        ->where('t.activo = 1');
                }
            ))
            ->add('asociacion', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Grupos',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('a')
                        ->where('a.activo = 1')
                        ->andWhere('a.tipoGrupos = 1');
                }
            ))
            ->add('categorias', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Categorias',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->where('c.activo = 1');
                }
            ))
            ->add('estado', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Estados',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('e')
                        ->where('e.activo = 1');
                }
            ))
            ->add('macrogrupos', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Grupos',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->where('c.activo = 1')
                        ->andWhere('c.tipoGrupos = 2');
                }
            ))

            ->add('buscar', SubmitType::class, array('label'=> 'Buscar'))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'busqueda_type';
    }
}
