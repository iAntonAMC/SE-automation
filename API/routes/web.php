<?php

/** @var \Laravel\Lumen\Routing\Router $router */


// --- DB CONNECTION --- //



// --- API ROUTES --- //

# ROOT:
/* Initial API test:
    @return JSON
*/
$router->get('/', function () use ($router) {
    return response()->json(['message' => 'API is Working!']);
});

$router->get('/docs', function () use ($router) {
    try {
        // Create the PDO instance:
        $cnxn = new PDO("mysql:host=localhost; port=3306; dbname=se_docs", "root", "");
        $cnxn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnxn -> exec("SET CHARACTER SET UTF8");

        // Declare cursor variable, for future queries
        $query = "SELECT * FROM documentos WHERE 1";
        $cursor = $cnxn -> prepare($query);
        $cursor -> execute([]);
        $results = $cursor -> fetchAll();

        return response()->json([$results]);
    }
    catch (Exception $E) {
        return response()->json(['error' => 'No se pudo consultar en la BD']);
    }  
}
);




?>
