<?php

namespace App\Tests;

use App\Tests\RestUtil\RestTestCase;

class PlantApiControllerTest extends RestTestCase
{
    public function testDisplayList()
    {
        $client = static::createClient();
        $client->request('GET', '/api/plant/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        /* @var $serializer Serializer */
        $serializer = $this->getSerializer();
        $decodedResponse = $serializer->decode(
            $client
                    ->getResponse()
                    ->getContent(),
            'json'
        );
        $this->assertGreaterThan(0, count($decodedResponse));
    }
}
