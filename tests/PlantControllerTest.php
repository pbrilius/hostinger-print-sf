<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\CrudUtil\CrudTestInterface;

class PlantControllerTest extends WebTestCase implements CrudTestInterface
{
    public function testDelete()
    {
    }

    public function testEdit()
    {
    }

    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/plant/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Plant Index', $crawler->filter('title')->text());
    }

    public function testNew()
    {
    }

    public function testShow()
    {
    }
}
