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
    
    public function getFunctions()
    {
        return array(
            new TwigFunction('bfsIteration', array($this, 'bfsDisplayIterative')),
        );
    }
    
    private function shiftStack($stack): ?array
    {
        $shiftedStack = [];
        var_dump(count($stack));
//        exit;
        foreach ($stack as $plant) {
            var_dump(get_class($plant));
            var_dump(get_class($plant->getInheritingplants()));
            var_dump(count($plant->getInheritingplants()->getSnapshot()));
//            exit;
            if (!$plant->getInheritingPlants()->getSnapshot()) {
                continue;
            }
//            continue;
            var_dump(count($plant->getInheritingplants()->getSnapshot()));
            $shiftedStack += $plant->getInheritingplants()->getSnapshot();
            continue;
            array_push($shiftedStack, $plant->getInheritingplants()->getSnapshot());
        }
//        exit;
        return $shiftedStack;
    }
    
    private function addInheritingPlants(\DOMDocument $doc, $plants, string $query)
    {
        $compoundDoc = new \DOMDocument();
        $list = $compoundDoc->createElement(self::PLANT_COMPOUND_TAG);
        var_dump(count($plants));
        foreach ($plants as $plant) {
            $element = $compoundDoc->createElement(self::PLANT_ELEMENT_TAG);
            $header = $compoundDoc->createElement(self::PLANT_HEADER_TAG);
            $link = $compoundDoc->createElement(self::PLANT_LINK_TAG, $plant->getCategoryname());
            $link->setAttribute('href', $this->denormativePath($plant));
            $header->appendChild($link);
            $element->appendChild($header);
            $list->appendChild($element);
        }
//        $compoundDoc->appendChild($list);
        var_dump($list->C14N());
        var_dump($compoundDoc->C14N());
        var_dump($compoundDoc->documentElement);
//        exit;
//        return $doc;
        $xpath = new \DOMXPath($doc);
        $elements = $xpath->query($query);
        var_dump($elements);
//        exit;
//        $elements->item(0)->appendChild($compoundDoc);
//        var_dump($elements->item(0)->C14N());
        foreach ($elements as $element) {
            var_dump($element);
//            exit;
            $element->appendChild(
                $doc->importNode($list, true)
            );
            var_dump($element->C14N());
        }
//        exit;
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
        var_dump(get_class($plants[0]));
//        exit;
        $initialQuery = '/';
        $shiftLevel = 0;
//        $plantCompound = $doc->createElement(self::PLANT_COMPOUND_TAG);
//        $doc->appendChild($plantCompound);
        $doc = $this->addInheritingPlants((new \DOMDocument()), $plants, $initialQuery);
        $inheritingPlants = $plants;
        $shiftLevelQuery = $initialQuery . self::PLANT_COMPOUND_TAG;
        while ($inheritingPlants) {
            $shiftLevel++;
            for ($i = 0, $c = count($inheritingPlants); $i < $c; $i++) {
                if (!$plants[$i]->getInheritingplants()) {
                    continue;
                }
                $query = $shiftLevelQuery
                        . '/'
                        . self::PLANT_ELEMENT_TAG
                        . '['
                        . $i
                        . ']';
                $doc = $this
                        ->addInheritingPlants(
                            $doc,
                            $plants[$i]->getInheritingplants()->getSnapshot(),
                            $query
                        );
            }
            $shiftLevelQuery .= '/' . self::PLANT_COMPOUND_TAG;
//            exit;
            $inheritingPlants = $this->shiftStack($inheritingPlants);
        }
        return $doc->C14N();
    }
}
