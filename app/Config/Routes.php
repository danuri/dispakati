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


 $routes->group("rekon", ["filter" => "auth"], function ($routes) {
     $routes->get('', 'Rekon::index');
     $routes->get('login', 'Rekon::login');
     $routes->get('token', 'Rekon::token');
     $routes->get('tubel/detail/(:any)', 'Asesmen\Tubel::detail/$1');
     $routes->post('tubel/addpegawai', 'Asesmen\Tubel::addpegawai');
 });
