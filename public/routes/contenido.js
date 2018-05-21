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
      sexosCollection.llenarModels();
      especialidadesCollection.llenarModels();
      sedeDoctorView.set("sede_id", sede_id);
      sedeDoctorView.render();
      sedeDoctorView.mostrarDoctores();
    },
    verSedeResponsables: function(sede_id) {
      $("#btnModal").click();
      console.log(sedeResponsableView.get("sede_id"));
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
