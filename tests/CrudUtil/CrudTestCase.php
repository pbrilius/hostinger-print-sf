<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\Tests\CrudUtil;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\CrudUtil\CrudTestInterface;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

/**
 * Description of CrudTestCase
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
abstract class CrudTestCase extends WebTestCase implements CrudTestInterface
{
    use RefreshDatabaseTrait;
    
    public function testDelete()
    {
    }

    public function testEdit()
    {
    }

    public function testIndex()
    {
    }

    public function testNew()
    {
    }

    public function testShow()
    {
    }
}
