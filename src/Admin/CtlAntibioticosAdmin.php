<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class CtlAntibioticosAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nombreAntibiotico')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
          //  ->add('id')
            ->add('nombreAntibiotico')
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
        ->with('Antibiotico',['class' => 'col-md-5'])
           ->add('nombreAntibiotico',  null, array(
            'required' => TRUE,
            'label' => 'Antibiotico'
                ))
        ->end() 
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('nombreAntibiotico')
            ;
    }
}
