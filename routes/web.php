<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/5/30
 * Time: 20:59
 */
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add('hello', new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => 'App\\Http\\Controllers\\Controller::render_template'
    )
));

$routes->add('bye', new Routing\Route('/bye',array(
    '_controller' => 'App\\Http\\Controllers\\Controller::render_template'
    )
));

$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'App\\Http\\Controllers\\YearController::indexAction'
    )
));

return $routes;