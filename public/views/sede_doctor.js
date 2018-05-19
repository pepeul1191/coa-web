var sedeDoctorView = new ModalView({
  el: "body",
  containerModal: "modal-container",
  urlTemplate: STATICS_URL + "templates/sede_doctor.html",
  handlebarsTemplateId: "sede-doctor-template",
  context: {
    titulo_modal: "Gestión de Doctores de la Sede",
  },
  closeFunction: function(){},
});
