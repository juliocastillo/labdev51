<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\CtlExamen;
use App\Entity\MntPosibleResultado;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class MntPosibleResultadoAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('idPosibleResultado')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('idPosibleResultado', EntityType::class, [
                'class' => MntPosibleResultado::class,
            ])
            ->add('idExamen', EntityType::class, [
                'class' => CtlExamen::class,
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
        ->add('idPosibleResultado', EntityType::class, [
            'class' => CtlPosibleResultado::class,
        ])
        ->add('idExamen', EntityType::class, [
            'class' => CtlExamen::class,
        ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ;
    }
}
