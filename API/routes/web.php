<?php

/** @var \Laravel\Lumen\Routing\Router $router */


// Application Routes //

# ROOT:
$router->get('/', function () use ($router) {
    return response()->json(['message' => 'API is Working!']);
});

?>
