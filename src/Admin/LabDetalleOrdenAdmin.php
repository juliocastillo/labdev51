<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\CtlExamen;
use App\Entity\CtlTipoMuestra;

final class LabDetalleOrdenAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('idExamen', EntityType::class, [
                    'class' => CtlExamen::class,
                    'label' => 'Examen',
                ])
            ->add('idTipoMuestra', EntityType::class, [
                    'class' => CtlTipoMuestra::class,
                    'label' => 'Tipo de muestra',
                    'required' => true,
                    'placeholder' => "Seleccionar..."
                ])
            ->add('precio', TextType::class, [
                    'required' => false,
                    'attr' => array('style' => 'width:200px',  'readonly' => true,)
                ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
       
    }
}
