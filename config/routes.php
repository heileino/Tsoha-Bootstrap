<?php

  // $routes->get('/', function() {
  //   HelloWorldController::kisalista_esittely();
  // });

  // $routes->get('/hiekkalaatikko', function() {
  //   HelloWorldController::sandbox();
  // });

  // $routes->get('/kilpailulista', function() {
  //   HelloWorldController::kisalista_esittely();
  // });

  // $routes->get('/kilpailulista/1', function() {
  //   HelloWorldController::kisalista_muokkaus();
  // });

  // kilpailija

  //$routes->get('/kilpailija', function() {
  //  HelloWorldController::kilpailija_esittely();
  //});

  $routes->get('/kilpailija', function() {
    KilpailijaController::kilpailijalista();
  });  

  $routes->post('/kilpailija', function(){
    KilpailijaController::tallenna();
  });

  $routes->get('/kilpailija/uusi', function(){
    KilpailijaController::luoUusi();
  });

  $routes->get('/kilpailija/:id', function($id) {
    KilpailijaController::kilpailijaesittely($id);
  });

  
  // kilpailu

  //$routes->get('/kilpailu', function() {
  //  HelloWorldController::kilpailu_lopputulosesittely();
  //});
  $routes->get('/', function(){
    KilpailuController::index();
  });


  $routes->get('/kilpailu', function(){
    KilpailuController::index();
  });

  // $routes->get('/kilpailu/1', function() {
  //   HelloWorldController::kilpailu_muokkaus();
  // });

  //   $routes->get('/kilpailijat/', function() {
  //   HelloWorldController::kilpailijat_lista();
  // });

  // $routes->get('/kilpailija/valiaika1', function() {
  //   HelloWorldController::kilpailija_valiaika1();
  // });

  // $routes->get('/kilpailu/lahtolista', function() {
  //   HelloWorldController::kilpailu_lahtolista();
  // });