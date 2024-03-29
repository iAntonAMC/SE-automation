<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\TemporalSaves;
use App\Models\PDFs;
use Illuminate\Http\Request;
use Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

class DocumentsController extends Controller
{
    /****************************************
     * Confirm that API is serving.
     *
     * @return object JSON
    ****************************************/
    public function APICheck()
    {
        return response()->json(['message' => 'API is Working!']);
    }

    /****************************************
     * Read all docs registered in DB.
     *
     * @return JSON array $documents
    ****************************************/
    public function GetAllDocuments()
    {
        try
        {
            $documentos = Documents::all();

            // Verify if $documents is not null
            if ($documentos == '[]') {
                return response()->json(['Empty!' => 'No docs where found in DB'], 404);
            }
            else {
                return response($documentos, 200);
            }
        }
        catch (Exception $E)
        {
            return response()->json(['Error!' => __FILE__.'@GetAllDocuments Dropped an Exception -> ' . $E], 400);
        }
    }

    /****************************************
     * Read an specific doc from DB.
     *
     * @param int $id
     * @return JSON $document
    ****************************************/
    public function GetDocumentById($id)
    {
        try
        {
            $document = Documents::find($id);

            // Verify if $documents is not null
            if ($document == '[]') {
                return response()->json(['Empty!' => 'No docs correspond to given ID'], 404);
            }
            else {
                return response($document, 200);
            }
        }
        catch (Exception $E)
        {
            return response()->json(['Error!' => __FILE__.'@GetDocumentById Dropped an Exception -> ' . $E], 400);
        }
    }

    /****************************************
     * Save a doc into DB.
     *
     * @param object $request
     * @return JSON $response
    ****************************************/
    public function CreateNewDocument(Request $request)
    {
        try
        {
            $inserted = Documents::create(
                [
                    'TIPO_DOCTO' => $request->TIPO_DOCTO,
                    'TITULO_DOCTO' => $request->TITULO_DOCTO,
                    'CUERPO_DOCTO' => $request->CUERPO_DOCTO,
                    'PUBLICAR' => $request->PUBLICAR,
                    'CVE_NIVEL' => $request->CVE_NIVEL,
                    'CVE_CALENDARIO' => $request->CVE_CALENDARIO,
                    'CAMPUS' => $request->CAMPUS,
                    'AUTOR_REGISTRO' => $request->AUTOR_REGISTRO,
                    'FECHA_MODIFICACION' => null,
                    'AUTOR_MODIFICACION' => null
                ]
            );

            //Verify if Doc was successfully inserted
            if ($inserted) {
                return response()->json(['Success!' => 'New doc inserted into DB'], 200);
            }
            else {
                return response()->json(['Error!' => 'Couldnt insert new doc into DB'], 400);
            }
        }
        catch (Exception $E)
        {
            return response()->json(['Error!' => __FILE__.'@CreateNewDocument Dropped an Exception -> ' . $E], 400);
        }
    }

    /****************************************
     * Update a doc from db by $id.
     *
     * @param object $request
     * @return JSON $response
    ****************************************/
    public function UpdateDocument(Request $request)
    {
        try
        {
            $updated = Documents::where('id', $request->id)->update(
                [
                    'TIPO_DOCTO' => $request->TIPO_DOCTO,
                    'TITULO_DOCTO' => $request->TITULO_DOCTO,
                    'CUERPO_DOCTO' => $request->CUERPO_DOCTO,
                    'PUBLICAR' => $request->PUBLICAR,
                    'CVE_NIVEL' => $request->CVE_NIVEL,
                    'CVE_CALENDARIO' => $request->CVE_CALENDARIO,
                    'CAMPUS' => $request->CAMPUS,
                    'FECHA_MODIFICACION' => $request->FECHA_MODIFICACION,
                    'AUTOR_MODIFICACION' => $request->AUTOR_MODIFICACION
                ]
            );

            // Verify if Doc was successfully updated
            if ($updated == 1) {
                return response()->json(['Success!' => 'Doc successfully updated'], 200);
            }
            else {
                return response()->json(['Error!' => 'Couldnt update doc'], 400);
            }
        }
        catch (Exception $E)
        {
            return response()->json(['Error!' => __FILE__.'@UpdateDocument Dropped an Exception -> ' . $E], 400);
        }
    }

