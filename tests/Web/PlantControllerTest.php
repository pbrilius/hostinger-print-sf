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
        $client = static::createClient();
        $crawler = $client->request('GET', '/plant/new');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('New Plant', $crawler->filter('title')->text());
    }
    
    public function testDelete()
    {
        parent::testDelete();
    }

    public function testEdit()
    {
        parent::testEdit();
        $client = static::createClient();
        $crawler = $client->request('GET', '/plant/1/edit');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Edit Plant', $crawler->filter('title')->text());
    }

    public function testShow()
    {
        parent::testShow();
        $client = static::createClient();
        $crawler = $client->request('GET', '/plant/1');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Plant', $crawler->filter('title')->text());
    }
}
