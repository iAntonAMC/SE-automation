DecoupledDocumentEditor
    .create( document.querySelector( '#document-editor-container__editable' ),
        {
            placeholder: 'Aquí se construyen las ideas...',
            autosave: {
                save( editor ){
                    return saveDocument(editor.getData());
                }
            }
        }
    )
    .then( editor => {
        window.editor = editor;

        const toolbarContainer = document.querySelector( '#document-editor__toolbar' );

        toolbarContainer.appendChild( editor.ui.view.toolbar.element );

        // Update document word count on editor change
        editor.plugins.get( 'WordCount' ).on( 'update', ( evt, stats ) => {
            const doc_info = document.getElementById("doc-info");
            doc_info.innerHTML = `Carácteres: ${ stats.characters } | Palabras: ${ stats.words }`;
        } );
    } )
    .catch( error => {
        console.error( 'There was a problem loading the editor build' );
        console.error( error );
    } );


function saveDocument(data) {
    const xhr = new XMLHttpRequest();

    xhr.open("POST", URL + "documentos/temporalsave");

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
        AUTOR_REGISTRO: "4"
    }

    xhr.send(JSON.stringify(documento));

    xhr.onload = () => {
        const response = xhr.responseText;
        console.log(response);
    }
}
