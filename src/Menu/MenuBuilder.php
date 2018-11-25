<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\Menu;

use Knp\Menu\FactoryInterface;

/**
 * Description of MenuBuilder
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
class MenuBuilder
{
    private $factory;
    
    /**
     * @param FactoryInterface $factory
     *
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild('Home', ['route' => 'display']);
        
        $menu->addChild('Plants', ['route' => 'plant_index']);
        $menu['Plants']->addChild('Add Plant', ['route' => 'plant_new']);

        return $menu;
    }
}
