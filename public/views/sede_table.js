var paramsSedeTable = {
  el: "#formTableSede",
  idTable: "tablaSede",
  targetMensaje: "mensajeRptaSede",
  mensajes: {
    errorListarAjax: "Error en listar los datos del servidor",
    errorGuardarAjax: "Error en guardar los datos en el servidor",
    success: "Se cargado guardo los cambios en las especialidades",
  },
  //urlListar: BASE_URL + "distrito/listar/" + provinciaId,
  urlGuardar: BASE_URL + "contenidos/sede/guardar",
  urlListar: BASE_URL + "contenidos/sede/listar",
  fila: {
    id: { // llave de REST
      tipo: "td_id",
      estilos: "color: blue; display:none",
      edicion: false,
    },
    nombre: { // llave de REST
      tipo: "text",
      estilos: "width: 200px;",
      edicion: true,
    },
    direccion: { // llave de REST
      tipo: "text",
      estilos: "width: 300px;",
      edicion: true,
    },
    telefono: { // llave de REST
      tipo: "text",
      estilos: "width: 80px;",
      edicion: true,
    },
    latitud: { // llave de REST
      tipo: "text",
      estilos: "width: 80px;",
      edicion: true,
    },
    longitud: { // llave de REST
      tipo: "text",
      estilos: "width: 80px;",
      edicion: true,
    },
    tipo_sede_id: { // llave de REST
      tipo: "select",
      estilos: "width: 125px;",
      edicion: true,
      collection: tipoSedesCollection,
    },
    filaBotones: {
      estilos: "width: 80px"
    },
  },
  filaBotones: [
    {
      tipo: "i",
      claseOperacion: "quitar-fila",
      clase: "fa-times",
      estilos: "padding-left: 15px;",
    },
  ],
  collection: new SedesCollection(),
  model: "Sede",
};
