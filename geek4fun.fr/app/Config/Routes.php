<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

//Route de la page d'acceuil
$routes->get('/', 'PrincipaleController::index');
$routes->get('/reglementation', 'PrincipaleController::reglementation');
$routes->get('/lots', 'PrincipaleController::lots');
$routes->get('/note', 'PrincipaleController::note');

//Route pour la connexion et l'inscription (déconnexion également)
$routes->match(['get','post'],'/Connexion','ConnexionController::index');
$routes->get('/Deconnexion','ConnexionController::deconnexion');
$routes->match(['get','post'],'/Inscription','ConnexionController::Inscription');

//Route pour l'administration du site
$routes->match(['get','post'],'/Administrateur','AdminController::index');
$routes->match(['get','post'],'/Supprimer', 'AdminController::SupprimerUtilisateur');
$routes->match(['get','post'],'/Modifier', 'AdminController::ModifierUtilisateur');


//Route "Nous concernant" (mention légale et page contact)
$routes->get('/Mention','PrincipaleController::Mention');
$routes->get('/Contact','PrincipaleController::Contact');

//Route de modification de l'utilisateur
$routes->get('/compte','PrincipaleController::compte');
$routes->match(['get','post'],'/updateLogin','PrincipaleController::changerLogin');