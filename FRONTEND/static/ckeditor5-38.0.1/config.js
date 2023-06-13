DecoupledDocumentEditor
    .create( document.querySelector( '#document-editor-container__editable' ), {
        plugins: [ Pagination],
        pagination: {
            // A4
            pageWidth: '21cm',
            pageHeight: '29.7cm',

            pageMargins: {
                top: '20mm',
                bottom: '20mm',
                right: '12mm',
                left: '12mm'
            }
        },
        licenseKey: 'RkdrWENUZ2taU29FaUlvTWpaVVJVRnJpSFQ2U1YzY2E0dTFseWxCR0FTekdtRERNRmRjL2ZzN3lVZjQ9LU1qQXlNekEzTVRNPQ=='
    })
    .then( editor => {
        window.editor = editor;

        const toolbarContainer = document.querySelector( '#document-editor__toolbar' );

        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
    })
    .catch( error => {
        console.error( 'There was a problem loading the editor build' );
        console.error( error );
    } );
