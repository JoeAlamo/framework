<?php

namespace App\Controllers;

use Core\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 29/06/2016
 * Time: 23:03
 */
class ExampleController extends Controller
{
    public function exampleAction() {
        echo "<p>Example output.</p>";
        echo "<p> _GET ARRAY: <pre>" . print_r($_GET, true) . "</pre></p>";
        echo "<p> _POST ARRAY: <pre>" . print_r($_POST, true) . "</pre></p>";
        echo "<p> ROUTE PARAMETERS: <pre>" . print_r($this->routeParameters, true) . "</pre></p>";
    }
}