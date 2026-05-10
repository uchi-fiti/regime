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


// routes back office
// afficher formulaire de connexion
$routes->get('/back-office/connection', 'BackOfficeController::form');

$routes->post('/back-office/connection', 'BackOfficeController::login');

$routes->group('back-office', ['filter' => 'role:admin'], function($routes) {
    $routes->get('dashboard','DashboardController::index');
});




