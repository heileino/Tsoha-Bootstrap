<?php

  $routes->get('/', function() {
    HelloWorldController::kisalista_esittely();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/kilpailulista', function() {
    HelloWorldController::kisalista_esittely();
  });

  $routes->get('/kilpailulista/1', function() {
    HelloWorldController::kisalista_muokkaus();
  });

  $routes->get('/kilpailija', function() {
    HelloWorldController::kilpailija_esittely();
  });

  $routes->get('/kilpailija/1', function() {
    HelloWorldController::kilpailija_muokkaus();
  });


  $routes->get('/kilpailu', function() {
    HelloWorldController::kilpailu_esittely();
  });

    $routes->get('/kilpailu/1', function() {
    HelloWorldController::kilpailu_muokkaus();
  });