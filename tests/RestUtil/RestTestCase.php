<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\Tests\RestUtil;

use App\Tests\RestUtil\RestTestInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Description of RestTestCase
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
abstract class RestTestCase extends WebTestCase implements RestTestInterface
{
    /**
     *
     * @var Seralizer
     */
    private $serializer;
    
    public function setUp()
    {
        $this->setUpSerializer();
    }
    
    public function tearDown()
    {
        $this->serializer = null;
    }
    
    private function setUpSerializer()
    {
        $encoders    = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        
        $this->setSerializer($serializer);
    }
    
    public function testDelete()
    {
    }

    public function testDisplay()
    {
    }

    public function testDisplayList()
    {
    }

    public function testInsert()
    {
    }

    public function testUpdate()
    {
    }
    
    public function getSerializer(): \Symfony\Component\Serializer\Serializer
    {
        return $this->serializer;
    }

    public function setSerializer(\Symfony\Component\Serializer\Serializer $serializer)
    {
        $this->serializer = $serializer;
    }
}
