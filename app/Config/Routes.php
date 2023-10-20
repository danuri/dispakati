<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 $routes->get('login', 'Auth::index');
 $routes->post('login', 'Auth::login');
 $routes->get('logout', 'Auth::logout');

 $routes->get('/', 'Home::index', ["filter" => "auth"]);
 $routes->post('/', 'Home::save', ["filter" => "auth"]);
