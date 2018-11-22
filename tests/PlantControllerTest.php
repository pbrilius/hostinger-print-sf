<?php

namespace App\Tests;

use App\Tests\CrudUtil\CrudTestCase;

class PlantControllerTest extends CrudTestCase
{

    public function testIndex()
    {
        parent::testIndex();
        
        $client = static::createClient();
        $crawler = $client->request('GET', '/plant/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Plant Index', $crawler->filter('title')->text());
    }
    
    public function testNew()
    {
        parent::testNew();
    }
}
