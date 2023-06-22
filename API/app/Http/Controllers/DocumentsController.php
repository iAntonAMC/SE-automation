<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Models\TemporalSaves;
use Illuminate\Http\Request;
use Exception;
use Dompdf\Dompdf;

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
            return response()->json(['Error!' => __FILE__.' Dropped an Exception -> ' . $E], 400);
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
            $document = Documents::all()->where('id', $id);

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
            return response()->json(['Error!' => __FILE__.' Dropped an Exception -> ' . $E], 400);
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
                    'AUTOR_REGISTRO' => $request->AUTOR_REGISTRO
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
            return response()->json(['Error!' => __FILE__.' Dropped an Exception -> ' . $E], 400);
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
                    'AUTOR_REGISTRO' => $request->AUTOR_REGISTRO
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
            return response()->json(['Error!' => __FILE__.' Dropped an Exception -> ' . $E], 400);
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
            return response()->json(['Error!' => __FILE__.' Dropped an Exception -> ' . $E], 400);
        }
    }

    /****************************************
     * Build the PDF file specifying the $id
     *
     * @param int $id
     * @return callable $dompdf
    ****************************************/
    public function BuildPDF($id)
    {
        try
        {
            $document = Documents::find($id);
            //print_r($document["CUERPO_DOCTO"]);
            $body = $document["CUERPO_DOCTO"];
            $styles = '.document-editor {
                border: 1px solid var(--ck-color-base-border);
                border-radius: var(--ck-border-radius);
            
                /* Set vertical boundaries for the document editor. */
                max-height: 92.5vh;
            
                /* This element is a flex container for easier rendering. */
                display: flex;
                flex-flow: column nowrap;
            }
            
            .document-editor__toolbar {
                /* Make sure the toolbar container is always above the editable. */
                z-index: 1;
            
                /* Create the illusion of the toolbar floating over the editable. */
                box-shadow: 0 0 5px hsla( 0,0%,0%,.2 );
            
                /* Use the CKEditor CSS variables to keep the UI consistent. */
                border-bottom: 1px solid var(--ck-color-toolbar-border);
            }
            
            /* Adjust the look of the toolbar inside the container. */
            .document-editor__toolbar .ck-toolbar {
                border: 0;
                border-radius: 0;
            }
            
            /* Make the editable container look like the inside of a native word processor application. */
            .document-editor-container {
                padding: calc( 2 * var(--ck-spacing-large) );
                background: rgb(155, 155, 155);
            
                /* Make it possible to scroll the "page" of the edited content. */
                overflow-y: scroll;
            }
            
            .document-editor-container .ck-editor__editable {
                /* Set the dimensions of the "page". */
                width: 21cm;
                min-height: 29.7cm;
            
                /* Keep the "page" off the boundaries of the container. */
                padding: 1cm 2cm 2cm;
            
                border: 1px hsl( 0,0%,82.7% ) solid;
                border-radius: var(--ck-border-radius);
                background: white;
            
                /* The "page" should cast a slight shadow (3D illusion). */
                box-shadow: 0 0 5px hsla(0, 0%, 0%, 0.15);
            
                /* Center the "page". */
                margin: 0 auto;
            }
            
            
            /* Set the "page" defaults, for best user experience */
            
            /* Set the default font for the "page" of the content. */
            .document-editor .ck-content,
            .document-editor .ck-heading-dropdown .ck-list .ck-button__label {
                font: 16px/1.6 "Helvetica Neue", Helvetica, Arial, sans-serif;
            }
            
            /* Adjust the headings dropdown to host some larger heading styles. */
            .document-editor .ck-heading-dropdown .ck-list .ck-button__label {
                line-height: calc( 1.7 * var(--ck-line-height-base) * var(--ck-font-size-base) );
                min-width: 6em;
            }
            
            /* Scale down all heading previews because they are way too big to be presented in the UI.
            Preserve the relative scale, though. */
            .document-editor .ck-heading-dropdown .ck-list .ck-button:not(.ck-heading_paragraph) .ck-button__label {
                transform: scale(0.8);
                transform-origin: left;
            }
            
            /* Set the styles for "Heading 1". */
            .document-editor .ck-content h2,
            .document-editor .ck-heading-dropdown .ck-heading_heading1 .ck-button__label {
                font-size: 2.18em;
                font-weight: normal;
            }
            
            .document-editor .ck-content h2 {
                line-height: 1.37em;
                padding-top: .342em;
                margin-bottom: .142em;
            }
            
            /* Set the styles for "Heading 2". */
            .document-editor .ck-content h3,
            .document-editor .ck-heading-dropdown .ck-heading_heading2 .ck-button__label {
                font-size: 1.75em;
                font-weight: normal;
                color: hsl( 203, 100%, 50% );
            }
            
            .document-editor .ck-heading-dropdown .ck-heading_heading2.ck-on .ck-button__label {
                color: var(--ck-color-list-button-on-text);
            }
            
            /* Set the styles for "Heading 2". */
            .document-editor .ck-content h3 {
                line-height: 1.86em;
                padding-top: .171em;
                margin-bottom: .357em;
            }
            
            /* Set the styles for "Heading 3". */
            .document-editor .ck-content h4,
            .document-editor .ck-heading-dropdown .ck-heading_heading3 .ck-button__label {
                font-size: 1.31em;
                font-weight: bold;
            }
            
            .document-editor .ck-content h4 {
                line-height: 1.24em;
                padding-top: .286em;
                margin-bottom: .952em;
            }
            
            /* Set the styles for "Paragraph". */
            .document-editor .ck-content p {
                font-size: 1em;
                line-height: 1.63em;
                padding-top: .5em;
                margin-bottom: 1.13em;
            }
            
            /* Make the block quoted text serif with some additional spacing. */
            .document-editor .ck-content blockquote {
                font-family: Georgia, serif;
                margin-left: calc( 2 * var(--ck-spacing-large) );
                margin-right: calc( 2 * var(--ck-spacing-large) );
            };';

            $dompdf = new Dompdf();

            // pass an array of options
            $dompdf->getOptions()->set([]);

            //Build the content body
            $dompdf->loadHtml($body);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper("A4","portrait");

            // Render the HTML as PDF
            $dompdf->render();

            return $dompdf->stream("Documento.pdf", ['Attachment' => 0, 'compress' => 0]);
        }
        catch (Exception $E) {
            return response()->json(['Error!' => __FILE__.' Dropped an Exception -> ' . $E], 400);
        }
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
            return response()->json(['Error!' => __FILE__.' Dropped an Exception -> ' . $E], 400);
        }
    }
}
