<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\Controller;

use App\RestUtil\AbstractRestController;
use App\RestUtil\RestControllerInterface;
use App\Entity\Plant;

/**
 * Description of PlantApiController
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
class PlantApiController extends AbstractRestController implements RestControllerInterface
{
    /**
     * @Route("/", name="plant_index", methods="GET,HEAD")
     */
    public function displayList()
    {
        $plants = $this->getDoctrine()
            ->getRepository(Plant::class)
            ->findAll();
        $serializer = $this->getSerializer();
        
        return $serializer->encode($plants, 'json');
    }
    
    public function delete(int $id)
    {
        $id = null;
    }

    public function display(int $id)
    {
        $id = null;
    }
    
    public function insert()
    {
    }

    public function update(int $id)
    {
        $id = null;
    }
}
