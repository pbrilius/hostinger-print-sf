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
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;

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
        $encoder    = new JsonEncoder();
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $normalizer->setIgnoredAttributes(['inheritingPlants']);
        $normalizers = [$normalizer];
        $normalizers[0]->setCircularReferenceHandler(function ($object) {
            return $object->getCategoryname();
        });
        $normalizers[0]->setCircularReferenceLimit(4);
        $encoders    = [$encoder];
        $serializer  = new Serializer($normalizers, $encoders);

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
    
    public function delete(int $id)
    {
        $id = null;
    }

    public function display(int $id)
    {
        $id = null;
    }

    public function displayList()
    {
    }

    public function insert()
    {
    }

    public function update(int $id)
    {
        $id = null;
    }
}
