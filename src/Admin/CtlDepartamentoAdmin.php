<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\CtlPais;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



final class CtlDepartamentoAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
           ->add('nombreDepartamento')
           ->add('idPais')
           ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('idPais')
            ->add('nombreDepartamento')
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
        ->with('Datos',['class' => 'col-md-5'])
                ->add('idPais', EntityType::class,[
                    'class' => CtlPais::class,
                    'label' => 'Pais'
                    ]
                    )
                ->add('nombreDepartamento', TextType::class, ['row_attr' => [
                   // 'class' => 'col-md-12',
                ]
                ])
                
        ->end()         
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nombreDepartamento')       
            ->add('idPais')
           ;
    }
}
