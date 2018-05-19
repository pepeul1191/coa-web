var Router = Marionette.AppRouter.extend({
    routes: {
      'email/:email': 'showEmail',
      "" : "index",
      "especialidad": "especialidad",
      "sede": "sede",
      "sede/doctores/:sede_id": "verSedeDoctores",
      "sede/responsables/:sede_id": "verSedeResponsables",
      "*actions" : "index"
    },
    showEmail: function(email) {
        // show the email
      alert(email);
    },
    especialidad: function() {
      var especialidadView = new EspecialidadView({});
      especialidadView.render();
      especialidadView.mostrarTabla();
    },
    sede: function() {
      var sedeView = new SedeView({});
      tipoSedesCollection.llenarModels();
      sedeView.render();
      sedeView.mostrarTabla();
    },
    verSedeDoctores: function(sede_id) {
      $("#btnModal").click();
      sedeDoctorView.set("sede_id", sede_id);
      sedeDoctorView.render();
    },
    verSedeResponsables: function(sede_id) {
      $("#btnModal").click();
      sedeResponsableView.set("sede_id", sede_id);
      sedeResponsableView.render();
    },
    index: function() {
        // show the email
    },
});


var App = Marionette.Application.extend({
  region: '#body-app',
  onStart() {
    var router = new Router();
    Backbone.history.start();
  }
});

var myApp = new App();
myApp.start();
