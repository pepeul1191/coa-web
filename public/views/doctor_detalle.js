var DoctorDetalleView = ModalView.extend({
  initialize: function(options){
    this.targetMensaje = options["targetMensaje"];
    // herencia de atributos, móetodos y eventos
    ModalView.prototype.initialize.apply(this, [options])
    this.inheritEvents(ModalView);
    // delegación de eventos
    this.delegateEvents();
  },
  events: {
    // se está usando asignacion dinamica de eventos en el constructor
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
