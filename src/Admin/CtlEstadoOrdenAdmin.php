<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;


final class CtlEstadoOrdenAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nombreEstado')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombreEstado',TextType::class, [
                'label' => 'Nombre del Estado'
            ])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Estados de la Orden', ['class' => 'col-md-6 col-xs-6 col-lg-6'])
                ->add('nombreEstado', TextType::class, [
                    'label' => 'Nombre del Estado*',
                    'required' => FALSE
                ])
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
        ->with('Detalles', ['class' => 'col-md-6 col-xs-6 col-lg-6'])
            ->add('nombreEstado', TextType::class, [
                'label' => 'Nombre del Estado'
            ])
        ->end()
            ;
    }
}
