<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CtlPosibleResultadoAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
           // ->add('id')
            ->add('nombrePosibleResultado')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
         //   ->add('id')
            ->add('nombrePosibleResultado')
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
         ->with('Posible Resultado',['class' => 'col-md-5'])
             ->add('nombrePosibleResultado',  null, array(
                 'required' => TRUE,
                 'label' => 'Posible Resultado'
             ))
         ->end() 
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('nombrePosibleResultado')
            ;
    }
}
