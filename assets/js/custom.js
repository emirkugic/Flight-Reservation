$(document).ready(function() {

  $("main#spapp > section").height($(document).height() - 60);
    
  $(window).on('resize', function(){
      $("main#spapp > section").height($(document).height() - 60);
  });

  var app = $.spapp({pageNotFound : 'error_404'}); // initialize

  // define routes
  app.route({view: 'hotels', load: 'hotels.html', onCreate: function() {}, onReady: function() {} });
  app.route({view: 'cars', load: 'cars.html', onCreate: function() {}, onReady: function() {} });
  app.route({view: 'signup', load: 'signup.html', onCreate: function() {}, onReady: function() {} });
  app.route({view: 'signin', load: 'login.html', onCreate: function() {}, onReady: function() {} });  
  app.route({view: 'homepage', load: 'homepage.html', onCreate: function() {}, onReady: function() {} });
  app.route({view: 'discover', load: 'discover.html', onCreate: function() {}, onReady: function() {} });

  // run app
  app.run();

});