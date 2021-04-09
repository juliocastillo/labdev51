<<<<<<< HEAD
<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


final class CtlExamenAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('nombreExamen')
            //->add('idAreaLaboratorio')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('idAreaLaboratorio')    
            ->add('nombreExamen')
            ->add('precio')
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
        ->with('Datos',['class' => 'col-md-4'])
                ->add('idAreaLaboratorio', null, array(
                    'required' => TRUE,
                    'label' => 'Area Laboratorio',
                ))
                ->add('nombreExamen', TextType::class, ['row_attr' => [
            ]])
                ->add('precio', TextType::class)
                /* ->add('activo', CheckboxType::class, [
                    'row_attr' => [
                ]
            ])*/
        ->end()
           
            ;
            if ($id) {  // cuando se edite el registro
                if ($entity->getActivo() == TRUE) { // si el registro esta activo
                    $formMapper
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE,
                                'attr' => array(
                                    'checked' => 'checked'
                    )));
                } else { // si el registro esta inactivo
                    $formMapper
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE
                    ));
                }
            } else { // cuando se crea el registro
                $formMapper
                        ->add('activo', null, array(
                            'label' => 'Activo',
                            'required' => FALSE,
                            'attr' => array(
                                'checked' => 'checked'
                )));
            }
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('idAreaLaboratorio')    
            ->add('nombreExamen')
            ->add('activo')
            ;
    }

    public function prePersist($alias) : void {
        // llenar campos de auditoria
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioReg($user);
        $alias->setFechahoraReg(new \DateTime());
    }

    public function preUpdate($alias) : void {
        // llenar campos de auditoria
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioMod($user);
        $alias->setFechahoraMod(new \DateTime());
    }
}
=======
<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\CtlAreaLaboratorio;
use App\Entity\CtlExamen;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



final class CtlExamenAdmin extends AbstractAdmin
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
            ->add('nombreExamen')
            ->add('idAreaLaboratorio')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('idAreaLaboratorio')    
            ->add('nombreExamen')
            ->add('precio')
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
        ->with('Datos',['class' => 'col-md-4'])
                ->add('idAreaLaboratorio', EntityType::class,[
                    'class' => CtlAreaLaboratorio::class,
                    'label' => 'Area de Laboratorio',
                    ]    
                )
                ->add('nombreExamen')
                ->add('precio')
                //->add('activo')
        ->end()
           
            ;
            if ($id) {  // cuando se edite el registro
                if ($entity->getActivo() == TRUE) { // si el registro esta activo
                    $formMapper
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE,
                                'attr' => array(
                                    'checked' => 'checked'
                    )));
                } else { // si el registro esta inactivo
                    $formMapper
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE
                    ));
                }
            } else { // cuando se crea el registro
                $formMapper
                        ->add('activo', null, array(
                            'label' => 'Activo',
                            'required' => FALSE,
                            'attr' => array(
                                'checked' => 'checked'
                )));
            }
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('idAreaLaboratorio')    
            ->add('nombreExamen')
            ->add('activo')
            ;
    }

    public function prePersist($alias) : void {
        // llenar campos de auditoria
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
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
>>>>>>> 73572724dc29c4ce7e4777343cbfefa44c565434
