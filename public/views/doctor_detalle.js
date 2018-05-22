var DoctorDetalleView = ModalView.extend({
  initialize: function(options){
    this.targetMensaje = options["targetMensaje"];
    // herencia de atributos, móetodos y eventos
    ModalView.prototype.initialize.apply(this, [options])
    this.inheritEvents(ModalView);
    // delegación de eventos
    this.delegateEvents();
    this.sexosSelect =  new SexosCollection({
      targetMensaje: "defaultTargetMensajes",
    });
    this.tipoSedesSelect = new TipoSedesCollection({
      targetMensaje: "defaultTargetMensajes",
    });
    this.sedesSelect = new SedesCollection({
      targetMensaje: "defaultTargetMensajes",
    });
    this.especialidadesSelect = new EspecialidadesCollection({
      targetMensaje: "defaultTargetMensajes",
    });
    this.model = new Doctor();
  },
  events: {
    // se está usando asignacion dinamica de eventos en el constructor
    "change #cbmTipoSede": "refrescarSedes",
  },
  setModel: function(){
    var viewInstance = this;
    $.ajax({
      type: "GET",
      url: BASE_URL + "contenidos/doctor/obtener/" + viewInstance.get("doctor_id"),
      data: {csrfmiddlewaretoken: CSRF},
      async: false,
      success: function(data){
        viewInstance.model = JSON.parse(data);
      },
      error: function(error){
        $("#" + viewInstance.targetMensaje).removeClass("color-success");
        $("#" + viewInstance.targetMensaje).removeClass("color-warning");
        $("#" + viewInstance.targetMensaje).addClass("color-danger");
        $("#" + viewInstance.targetMensaje).html("Error en listar los tipos de estaciones");
        $("html, body").animate({ scrollTop: $("#" + viewInstance.targetMensaje).offset().top }, 1000);
        console.log(error);
      }
    });
  },
  llenarModelsSelect: function(){
    this.sexosSelect.llenarModels();
    this.tipoSedesSelect.llenarModels();
    this.sedesSelect.llenarModels(this.model.tipo_sede_id);
    this.especialidadesSelect.llenarModels();
  },
  refrescarSedes: function(event){
    this.sedesSelect.llenarModels(event.target.value);
    $("#cbmSede").empty();
    for (var i = 0; i < this.sedesSelect.toJSON().length; i++) {
      var option = document.createElement("option");
			option.value = this.sedesSelect.toJSON()[i].id;
			option.text = this.sedesSelect.toJSON()[i].nombre;
			document.getElementById("cbmSede").appendChild(option);
    }
    document.getElementById("cbmSede").value = this.model.sede_id;
  },
});

var doctorDetalleView = new DoctorDetalleView({
  el: "body",
  containerModal: "modal-container",
  urlTemplate: STATICS_URL + "templates/doctor_detalle.html",
  handlebarsTemplateId: "doctor-detalle-template",
  targetMensaje: "mensajeRptaDoctor",
  context: {
    titulo_modal: "Editar Doctor",
  },
  closeFunction: function(){},
});
