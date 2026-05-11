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
$routes->get('/logout', 'Auth::logout');
$routes->post('/health/submit', 'UserHealthInfoController::submitHealthInfo');
$routes->post('/health/objective', 'UserHealthInfoController::storeObjective');
// Routes pour les pages principales
$routes->get('/model', 'Page::model');  
$routes->get('/home', 'Page::home');

// Route pour les recommandations
$routes->get('/recommandation', 'RecommandationController::generer');

// Route pour la confirmation d'achat
$routes->get('/confirmation-achat', 'ConfirmationAchatController::index');
$routes->post('/confirmation-achat', 'ConfirmationAchatController::confirmer');
$routes->get('/confirmation-achat/pdf', 'ConfirmationAchatController::exportPdf');

$routes->post('/wallet/redeem', 'WalletController::redeem');

$routes->get('/confirmation-abonnement', 'AbonnementController::index');
$routes->post('/confirmation-abonnement', 'AbonnementController::confirmer');


// routes back office
// afficher formulaire de connexion
$routes->get('/back-office/connection', 'BackOfficeController::form');

$routes->post('/back-office/connection', 'BackOfficeController::login');

$routes->get('/back-office/model_back', 'BackOfficeController::model');

$routes->get('/back-office/deconnexion', 'BackOfficeController::logout');

$routes->group('/back-office', ['filter' => 'role:admin'], function($routes) {
    $routes->get('/dashboard','DashboardController::index');
    
    // CRUD Régimes
    $routes->get('/regimes', 'RegimeController::index');
    $routes->get('/regimes/create', 'RegimeController::form');
    $routes->post('/regimes/create', 'RegimeController::create');
    $routes->get('/regimes/edit/(:num)', 'RegimeController::form/$1');
    $routes->post('/regimes/update/(:num)', 'RegimeController::update/$1');
    $routes->get('/regimes/delete/(:num)', 'RegimeController::delete/$1');
    
    // CRUD Prix Régimes
    $routes->get('/prix-regimes', 'PrixRegimeController::index');
    $routes->get('/prix-regimes/create', 'PrixRegimeController::form');
    $routes->post('/prix-regimes/create', 'PrixRegimeController::create');
    $routes->get('/prix-regimes/edit/(:num)', 'PrixRegimeController::form/$1');
    $routes->post('/prix-regimes/update/(:num)', 'PrixRegimeController::update/$1');
    $routes->get('/prix-regimes/delete/(:num)', 'PrixRegimeController::delete/$1');
    
    // CRUD Sports
    $routes->get('/sports', 'SportController::index');
    $routes->get('/sports/create', 'SportController::form');
    $routes->post('/sports/create', 'SportController::create');
    $routes->get('/sports/edit/(:num)', 'SportController::form/$1');
    $routes->post('/sports/update/(:num)', 'SportController::update/$1');
    $routes->get('/sports/delete/(:num)', 'SportController::delete/$1');
    
    // CRUD Abonnements
    $routes->get('/abonnements', 'AbonnementController::index');
    $routes->get('/abonnements/create', 'AbonnementController::form');
    $routes->post('/abonnements/create', 'AbonnementController::create');
    $routes->get('/abonnements/edit/(:num)', 'AbonnementController::form/$1');
    $routes->post('/abonnements/update/(:num)', 'AbonnementController::update/$1');
    $routes->get('/abonnements/delete/(:num)', 'AbonnementController::delete/$1');
    
    // CRUD Codes
    $routes->get('/codes', 'CodeController::index');
    $routes->get('/codes/create', 'CodeController::form');
    $routes->post('/codes/create', 'CodeController::create');
    $routes->get('/codes/edit/(:num)', 'CodeController::form/$1');
    $routes->post('/codes/update/(:num)', 'CodeController::update/$1');
    $routes->get('/codes/delete/(:num)', 'CodeController::delete/$1');
});




