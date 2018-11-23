<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Doctrine\Common\Collections\Collection;
use App\Entity\Plant;

/**
 * Description of AppExtension
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFunction('bfsIteration', array($this, 'bfsDisplayIterative')),
        );
    }
    
    public function rearrangeShiftedStackPlants(array $plants)
    {
        $rearrangedPlants = [];
        foreach ($plants as $plant) {
            array_append($rearrangedPlants, $this->shiftStack($plant));
        }
        return $rearrangedPlants;
    }
    
    private function shiftStack(Plant $stack): ?Collection
    {
        return $stack->inheritingPlants();
    }
    
    public function bfsDisplayIterative()
    {
        while ($plants) {
            foreach ($plant as $plant) {
                macroBsf(1, [$plant]);
            }
            $plants = rearrangeShiftedStackPlants($plants);
        }
    }
}
