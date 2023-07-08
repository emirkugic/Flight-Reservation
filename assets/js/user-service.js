var UserService = {
    init: function () {
      var token = localStorage.getItem("user_token");
      if (token) {
        window.location.replace("index.html");
      }
      $("#login-form").validate({
        submitHandler: function (form) {
          $("#signin-btn").prop("disabled", true);
          var entity = Object.fromEntries(new FormData(form).entries());
          UserService.login(entity);
        },
      });
    },
    login: function (entity) {
      $.ajax({
        url: "rest/users/login",
        type: "POST",
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function (result) {
          console.log(result);
          localStorage.setItem("user_token", result.token);
          window.location.replace("index.html");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          $("#signin-btn").prop("disabled", false);
          alert("Wrong username or password");
        },
      });
    },
  
    logout: function () {
      localStorage.clear();
      window.location.replace("login.html");
    },
  };

  UserService.init();