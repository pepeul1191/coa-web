var SedeDoctorView = ModalView.extend({
  initialize: function(options){
    // herencia de atributos, móetodos y eventos
    ModalView.prototype.initialize.apply(this, [options])
    this.inheritEvents(ModalView);
    // delegación de eventos
    this.delegateEvents();
    this.tabla = new TableView(paramsSedeDoctorTable);
  },
  events: {
    // se está usando asignacion dinamica de eventos en el constructor
  },
  mostrarDoctores: function(){
    this.tabla.urlListar = this.tabla.urlListar + this.get("sede_id");
    this.tabla.listar();
  },
});

var sedeDoctorView = new SedeDoctorView({
  el: "body",
  containerModal: "modal-container",
  urlTemplate: STATICS_URL + "templates/sede_doctor.html",
  handlebarsTemplateId: "sede-doctor-template",
  context: {
    titulo_modal: "Gestión de Doctores de la Sede",
  },
  closeFunction: function(){},
});
