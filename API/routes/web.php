<?php

/** @var \Laravel\Lumen\Routing\Router $router */


// --- API ROUTES --- //

# ROOT
/* Initial API test:
    @return JSON
*/
$router->get('/', function () {
    return response()->json(['message' => 'API is Working!']);
});

//Temporal route for tests
$router->get('/text', function () {
    return response("Funcionó el Header", 200, ['Access-Control-Allow-Origin: http://127.0.0.1:666/'])
        ->header('Access-Control-Allow-Origin', 'http://127.0.0.1:666');
});


# GET ALL DOCUMENTS
/* Reads all the documents registered in database:
    @param $calendar : string
    @return $response : JSON, HTTP code
*/
$router->get('/docs', function () use ($router) {
    try {
        // Create the PDO instance.
        $cnxn = new PDO("mysql:host=localhost; port=3306; dbname=se_docs", "root", "");
        $cnxn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnxn -> exec("SET CHARACTER SET UTF8");

        $query = "SELECT * FROM documentos WHERE 1";
        $cursor = $cnxn -> prepare($query);
        $cursor -> execute([]);
        $results = $cursor -> fetchAll();

        // Check if there's docs to return.
        if ($results == []) {
            return response()->json(['Error' => 'No se encontraron documentos en la BD'], 404);
        }
        else {
            return response()->json($results, 200);
        }
    }
    catch (Exception $E) {
        return response()->json(['Error' => 'No se pudo consultar en la BD -> ' . $E], 400);
    }
    finally {
        $cnxn = null;
    }
}
);


# GET ONE DOCUMENT
/* Reads the document matching by id:
    @param $doc_id : int
    @return $response : JSON, HTTP code
*/
$router->get('/docs/{doc_id}', function ($doc_id) {
    try {
        // Create the PDO instance.
        $cnxn = new PDO("mysql:host=localhost; port=3306; dbname=se_docs", "root", "");
        $cnxn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnxn -> exec("SET CHARACTER SET UTF8");

        $query = "SELECT * FROM documentos WHERE ID_DOCTO = ?";
        $cursor = $cnxn -> prepare($query);
        $cursor -> execute([$doc_id]);
        $results = $cursor -> fetch();

        // Check if there's docs to return.
        if ($results == []) {
            return response()->json(['Error' => 'Ningún documento coincide con lo especificado'], 404);
        }
        else {
            return response()->json($results, 200);
        }
    }
    catch (Exception $E) {
        return response()->json(['Error' => 'No se pudo consultar en la BD -> ' . $E], 400);
    }
    finally {
        $cnxn = null;
    }
}
);











?>
