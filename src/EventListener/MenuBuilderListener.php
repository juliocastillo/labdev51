<?php

namespace App\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

/**
 * Class MenuBuilderListener
 * @package AdminBundle\EventListener
 */
class MenuBuilderListener
{
    /**
     * @param ConfigureMenuEvent $event
     */
    public function adminMenuItems(ConfigureMenuEvent $event)
    {
        // Esta es la funcionalidad para agregar opciones estáticas al menú de Sonata
        $event->getMenu()
            ->addChild('Resultados', ['route' => ''])
            ->setExtras(
                [
                    'icon' => '<span class="fa fa-file"></span>&nbsp;',
                ]
            )
            ->setLabel('Resultados')
            ->addChild('resultados_de_laboratorio', ['route' => 'admin_app_labresultados_index'])
            ->setLabel('Resultados de laboratorio')
            ->getParent()
            ->getParent();

    }
}
