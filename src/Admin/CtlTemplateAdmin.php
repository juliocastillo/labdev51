<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CtlTemplateAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nombreTemplate')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper 
            ->add('nombreTemplate',TextType::class,[
                'label' => 'Nombre del Template'
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
            ->with('Templates', ['class' => 'col-md-6 col-xs-6 col-lg-6'])
                ->add('nombreTemplate', TextType::class, [
                    'label' => 'Nombre del Template'
                ])
            ->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
        ->with('Detalles', ['class' => 'col-md-6 col-xs-6 col-lg-6'])
            ->add('nombreTemplate', TextType::class, [
                'label' => 'Nombre del Template'
            ])
        ->end()
            ;
    }
}
