<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CtlMicroorganismoAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nombreMicroorganismo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombreMicroorganismo',TextType::class, [
                'label' => 'Nombre del Microorganismo'
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
            ->with('Microorganismos', ['class' => 'col-lg-6 col-md-6 col-xs-6 col-lg-6'])
                ->add('nombreMicroorganismo', TextType::class, [
                    'label' => 'Nombre del Microorganismo*',
                    'required' => FALSE
                ])
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->with('Detalles',['class' => 'col-lg-6 col-md-6 col-xs-6 col-lg-6'])
                ->add('nombreMicroorganismo',TextType::class,[
                'label' => 'Nombre del Microorganismo'
                ])
            ->end()
            ;
    }
}
