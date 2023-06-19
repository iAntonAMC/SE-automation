DecoupledDocumentEditor
    .create( document.querySelector( '#document-editor-container__editable' ),
        {
            placeholder: 'Aquí se construyen las ideas...',
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
