var Router = Marionette.AppRouter.extend({
    routes: {
      'email/:email': 'showEmail',
      "" : "index",
      "especialidad": "especialidad",
      "sede": "sede",
      "sede/doctores/:sede_id": "verSedeDoctores",
      "sede/responsables/:sede_id": "verSedeResponsables",
      "doctor": "doctor",
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
      sedeResponsableView.set("sede_id", sede_id);
      sedeResponsableView.llenarModelsSelect();
      sedeResponsableView.obtenerResponsables();
      sedeResponsableView.context.doctores = sedeResponsableView.doctoresSelect.toJSON();
      sedeResponsableView.context.telefono = sedeResponsableView.responsables.telefono;
      sedeResponsableView.context.director_id = sedeResponsableView.responsables.director_id;
      sedeResponsableView.context.doctor_turno_id = sedeResponsableView.responsables.doctor_turno_id;
      sedeResponsableView.render();
    },
    doctor: function(){
      var doctorView = new DoctorView({});
      doctorView.render();
      doctorView.mostrarTabla();
      
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
