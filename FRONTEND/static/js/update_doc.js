function updateDoc() {
    const xhr = new XMLHttpRequest();

    xhr.open("POST", URL + "documentos/actualizar");

    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-type", "application/json");

    var id_doc = document.URL.split("=")[1];

    // Get form values to save
    var doc_type = document.getElementById("doc_type").value;
    var doc_title = document.getElementById("doc_title").value;
    var doc_body = document.getElementById("document-editor-container__editable").innerHTML;
    var doc_publish = document.getElementById("posted");
    var posted = "N";
    if (doc_publish.checked == true)
    {
        posted = "S";
    }
    var doc_level = document.getElementById("doc_level").value;
    var doc_calendar = document.getElementById("doc_calendar").value;
    var doc_campus = document.getElementById("doc_campus").value;

    // Prepare the uodate timestamp
    var cDate = new Date();
    var year = cDate.getFullYear();
    var month = cDate.getMonth() + 1;
    var day = cDate.getDate();
    var hours = cDate.getHours();
    var min = cDate.getMinutes();
    var secs = cDate.getSeconds();
    var update_date = year + "-" + month + "-" + day + " " + hours + ":" + min + ":" + secs;

    const documento = {
        id: id_doc,
        TIPO_DOCTO: doc_type,
        TITULO_DOCTO: doc_title,
        CUERPO_DOCTO: doc_body,
        PUBLICAR: posted,
        CVE_NIVEL: doc_level,
        CVE_CALENDARIO: doc_calendar,
        CAMPUS: doc_campus,
        FECHA_MODIFICACION: update_date,
        AUTOR_MODIFICACION: "4"
    }

    console.log(JSON.stringify(documento));

    xhr.send(JSON.stringify(documento));

    xhr.onload = () => {
        const response = xhr.responseText;
        console.log(response);
        alert(response);
    }
}