    /****************************************
     * Delete a doc from db by $id.
     *
     * @param int $id
     * @return JSON $response
    ****************************************/
    public function DeleteDocument($id)
    {
        try
        {
            if (Documents::where('id', $id)->delete())
            {
                return response()->json(['Success!' => 'Doc successfully deleted'], 200);
            }
            else {
                return response()->json(['Error!' => 'Couldnt delete doc from DB'], 400);
            }
        }
        catch (Exception $E) {
            return response()->json(['Error!' => __FILE__.'@DeleteDocument Dropped an Exception -> ' . $E], 400);
        }
    }

    /****************************************
     * Preview the PDF file specifying the doc $id
     *
     * @param int $id
     * @return callable $dompdf
    ****************************************/
    public function BuildPDF($id)
    {
        try
        {
            $document = Documents::find($id);

            $body = $document["CUERPO_DOCTO"];

            // DOMPDF configuration
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($options);

            //Build the content body
            $dompdf->loadHtml($body);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper("A4","portrait");

            // Render the HTML as PDF
            $dompdf->render();

            $dompdf->stream("Documento.pdf", ['Attachment' => 0, 'compress' => 0]);
        }
        catch (Exception $E) {
            return response()->json(['Error!' => __FILE__.'@BuildPDF Dropped an Exception -> ' . $E], 400);
        }
    }

    /****************************************
     * Fill the PDF with portal data
     *
     * @param int $id
     * @param object $request
     * @return JSON $response
    ****************************************/
    public function FillPDF(Request $request, $id)
    {
        try
        {
            // Recieve the data from the request
            $data = $request->all();

            // Get the template from DB
            $document = Documents::find($id);
            $title = $document["TITULO_DOCTO"];
            $body = $document["CUERPO_DOCTO"];

            // Replace the placeholders with the data
            foreach ($data as $key => $value) {
                if (strpos($body, '{{'.$key.'}}') !== false) {
                    $body = str_replace('{{'.$key.'}}', $value, $body);
                }
            }

            // Prepare PDF in DB
            $id = pdfs::all('id');
            $updated = pdfs::where('id', $id[0]['id'])->update(
                [
                    'CUERPO_DOCTO' => $body,
                ]
            );
            if ($updated == 1) {
                return response()->json(['Name' => $title, 'Content:' => $body], 200);
            }
            else {
                return response()->json(['Error!' => 'Couldnt fill pdf content'], 400);
            }
        }
        catch (Exception $E) {
            return response()->json(['Error!' => __FILE__.'@FillPDF Dropped an Exception -> ' . $E], 400);
        }
    }

    /****************************************
     * Print the PDF on screen
     *
     * @param str $doc
     * @return callable $dompdf
    ****************************************/
    public function PrintPDF($doc)
    {
        $document = pdfs::all();
        $body = $document[0]["CUERPO_DOCTO"];

        // DOMPDF configuration
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        //Build the content body
        $dompdf->loadHtml($body);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper("A4","portrait");

        // Render the HTML as PDF
        $dompdf->render();

        $dompdf->stream($doc, ['Attachment' => 0, 'compress' => 0]);
    }


    /****************************************
     * Saves the progress in the editor.
     *
     * @param object $request
     * @return JSON $response
    ****************************************/
    public function AutoSave(Request $request)
    {
        try
        {
            $id = TemporalSaves::all('id');
            $updated = TemporalSaves::where('id', $id[0]['id'])->update(
                [
                    'TIPO_DOCTO' => $request->TIPO_DOCTO,
                    'TITULO_DOCTO' => $request->TITULO_DOCTO,
                    'CUERPO_DOCTO' => $request->CUERPO_DOCTO,
                    'PUBLICAR' => $request->PUBLICAR,
                    'CVE_NIVEL' => $request->CVE_NIVEL,
                    'CVE_CALENDARIO' => $request->CVE_CALENDARIO,
                    'CAMPUS' => $request->CAMPUS,
                ]
            );

            // Verify if Doc was successfully updated
            if ($updated == 1) {
                return response()->json(['Success!' => 'Doc successfully updated'], 200);
            }
            else {
                return response()->json(['Error!' => 'Couldnt update doc'], 400);
            }
        }
        catch (Exception $E)
        {
            return response()->json(['Error!' => __FILE__.'@AutoSave Dropped an Exception -> ' . $E], 400);
        }
    }
}
