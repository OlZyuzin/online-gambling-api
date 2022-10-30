<?php

require_once __DIR__ . '/../vendor/autoload.php';

//use OlZyuzinFramework\RequestHandler;
//use GuzzleHttp\Psr7\Request;
use \Slim\Psr7\Factory\ServerRequestFactory;
use Slim\Psr7\Response;

$request = ServerRequestFactory::createFromGlobals();

//$requestHandler = new RequestHandler();
//$response = $requestHandler->handle($request);

$response = new Response();
$response->getBody()->write("Hello world!");

foreach ($response->getHeaders() as $name => $values) {
    $first = strtolower($name) !== 'set-cookie';
    foreach ($values as $value) {
        $header = sprintf('%s: %s', $name, $value);
        header($header, $first);
        $first = false;
    }
}

$body = $response->getBody();
if ($body->isSeekable()) {
    $body->rewind();
}

$amountToRead = (int) $response->getHeaderLine('Content-Length');
if (!$amountToRead) {
    $amountToRead = $body->getSize();
}

if ($amountToRead) {
    while ($amountToRead > 0 && !$body->eof()) {
        $length = min(4096, $amountToRead);
        $data = $body->read($length);
        echo $data;

        $amountToRead -= strlen($data);

        if (connection_status() !== CONNECTION_NORMAL) {
            break;
        }
    }
} else {
    while (!$body->eof()) {
        echo $body->read(4096);
        if (connection_status() !== CONNECTION_NORMAL) {
            break;
        }
    }
}