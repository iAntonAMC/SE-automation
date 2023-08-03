<?php

/** @var \Laravel\Lumen\Routing\Router $router */


// --- API ROUTES --- //

# ROOT
$router->get('/', ['uses'=>'DocumentsController@APICheck']);

# GET ALL
$router->get('/documentos', ['uses'=>'DocumentsController@GetAllDocuments']);

# GET ONE
$router->get('/documentos/{id}', ['uses'=>'DocumentsController@GetDocumentById']);

# POST ONE
$router->post('/documentos', ['uses' => 'DocumentsController@CreateNewDocument']);

# UPDATE ONE
$router->post('/documentos/actualizar', ['uses' => 'DocumentsController@UpdateDocument']);

# DELETE ONE
$router->delete('/documentos/{id}', ['uses' => 'DocumentsController@DeleteDocument']);

# GET PDF PREVIEW
$router->get('/documentos/pdf/{id}', ['uses' => 'DocumentsController@BuildPDF']);

# GET PDF FILLED
$router->post('/documentos/build-pdf/{id}', ['uses' => 'DocumentsController@FillPDF']);

# AUTOSAVE
$router->post('/documentos/autosave', ['uses' => 'DocumentsController@AutoSave']);

// 'middleware' => 'csrf',

# IMAGE UPLOADING
$router->post('/documentos/imagenes', ['uses' => 'ImageController@upload']);
