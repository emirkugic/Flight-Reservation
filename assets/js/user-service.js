var UserService = {
	init: function () {
		$("#login-form").validate({
			submitHandler: function (form, event) {
				event.preventDefault();
				$("#signin-btn").prop("disabled", true);
				var entity = Object.fromEntries(new FormData(form).entries());
				UserService.login(entity);
			},
		});

		$("#signup-form").validate({
			submitHandler: function (form, event) {
				event.preventDefault();
				$("#signup-btn").prop("disabled", true);
				var entity = Object.fromEntries(new FormData(form).entries());
				UserService.signup(entity);
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
				alert("Wrong email or password");
			},
		});
	},

	logout: function () {
		localStorage.clear();
		window.location.replace("login.html");
	},

	signup: function (entity) {
		$.ajax({
			url: "rest/users/signup",
			type: "POST",
			data: JSON.stringify(entity),
			contentType: "application/json",
			dataType: "json",
			success: function (result) {
				console.log(result);
				alert("User created successfully");
				window.location.replace("login.html?action=login");
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$("#signup-btn").prop("disabled", false);
				alert("Failed to create user");
			},
		});
	},
};
