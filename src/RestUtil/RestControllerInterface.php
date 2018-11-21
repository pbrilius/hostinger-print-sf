<?php

/*
 * Copyright (c) <pixelpitcteam.tumblr.com> (tm) 2017 - Nov 8, 2018
 */

namespace App\RestUtil;

/**
 *
 * @author Povilas Brilius <pbrilius@gmail.com>
 */
interface RestControllerInterface
{
    public function display(int $id);
    
    public function displayList();
    
    public function update(int $id);
    
    public function delete(int $id);
    
    public function insert();
}
