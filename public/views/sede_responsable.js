var sedeResponsableView = ModalView.extend({
  initialize: function(options){
    // herencia de atributos, móetodos y eventos
    ModalView.prototype.initialize.apply(this, [options])
    this.inheritEvents(ModalView);
    // delegación de eventos
    this.delegateEvents();
    this.doctoresSelect =  new DoctoresCollection({
      targetMensaje: "defaultTargetMensajes",
    });
  },
  events: {
    // se está usando asignacion dinamica de eventos en el constructor
  },
  llenarModelsSelect: function(){
    this.doctoresSelect.llenarModelsSelect(this.get("sede_id"));
  },
});

var sedeResponsableView = new sedeResponsableView({
  el: "body",
  containerModal: "modal-container",
  urlTemplate: STATICS_URL + "templates/sede_responsable.html",
  handlebarsTemplateId: "sede-responsable-template",
  context: {
    titulo_modal: "Gestión de Responsables de la Sede",
  },
  closeFunction: function(){},
});
