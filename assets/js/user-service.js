var UserService = {
	init: function () {
		$("#login-form").validate({
			rules: {
				email: {
					required: true,
				},
				password: {
					required: true,
				},
			},
			messages: {
				email: {
					required: "Email is required",
				},
				password: {
					required: "Password is required",
				},
			},
			submitHandler: function (form, event) {
				event.preventDefault();
				$("#save-changes-btn").prop("disabled", true);
				var entity = Object.fromEntries(new FormData(form).entries());
				UserService.login(entity);
			},
		});

		$("#signup-form").validate({
			rules: {
				first_name: {
					required: true,
				},
				last_name: {
					required: true,
				},
				email: {
					required: true,
					email: true,
				},
				password: {
					required: true,
					minlength: 8,
					regex: /[!@#$%^&*]/,
				},
			},
			messages: {
				first_name: {
					required: "First name is required",
				},
				last_name: {
					required: "Last name is required",
				},
				email: {
					required: "Email is required",
					email: "Please enter a valid email address",
				},
				password: {
					required: "Password is required",
					minlength: "Password must be at least 8 characters long",
					regex: "Password must contain at least one special character",
				},
			},
			submitHandler: function (form, event) {
				event.preventDefault();
				$("#signup-btn").prop("disabled", true);
				var entity = Object.fromEntries(new FormData(form).entries());
				UserService.signup(entity);
			},
		});

		$("#account-form").validate({
			rules: {
				first_name: {
					required: true,
				},
				last_name: {
					required: true,
				},
				email: {
					required: true,
					email: true,
				},
				password: {
					required: true,
					minlength: 8,
					regex: /[!@#$%^&*]/,
				},
			},
			messages: {
				first_name: {
					required: "First name is required",
				},
				last_name: {
					required: "Last name is required",
				},
				email: {
					required: "Email is required",
					email: "Please enter a valid email address",
				},
				password: {
					required: "Password is required",
				},
			},
			submitHandler: function (form, event) {
				event.preventDefault();
				$("#save-changes-btn").prop("disabled", true);
				var entity = Object.fromEntries(new FormData(form).entries());
				UserService.updateUser(entity);
			},
		});
	},

	displayError: function (message, targetId) {
		var errorHtml = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Error!</strong> ${message}
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>`;

		$(`#${targetId}`).html(errorHtml);
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
				
				var redirectUrl = localStorage.getItem('redirectUrl') || 'index.html';
				localStorage.removeItem('redirectUrl'); 
				window.location.href = redirectUrl;
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$("#signin-btn").prop("disabled", false);
				UserService.displayError("Wrong email or password", "login-error");
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
				if (
					XMLHttpRequest.responseJSON &&
					XMLHttpRequest.responseJSON.message === "Email address already exists"
				) {
					UserService.displayError(
						"Email address already exists",
						"signup-error"
					);
				} else {
					UserService.displayError("Failed to create user", "signup-error");
				}
			},
		});
	},

	populateAccountForm: function () {
		var token = localStorage.getItem("user_token");
		var user = Utils.parseJwt(token);
		var id = user.id;

		$.ajax({
			url: "rest/users/account/" + id,
			type: "GET",
			beforeSend: function (xhr) {
				xhr.setRequestHeader(
				  "Authorization",
				  localStorage.getItem("user_token")
				);
			},
			contentType: "application/json",
			dataType: "json",
			success: function (result) {
				$("#first_name").val(result.first_name);
				$("#last_name").val(result.last_name);
				$("#email").val(result.email);
				$("#password").val(result.password);
				$("#user_name").text(result.first_name + " " + result.last_name);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				UserService.displayError(
					"Failed to retrieve account information",
					"account-error"
				);
			},
		});
	},

	updateUser: function (entity) {
		var token = localStorage.getItem("user_token");
		var user = Utils.parseJwt(token);
		var id = user.id;

		$.ajax({
			url: "rest/users/account/" + id,
			type: "PUT",
			beforeSend: function (xhr) {
				xhr.setRequestHeader(
				  "Authorization",
				  localStorage.getItem("user_token")
				);
			  },
			data: JSON.stringify(entity),
			contentType: "application/json",
			dataType: "json",
			success: function (result) {
				alert("User updated successfully");
				UserService.populateAccountForm();
				window.location.reload();
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$("#save-changes-btn").prop("disabled", false);
				if (
					XMLHttpRequest.responseJSON &&
					XMLHttpRequest.responseJSON.message === "Email address already exists"
				) {
					UserService.displayError(
						"Email address already exists",
						"account-error"
					);
				} else {
					UserService.displayError("Failed to update user", "account-error");
				}
			},
		});
	},
};

$.validator.addMethod(
	"regex",
	function (value, element, param) {
		return (
			this.optional(element) ||
			value.match(typeof param === "string" ? new RegExp(param) : param)
		);
	},
	"Please enter a valid value"
);
