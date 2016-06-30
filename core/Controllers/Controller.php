<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 30/06/2016
 * Time: 14:20
 */

namespace Core\Controllers;


abstract class Controller
{
    protected $routeParameters = [];

    public function __construct(array $routeParameters) {
        $this->routeParameters = $routeParameters;
    }
}