var sedeResponsableView = new ModalView({
  el: "body",
  containerModal: "modal-container",
  urlTemplate: STATICS_URL + "templates/sede_responsable.html",
  handlebarsTemplateId: "sede-responsable-template",
  context: {
    titulo_modal: "Gestión de Responsables de la Sede",
  },
  closeFunction: function(){},
});
