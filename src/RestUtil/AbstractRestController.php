<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\RestUtil;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\RestUtil\RestControllerInterface;

/**
 * Description of AbstractRestController
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
class AbstractRestController extends AbstractController implements RestControllerInterface
{
    /**
     *
     * @var Serializer
     */
    private $serializer;
    
    public function __construct()
    {
        $this->setUpSerializer();
    }

    private function setUpSerializer()
    {
        $encoders    = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        
        $this->setSerializer($serializer);
    }
    
    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }

    public function setSerializer(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }
}
