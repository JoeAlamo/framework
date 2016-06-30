<?php

namespace App\Controllers;

use Core\Controllers\Controller;
use Core\Views\View;

/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 29/06/2016
 * Time: 23:03
 */
class ExampleController extends Controller
{
    public function exampleAction()
    {
        echo "<p>Example output.</p>";
        echo "<p> _GET ARRAY: <pre>" . print_r($_GET, true) . "</pre></p>";
        echo "<p> _POST ARRAY: <pre>" . print_r($_POST, true) . "</pre></p>";
        echo "<p> ROUTE PARAMETERS: <pre>" . print_r($this->routeParameters, true) . "</pre></p>";
    }

    public function exampleViewAction()
    {
        View::renderFile('Example/example.php', [
            'routeParameters' => $this->routeParameters
        ]);
    }

    public function exampleTwigViewAction()
    {
        View::render('Example/example.twig', [
           'routeParameters' => $this->routeParameters
        ]);
    }

    protected function before()
    {
        echo "<p> BEFORE FILTER </p>";
    }

    protected function after()
    {
        echo "<p> AFTER FILTER </p>";
    }
}