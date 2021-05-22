<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\CtlDepartamento;
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


final class CtlMunicipioAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('idDepartamento')
         //   ->add('id')
            ->add('nombreMunicipio')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
             ->add('idDepartamento')
           // ->add('id')
            ->add('nombreMunicipio')
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
        $entity = $this->getSubject();   //obtiene el elemento seleccionado en un objeto
        $id = $entity->getId();
        $formMapper
            ->with('Datos',['class' => 'col-md-5'])
                ->add('idDepartamento', EntityType::class,[
                    'class' => CtlDepartamento::class,
                    'label' => 'Departamento'
                    ]
                    )
                ->add('nombreMunicipio', TextType::class, ['row_attr' => [
                  //  'class' => 'col-md-12',
                ]])
            ->end()    
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
          //  ->add('id')
            ->add('nombreMunicipio')
            ->add('idDepartamento')
            ;
    }
}
