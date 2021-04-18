<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\MntPaciente;
use App\Entity\MntMedico;
use App\Entity\CtlFormaPago;
use App\Entity\CtlTipoDocumento;

final class LabOrdenAdmin extends AbstractAdmin
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    
    public function __construct($code, $class, $baseControllerName, $container = null)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->container = $container;
    }

    
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('fechaOrden', null, [], DateType::class)
            ->add('fechaTomaMuestra', null, [], DateType::class)
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('fechaOrden')
            ->add('fechaTomaMuestra')
            ->add('fechahoraReg')
            ->add('fechahoraMod')
            ->add('activo')
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
            ->with('Datos de la orden', ['class' => 'col-md-6'])
                ->add('fechaTomaMuestra', DateType::class, [
                        'widget' => 'single_text',
                        'label' => 'Fecha de la muestra',
                        'attr' => array('style' => 'width:200px')
                    ])
                ->add('idPaciente', EntityType::class,[
                        'class' => MntPaciente::class,
                        'label' => 'Paciente',
                        'required' => true,
                        'placeholder' => "Seleccionar..."
                    ])
                ->add('idMedico', EntityType::class,[
                        'class' => MntMedico::class,
                        'label' => 'Medico',
                        'required' => true,
                        'placeholder' => "Seleccionar..."
                    ])
            ->end()
            ->with('Documento',['class' => 'col-md-6'])
                ->add('numeroDocumento', TextType::Class, [
                        'label' => 'Numero',
                        'attr' => array('style' => 'width:500px')
                    ])
                ->add('idTipoDocumento', EntityType::class, [
                        'class' => CtlTipoDocumento::class,
                        'label' => 'Tipo documento',
                        'required' => true,
                        'placeholder' => "Seleccionar..."
                    ])
                ->add('idFormaPago', EntityType::class, [
                       'class' => CtlFormaPago::class,
                        'label' => 'Forma de pago',
                        'required' => true,
                        'placeholder' => "Seleccionar..."
                    ])
                ->end()
            ->with('Detalle')
                ->add('labDetalleOrdens', CollectionType::class, [],array('edit' => 'inline', 'inline' => 'table'));
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('fechaOrden')
            ->add('fechaTomaMuestra')
            ->add('fechahoraReg')
            ->add('fechahoraMod')
            ->add('activo')
            ;
    }
    
    
    
}
