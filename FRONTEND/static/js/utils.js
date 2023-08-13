// Specify where the API is located:
const URL = "http://localhost:8000/";

// Config the fill PDF request:
/****************************************
 * Sends a request to the API to fill a PDF
 *
 * @param int $id
 * @return callable $dompdf
****************************************/
function fillPDF(id) {
    const xhr = new XMLHttpRequest();

    xhr.open("POST", URL + "documentos/fill/" + id);

    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-type", "application/json");

    // Prepare the data to send
    var data = {
        MATRICULA          : "A01234567",
        NOMBRE_COMPLETO    : 'VICENTE ANDRÉS GARCÍA MONTES DE OCA',
        NOMBRE             : 'VICENTE ANDRÉS',
        APELLIDO_PATERNO   : 'MONTES DE OCA',
        APELLIDO_MATERNO   : 'GARCÍA',
        CAMPUS             : 'PACHUCA',
        CARRERA            : 'LICENCIATURA EN MERCADOTECNIA',
        GRADO              : 'SEGUNDO CUATRIMESTRE',
        PERFIL             : 'ALUMNO CONCENTRACIÓN',
        CATEGORIA          : 'UFD 98-04',
        LAVANDERIA         : '2672',
        NIVEL              : 'LICENCIATURA CUATRIMESTRAL',
        PERIODO            : 'ENERO-ABRIL 2023',
        PLAN_ESTUDIOS      : '2DO PLAN ART',
        NIVEL_DEPORTIVO    : 'INICIACIÓN',
        RESIDENCIA         : 'ALTO RENDIMIENTO TUZO',
        HABITACIÓN         : '3154',
        CURP               : 'GAMV900101HDFNNS09',
        DIRECCION          : 'CALLE DOS MZ. 2 LT 3 COL. PONCIANO ARRIAGA CP. 01645',
        LOCALIDAD          : 'ALVARO OBREGON',
        ESTADO             : 'CIUDAD DE MÉXICO',
        FECHA_NACIMIENTO   : '10 DE MARZO DE 1999',
        TELEFONO           : '55 1234 5678',
        CORREO_ELECTRONICO : 'andresmontes@gmail.com',
        PAIS               : 'MÉXICO',
        NOMBRE_TUTOR       : 'GARCIA GARCIA ALICIA',
        TELEFONO_TUTOR     : '55 1234 5678',
        DIRECCION_TUTOR    : 'CALLE DOS MZ. 2 LT 3 COL. PONCIANO ARRIAGA CP. 01645',
        CORREO_TUTOR       : 'aliciagarcia@hotmail.com'
    }

    xhr.send(JSON.stringify(data));

    xhr.onload = () => {
        console.log(xhr.responseText);
        if (xhr.status == 200)
        {
            const response = xhr.responseText;
            const doc = JSON.parse(response);
            var title = doc.Name;
            window.open(URL + "documentos/pdf/" + title, '_blank');
        }
    }
}
