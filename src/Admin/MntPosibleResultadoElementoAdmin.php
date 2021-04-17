<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class MntPosibleResultadoElementoAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('idPosibleResultado', EntityType::class,[
                'label' => 'Posible Resultado'
            ])
            ->add('idElemento', EntityType::class,[
                'label' => 'Elemento'
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
        ->add('idPosibleResultado')
        ->add('idElemento')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
        ->add('idPosibleResultado')
        ->add('idElemento')
            ;
    }
}
