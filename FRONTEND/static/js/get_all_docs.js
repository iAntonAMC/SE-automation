function getDocs() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", URL + "documentos");
    xhr.send();

    // Maneja la respuesta obtenida del request
    xhr.onload = () => {
        const response = xhr.responseText;
        const docs = JSON.parse(response);

        if (xhr.status == 200)
        {
            const tbody = document.getElementById("docs_table_body");
            for(let i = 0; i<docs.length; i++)
            {
                // Se crean los elementos que rellenan la información de la tabla:
                var tr = document.createElement("tr");
                var td_titulo = document.createElement("td");
                var td_tipo = document.createElement("td");
                var td_nivel = document.createElement("td");

                // Dentro de cada elemento se coloca la info de cada columna, según se recorra cada objeto del array recibido (contactos)
                td_titulo.innerHTML = docs[i].TITULO_DOCTO;
                td_tipo.innerHTML = docs[i].TIPO_DOCTO;
                td_nivel.innerHTML = docs[i].CVE_NIVEL;

                // Se une cada elemento creado a la row que se coloca en la tabla
                tr.appendChild(td_titulo);
                tr.appendChild(td_tipo);
                tr.appendChild(td_nivel);

                // Se crean los campos de detalles por cada objeto del array
                var td_ver = document.createElement("td");
                var td_put = document.createElement("td");
                // var td_borrar = document.createElement("td");
                var td_llenar = document.createElement("td");

                // Cada campo redirige a una página HTML pasando el id_contacto como parámetro
                td_ver.innerHTML = "<a href = 'http://localhost:8000/documentos/pdf/" + docs[i].id + "' target='_blank'> ⨀ Ver PDF </a>";
                td_put.innerHTML = "<a href = '/views/editar-documento.html?id=" + docs[i].id + "'> ⨁ Editar </a>";
                // td_borrar.innerHTML = "<a href = 'http://localhost:8000/documentos/" + docs[i].id + "'> ✘ Borrar </a>";
                td_llenar.innerHTML = "<a href = '/views/documento-pdf.html?id=" + docs[i].id + "' target='_blank'> ⨀ Llenar PDF </a>";

                // Se añade cada elemnto al row que se está creando
                tr.appendChild(td_ver);
                tr.appendChild(td_put);
                // tr.appendChild(td_borrar);
                tr.appendChild(td_llenar);

                tbody.appendChild(tr);  // Se añade el row creado a la tabla del HTML
            }
        }
    };
};
