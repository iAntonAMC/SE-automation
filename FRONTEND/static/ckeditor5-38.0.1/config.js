DecoupledDocumentEditor
    .create( document.querySelector( '#document-editor-container__editable' ),
        {
            placeholder: 'Aquí se construyen las ideas...',
            wordCount: {
                onUpdate: stats => {
                    // Prints the current content statistics.
                    console.log( `Characters: ${ stats.characters }\nWords: ${ stats.words }` );
                }
            }
        }
    )
    .then( editor => {
        window.editor = editor;

        const toolbarContainer = document.querySelector( '#document-editor__toolbar' );

        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
    } )
    .catch( error => {
        console.error( 'There was a problem loading the editor build' );
        console.error( error );
    } );
