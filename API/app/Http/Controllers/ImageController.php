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
            $file = $request->file('upload');
            if(isset($file))
            {
                $name = $file->getClientOriginalName();
                return ['url' => $name];
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
