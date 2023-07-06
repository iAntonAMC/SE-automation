DecoupledDocumentEditor
    .create( document.querySelector( '#document-editor-container__editable' ), {
        placeholder: 'Redacte su documento aquí...',
        autosave: {
            waitingTime: 500,
            save( editor ){
                return autoSave(editor.getData());
            }
        },
        // Image uploader
        simpleUpload: {
            // The URL that the images are uploaded to.
            uploadUrl: URL + 'documentos/imagenes',

            // Enable the XMLHttpRequest.withCredentials property.
            withCredentials: true,

            // Headers sent along with the XMLHttpRequest to the upload server.
            headers: {
                'Content-type': 'image/jpg',
                'X-CSRF-TOKEN': 'CSRF-Token'
            }
        }
    } )
    .then( editor => {
        window.editor = editor;

        const toolbarContainer = document.querySelector( '#document-editor__toolbar' );

        toolbarContainer.appendChild( editor.ui.view.toolbar.element );

        // Update document word count on editor changes
        editor.plugins.get( 'WordCount' ).on( 'update', ( evt, stats ) => {
            const wcount = document.getElementById("characters-count");
            wcount.innerHTML = `Carácteres: ${ stats.characters } | Palabras: ${ stats.words }`;
        } );
    } )
    .catch( error => {
        console.error( 'There was a problem loading the editor build' );
        console.error( error );
    } );


/****************************************
* Autosave document progress into db
*
* @param data
* @return any
****************************************/
function autoSave( data ) {
    return new Promise( resolve => {
        setTimeout( () => {
            const status = document.getElementById("editor-status");
            status.innerHTML = "Guardando...";

            const xhr = new XMLHttpRequest();

            xhr.open("POST", URL + "documentos/autosave");
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Content-type", "application/json");

            // Get form values to save
            var doc_type = document.getElementById("doc_type").value;
            var doc_title = document.getElementById("doc_title").value;
            var doc_body = data;
            var doc_level = document.getElementById("doc_level").value;
            var doc_calendar = document.getElementById("doc_calendar").value;
            var doc_campus = document.getElementById("doc_campus").value;

            const documento = {
                TIPO_DOCTO: doc_type,
                TITULO_DOCTO: doc_title,
                CUERPO_DOCTO: doc_body,
                PUBLICAR: "S",
                CVE_NIVEL: doc_level,
                CVE_CALENDARIO: doc_calendar,
                CAMPUS: doc_campus,
            }

            xhr.send(JSON.stringify(documento));

            xhr.onload = () => {
                const response = xhr.responseText + ' : ' + data;
                console.log(response);
                status.innerHTML = "Guardado.";
            }

            resolve();
        },
        // Autosave waiting time in milliseconds
        500 );
    } );
}
