<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Entity\Plant;

/**
 * Description of AppExtension
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
class AppExtension extends AbstractExtension
{
    const PLANT_COMPOUND_TAG = 'ul';
    const PLANT_ELEMENT_TAG = 'li';
    const PLANT_HEADER_TAG = 'h4';
    const PLANT_LINK_TAG = 'a';
    const PLANT_ELEMENT_ID_ATTRIBUTE = 'data-id';
    
    public function getFunctions()
    {
        return array(
            new TwigFunction('bfsIteration', array($this, 'bfsDisplayIterative')),
        );
    }
    
    private function shiftStack($stack): ?array
    {
        $shiftedStack = [];
        foreach ($stack as $plant) {
            if (!$plant->getInheritingPlants()->getSnapshot()) {
                continue;
            }
            foreach ($plant->getInheritingPlants()->getSnapshot() as $plant) {
                array_push($shiftedStack, $plant);
            }
        }

        return $shiftedStack;
    }
    
    private function addInheritingPlants(\DOMDocument $doc, $plants, string $query)
    {
        $compoundDoc = new \DOMDocument();
        $list = $compoundDoc->createElement(self::PLANT_COMPOUND_TAG);

        foreach ($plants as $plant) {
            $element = $compoundDoc->createElement(self::PLANT_ELEMENT_TAG);
            $element->setAttribute('data-id', $plant->getId());
            $header = $compoundDoc->createElement(self::PLANT_HEADER_TAG);
            $link = $compoundDoc->createElement(self::PLANT_LINK_TAG, $plant->getCategoryname());
            $link->setAttribute('href', $this->denormativePath($plant));
            $header->appendChild($link);
            $element->appendChild($header);
            $list->appendChild($element);
        }
        $compoundDoc->appendChild($list);
        $xpath = new \DOMXPath($doc);
        $elements = $xpath->query($query);
        $compoundList = $compoundDoc
                ->getElementsByTagName(self::PLANT_COMPOUND_TAG)
                ->item(0);
        foreach ($elements as $element) {
            $element->appendChild(
                $doc->importNode($compoundList, true)
            );
        }

        return $doc;
    }
    
    private function denormativePath(Plant $plant)
    {
        return '/'
               . strtolower((new \ReflectionClass(new Plant()))->getShortName())
               . '/'
               . $plant->getId();
    }
    
    public function bfsDisplayIterative($plants)
    {
        $initialQuery = '/';
        $shiftLevelQuery = $initialQuery;
        $doc = new \DOMDocument();
        $this->addInheritingPlants($doc, $plants, $initialQuery);
        while ($plants) {
            $shiftLevelQuery .= self::PLANT_COMPOUND_TAG . '/';
            for ($i = 0, $c = count($plants); $i < $c; $i++) {
                $query = $shiftLevelQuery
                        . self::PLANT_ELEMENT_TAG
                        . '[@'
                        . self::PLANT_ELEMENT_ID_ATTRIBUTE
                        . '="'
                        . $plants[$i]->getId()
                        . '"]';
                $doc = $this
                        ->addInheritingPlants(
                            $doc,
                            $plants[$i]->getInheritingPlants()->getSnapshot(),
                            $query
                        );
            }
            $shiftLevelQuery .= self::PLANT_ELEMENT_TAG . '/';
            $plants = $this->shiftStack($plants);
        }
        return $doc->C14N();
    }
}
