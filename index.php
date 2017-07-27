<?php
/**
 * Created by PhpStorm.
 * Date: 27.07.2017
 * Time: 12:49
 */


use Symfony\Component\Yaml\Yaml;


error_reporting(E_ALL);
ini_set('display_errors', 1);
require './vendor/autoload.php';

$serviceTargetRoutes = Yaml::parse(file_get_contents('./src/config/routes.yml'));

$routes = array_merge($serviceTargetRoutes);

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);


foreach ($routes as $route => $callableControllerAction) {
    $app->map(['GET', 'POST'], $route, $callableControllerAction);
}

$app->run();