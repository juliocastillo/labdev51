<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Security\Core\Security;

final class CnfLaboratorioAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('nombreLaboratorio')
            ->add('representanteLegal')
            ->add('direccion')
            ->add('telefono')
            ->add('correoElectronico')
            ->add('logo')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombreLaboratorio')
            ->add('representanteLegal')
            ->add('direccion')
            ->add('telefono')
            ->add('correoElectronico')
            ->add('logo')
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
            ->add('nombreLaboratorio')
            ->add('representanteLegal')
            ->add('direccion')
            ->add('telefono')
            ->add('correoElectronico')
            ->add('logo')
            ->add('activo')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nombreLaboratorio')
            ->add('representanteLegal')
            ->add('direccion')
            ->add('telefono')
            ->add('correoElectronico')
            ->add('logo')
            ->add('activo')
            ;
    }

    public function prePersist($form) : void {
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $form->setIdUsuarioReg($user);
        $form->setFechahoraReg(new \Datetime());
    }

    public function preUpdate($form) : void {
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $form->setIdUsuarioMod($user);
        $form->setFechahoraMod(new \Datetime());
    }

}
