<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/5/31
 * Time: 16:18
 */
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Illuminate\Framework;
use Illuminate\ResponseEvent;


$request = Request::createFromGlobals();
$routes = include __DIR__.'/../routes/web.php';

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addListener('response', function(ResponseEvent $event){
    $response = $event->getResponse();

    if($response->isRedirection()
        || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
        || 'html' !== $event->getRequest()->getRequestFormat()
    ){
        return;
    }

    $response->setContent($response->getContent().'<span hidden>Response Event Dispatcher</span>');

});

$framework = new Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

$response->send();