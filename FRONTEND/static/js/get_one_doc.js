function getDocData() {
    ActualURL = document.URL;

    // Get ID from URL
    id_doc = ActualURL.split("=")[1];

    const xhr = new XMLHttpRequest();
    xhr.open("GET", URL + "documentos/" + id_doc);
    xhr.send();

    // Maneja la respuesta obtenida del request
    xhr.onload = () => {
        const response = xhr.responseText;
        const doc_body = JSON.parse(response);
        console.log(doc_body[0]);

        if (xhr.status == 200) {
            var titulo = document.getElementById("doc_title");
            var tipo = document.getElementById("doc_type");
            var nivel = document.getElementById("doc_level");
            var calendar = document.getElementById("doc_calendar");
            var campus = document.getElementById("doc_campus");
            var posted = document.getElementById("posted");
            var cuerpo = doc_body[0]["CUERPO_DOCTO"];

            titulo.value = doc_body[0]["TITULO_DOCTO"];
            tipo.value = doc_body[0]["TIPO_DOCTO"];
            nivel.value = doc_body[0]["CVE_NIVEL"];
            calendar.value = doc_body[0]["CVE_CALENDARIO"];
            campus.value = doc_body[0]["CAMPUS"];
            if (doc_body[0]["PUBLICAR"] == "S") {
                posted.checked = true;
            }
            editor.setData(cuerpo);
        }
    };
};
