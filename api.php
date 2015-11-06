<?php
require 'vendor/autoload.php';
require 'config/db.php';
require 'model/user.php';
require 'model/message.php';

$app = new Slim\App;

$app->get('/', function ($request, $response, $args) {
  $response->write("Welcome to Slim!");
  return $response;
});

$app->get('/hello[/{name}]', function ($request, $response, $args) {
  $response->write("Hello, " . $args['name']);
  return $response;
})->setArgument('name', 'World!');

$app->get('/user/{id}', function ($request, $response, $args) {
  $newResponse = $response->withHeader('Content-type', 'application/json');

  $newResponse->write(json_encode(getUser(getDbConnection(), $args['id'])));

  return $newResponse;
});

$app->get('/messages', function ($request, $response, $args) {
  $newResponse = $response->withHeader('Content-type', 'application/json');

  $queryParams = $request->getQueryParams();
  if (isset($queryParams['lat']) || isset($queryParams['lng'])) {
    $lat = $queryParams['lat'];
    $lng = $queryParams['lng'];
    $messages = messagesWithLatLng(getDbConnection(), $lat, $lng);
  } else {
    $messages = messages(getDbConnection());
  }
  $newResponse->write(json_encode($messages));

  return $newResponse;
});

$app->run();
