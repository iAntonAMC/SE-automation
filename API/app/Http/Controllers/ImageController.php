<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /****************************************
     * Move the uploaded file to storage.
     *
     * @return object JSON
    ****************************************/
    public function upload(Request $request)
    {
        try
        {
            $file = $request->file();
            if(isset($file))
            {
                // $path = Storage::put('images', $file);
                return ['url' => $file];
            }
            else
            {
                return ['url' => 'Imagen no encontrada'];
            }
        }
        catch (Exception $E)
        {
            return response()->json(['Error!' => __FILE__.' Dropped an Exception -> ' . $E], 400);
        }
    }
}
