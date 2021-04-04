<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\ChoiceList\ChoiceList;

final class CtlEmpresaAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('nombreEmpresa')
            ->add('idDescuento')
            ->add('activo')            
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombreEmpresa')
            ->add('idDescuento')
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
            ->with('Empresa',['class' => 'col-md-5'])
                ->add('nombreEmpresa', TextType::class)
                ->add('idDescuento',  null, array(
                    'required' => TRUE,
                    'label' => 'Descuento a aplicar',
                ))
                ->add('activo', CheckboxType::class)
            ->end()    
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nombreEmpresa')
            ->add('idDescuento')
            ->add('activo')            
            ;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'CRUD/CtlEmpresa/list.html.twig';
                break;
            case 'edit':
                return 'CRUD/CtlEmpresa/edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
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
