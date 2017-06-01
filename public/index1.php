<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/5/17
 * Time: 12:57
 */
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

function render_template($request){
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../resources/views/%s.php', $_route);

    return new Response(ob_get_clean());
}

$request = Request::createFromGlobals();

/*$map = array(
    '/hello' => '../resources/views/hello.php',
    '/bye'=> '../resources/views/bye.php'
);*/
$routes = include __DIR__.'/../routes/web.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

/*if(isset($map[$path])){
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    include sprintf(__DIR__.'/../resources/views/%s.php', $map[$path]);
    $response->setContent(ob_get_clean());
}else{
    $response->setStatusCode(404);
    $response->setContent('Sorry,Not Found This Page!');
}*/

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try{
    /*extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../resources/views/%s.php', $_route);

    $response = new Response(ob_get_clean());*/
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    /*$response = call_user_func($request->attributes->get('_controller'), $request);*/
    $response = call_user_func_array($controller, $arguments);
}catch(Routing\Exception\ResourceNotFoundException $e){
    $response = new Response('Sorry,Not Found This Page', 404);
}catch(Exception $e){
    $response = new Response('An Error Occurred', 500);
}

$response->send();