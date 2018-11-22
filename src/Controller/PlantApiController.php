<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\Controller;

use App\RestUtil\AbstractRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Plant;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of PlantApiController
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 * @Route("/api/plant")
 */
class PlantApiController extends AbstractRestController
{
    /**
     * @Route("/", name="plant_api_index", methods={"GET","HEAD"})
     */
    public function displayList()
    {
        $plants = $this->getDoctrine()
            ->getRepository(Plant::class)
            ->findAll();
        var_dump($plants);
//        die;
        return new JsonResponse($plants);
        
        $serializer = $this->getSerializer();
        
        return $serializer->serialize($plants, 'json');
    }
}
