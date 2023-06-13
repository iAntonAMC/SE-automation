DecoupledDocumentEditor
    .create( document.querySelector( '#document-editor-container__editable' ) )
    .then( editor => {
        window.editor = editor;

        const toolbarContainer = document.querySelector( '#document-editor__toolbar' );

        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
    } )
    .catch( error => {
        console.error( 'There was a problem loading the editor build' );
        console.error( error );
    } );
