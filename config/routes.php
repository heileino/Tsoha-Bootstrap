<?php

  // kilpailija

  $routes->get('/kilpailija', function() {
    KilpailijaController::show();
  });  

  $routes->post('/kilpailija', function(){
    KilpailijaController::store();
  });

  $routes->get('/kilpailija/uusi', function(){
    KilpailijaController::create();
  });

  $routes->get('/kilpailija/:id', function($id) {
    KilpailijaController::show_kilpailija($id);
  });

  $routes->get('/kilpailija/:id/muokkaa', function($id) {
    KilpailijaController::edit($id);
  });

  $routes->post('/kilpailija/:id/muokkaa', function($id) {
    KilpailijaController::update($id);
  });

  $routes->post('/kilpailija/:id/poista', function($id){
    KilpailijaController::destroy($id);
  });

  
  // kilpailu

  $routes->get('/', function(){
    KilpailuController::index();
  });

  $routes->get('/kilpailu', function(){
    KilpailuController::index();
  });

  $routes->post('/omakilpailulista', function(){
    KilpailuController::store();
  });

  $routes->get('/kilpailu/uusi', function(){
    KilpailuController::create();
  });


  $routes->get('/kilpailu/:id', function($id){
    KilpailuController::show($id);
  });

  $routes->get('/kilpailu/:id/muokkaa', function($id){
    KilpailuController::edit($id);
  });

  $routes->post('/kilpailu/:id/muokkaa', function($id) {
    KilpailuController::update($id);
  });

  $routes->post('/kilpailu/:id/poista', function($id){
    KilpailuController::destroy($id);
  });

  $routes->get('/omakilpailulista', function(){
    KilpailuController::ownlist();
  });

  // kayttaja

  $routes->get('/login', function(){
    KayttajaController::login();
  });

  $routes->post('/login', function(){
    KayttajaController::handle_login();
  });

  $routes->get('/logout', function(){
    KayttajaController::logout();
  });

  // kirjaaja

  $routes->get('/kirjaajalogin', function(){
    KirjaajaController::login();
  });

  $routes->post('/kirjaajalogin', function(){
    KirjaajaController::handle_login();
  });

  $routes->get('/omakirjaaja', function(){
    KirjaajaController::show();
  });


  // ajanmittauspiste

  $routes->post('/kilpailu/:kilpailu_id', function($kilpailu_id){
    AjanmittauspisteController::store($kilpailu_id);
  });

  $routes->get('/kilpailu/:kilpailu_id/uusiajanmittauspiste', function($kilpailu_id){
    AjanmittauspisteController::create($kilpailu_id);
  });


  $routes->get('/kilpailu/:kilpailu_id/ajanmittauspisteet', function($kilpailu_id){
    AjanmittauspisteController::show_from_kilpailu($kilpailu_id);
  });

  $routes->get('/kilpailu/:kilpailu_id/ajanmittauspiste/:id', function($kilpailu_id, $id){
    AjanmittauspisteController::show($kilpailu_id, $id);
  });


  // osallistuja
  $routes->get('/kilpailu/:kilpailu_id/osallistujat', function($kilpailu_id) {
    OsallistujaController::show($kilpailu_id);
  });

  $routes->get('/kilpailu/:kilpailu_id/lisaa', function($kilpailu_id){
    OsallistujaController::show_not_osallistuja($kilpailu_id);
  });

  $routes->post('/kilpailu/:kilpailu_id/osallistujat', function($kilpailu_id) {
    OsallistujaController::store($kilpailu_id);
  });
  

  // tulos

  $routes->post('/kilpailu/:kilpailu_id/tulokset/uusi', function($kilpailu_id, $ajanmittauspiste_id){
    TulosController::store($kilpailu_id, $ajanmittauspiste_id);
  });

  $routes->get('/kilpailu/:kilpailu_id/tulokset/uusi', function($kilpailu_id){
    TulosController::create($kilpailu_id);
  });

  $routes->get('/kilpailu/:id/tulokset', function($id){
    TulosController::show($id);
  });

  $routes->post('/kilpailu/:kilpailu_id/tulokset', function($kilpailu_id){
    TulosController::show_ajanottopiste_data($kilpailu_id);
  });


  // kilpailun suunnittelunäkymiä
  
  $routes->get('/kilpailu/1/tulokset', function() {
  HelloWorldController::kilpailu_lopputulosesittely();
  });

 
  $routes->get('/kilpailu/1', function() {
    HelloWorldController::kilpailu_muokkaus();
  });

    $routes->get('/kilpailijat/', function() {
    HelloWorldController::kilpailijat_lista();
  });

  $routes->get('/kilpailija/valiaika1', function() {
    HelloWorldController::kilpailija_valiaika1();
  });

  $routes->get('/kilpailu/lahtolista', function() {
    HelloWorldController::kilpailu_lahtolista();
  });