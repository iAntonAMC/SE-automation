<?php
use Dompdf\Dompdf;
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------

*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hola-mundo', function () use ($router) {
    return response()->json(['mensaje' => 'API is working']);
});

$router->get('/pdf', function () use ($router) {
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    // pass an array of options
    $dompdf->getOptions()->set([]);
    $dompdf->loadHtml('<div class="ql-editor" data-gramm="false" contenteditable="true"><p>Hello World!</p><p><strong class="ql-size-large">Hello World!</strong></p><p><br></p><p>Hello World!</p><h1 class="ql-align-center">Hello World!</h1><h2 class="ql-align-center">Hello World!</h2><p class="ql-align-center"><br></p><p class="ql-align-right"><span class="ql-font-monospace">Hello World!</span></p><p><br></p></div><div class="ql-clipboard" contenteditable="true" tabindex="-1"></div><div class="ql-tooltip ql-hidden"><a class="ql-preview" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a class="ql-action"></a><a class="ql-remove"></a></div>');

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    
    return $dompdf->stream('hola.pdf', ['Attachment' => 0, 'compress' => 0]);
});

?>
