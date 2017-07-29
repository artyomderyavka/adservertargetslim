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

$routes = Yaml::parse(file_get_contents('./src/config/routes.yml'));

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$container = new \Slim\Container($configuration);
$container['contentServiceClient'] = function ($container) {
    return new \AdServer\LocalClient();
};
\AdServer\Engine::run($container, $routes);
