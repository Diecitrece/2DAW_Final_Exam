<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);


// Namespace constants
if(!defined('REST_NAMESPACE')) define('REST_NAMESPACE' , 'App\Controllers\Rest');
if(!defined('COMMAND_NAMESPACE')) define('COMMAND_NAMESPACE' , 'App\Controllers\command');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group('rest', function($routes)
{
    $routes->get('restaurants', 'RestaurantsController::getRestaurants', ['namespace'=> REST_NAMESPACE]);
    $routes->get('restaurants/(:any)', 'RestaurantsController::getRestaurants/$1', ['namespace'=> REST_NAMESPACE]);

    $routes->get('gas_stations', 'GasStationsController::getGasStations', ['namespace'=> REST_NAMESPACE]);
    $routes->get('gas_stations/(:any)', 'GasStationsController::getGasStations/$1', ['namespace'=> REST_NAMESPACE]);

    $routes->get('weather', 'WeatherController::getWeather', ['namespace'=> REST_NAMESPACE]);

    $routes->get('news', 'NewsController::getNews', ['namespace'=> REST_NAMESPACE]);
    $routes->get('news/(:any)', 'NewsController::getNews/$1', ['namespace'=> REST_NAMESPACE]);

    $routes->get('videos', 'VideosController::getVideos', ['namespace'=> REST_NAMESPACE]);
    $routes->get('videos/(:any)', 'VideosController::getVideos/$1', ['namespace'=> REST_NAMESPACE]);

    $routes->get('reviews_restaurant', 'ReviewsController::getReviewsByRestaurant', ['namespace'=> REST_NAMESPACE]);
    $routes->get('reviews_resturant/(:any)/(:any)', 'ReviewsController::getReviewsByRestaurantAndEmail/$1/$2', ['namespace'=> REST_NAMESPACE]);
    $routes->get('reviews_restaurant/(:any)', 'ReviewsController::getReviewsByRestaurant/$1', ['namespace'=> REST_NAMESPACE]);
    $routes->get('reviews/(:any)', 'ReviewsController::getReviews/$1', ['namespace'=> REST_NAMESPACE]);
    $routes->get('reviews', 'ReviewsController::getReviews', ['namespace'=> REST_NAMESPACE]);
    $routes->post('reviews', 'ReviewsController::create_update_review', ['namespace'=> REST_NAMESPACE]);
    $routes->delete('reviews/(:any)', 'ReviewsController::deleteReview/$1', ['namespace'=> REST_NAMESPACE]);
    $routes->delete('reviews', 'ReviewsController::deleteReview', ['namespace'=> REST_NAMESPACE]);
    
});

$routes->group('commands' , function ($routes)
{
    $routes->cli('gas_stations', 'GasStations::loadGasStations', ['namespace' => COMMAND_NAMESPACE]);
    
    $routes->cli('weather', 'Weather::loadWeather', ['namespace' => COMMAND_NAMESPACE]);

    $routes->cli('news', 'News::loadNews', ['namespace' => COMMAND_NAMESPACE]);

    $routes->cli('videos', 'Videos::loadVideos', ['namespace' => COMMAND_NAMESPACE]);
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
