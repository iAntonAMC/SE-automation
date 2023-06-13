# Proyecto Estadía: Automatización del llenado de formatos para Reinscripciones UFD


## Antecedentes
La Universidad del Fútbol y Ciencias del Deporte, es una institución de educación en el estado de Hidalgo, México. Esta institución educativa tiene un modelo de enseñanza en torno al deporte.
El 15 de febrero de 2000 el gobernador de Hidalgo, Manuel Ángel Núñez Soto, colocó la primera piedra de la Universidad. Se culminó la primera etapa de la universidad con la inauguración de las instalaciones el día 8 de noviembre de 2001. El gobernador de Hidalgo, Manuel Ángel Núñez Soto, fue el encargado de cortar el listón, acompañado por Jesús Martínez, Presidente del Club Pachuca y de Nelson Vargas, titular de la CONADE (Comisión Nacional del Deporte).

La institución comprende diferentes niveles académicos desde Preescolar hasta diferentes opciones de Posgrado, por lo que el proceso de reeinscripciones y el llenado de formatos para esto resultan en un proceso que toma mucho tiempo tanto para el área de Servicios Escolares, como para el área de Sistemas y Desarrollo, inclusive para los padres o tutores o alumnos quienes son los que deben de hacer un llenado completo de todos y cada uno de los formatos que se necesitan

Actualmente existe un portal desarrollado por el equipo de desarrollo de la UFD el cuál permite a los tutores o alumnos a buscar dichos formatos de reeinscripción, los cuáles son almacenados dentro del server que usan los sistemas, la búsqueda se realiza a través de una nomenclatura acordada por las áreas involucradas.
(Aqui en esta parte es en donde va lo de cómo se realiza la búsqueda actualmente, en el sentido de cómo diferencian cada tipo de archivo)


## Definición del Problema
Los archivos de formato de reincripción son creados por el área de Servicios Escolares y en ocasiones no llegan a ser almacenados con la nomenclatura correcta, ya sea por algún error al momento de crear, guardar, trasladar o subir éstos al server, por esta razón al intentar ser accedidos por la parte del sitio web de los tutores o interesados en la reinscripción llegan a existir errores tipo 404 (Not Found) debido a que la búsqueda se realiza bajo las especificaciones que cada nomenclatura debe tener. Esto significa un problema para todos los relacionados al proceso, ya que los interesados deben reportar la falla al área deServicios para poder continuar con su proceso de reinscripción, el área de Servicios Escolares debe comunicarse con soporte de Sistemas para poder verificar en qué parte y por cuáles motivos se genera el error para finalmente, encontrar y renombrar el archivo en específico del cuál no se encuentra desde el portal de la persona que levantó el reporte inicial. Significando así una pérdida de tiempo y retraso dentro de lo que es el proceso de reinscripción, así como una pérdida o desperdicio de recursos como lo pueden ser el almacenamiento y rendimiento del servidor, como gastos energéticos.


## Definición del Proyecto
Se desarrollará una API, empleando herramientas como Laravel para PHP y una propuesta de una nueva tabla para la base de datos del server, esta API fungira como herramienta para poder facilitar la solución a la problemática descrita anteriormente, el API generará los archivos PDF necesarios y realizará el llenado de forma automática, para facilitar así el avance en tiempos de reeinscripción.

### Funciones necesarias para el API
1. Desplegar un apartado de edición de texto para Servicios Escolares
2. Almacenar el texto a través de un POST como formulario o con una petición AJAX
3. Recuperar el texto almacenado
4. Codificar el texto recuperado como "plantilla"
5. Almacenar el cuerpo de la "plantilla" generada por SE dentro de una tabla en la base de datos de SQL Server
6. Recuperar la "plantilla" almacenada en la base de datos
7. Decodificar el texto recuperado para construir el archivo PDF
8. Recibir un objeto JSON desde el portal de interesados en reinscripción con todos los datos necesarios para el llenado de formatos
9. Manipular el archivo JSON para identificar el tipo de información que llega
10. Distinguir la información por Nivel, Calendario y Tipo de estudio
11. Construir el archivo PDF al vuelo empleando la "plantilla" recuperada y la información necesaria para cada documento que se pueda prellenar
12. Generar un URL instantáneo para poder acceder al PDF generado
13. Devolver el JSON al portal de interesados en reinscripción con el URL del PDF generado para que pueda ser desplegado como lo hace actualmente.


# Configuraciones
- Instalar domPDF:

    composer require dompdf/dompdf

- Estructura de la tabla empleada en la base de datos (MySQL):

    DROP TABLE IF EXISTS documents;
    CREATE TABLE documents (
        id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        TIPO_DOCTO INTEGER NOT NULL,
        TITULO_DOCTO TEXT(200) NOT NULL,
        CUERPO_DOCTO TEXT NOT NULL,
        PUBLICAR VARCHAR(2) NOT NULL,
        CVE_NIVEL INTEGER NOT NULL,
        CVE_CALENDARIO TEXT(100) NOT NULL,
        CAMPUS INTEGER NOT NULL,
        FECHA_REGISTRO TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        AUTOR_REGISTRO VARCHAR(10) NOT NULL,
        FECHA_MODIFICACION DATE DEFAULT NULL,
        AUTOR_MODIFICACION VARCHAR(10) DEFAULT NULL
    )ENGINE=INNODB;

    CREATE INDEX id_tipo ON documents(id, TIPO_DOCTO);
    CREATE INDEX id_titulo ON documents(id, TITULO_DOCTO);
    CREATE INDEX id_nivel_calendario ON documents(id, CVE_NIVEL, CVE_CALENDARIO)

- Modificar archivo .env para la integración con la base de datos:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=se_docs
    DB_USERNAME=root
    DB_PASSWORD= 
    CACHE_DRIVER=file
    QUEUE_CONNECTION=sync

---
# URLS
### [Lumen Docs](https://lumen.laravel.com/docs)
---
