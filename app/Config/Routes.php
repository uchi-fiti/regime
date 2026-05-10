<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes pour les pages d'authentification et inscription
$routes->get('/inscription', 'Auth::inscription');
$routes->get('/connection', 'Auth::connection');
$routes->get('/information', 'Auth::information');
$routes->get('/choose-obj', 'Auth::chooseObj');
$routes->post('/auth/validerChamp', 'Auth::validerChamp');
$routes->post('/auth/traiteInscription', 'Auth::traiteInscription');
$routes->post('/health/submit', 'UserHealthInfoController::submitHealthInfo');
// Routes pour les pages principales
$routes->get('/model', 'Page::model');  
$routes->get('/home', 'Page::home');

// Route pour les recommandations
$routes->get('/test', 'RecommandationController::generer');




// routes back office
$routes->get('/back-office/connection', 'BackOfficeController::connection');



