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
  obtenerResponsables: function(){
    this.responsables = {};
    var viewInstance = this;
    $.ajax({
      type: "GET",
      url: BASE_URL + "contenidos/sede/obtener_responsables/" + viewInstance.get("sede_id"),
      data: {csrfmiddlewaretoken: CSRF},
      async: false,
      success: function(data){
        viewInstance.responsables = JSON.parse(data);
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
