<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . "/../vendor/autoload.php";

use App\http\Request;
use Controllers\ActivicyController;
use Src\Router;
use eftec\bladeone\BladeOne;
use Src\Cache;

/**
 * Create cache and blade
 */
$blade = new BladeOne(__DIR__ . "/../views", __DIR__ . "/../cache", BladeOne::MODE_DEBUG);
$cache = new Cache();

/**
 * Set routes
 */
Router::get('/', function() {
    header("Location: /home");
});

Router::get('/home', function() use ($blade) {
    echo $blade->run("homeview");
});

Router::get('/activities', function() use ($blade, $cache) {
    if (empty($_GET)) {
        header("Location: /home");exit;
    }

    $request = new Request(
        strtolower($_SERVER["REQUEST_METHOD"]),
        $_SERVER["REQUEST_URI"],
        $_GET,
        $_POST
    );

    $events = (new ActivicyController($request, $cache))->getActivities();
    echo $blade->run("activitiesview", [
        "events" => $events,
        "username" => $request->query()["username"]
    ]);
});

Router::addNofFoundHandler(function() use ($blade) {
    echo $blade->run("notfoundview");
});

Router::run();