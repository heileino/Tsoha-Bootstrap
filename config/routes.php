<?php

  $routes->get('/', function() {
    HelloWorldController::kisalista_esittely();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/1', function() {
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

 
