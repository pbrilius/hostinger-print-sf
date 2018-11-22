<?php

/*
 * Copyright (c) pixelpitchteam.yolasite.com 2017 - 2018
 */

namespace App\Tests\RestUtil;

/**
 *
 * @author paul
 */
interface RestTestInterface
{
    public function testDelete();
    
    public function testDisplay();
    
    public function testDisplayList();
    
    public function testInsert();
    
    public function testUpdate();
}
