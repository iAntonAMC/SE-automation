function getDocs() {
    const req = new XMLHttpRequest();
    req.open("GET", URL + "docs");
    req.send();

    // Maneja la respuesta obtenida del request
    req.onload = () => {
        const response = req.responseText;
        const docs = JSON.parse(response);
        console.log(docs);

        if (req.status == 200)
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

                // // Se crean los campos de detalles por cada objeto del array
                // var td_ver = document.createElement("td");
                // var td_put = document.createElement("td");
                // var td_borrar = document.createElement("td");

                // // Cada campó redirige a una página HTML pasando el id_contacto como parámetro
                // td_ver.innerHTML = "<a href = 'get_one.html?" + docs[i].id_contacto + "'> ⨀ Detalles </a>";
                // td_put.innerHTML = "<a href = 'put_one.html?" + docs[i].id_contacto + "'> ⨁ Actualizar </a>";
                // td_borrar.innerHTML = "<a href = 'delete.html?" + docs[i].id_contacto + "'> ⨂ Borrar </a>";
                // // Se añade cada elemnto al row que se está creando
                // tr.appendChild(td_ver);
                // tr.appendChild(td_put);
                // tr.appendChild(td_borrar);

                tbody.appendChild(tr);  // Se añade el row creado a la tabla del HTML
            }
        }
    };
};
