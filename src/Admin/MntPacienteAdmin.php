<?php

declare(strict_types=1);

namespace App\Admin;

//use App\Entity\CtlDepartamento;
//use App\Entity\CtlMunicipio;
use DateTime;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CtlSexo;

final class MntPacienteAdmin extends AbstractAdmin
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
            ->add('nombre')
            ->add('apellido')
            ->add('idSexo')
            //->add('fechaNacimiento')
            ->add('telefono')
            ->add('direccionPaciente')
            ->add('NRC')
            ->add('NIT')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombre')
            ->add('apellido')
            ->add('idSexo')
            ->add('fechaNacimiento')
            ->add('telefono')
            ->add('direccionPaciente')
            ->add('NRC')
            ->add('NIT')
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
        $entity = $this->getSubject();   //obtiene el elemento seleccionado en un objeto
        $id = $entity->getId();
        
        $formMapper
            ->with('Datos Paciente',['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre',
                ])
                ->add('apellido')
                ->add('idSexo', EntityType::class,[
                    'class' => CtlSexo::class,
                    'label' => 'Sexo',
                    'placeholder' => "Seleccionar..."
                    ])
                ->add('fechaNacimiento')
                ->add('fechaNacimiento', DateType::class, [
                    'widget' => 'single_text',
                ])
                ->add('telefono')
            ->end()
            ->with('Dirección y Documentación', ['class' => 'col-md-6'])
                ->add('direccionPaciente')
                /* ->add('idDepartamento', EntityType::class, [
                    'class' => CtlDepartamento::class,
                    'label' => 'Departamento',
                ])
                ->add('idMunicipio', EntityType::class, [
                    'class' => CtlMunicipio::class,
                    'label' => 'Municipio',
                ]) */
                ->add('NRC')
                ->add('NIT')
                
            ->end()
            ;
            if ($id) {  // cuando se edite el registro
                if ($entity->getActivo() == TRUE) { // si el registro esta activo
                    $formMapper
                    ->with('Dirección y Documentación',['class' => 'col-md-6'])
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE,
                                'attr' => array(
                                    'checked' => 'checked',
                    )))
                    ->end()
                    ;
                } else { // si el registro esta inactivo
                    $formMapper
                    ->with('Dirección y Documentación',['class' => 'col-md-6'])
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE
                    ))
                    ->end()
                    ;
                }
            } else { // cuando se crea el registro
                $formMapper
                ->with('Dirección y Documentación',['class' => 'col-md-6'])
                        ->add('activo', null, array(
                            'label' => 'Activo',
                            'required' => FALSE,
                            'attr' => array(
                                'checked' => 'checked'
                )))
                ->end()
                ;
            }
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nombreCompleto')
            ->add('apellidos')
            ->add('idSexo')
            ->add('fechaNacimiento')
            ->add('telefono')
            ->add('direccionPaciente')
            ->add('NRC')
            ->add('NIT')
            ->add('activo')
            ;
    }

    public function prePersist($alias) : void {
        // llenar campos de auditoria
        $user = $this->container->get('security.token_storage')->getToken();
        $alias->setIdUsuarioReg($user);
        $alias->setFechahoraReg(new \DateTime());
    }

    public function preUpdate($alias) : void {
        // llenar campos de auditoria
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioMod($user);
        $alias->setFechahoraMod(new \DateTime());
    }
}
