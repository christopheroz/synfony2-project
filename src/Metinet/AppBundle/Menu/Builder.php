<?php

namespace Metinet\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Home',   ['route' => 'home']);
        $menu->addChild('Random', ['route' => 'random']);
        $menu->addChild('Submit', ['route' => 'submit']);
        $menu->addChild('Pending facts', ['route' => 'pending_facts']);
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $menu->addChild('Logout', ['route' => 'logout']);
        } else {
            $menu->addChild('Login', ['route' => 'login']);
        }
        $menu->addChild('API Fact', ['route' => 'api']);


        return $menu;
    }
}
