<?php

namespace App\Tests;

use App\Tests\CrudUtil\CrudTestCase;

class DisplayControllerTest extends CrudTestCase
{
    public function testIndex()
    {
        parent::testIndex();
        
        $client = static::createClient();
        $crawler = $client->request('GET', '/display');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Plants Display', $crawler->filter('title')->text());
    }
}
