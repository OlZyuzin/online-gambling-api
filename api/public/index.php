<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Stratigility\Middleware\ErrorResponseGenerator;
use OlZyuzinFramework\RequestHandler;
use OlZyuzinFramework\Router;

$errorResponseGenerator = function (Throwable $e) {
    $generator = new ErrorResponseGenerator();
    return $generator($e, new ServerRequest(), new Response());
};

$routes = include __DIR__ . '/../config/routes.php';


$builder = new DI\ContainerBuilder();
$builder->useAutowiring(true);
$builder->addDefinitions(__DIR__ . '/../config/parameters.php');
$builder->addDefinitions(__DIR__ . '/../config/services.php');
$container = $builder->build();

$handler = new RequestHandler(
    $container,
    new Router($routes),
);

$runner = new RequestHandlerRunner(
    $handler,
    new SapiEmitter(),
    [ServerRequestFactory::class, 'fromGlobals'],
    $errorResponseGenerator,
);

$runner->run();
