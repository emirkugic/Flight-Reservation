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
				$("#signin-btn").prop("disabled", true);
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
				window.location.replace("index.html");
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
			if (XMLHttpRequest.responseJSON && XMLHttpRequest.responseJSON.message === "Email address already exists") {
			  UserService.displayError("Email address already exists", "signup-error");
			} else {
			  UserService.displayError("Failed to create user", "signup-error");
			}
		  },
		});
	  },
	  
};

$.validator.addMethod('regex', function (value, element, param) {
	return this.optional(element) || value.match(typeof param === 'string' ? new RegExp(param) : param);
}, 'Please enter a valid value');
