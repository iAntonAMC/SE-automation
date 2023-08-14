INSERT INTO catalogo (DESC_TPO_DOCTO, ORDEN_TPO) VALUES
    ("Formatos de Salida", '13'),
    ("Reglamentos", '10'),
    ("Hoja Informativa de Inscripciones", '11'),
    ("Hoja Informativa de Reinscripciones", '2'),
    ("Solicitud de Inscripción", '12'),
    ("Solicitud de Reinscripción", '5'),
    ("Normas Administrativas", '4'),
    ("Anuencia de formación y participación deportiva", '6'),
    ("Forma de Recomendación", '9'),
    ("Secuencias Didácticas", '15'),
    ("Guias de Estudio", '18'),
    ("Carta responsiva", '7'),
    ("Pase Directo", '9'),
    ("Guia de Acompañamiento de Periodo Transitorio", '17'),
    ("Portafolio de Evidencias", '16'),
    ("Solicitud de Reinscripción", '5'),
    ("Hoja Inf. de Reinscripciones con Pase Directo", '3'),
    ("Tarjetón UFD", '8'),
    ("Guías de Reinscripción", '1'),
    ("Consentimiento médico", '14');

INSERT INTO documents (TIPO_DOCTO, TITULO_DOCTO, CUERPO_DOCTO, PUBLICAR, CVE_NIVEL, CVE_CALENDARIO, CAMPUS, AUTOR_REGISTRO) VALUES
    ('0', 'Documento Ejemplo', '<h2 style="text-align:center;">Título de Documento</h2><div class="ck-horizontal-line ck-widget" contenteditable="false"><hr><div class="ck ck-reset_all ck-widget__type-around"><div class="ck ck-widget__type-around__button ck-widget__type-around__button_before" title="Insertar párrafo antes del bloque" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 8"><path d="M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038"></path></svg></div><div class="ck ck-widget__type-around__button ck-widget__type-around__button_after" title="Insertar párrafo después del bloque" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 8"><path d="M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038"></path></svg></div><div class="ck ck-widget__type-around__fake-caret"></div></div></div><p><span style="color:hsl(0, 75%, 60%);">Prueba de texto documento</span></p><p style="text-align:center;"><span style="color:hsl(0, 0%, 0%);font-family:"Courier New", Courier, monospace;">Courier</span></p><p style="text-align:center;"><span style="color:hsl(0, 0%, 0%);font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;">Este texto es una prueba para llenar una plantilla de un documento guardado en la base de datos</span></p>', '0', '0', 'Mayo - Agosto 2023', '1', '0'),
    ('0', 'Ejemplo Prellenado', '<p data-placeholder="Redacte su documento aquí..."><strong>Instrucciones: Favor de llenar completamente y con letra de molde.</strong><br>Fecha:____________&nbsp;</p><div class="ck-horizontal-line ck-widget" contenteditable="false"><hr><div class="ck ck-reset_all ck-widget__type-around"><div class="ck ck-widget__type-around__button ck-widget__type-around__button_before" title="Insertar párrafo antes del bloque" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 8"><path d="M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038"></path></svg></div><div class="ck ck-widget__type-around__button ck-widget__type-around__button_after" title="Insertar párrafo después del bloque" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 8"><path d="M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038"></path></svg></div><div class="ck ck-widget__type-around__fake-caret"></div></div></div><p>Matrícula: {{MATRICULA}}<br>Fecha de Nacimiento: {{FECHA_NACIMIENTO}}<br>Cuatrimestre actual: {{NIVEL}}<br>Periodo Ciclos que comprende: {{PERIODO}}<br>Perfil Alumno: {{PERFIL}}</p><div class="ck-horizontal-line ck-widget" contenteditable="false"><hr><div class="ck ck-reset_all ck-widget__type-around"><div class="ck ck-widget__type-around__button ck-widget__type-around__button_before" title="Insertar párrafo antes del bloque" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 8"><path d="M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038"></path></svg></div><div class="ck ck-widget__type-around__button ck-widget__type-around__button_after" title="Insertar párrafo después del bloque" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 8"><path d="M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038"></path></svg></div><div class="ck ck-widget__type-around__fake-caret"></div></div></div><h3 style="text-align:center;"><span style="color:hsl(0, 0%, 0%);">INFORMACIÓN GENERAL</span></h3><p style="text-align:justify;">Nombre del Alumno(a): {{NOMBRE_COMPLETO}}<br>Apellido Paterno: {{APELLIDO_PATERNO}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Apellido Materno: {{APELLIDO_MATERNO}}</p>', '0', '0', 'Mayo - Agosto 2023', '1', '0');

INSERT INTO temporal_saves (TIPO_DOCTO, TITULO_DOCTO, CUERPO_DOCTO, PUBLICAR, CVE_NIVEL, CVE_CALENDARIO, CAMPUS) VALUES
    ('0', 'AutoSavePlaceHolder', '<p>AutoSave Placeholder</p>', 'N', '0', 'Mayo - Agosto 2023', '1');

INSERT INTO pdfs (CUERPO_DOCTO) VALUES
    ('<p>PDF filler Placeholder</p>');
