var Router = Marionette.AppRouter.extend({
    routes: {
      'email/:email': 'showEmail',
      "" : "index",
      "especialidad": "especialidad",
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
