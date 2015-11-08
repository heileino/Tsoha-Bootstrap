<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/tapahtumalista', function() {
  HelloWorldController::tapahtumalista();
});
$routes->get('/kilpailija', function() {
  HelloWorldController::kilpailija_esittely();
});

$routes->get('/kilpailija/1', function() {
  HelloWorldController::kilpailija_muokkaus();
});

$routes->get('/tapahtumalista/1', function() {
  HelloWorldController::kilpailulista();
});

$routes->get('/tapahtumalista/1/1', function() {
  HelloWorldController::kilpailu();
});
