<?php

/*
 * Copyright (c) <https://pixelpitcteam.tumblr.com> (tm) 2017 - 2018
 */

namespace App\Tests\CrudUtil;

/**
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
interface CrudTestInterface
{
    public function testIndex();
    
    public function testNew();
    
    public function testShow();
    
    public function testEdit();
    
    public function testDelete();
}
